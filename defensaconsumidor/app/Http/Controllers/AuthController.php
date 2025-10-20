<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Solo un usuario admin (hardcodeado por ahora)
        $adminEmail = 'admin@example.com';
        $adminPassword = 'password'; // Cambia esto en producción

        if ($request->email === $adminEmail && Hash::check($request->password, Hash::make($adminPassword))) {
            // Crear usuario si no existe
            $user = \App\Models\User::firstOrCreate(
                ['email' => $adminEmail],
                [
                    'name' => 'Admin',
                    'password' => Hash::make($adminPassword),
                    'is_admin' => true,
                ]
            );

            Auth::login($user);

            return redirect()->route('juridico.index')->with('success', '¡Bienvenido, administrador!');
        }

        return back()->withErrors(['email' => 'Credenciales inválidas.']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('dashboard')->with('success', 'Has cerrado sesión.');
    }
}