<?php

namespace App\Http\Controllers;

use App\Enums\CompanieStatus;
use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use App\Models\User;
use App\Repositories\DatabaseRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{

    public function index(Request $request)
    {
        $filters = $request->only(['name', 'owner', 'status', 'withoutActivities']);
        $companies = Company::with('user')->filter($filters)->get();

        return view('companies.index', compact('companies'));
    }



    public function create()
    {
        $users = DatabaseRepository::getUsers();

        return view('companies.create', compact('users'));
    }

    public function store(CompanyRequest $request)
    {
        try {
            DB::beginTransaction();
            $user = Auth::user();
            $role = User::getRoleByUserId($user->id);
            if ($role == 'admin') {
                $owner = $request->owner;
            } else {
                $owner = $user->id;
            }
            if (Company::where('id_user', $owner)->exists()) {
                DB::commit();

                return redirect()->route('companies')->with('error', 'User Already Own a Registered Company');
            } else {
                $solpago = new Company;
                $solpago->name = $request->name;
                $solpago->document_type = $request->document_type;
                $solpago->document_number = $request->document_number;
                $solpago->id_user = $owner;
                $solpago->status = $request->status;
                $solpago->save();
                DB::commit();

                return redirect()->route('companies')->with('success', 'Successfully Registered Company');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function activate($id)
    {
        try {
            DB::beginTransaction();
            $request = Company::find($id);

            if ($request) {
                $request->status = CompanieStatus::Active->value;
                $request->save();
                DB::commit();

                return redirect()->route('companies')->with('success', 'Company Successfully Activated');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function desactivate($id)
    {
        try {
            DB::beginTransaction();
            $request = Company::find($id);

            if ($request) {
                $request->status = CompanieStatus::Inactive->value;
                $request->save();
                DB::commit();

                return redirect()->route('companies')->with('success', 'Company Successfully Inactivated');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }
}
