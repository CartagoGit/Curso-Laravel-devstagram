@extends('layouts.app')

@section('titulo')
    Tu Cuenta
@endsection

@section('contenido')
    <div class="flex justify-center">
        <div class="w-full flex flex-col items-center sm:w-8/12 md:flex-row lg:w-6/12 ">
            <div class="w-8/12 md:w-6/12 px-5">
                <img src="{{ asset('img/user/usuario.svg') }}" alt="imagen del usuario" />
            </div>
            <div class="md:w-8/12 lg:w-6/12 px-5 flex flex-col md:justify-center items-center py-10">
                {{-- <p class="text-gray-700 text-2xl">{{ auth()->user()->name }}</p> --}}
                <p class="text-gray-700 text-2xl">{{ $user->name }}</p>
                <p class="text-gray-800 text-sm mb-3 font-bold">
                    0
                    <span class="font-normal">
                        Seguidores
                    </span>
                </p>
                <p class="text-gray-800 text-sm mb-3 font-bold">
                    0
                    <span class="font-normal">
                        Siguiendo
                    </span>
                </p>
                <p class="text-gray-800 text-sm mb-3 font-bold">
                    0
                    <span class="font-normal">
                        Posts
                    </span>
                </p>
            </div>
        </div>
    </div>
@endsection
