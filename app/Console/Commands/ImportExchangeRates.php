<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\ExchangeRate;

class ImportExchangeRates extends Command
{
    protected $signature = 'import:exchange-rates
                            {--limit= : Limit the number of records to import}
                            {--source=url : Specify the data source (url or file)}';
    protected $description = 'Import exchange rates from ECB';

    protected $defaultRecordLimit = 10;
    protected $xmlFilePath = 'xml/eurofxref-hist.xml';
    protected $xmlUrl = 'https://www.ecb.europa.eu/stats/eurofxref/eurofxref-hist.xml';

    public function handle()
    {
        $this->info('Starting import...');

        $limit = $this->option('limit') ? (int) $this->option('limit') : null;
        $source = $this->option('source') ? $this->option('source') : 'url';

        try {
            if ($source === 'file') {
                $this->importFromFile($limit);
            } else {
                $this->importFromUrl($limit);
            }
        } catch (\Exception $e) {
            $this->error('An error occurred: ' . $e->getMessage());
        }
    }

    protected function importFromFile($limit)
    {
        $path = public_path($this->xmlFilePath);

        if (file_exists($path)) {
            $xml = simplexml_load_file($path);
            $this->importXmlData($xml, $limit);
        } else {
            $this->error('Failed to find the XML file.');
        }
    }

    protected function importFromUrl($limit)
    {
        $response = Http::timeout(60)->get($this->xmlUrl);

        if ($response->successful()) {
            $xml = simplexml_load_string($response->body());
            $this->importXmlData($xml, $limit);
        } else {
            $this->error('Failed to retrieve data.');
        }
    }

    protected function importXmlData($xml, $limit)
    {
        $recordCount = 0;

        foreach ($xml->Cube->Cube as $day) {
            if ($limit && $recordCount >= $limit) {
                break;
            }

            $date = (string)$day['time'];

            foreach ($day->Cube as $rate) {
                if ($limit && $recordCount >= $limit) {
                    break;
                }

                $currency = (string)$rate['currency'];
                $rateValue = (float)$rate['rate'];

                ExchangeRate::updateOrCreate(
                    ['date' => $date, 'currency' => $currency],
                    ['rate' => $rateValue]
                );

                $recordCount++;
            }
        }

        $this->info('Import completed successfully. Total records inserted: ' . $recordCount);
    }
}
