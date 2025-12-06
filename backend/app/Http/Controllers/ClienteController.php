<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ClienteController extends Controller
{
    public function index()
    {
        if (!auth()->check() || !auth()->user()->is_admin) { abort(403); }
        
        $clientes = User::where('is_admin', false)->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.clientes.index', compact('clientes'));
    }

    public function toggleVerification(User $user)
    {
        if (!auth()->check() || !auth()->user()->is_admin) { abort(403); }

        if ($user->email_verified_at) {
            $user->email_verified_at = null;
        } else {
            $user->email_verified_at = Carbon::now();
        }

        $user->save();

        return response()->json([
            'is_verified' => $user->email_verified_at ? true : false,
        ]);
    }
}