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
        // $userDn = auth()->user()->dn;
        // $groups = \Adldap::search()
        //     ->groups()
        //     ->select('dn')
        //     ->in("OU=Dept. Informatica,ou=TECNOL,dc=tecnol,dc=es")
        //     ->rawFilter("(member=$userDn)")
        //     ->get();
        // // return $groups;
        // $passwordIDs = [];
        // foreach($groups as $key => $group){
        //     $ids = Share::where('name', $group['distinguishedname'][0])
        //         ->pluck('password_id');
        //     foreach($ids as $key => $id){
        //         $passwordIDs[] = $id;
        //     }
        // }
        $mail = Auth::user()->email;
        return \Adldap::search()
            ->user()
            ->rawFilter("(mail: $mail)")
            ->get();
    }
}
