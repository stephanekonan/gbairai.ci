@extends('layouts.site')

@section('content')

<div class="relative">
    <img class="h-auto w-full rounded-lg" src="{{ asset('/storage/'.$post->image) }}" alt="">
    <span class="absolute top-0 space-x-5 bg-white font-bold w-full p-5 text-xl">{{ $post->title }}</span>
</div>



<div class="p-5 my-5 shadow-xl rounded-lg">

    <span>{{ $post->description }}</span>

</div>

<div class="mb-5 mt-5">

    <div class="flex gap-4">
        <span>Date de publication:</span>
        <span class="bg-gray-100 text-gray-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-400 border border-gray-400">
            <svg class="w-2.5 h-2.5 mr-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm3.982 13.982a1 1 0 0 1-1.414 0l-3.274-3.274A1.012 1.012 0 0 1 9 10V6a1 1 0 0 1 2 0v3.586l2.982 2.982a1 1 0 0 1 0 1.414Z"/>
            </svg>
            {{ $post->created_at }}
        </span>
    </div>

    <div class="flex gap-5">
        <span>Auteur: </span>
        <span> {{ $post->user->username }}</span>
    </div>

</div>

<div class="">

    <form action="{{ route('post.comment') }}" method="POST">
        @csrf
        <div class="w-full mb-4 border-4 border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
            <div class="px-4 py-4 bg-white rounded-t-lg dark:bg-gray-800">
                <label for="comment" class="sr-only">Votre commentaire</label>
                <textarea id="comment" name="content" rows="3" class="w-full px-0 text-sm text-gray-900 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400" placeholder="Laissez un commentaire..." required></textarea>
            </div>
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            <div class="flex items-center justify-between px-3 py-2 border-t dark:border-gray-600">

                <button type="submit" class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-green-700 rounded-lg focus:ring-4 focus:ring-green-200 dark:focus:ring-green-900 hover:bg-green-800">
                    Poster votre commentaire
                </button>
                @auth


                    @else

                    <a data-modal-target="authentication-modal" data-modal-toggle="authentication-modal" class="inline-flex cursor-pointer items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-green-700 rounded-lg focus:ring-4 focus:ring-green-200 dark:focus:ring-green-900 hover:bg-green-800">
                        Poster votre commentaire
                    </a>

                @endauth

            </div>
        </div>
    </form>

    </div>


</div>

@auth

<div class="my-10">


    @foreach ($comments as $comment )



    @endforeach


</div>

@endauth

<!-- Create Category Modal -->
<div id="authentication-modal" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="authentication-modal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <!-- Modal body -->
            <div class="px-6 py-6 lg:px-8">
                <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Connecte toi à Gbairai.ci</h3>
                <form class="space-y-6" action="{{ route('login.in.modal') }}" method="POST">
                    @csrf
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Votre email</label>
                        <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="nom@gmail.com" required>
                    </div>
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Votre mot de passe</label>
                        <input type="password" name="password" id="password" placeholder="••••••••••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                    </div>
                    <div class="flex justify-between">
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="remember" type="checkbox" value="" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-green-300 dark:bg-gray-600 dark:border-gray-500 dark:focus:ring-green-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800" required>
                            </div>
                            <label for="remember" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Se souvenir de moi</label>
                        </div>
                        <a href="#" class="text-sm text-green-700 hover:underline dark:text-green-500">Mot de passe oublié?</a>
                    </div>
                    <button type="submit" class="w-full text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Se connecter maintenant</button>
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-300">
                        Pas de compte ? <a href="#" class="text-green-700 hover:underline dark:text-green-500">S'inscrire</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
