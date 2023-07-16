@extends('layouts.app')
@push('styles')
    <link
        type="text/css"
        href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css"
        rel="stylesheet"
    />
    @vite('resources/css/dropzone.css')
@endpush
@section('titulo')
    Edición del perfil de {{ $user->username }}
@endsection

@section('contenido')
    <div class="flex flex-col items-center justify-center lg:flex-row">
        <div class="w-4/5 bg-white p-6 shadow">
            <form
                action="{{ route('profile.store', ['user' => $user]) }}"
                method="POST"
                novalidate
                autocomplete="off"
            >
                @csrf

                <div class="flex flex-col lg:flex-row">
                    <section class="section__left flex w-full lg:w-1/2 flex-col">
                        <label
                            class="mb-2 block font-bold uppercase text-gray-500"
                            for="nombre"
                        >
                            Imagen de perfil
                        </label>
                        {{-- <input
                            name='imagen'
                            type="file"
                        > --}}
                        <div class="flex min-h-[200px] self-stretch px-10 pb-5 h-full">
                            <div
                                class="dropzone rounder flex w-full cursor-pointer flex-col items-center justify-center rounded-xl border-[4px] border-dashed border-gray-200 bg-gray-50 shadow-md transition-opacity hover:opacity-70"
                                id="dropzone"
                            >
                                @csrf
                                <div
                                    class="dz-message font-bold uppercase text-gray-500"
                                    data-dz-message
                                >
                                    <span>
                                        Suelta
                                        <span class="underline">
                                            aquí
                                        </span>
                                        tu imagen
                                    </span>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="section__right w-full lg:w-1/2">
                        <div class="mb-5">
                            <label
                                class="mb-2 block font-bold uppercase text-gray-500"
                                for="nombre"
                            >
                                Nombre
                            </label>
                            <input
                                class="@error('nombre') border-red-500  @enderror w-full rounded-lg border p-3 focus:outline-gray-300"
                                id="nombre"
                                name="nombre"
                                type="text"
                                value=" {{ auth()->user()->name }}"
                                placeholder="Nombre"
                            />
                            @error('nombre')
                                <p
                                    class="my-2 w-full rounded-lg bg-red-500 p-2 text-center text-sm text-white">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                        <div class="mb-5">
                            <label
                                class="mb-2 block font-bold uppercase text-gray-500"
                                for="nick"
                            >
                                Nick del usuario
                            </label>
                            <input
                                class="@error('nick') border-red-500 @enderror w-full rounded-lg border p-3 focus:outline-gray-300"
                                id="nick"
                                name="nick"
                                type="text"
                                value="{{ auth()->user()->username }}"
                                placeholder="Nick del usuario"
                            />
                            @error('nick')
                                <p
                                    class="my-2 w-full rounded-lg bg-red-500 p-2 text-center text-sm text-white">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="mb-5">
                            <label
                                class="mb-2 block font-bold uppercase text-gray-500"
                                for="email"
                            >
                                Email
                            </label>
                            <input
                                class="@error('email') border-red-500 @enderror w-full rounded-lg border p-3 focus:outline-gray-300"
                                id="email"
                                name="email"
                                type="text"
                                value="{{ auth()->user()->email }}"
                                placeholder="Email"
                            />
                            @error('email')
                                <p
                                    class="my-2 w-full rounded-lg bg-red-500 p-2 text-center text-sm text-white">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="mb-5">
                            <label
                                class="mb-2 block font-bold uppercase text-gray-500"
                                for="password"
                            >
                                Contraseña
                            </label>
                            <input
                                class="@error('password') border-red-500 @enderror w-full rounded-lg border p-3 focus:outline-gray-300"
                                id="password"
                                name="password"
                                type="password"
                                placeholder="Contraseña"
                                autocomplete="new-password"
                            />
                            @error('password')
                                <p
                                    class="my-2 w-full rounded-lg bg-red-500 p-2 text-center text-sm text-white">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="mb-5">
                            <label
                                class="mb-2 block font-bold uppercase text-gray-500"
                                for="password_confirmation"
                            >
                                Verificar Contraseña
                            </label>
                            <input
                                class="@error('password') border-red-500 @enderror w-full rounded-lg border p-3 focus:outline-gray-300"
                                id="password_confirmation"
                                name="password_confirmation"
                                type="password"
                                placeholder="Contraseña de verificación"
                            />

                        </div>
                    </section>

                </div>

                <button
                    class="w-full cursor-pointer rounded-lg bg-sky-600 p-3 font-bold uppercase text-white transition-colors hover:bg-sky-700"
                    type="submit"
                >
                    Cambiar perfil
                </button>
            </form>
        </div>
    </div>
@endsection
