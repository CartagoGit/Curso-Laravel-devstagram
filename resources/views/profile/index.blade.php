@extends('layouts.app')
@section('titulo')
    Edición del perfil de {{ $user->username }}
@endsection

@section('contenido')
    <div class="flex flex-col items-center justify-center md:flex-row">
        <div class="w-4/5 bg-white p-6 shadow md:w-1/2">
            <form
                class="m-10 md:mt-0"
                novalidate
            >
            </form>
        </div>
    </div>
@endsection
