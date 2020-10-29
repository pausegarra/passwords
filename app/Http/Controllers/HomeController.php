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
        echo auth()->user()->god_active;
        echo "<br>";
        $userMod = User::find(auth()->user()->id);
        $userMod->god_active = 0;
        $userMod->save();
        auth()->setUser($userMod);
        echo auth()->user()->god_active;
    }
}
