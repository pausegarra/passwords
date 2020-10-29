<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Password;
use App\Models\Share;

class PasswordView extends Component
{
    public $password_id,$name,$username,$platform,$password,$link,$usersToShare = [],$groupsToShare = [],$user_id,$inputPassword, $searchUsers, $searchGroups, $notas;

    protected $listeners = [
        'getMembers'       => 'getMembers',
    ];

    public function mount($id){
        $this->password_id = $id;
        $password      = Password::where('id',$this->password_id)->firstOrFail();
        $usersToShare  = getShared('user',$this->password_id);
        $groupsToShare = getShared('group',$this->password_id);
        $this->fill([
            'name'          => $password->name,
            'username'      => $password->username,
            'platform'      => $password->platform,
            'password'      => $password->password,
            'link'          => $password->link,
            'notas'         => $password->notas,
            'user_id'       => $password->user_id,
            'usersToShare'  => $usersToShare,
            'groupsToShare' => $groupsToShare,
        ]);
    }

    public function getMembers($groupDN, $index){
        $data = getADMembers($groupDN, $index);
        $this->emit('showMembers', $data);
    }

    public function delete(){
        Password::destroy($this->password_id);
        return redirect('/passwords');
    }

    public function changeGod($status){
        changeGod($status);
    }

    public function savePassword(){
        $oldPass = Password::where('id',$this->password_id)
            ->firstOrFail();
        $oldPass->fill([
            'name'     => $this->name,
            'username' => $this->username,
            'link'     => $this->link,
            'platform' => $this->platform,
            'notas'    => $this->notas,
        ]);
        if(strlen($this->inputPassword) > 0){
            $oldPass->password = encrypt($this->inputPassword);
            $this->password    = $oldPass->password;
            $this->reset('inputPassword');
        }
        $oldPass->save();
        Share::where('password_id',$this->password_id)
            ->delete();
        createShare($this->password_id, 'user', $this->usersToShare);
        createShare($this->password_id, 'group', $this->groupsToShare);
    }

    public function render()
    {
        return view('livewire.passwords.password-view');
    }
}
