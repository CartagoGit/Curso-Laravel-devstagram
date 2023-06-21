@extends('layouts.app')

@section('titulo')
    Registrarse en DevStagram
@endsection

@section('contenido')
    <div class="md:flex md:justify-center md:gap-10 md:items-center">
        <div class="md:w-6/12 p-5">
            <img src="{{ asset('img/auth/registrar.jpg') }}" alt="Imagen de registro de usuario"
            class="rounded-lg">
        </div>

        <div class="md:w-4/12 p-6 bg-white rounded-lg shadow-xl">
            <form action="">
                <div class="mb-5">
                    <label for="name" class="mb-2 block uppercase text-gray-500 font-bold">
                        Nombre
                    </label>
                    <input id="name" type="text" name="name" placeholder="Nombre"
                        class="border p-3 w-full rounded-lg">

                </div>

                <div class="mb-5">
                    <label for="nickname" class="mb-2 block uppercase text-gray-500 font-bold">
                        Nick del usuario
                    </label>
                    <input id="nickname" type="text" name="nickname" placeholder="Nick del usuario"
                        class="border p-3 w-full rounded-lg">

                </div>

                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                        Email
                    </label>
                    <input id="email" type="text" name="email" placeholder="Email"
                        class="border p-3 w-full rounded-lg">

                </div>

                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">
                        Contraseña
                    </label>
                    <input id="password" type="password" name="password" placeholder="Contraseña"
                        class="border p-3 w-full rounded-lg">

                </div>

                <div class="mb-5">
                    <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">
                        Verificar Contraseña
                    </label>
                    <input id="password_confirmation" type="password" name="password_confirmation"
                        placeholder="Contraseña de verificación" class="border p-3 w-full rounded-lg">

                </div>

                <input type="submit" value="Registrarse"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase w-full font-bold p-3 text-white rounded-lg">
            </form>
        </div>
    </div>
@endsection
