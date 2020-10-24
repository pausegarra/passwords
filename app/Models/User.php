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
        return \Adldap::search()
            ->users()
            ->select('dn', 'displayname', 'samaccountname')
            ->rawFilter("(memberof=CN=g_tecnol_todos,OU=Dept. Informatica,OU=TECNOL,DC=tecnol,DC=es)")
            ->get();
    }

    public static function getAuthUserGroups(){
        $userDn = auth()->user()->dn;
        return \Adldap::search()
            ->groups()
            ->select('dn', 'cn', 'member')
            ->in("OU=Dept. Informatica,ou=TECNOL,dc=tecnol,dc=es")
            ->rawFilter("(member=$userDn)")
            ->get();
    }
}
