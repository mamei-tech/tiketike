<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\User;
use Socialite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Traits\HasRoles;

class SocialAuthController extends Controller
{
    // Metodo encargado de la redireccion a Facebook
    public function redirectToProvider($provider)
    {
    	if ($provider == 'facebook') {
    		return Socialite::driver($provider)->fields(['name','last_name','email','picture'])->redirect();
    	}
    	return Socialite::driver($provider)->redirect();
    }

    // Metodo encargado de obtener la información del usuario
    public function handleProviderCallback($provider)
    {
        // Aki obtengo los datos del usuario
        if ($provider == 'facebook') {
        	$social_user = Socialite::driver($provider)->fields(['name','last_name','email','picture'])->stateless()->user();
        }else {
        	$social_user = Socialite::driver($provider)->stateless()->user();
        }

        // Comprobamos si el usuario ya existe
        if ($user = User::where('email', $social_user->email)->first()) {
            return $this->authAndRedirect($user); // Login y redireccion
        } else {
        	if ($provider == 'facebook') {
            // En caso de que no exista creamos un nuevo usuario con sus datos.
            //Validating that user has an email
            $email = $social_user->email;
            if ($email == '' or $email == null)
                $email = $social_user->name."@tiketikes.com";
            $user = User::create([
                'name' => $social_user->name,
                'lastname'=>$social_user->user['last_name'],
                'email' => $email,
            ]);
            $user->syncRoles(2);
            $user->addMediaFromUrl($social_user->avatar)->toMediaCollection('avatars','avatars');

            return $this->authAndRedirect($user); // Login y redireccion
        }else {
        	// En caso de que no exista creamos un nuevo usuario con sus datos.
            //Validating that user has an email
            $email = $social_user->email;
            if ($email == '' or $email == null)
                $email = $social_user->name."@tiketikes.com";
            $user = User::create([
                'name' => $social_user->name,
                'email' => $email,
            ]);
            $user->syncRoles(2);
            $user->addMediaFromUrl($social_user->avatar)->toMediaCollection('avatars','avatars');

            return $this->authAndRedirect($user); // Login y redireccion
        }
        }
    }

    // Login y redireccion
    public function authAndRedirect($user)
    {

        Auth::login($user);

        return redirect()->to(route('profile.edit',Auth::user()->id));
    }
}
