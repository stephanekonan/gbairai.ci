@extends('layouts.login')
@section('content')

@push('style')

<style>
</style>

@endpush

<section class="bg-white dark:bg-gray-900" style="width: 500px;">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">

        <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                    Créer un compte
                </h1>
                <form class="space-y-4 md:space-y-6" action="{{ route('register.store') }}" method="POST">
                    @csrf
                    <div>
                        <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Votre nom et prénom</label>
                        <input type="text" name="username" id="username" placeholder="Stéphane Konan" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                    </div>
                    <div>
                        <label for="date_naissance" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date de naissance</label>
                        <input type="date" name="date_naissance" id="date_naissance" placeholder="18/12/1999" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                    </div>
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Votre email</label>
                        <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@company.com" required="">
                    </div>
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mot de passe</label>
                        <input type="password" name="password" id="password" placeholder="••••••••••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                    </div>

                    <button type="submit" style="background-color: #07a875;"class="w-full text-white font-semibold border hover:text-white hover:bg-green-700 focus:outline-none rounded-lg text-sm px-5 py-2.5 text-center">S'inscrire maintenant</button>
                    <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                        Vous avez déjà un compte? <a href="{{ route('login.index') }}" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Connectez-vous ici</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection
