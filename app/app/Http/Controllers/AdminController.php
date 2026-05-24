<?php

namespace App\Http\Controllers;

use App\User;
use App\Pet;
use App\Health;
use App\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        $users = User::with('pets')->get();
    
        return view('admin.dashboard', [
            'users' => $users,
        ]);
    }

    public function show(int $id)
    {
        $user = User::with('pets')->findOrFail($id);
    
        return view('admin.show', [
            'pets' => $user->pets,
        ]);
    }

    public function index(int $id)
    {
        $pet = Pet::findOrFail($id);
        $healths = Health::where('pet_id', $id)->get();
        $visits = Visit::where('pet_id', $id)->get();
    
        return view('admin.index', [
            'pet' => $pet,
            'healths' => $healths,
            'visits' => $visits,
        ]);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();

        return redirect()->route('login');
    }
}

