<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Adldap\Laravel\Facades\Adldap;
use App\Models\Share;
use App\Models\Password;
use App\Models\User;

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
        $index = 0;
        $sessionMembers = session()->get('groups');
        $dn = "CN=Ferran,OU=Dept. Informatica,OU=TECNOL,DC=tecnol,DC=es";
        $members = [];
        return $sessionMembers[0]['cn'];

        foreach($sessionMembers[$index]['member'] as $index => $member){
            $ldapMember = \Adldap::search()
                ->users()
                ->select('displayname')
                ->rawfilter("(distinguishedname=$member)")
                ->first();
            if($ldapMember) $members[] = $ldapMember['displayname'][0];
        }
    }
}
