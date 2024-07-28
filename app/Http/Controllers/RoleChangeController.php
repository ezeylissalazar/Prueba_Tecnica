<?php

namespace App\Http\Controllers;

use App\Mail\RoleChangeRequested;
use App\Models\Request as ModelsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class RoleChangeController extends Controller
{
    public function requestChange(Request $request)
    {
        try {
            DB::beginTransaction();
            $user = auth()->user();
            ModelsRequest::create([
                'id_user' => $user->id,
                'status' => 0,
            ]);
            // Enviar correo de solicitud de cambio de rol
            Mail::to('pruebatecnica717@gmail.com')->send(new RoleChangeRequested($user));
            DB::commit();

            return redirect()->route('home')->with('success', 'Role Change Request Submitted');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }
}
