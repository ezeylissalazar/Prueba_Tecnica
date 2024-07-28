@extends('layouts.app')

@section('content')
    <div class="container">
        @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-1"></i>
                {{ Session::get('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif(Session::has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-1"></i>
                {{ Session::get('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <h1 class="mb-4">Currency Conversion</h1>
        <form action="{{ route('convert') }}" method="GET">
            <div class="form-group">
                <label for="from">From Currency</label>
                <select name="from" id="from" class="form-control @error('from') is-invalid @enderror">
                    <option value="" disabled selected>Select Currency</option>
                    @foreach ($currencies as $currency)
                        <option value="{{ $currency }}"{{ old('from') == $currency ? 'selected' : '' }}>
                            {{ $currency }}</option>
                    @endforeach
                </select>
                @error('from')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="to">To Currency</label>
                <select name="to" id="to" class="form-control @error('to') is-invalid @enderror">
                    <option value="" disabled selected>Select Currency</option>
                    @foreach ($currencies as $currency)
                        <option value="{{ $currency }}"{{ old('to') == $currency ? 'selected' : '' }}>
                            {{ $currency }}</option>
                    @endforeach
                </select>
                @error('to')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="amount">Amount</label>
                <input type="text" name="amount" id="amount"
                    class="form-control @error('amount') is-invalid @enderror" placeholder="Amount"
                    value="{{ old('amount') }}"  oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                @error('amount')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary mt-3">Convert</button>
        </form>

        @if (session('result'))
            <div class="mt-4">
                <h2>Conversion Result</h2>
                <p><strong>Rate:</strong> {{ session('result')['rate'] }}</p>
                <p><strong>Converted Amount:</strong> {{ session('result')['converted_amount'] }}</p>
            </div>
        @endif

    </div>
@endsection
