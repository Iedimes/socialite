<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class LoginController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {

            $user = Socialite::driver('google')->user();
            //dd($user->id);
            // $user = User::where('email', $googleUser->getEmail())->first();
            $finduser = User::where('google_id', $user->id)->first();
            //dd($finduser);

            if ($finduser) {
                //if the user exists, login and show dashboard
                Auth::login($finduser);
                //dd(Auth::login);
                return redirect()->intended('home'); // Redirige a la página deseada
            } else {
                //return "sale por else";
                $finduser = User::where('email', $user->email)->first();

                if ($finduser) {
                    //dd('Correo ya se registro con otra red social');
                    //return ['redirect' => url('login'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
                    return redirect('login')->withErrors(['Correo ya se registro con otra red social']);
                } else {
                    $newUser = User::create([
                        'name' => $user->name,
                        'email' => $user->email,
                        'google_id' => $user->id,
                        'password' => encrypt('')
                    ]);

                    $newUser->save();
                    //login as the new user
                    Auth::login($newUser);
                    // go to the dashboard
                    // return redirect('/home');
                    return redirect()->intended('home'); // Redirige a la página deseada
                }
            }
        } catch (Exception $e) {
         dd($e->getMessage());
        }
}

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/'); // Redirige a la página de inicio después de cerrar sesión
    }
}
