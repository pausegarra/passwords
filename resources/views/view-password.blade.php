@extends('layouts.app')

@section('content')
    @livewire('password-view', [
        'id' => $id,
    ])
@endsection