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
        $pet = Pet::with('user')->findOrFail($id);
    
        $healths = Health::where('pet_id', $id)->get();
        $visits = Visit::where('pet_id', $id)->get();
    
        return view('admin.index', [
            'pet' => $pet,
            'healths' => $healths,
            'visits' => $visits,
        ]);
    }

    public function search(Request $request)
    {
        $email = $request->input('email');
        $name = $request->input('name');
        $petName = $request->input('pet_name');
        $birthDate = $request->input('birth_date');
    
        $query = User::with('pets');
    
        if (!empty($email)) {
            $query->where('email', 'LIKE', "%{$email}%");
        }
    
        if (!empty($name)) {
            $query->where('name', 'LIKE', "%{$name}%");
        }
    
        if (!empty($petName)) {
            $query->whereHas('pets', function ($q) use ($petName) {
                $q->where('name', 'LIKE', "%{$petName}%");
            });
        }
    
        if (!empty($birthDate)) {
            $query->whereHas('pets', function ($q) use ($birthDate) {
                $q->where('birth_date', $birthDate);
            });
        }
    
        $users = $query->get();
    
        return view('admin.dashboard', [
            'users' => $users,
        ]);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();

        return redirect()->route('login');
    }
}