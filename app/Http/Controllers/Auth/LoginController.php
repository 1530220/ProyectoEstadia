<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {
        return view('auth.login');
    }
  
  /*public function verificar_type(Request $request){
       $user = DB::table('siita_db.users as users')
            ->select(
                'users.email'
            )
            ->where('users.email', '=', $request->email)
         ->where('users.type','!=',2)
         ->where('users.type','!=',4)
         ->where('users.type','!=',6)
         ->where('users.type','!=',7)
            ->first();

        //Se retorna una respuesta codificada con JSON
        return response()->json(['response'=>$user]);
  }*/
}
