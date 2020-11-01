<div class="row mb-5">
    <div class="col">
        <div class="card card-body">
            @include('livewire.passwords.passwords-form')
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th>Nombre</th>
                        <th>Plataforma</th>
                        <th>Usuario</th>
                        <th>Enalce</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @if($passwords->count() > 0)
                        @foreach ($passwords->filter(function($val,$key){
                            if(strlen($this->search) > 0){
                                return strpos($val,$this->search) !== false;
                            }else{
                                return true;
                            }
                        }) as $password)
                            <tr>
                                <td>{{ $password->name }}</td>
                                <td>{{ $password->platform }}</td>
                                <td>{{ $password->username }}</td>
                                <td>
                                    @if($password->link == '')
                                    @else
                                        <a href="{{ $password->link }}" class="btn btn-success btn-sm" target="_blank"><i class="fas fa-external-link-alt"></i></a>
                                    @endif
                                </td>
                                <td class="text-left">
                                    <button class="btn btn-primary btn-sm" wire:click="$emit('showPassword', '{{ decrypt($password->password) }}')"><i class="fas fa-eye"></i></button>
                                    <a class="btn btn-warning btn-sm" href="/passwords/{{ $password->id }}"><i class="fas fa-pen-square"></i></a>
                                    @if (isOwner($password->user_id) || auth()->user()->god_active)
                                        <button class="btn btn-danger btn-sm" wire:click="delete({{ $password->id }})"><i class="fas fa-trash-alt"></i></button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            {{-- {{ $passwords->links("pagination::bootstrap-4") }} --}}
            @if($passwords->count() == 0)
                <div class="row">
                    <div class="col">
                        <p class="text-center text-gray">No hay registros</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>