<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Password extends Model
{
    use HasFactory;

    protected $fillable = ['name','platform','username','password','link','user_id','notas'];

    public $usersIDS,$search;

    public function scopeUserPasswords($query, $search = ""){
        $this->usersIDS = Share::where('name', auth()->user()->dn)
            ->pluck('password_id');
        $this->search = $search;
        return $query->where('user_id', auth()->user()->id)
            ->where(function($query){
                $query->whereIn('id', $this->usersIDS)
                    ->orWhereIn('id', getGroupIDs())
                    ->get();
            })->where(function($query){
                $query->where('name', 'like', "%$this->search%")
                    ->orWhere('platform', 'like', "%$this->search%")
                    ->orWhere('username', 'like', "%$this->search%")
                    ->get();
            });
    }
}
