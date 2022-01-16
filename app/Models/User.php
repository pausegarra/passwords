<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function getAdUsers(){
        $users = \Adldap::search()
            ->users()
            ->select('dn', 'displayname', 'samaccountname')
            ->rawFilter("(memberof=CN=acl_passwords,OU=PASSWORDS,OU=ACL," . env('LDAP_BASE_DN') . ")")
            ->get();
        foreach($users as $key => $usuario) if(strpos($usuario['displayname'][0], auth()->user()->name) !== false) unset($users[$key]);
        return $users;
    }

    public static function getAuthUserGroups(){
        $userDn = auth()->user()->dn;
        return \Adldap::search()
            ->groups()
            ->select('dn', 'cn', 'member')
            ->in("OU=SHARE_GROUPS,OU=PASSWORDS,OU=ACL," . env('LDAP_BASE_DN') . "")
            ->rawFilter("(member=$userDn)")
            ->get();
    }

    public static function canBeGod(){
        $mail = auth()->user()->email;
        $user = \Adldap::search()
            ->users()
            ->select('dn', 'displayname', 'samaccountname')
            ->rawFilter("(&(memberof=CN=acl_passwords_god,OU=PASSWORDS,OU=ACL," . env('LDAP_BASE_DN') . ")(mail=$mail))")
            ->get();
        return $user->count();
    }
}
