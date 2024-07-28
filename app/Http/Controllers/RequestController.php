<?php

namespace App\Http\Controllers;

use App\Enums\RequestStatus;
use App\Mail\ApproveRequest;
use App\Mail\DeclineRequest;
use App\Models\Request;
use App\Models\User;
use App\Repositories\DatabaseRepository;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;

class RequestController extends Controller
{
    public function index(HttpRequest $request)
    {
        $filters = $request->only(['name', 'status']);
        $requests = Request::filter($filters)->get();
        return view('request.index', compact('requests'));
    }

    public function approve($id)
    {
        try {
            DB::beginTransaction();
            $request = Request::find($id);

            if ($request) {
                $request->status = RequestStatus::Accepted->value;
                $request->save();

                $user = User::find($request->id_user);
                $email = $user->email;
                $role = Role::findByName('admin');
                $user->syncRoles($role);

                Mail::to($email)->send(new ApproveRequest($user));

                DB::commit();

                return redirect()->route('requests')->with('success', 'Application Successfully Approved');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }


    public function decline($id)
    {
        try {
            DB::beginTransaction();
            $request = Request::find($id);

            if ($request) {
                $request->status = RequestStatus::Reject->value;
                $request->save();

                $user = User::find($request->id_user);
                $email = $user->email;

                Mail::to($email)->send(new DeclineRequest($user));
                DB::commit();

                return redirect()->route('requests')->with('success', 'Request Successfully Rejected');
            }

            return redirect()->route('requests')->with('error', 'Request Not Found');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }
}
