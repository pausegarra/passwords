<div>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Editar contraseña {{ $name }}</h1>
                <p style="font-size: 15px;"><strong>Propietario: </strong>{{ getOwner($user_id) }}</p>
            </div>
            <div class="col text-right">
                @if (auth()->user()->can_god)
                    @if (auth()->user()->god_active)
                        <button class="btn btn-warning" wire:click="changeGod(false)">Turn God Mode OFF</button>
                    @else
                        <button class="btn btn-success" wire:click="changeGod(true)">Turn God Mode ON</button>
                    @endif
                @endif
                <button class="btn btn-primary" wire:click="$emit('showPassword', '{{ decrypt($password) }}')">Ver Contraseña</button>
                @if (isOwner($user_id) || auth()->user()->god_active)
                    <button class="btn btn-danger" wire:click="delete">Eliminar Contraseña</button>
                @endif
            </div>
        </div>
        <div class="row mt-4">
            <div class="col">
                <div class="card card-body">
                    @include('livewire.passwords.form')
                </div>
            </div>
        </div>
    </div>
</div>
