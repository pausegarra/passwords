<form wire:submit.prevent="savePassword">
    <div class="row">
        <div class="col">
            <div class="row">
                <div class="col">
                    <h3>Datos de la contraseña</h3>
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-3">Nombre:</label>
                <input type="text" wire:model.lazy="name" id="name" class="form-control col-9">
                @error('name') <span class="text-danger font-weight-bold">{{ $message }}</span> @enderror
            </div>
            <div class="form-group row">
                <label for="username" class="col-3">Usuario:</label>
                <input type="text" wire:model.lazy="username" id="username" class="form-control col-9">
                @error('username') <span class="text-danger font-weight-bold">{{ $message }}</span> @enderror
            </div>
            <div class="form-group row">
                <label for="platform" class="col-3">Plataforma:</label>
                <input type="text" wire:model.lazy="platform" id="platform" class="form-control col-9">
            </div>
            <div class="form-group row">
                <label for="password" class="col-3">Contraseña:</label>
                <input type="password" wire:model.lazy="inputPassword" id="password" class="form-control col-9">
                @error('password') <span class="text-danger font-weight-bold">{{ $message }}</span> @enderror
            </div>
            <div class="form-group row">
                <label for="link" class="col-3">Enlace al sitio:</label>
                <input type="text" wire:model.lazy="link" id="link" class="form-control col-9">
            </div>
        </div>
        <div class="col">
            <div class="row">
                <div class="col">
                    <h3>Compartir con</h3>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="row">
                        <div class="col">
                            <div class="card card-body" id="usersCard">
                                <h4>Usuarios</h4>
                                <div class="row mb-3">
                                    <div class="col">
                                        <input type="text" wire:model="searchUsers" class="form-control form-control-sm" placeholder="Buscar Usuarios">
                                    </div>
                                </div>
                                @if (strlen($searchUsers) > 0)
                                    @foreach(collect(session()->get('users_ad'))->filter(function($val,$key){return strpos($val['displayname'][0], $this->searchUsers) !== false;}) as $index => $user)
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" wire:model.defer="usersToShare" id="checkbox-{{ $user['samaccountname'][0] }}" value="{{ $user['distinguishedname'][0] }}">
                                            <label class="custom-control-label" for="checkbox-{{ $user['samaccountname'][0] }}">{{ $user['displayname'][0] }}</label>
                                        </div>
                                    @endforeach
                                @else
                                    @foreach(collect(session()->get('users_ad')) as $index => $user)
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" wire:model.defer="usersToShare" id="checkbox-{{ $user['samaccountname'][0] }}" value="{{ $user['distinguishedname'][0] }}">
                                            <label class="custom-control-label" for="checkbox-{{ $user['samaccountname'][0] }}">{{ $user['displayname'][0] }}</label>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="col">
                        <div class="row">
                            <div class="col">
                                <div class="card card-body" id="usersCard">
                                    <h4>Grupos</h4>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <input type="text" wire:model="searchGroups" class="form-control form-control-sm" placeholder="Buscar Grupos">
                                        </div>
                                    </div>
                                    @if (strlen($searchGroups) > 0)
                                        @foreach(collect(session()->get('groups'))->filter(function($val,$key){return strpos($val['cn'][0], $this->searchGroups) !== false;}) as $index => $group)
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" wire:model.defer="groupsToShare" id="checkbox-{{ $group['cn'][0] }}" value="{{ $group['distinguishedname'][0] }}">
                                                <label class="custom-control-label" for="checkbox-{{ $group['cn'][0] }}">{{ $group['cn'][0] }}</label>
                                                <span class="badge badge-primary" wire:click="$emit('askMembers', '{{ $group['distinguishedname'][0] }}', '{{ $index }}')" style="cursor: pointer;"><i class="fas fa-users"></i></span>
                                            </div>
                                        @endforeach
                                    @else
                                        @foreach(session()->get('groups') as $index => $group)
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" wire:model.defer="groupsToShare" id="checkbox-{{ $group['cn'][0] }}" value="{{ $group['distinguishedname'][0] }}">
                                                <label class="custom-control-label" for="checkbox-{{ $group['cn'][0] }}">{{ $group['cn'][0] }}</label>
                                                <span class="badge badge-primary" wire:click="$emit('askMembers', '{{ $group['distinguishedname'][0] }}', '{{ $index }}')" style="cursor: pointer;"><i class="fas fa-users"></i></span>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col text-left">
            <input type="submit" value="Guardar" class="btn btn-outline-tecnol">
        </div>
    </div>
</form>