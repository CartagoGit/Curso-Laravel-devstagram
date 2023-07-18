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

            <div class="flex flex-col lg:flex-row">
                <section class="section__left flex w-full flex-col lg:w-1/2">
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
                    <div
                        class="flex flex h-full h-full min-h-[200px] items-center justify-center self-stretch px-10 pb-5">
                        <form
                            class="dropzone rounder flex flex max-h-[560px] min-h-[400px] w-full cursor-pointer flex-col items-center justify-center rounded-xl border-[4px] border-dashed border-gray-200 bg-gray-50 shadow-xl transition-opacity hover:opacity-70"
                            id="dropzone"
                            novalidate
                            action="{{ route('images.store', 'profiles') }}"
                            method="POST"
                            enctype="multipart"
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
                        </form>
                    </div>
                </section>
                <section class="section__right w-full lg:w-1/2">
                    <form
                        id="form-edit-profile"
                        action="{{ route('profile.store', ['user' => auth()->user()]) }}"
                        method="POST"
                        novalidate
                        autocomplete="off"
                    >

                        @csrf

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

                        <div class="mb-5">
                            <input
                                name="imagen"
                                type="hidden"
                                value="{{ old('imagen') ?: $user->image }}"
                            />

                            @error('imagen')
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
                                Contraseña actual
                            </label>
                            <input
                                class="@error('password') border-red-500 @enderror w-full rounded-lg border border-2 border-orange-400 p-3 focus:outline-gray-300"
                                id="actual_password"
                                name="actual_password"
                                type="password"
                                value=""
                                placeholder="Constraseña actual"
                            />

                            @error('actual_password')
                                <p
                                    class="my-2 w-full rounded-lg bg-red-500 p-2 text-center text-sm text-white">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </form>
                </section>

            </div>

            <button
                class="w-full cursor-pointer rounded-lg bg-sky-600 p-3 font-bold uppercase text-white transition-colors hover:bg-sky-700"
                type="button"
                onclick="document.getElementById('form-edit-profile').submit();"
            >
                Cambiar perfil
            </button>

        </div>
    </div>
@endsection
