<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $usuarios = User::all();
        return view('usuarios.index', compact('usuarios'));
    }
}