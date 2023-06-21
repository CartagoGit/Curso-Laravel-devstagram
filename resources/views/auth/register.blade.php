@extends('layouts.app')

@section('titulo')
    Registrarse en DevStagram
@endsection

@section('contenido')
    <div class="md:flex">
        <div class="md:w-1/2">
            <p>Imagen aquí</p>
        </div>

        <div class="md:w-1/2">
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
            </form>
        </div>
    </div>
@endsection


