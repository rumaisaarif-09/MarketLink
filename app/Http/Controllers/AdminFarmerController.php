<?php

namespace App\Http\Controllers;

use App\Models\User;

class AdminFarmerController extends Controller
{
    public function index()
    {
        $farmers = User::latest()->get();

        return view('admin.farmers.index', compact('farmers'));
    }
}
