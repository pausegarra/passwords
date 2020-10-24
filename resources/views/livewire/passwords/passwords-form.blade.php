<div class="collapse mb-4 mt-2" id="addForm" wire:ignore.self>
    <div class="row">
        <div class="col">
            <h2>Añadir contraseña</h2>
        </div>
    </div>
    <img src="{{ asset('img/DIVIDER.svg') }}" alt="" height="6px">
    {{-- <div class="tecnol-divider"></div> --}}
    @include('livewire.passwords.form')
</div>
