<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Adldap\Laravel\Facades\Adldap;
use App\Models\Share;
use App\Models\Password;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public $usersIDS;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $passwords = file_get_contents('old_passwords_2.json');
        // $passwords = json_decode($passwords, true);
        // $shareDN   = 'CN=MK,OU=SHARE_GROUPS,OU=passwords,OU=_ACL,OU=TECNOL,DC=tecnol,DC=es';
        // foreach($passwords as $key => $password){
        //     Password::create([
        //         'user_id'  => auth()->user()->id,
        //         'name'     => $password['platform'],
        //         'platform' => '',
        //         'username' => $password['username'],
        //         'password' => encrypt($password['password']),
        //         'link'     => '',
        //         'notas'    => '',
        //     ]);
        // }

        // $passwords = Password::where('user_id',2)
        //     ->get();
        // foreach($passwords as $key => $password){
        //     $newPassword[$key]['platform'] = $password->plataforma;
        //     $newPassword[$key]['username'] = $password->usuario;
        //     $newPassword[$key]['password'] = decrypt($password->password);
        // }
        // file_put_contents('old_passwords_2.json',json_encode($newPassword));
    }
}
