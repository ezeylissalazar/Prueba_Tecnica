<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssociateActivityRequest;
use App\Http\Requests\TypeActivityRequest;
use App\Models\ActivityByCompany;
use App\Models\Company;
use App\Models\TypeActivity;
use App\Repositories\DatabaseRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TypeActivityController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->only(['name']);

        $type_of_activity = TypeActivity::filter($filters)->get();

        return view('type_of_activity.index', compact('type_of_activity'));
    }

    public function create()
    {
        $users = DatabaseRepository::getUsers();

        return view('type_of_activity.create', compact('users'));
    }

    public function store(TypeActivityRequest $request)
    {
        try {
            DB::beginTransaction();
            $solpago = new TypeActivity();
            $solpago->name = $request->name;
            $solpago->save();
            DB::commit();

            return redirect()->route('typeActivity')->with('success', 'Successfully Registered Activity');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function associate_activity($id)
    {
        $companies = Company::find($id);
        $activities = TypeActivity::all();
        $associatedActivities = $companies->associatedActivities->pluck('id')->toArray();

        return view('type_of_activity.associate', compact('companies', 'activities', 'associatedActivities'));
    }

    public function associate_activity_store(AssociateActivityRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            ActivityByCompany::where('id_company', $id)->delete();
            $activities = $request['activities'];

            foreach ($activities as $activityId) {
                ActivityByCompany::create([
                    'id_company' => $id,
                    'id_activity' => $activityId,
                ]);
            }
            DB::commit();
            return redirect()->route('companies')->with('success', 'Successfully Associated Activities');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to associate activities. ' . $e->getMessage());
        }
    }
}
