<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Password;
use App\Models\User;
use App\Models\Share;

class PasswordComponent extends Component
{
    public $name, $inputPassword, $platform, $username, $link, $usersToShare = [], $groupsToShare = [],$search;

    protected $listeners = [
        'getMembers' => 'getMembers'
    ];

    protected $rules = [
        'name'          => 'required',
        'username'      => 'required',
        'inputPassword' => 'required',
    ];

    public function savePassword(){
        $this->validate();
        $password = Password::create([
            'user_id'   => auth()->user()->id,
            'name'      => $this->name,
            'username'  => $this->username,
            'password'  => encrypt($this->inputPassword),
            'platform'  => (isset($this->platform)) ? $this->platform : '-',
            'link'      => (isset($this->link)) ? $this->link : '-',
        ]);
        createShare($password->id, 'user', $this->usersToShare);
        createShare($password->id, 'group', $this->groupsToShare);
        $this->reset();
    }

    public function delete($id){
        Password::destroy($id);
    }

    public function getMembers($groupDN, $index){
        $data = getADMembers($groupDN, $index);
        $this->emit('showMembers', $data);
    }

    public function render()
    {
        $usersIDS = Share::where('name', auth()->user()->dn)
            ->pluck('password_id');
        return view('livewire.passwords.password-component', [
            'passwords'     => Password::where('user_id', auth()->user()->id)
                ->orWhereIn('id', $usersIDS)
                ->orWhereIn('id', getGroupIDs())
                ->get(),
        ]);
    }
}
