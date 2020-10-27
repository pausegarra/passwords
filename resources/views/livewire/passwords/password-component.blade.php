<div>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Contraseñas <a class="btn btn-outline-tecnol btn-sm" data-toggle="collapse" href="#addForm" role="button" aria-expanded="false" aria-controls="collapseExample">
                    Añadir
                  </a>
                </h1>
            </div>
            <div class="col-4 text-right">
                <input type="text" wire:model="search" placeholder="Buscar" class="form-control">
            </div>
        </div>
        @include('livewire.passwords.passwords-table')
    </div>
</div>
