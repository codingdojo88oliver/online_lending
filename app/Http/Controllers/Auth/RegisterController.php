<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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

    protected function rules($data)
    {
      $rules = [
          'first_name'  => 'required|max:255',
          'last_name'   => 'required|max:255',
          'email'       => 'required|email|max:255|unique:users',
          'password'    => 'required|min:6|confirmed',
      ];

      if($data['type'] == "lender") {
          $rules['money'] = 'required';
      }

      elseif($data['type'] == "borrower") {
          $rules['money']       = 'required';
          $rules['purpose']     = 'required';
          $rules['description'] = 'required';
      }

      return $rules;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, $this->rules($data));
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'first_name'    => $data['first_name'],
            'last_name'     => $data['last_name'],
            'email'         => $data['email'],
            'password'      => bcrypt($data['password']),
        ]);

        if($data['type'] == "lender") {
            $user->lender()->create([
              'money'       => $data['money'],
            ]);
        }

        else if($data['type'] == "borrower") {
            $user->borrower()->create([
              'money'       => $data['money'],
              'purpose'     => $data['purpose'],
              'description' => $data['description'],
              'raised'      => 0,
            ]);
        }

        $this->setRedirectTo($data, $user);

        return $user;
    }

    protected function setRedirectTo($data, $user)
    {
      $this->redirectTo = $data['type'] . 's/' . $user->id;
    }
}
