<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Socialite;

class SocialController extends Controller
{
     /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('google')->user();
        $createUser = User::firstOrCreate([
        	'email' => $user->getEmail()
        ],[
        	'name' => $user->getName()
        ]);

        auth()->login($createUser);

        return redirect('http://localhost/PlanDeAccion/public/plandeaccion/plan')->with('alert',"Bienvenido");

        // $user->token;
    }
}
