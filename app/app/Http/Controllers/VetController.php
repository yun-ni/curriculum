<?php

namespace App\Http\Controllers;

use App\User;
use App\Pet;
use App\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VetController extends Controller
{
    public function dashboard()
    {
        $users = User::with('pets')->get();
    
        return view('vets.dashboard', [
            'users' => $users,
        ]);
    }

    public function show(int $id)
    {
        $user = User::with('pets')->findOrFail($id);
    
        return view('vets.show', [
            'pets' => $user->pets,
        ]);
    }

    public function index(int $id)
    {
        $pet = Pet::findOrFail($id);
        $visits = Visit::where('pet_id', $id)->get();
    
        return view('vets.index', [
            'pet' => $pet,
            'visits' => $visits,
        ]);
    }

    public function pdf(int $id)
    {
        $pet = Pet::findOrFail($id);
        $visits = Visit::where('pet_id', $id)->get();
    
        return view('vets.pdf', [
            'pet' => $pet,
            'visits' => $visits,
        ]);
    }

    public function logout()
    {
        Auth::guard('vet')->logout();

        return redirect()->route('login');
    }
}