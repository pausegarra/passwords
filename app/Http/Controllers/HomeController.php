<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Adldap\Laravel\Facades\Adldap;
use App\Models\Share;
use App\Models\Password;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
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
        // $groups = collect(session()->get('groups')[0]['member']);
        // return $groups->filter(function($val,$key){
        //     return strpos($val, 'P') !== false;
        // });
        return session()->get('users_ad');
    }
}
