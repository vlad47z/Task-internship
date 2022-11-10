<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\UpdateProfileRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    //Route to profile dashboard / user panel
    public function index() {
        return view('users.index')->with('users', User::all());
    }

    
    //Profile edit - modify username
    public function edit() {
        return view('users.edit')->with('user', auth()->user());
    }

    public function update(UpdateProfileRequest $request) {
        $request->validate([
            'name' => 'required|unique:users|min:3|max:20|alpha_num',
        ]);
        
        $user = auth()->user();
        $user->update([
            'name' => $request->name,
        ]);
        return back()->with('success', 'Datele profilului au fost modificate cu succes!');
    }
    
    //Profile edit - change password
    public function changePassword() {
        
        return view('users/change-password');
        }

    public function updatePassword(Request $request) {
            // Validation
            $request->validate([
                'old_password' => 'required',
                'new_password' => 'required|confirmed',
            ]);
    
    
            // Actual password for user
            if(!Hash::check($request->old_password, auth()->user()->password)){
                return back()->with("error", "Actual password is wrong!");
            }
    
    
            // New password for user
            User::whereId(auth()->user()->id)->update([
                'password' => Hash::make($request->new_password)
            ]);
            //Commit
            return back()->with("status", "User password has been succesfully modified!");
    }
}