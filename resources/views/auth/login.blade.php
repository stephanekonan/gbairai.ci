@extends('layouts.login')
@section('content')

<section class="bg-white dark:bg-gray-900" style="width: 500px;">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">

        <div>
            <img src="{{ asset('images/logos/') }}" alt="">
        </div>

        @auth
            <div class="flex flex-col items-center justify-center">
                <div>{{ Auth::user()->username }}</div>
                <div>{{ Auth::user()->email }}</div>
            </div>
        @endauth

        <div class="w-full bg-white rounded-2xl shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                    Connecte-toi à ton compte
                </h1>
                <form class="space-y-4 md:space-y-6" action="{{ route('login.store') }}" method="POST">
                    @method('post')
                    @csrf
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Votre email</label>
                        <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@gmail.com" required="">
                    </div>
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Votre mot de passe</label>
                        <input type="password" name="password" id="password" placeholder="••••••••••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                    </div>
                    <button type="submit" class="w-full text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                        Se connecter maintenant
                    </button>
                    <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                        Pas de compte? <a href="{{ route('register.index') }}" class="font-medium text-primary-600 hover:underline dark:text-primary-500">S'inscrire</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection
