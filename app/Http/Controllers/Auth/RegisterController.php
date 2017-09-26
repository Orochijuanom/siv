<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'tipouser_id' => 'required|numeric',
            'tipodocumento_id' => 'required|numeric',
            'numero_documento' => 'required|numeric',
            'nombres' => 'required|max:255',
            'apellidos' => 'required|max:255',
            'fecha_nacimiento' => 'required|date',
            'genero' => 'required',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'tipouser_id' => $data['tipouser_id'],
            'tipodocumento_id' => $data['tipodocumento_id'],
            'numero_documento' => $data['numero_documento'], 
            'nombres' => $data['nombres'], 
            'apellidos' => $data['apellidos'], 
            'fecha_nacimiento' => $data['fecha_nacimiento'], 
            'genero' => $data['genero'], 
            'email' => $data['email'], 
            'password' => bcrypt($data['password']),
        ]);
    }
}
