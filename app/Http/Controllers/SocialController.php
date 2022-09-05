<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;
// use Socialite;
// use Laravel\Socialite\Contracts\Factory as Socialite;
// use Laravel\Socialite\Facades\Socialite as Socialite;
use Laravel\Socialite\Facades\Socialite;

use Exception;
use Illuminate\Support\Facades\Auth;

class SocialController extends Controller {

    
    //Google logger
    public function googleRedirect() {
        return Socialite::driver('google')->redirect();
    }

    public function loginWithGoogle() {
        try {
            $user = Socialite::driver('google')->user();
            dd($user);
            $isUser = User::where('google_id', $user->id)->first();

            if ($isUser) {
                Auth::login($isUser);
                return redirect('/posts');
            } else {
                $createUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id' => $user->id,
                    'password' => encrypt('user'),
                ]);
                Auth::login($createUser);
                return redirect('/posts');

            }
        } catch (Exception $exception) {
            dd($exception->getMessage());
        }
    }

    //Facebook logger
    public function facebookRedirect() {
        return Socialite::driver('facebook')->redirect();
    }

    public function loginWithFacebook() {
        try {
            $user = Socialite::driver('facebook')->user();
            dd($user);
            $isUser = User::where('fb_id', $user->id)->first();

            if ($isUser) {
                Auth::login($isUser);
                return redirect('/posts');
            } else {
                $createUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'fb_id' => $user->id,
                    'password' => encrypt('user'),
                ]);
                Auth::login($createUser);
                return redirect('/posts');

            }
        } catch (Exception $exception) {
            dd($exception->getMessage());
        }
    }
}
?>