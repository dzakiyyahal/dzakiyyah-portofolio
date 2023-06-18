<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MainController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $hero = Hero::first();
        $products = Product::all();

        return view('home', compact('user', 'hero', 'products'));
    }

    public function login()
    {
        return view('login');
    }

    public function loginProses(Request $request)
    {
        if (
            Auth::attempt([
                'email' => $request->get('email'),
                'password' => $request->get('password'),
            ])
        ) {
            $role = Auth::user()->role;

            if ($role == 'admin') {
                return redirect('/admin');
            } else {
                return redirect('/');
            }
        } else {
            return redirect('/login')->withErrors([
                'email' => 'Invalid credentials',
            ]);
        }
    }

    public function register()
    {
        return view('register');
    }

    public function registerProses(Request $request)
    {
        try {
            $user = new User();
            $user->name = $request->get('name');
            $user->email = $request->get('email');
            $user->password = Hash::make($request->get('password'));
            $user->save();

            return redirect('/login')->with('success', 'Registration successful. Please login to continue.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Registration failed. Please try again.');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login')->with('success', 'Logout successful');
    }
}