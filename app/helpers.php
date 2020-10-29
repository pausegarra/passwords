<?php

use App\Models\Share;
use App\Models\User;

function getADMembers($groupDN, $index){
    $sessionMembers = session()->get('groups')[$index];
    $members        = [];
    foreach($sessionMembers['member'] as $index => $member){
        $ldapMember = \Adldap::search()
            ->users()
            ->select('displayname')
            ->rawfilter("(distinguishedname=$member)")
            ->first();
        if($ldapMember) $members[] = $ldapMember['displayname'][0];
    }
    return [
        'members'   => $members,
        'groupName' => $sessionMembers['cn'],
    ];
}

function isOwner($user_id){
    return $user_id == auth()->user()->id;
}

function getShared($type,$password_id){
    return Share::where('type',$type)
        ->where('password_id',$password_id)
        ->pluck('name');
}

function getGroupIDs(){
    $userDn = auth()->user()->dn;
    $groups = session()->get('groups');
    $passwordIDs = [];
    foreach($groups as $key => $group){
        $ids = Share::where('name', $group['distinguishedname'][0])
            ->pluck('password_id');
        foreach($ids as $key => $id){
            $passwordIDs[] = $id;
        }
    }
    return $passwordIDs;
}

function createShare($passwordID, $type, $shareData){
    foreach($shareData as $key => $value){
        Share::create([
            'password_id'   => $passwordID,
            'type'          => $type,
            'name'          => $value, 
        ]);
    }
}

function getOwner($user_id){
    return User::where('id',$user_id)
        ->firstOrFail()['name'];
}

function changeGod($status){
    $userMod = User::find(auth()->user()->id);
    $userMod->god_active = $status;
    $userMod->save();
    auth()->setUser($userMod);
}