<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserEmail;

class UserEmailController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:user_emails,email',
        ]);

        UserEmail::create([
            'email' => $request->email,
        ]);

        return redirect()->back()->with('success', 'Correo guardado correctamente.');
    }
}
