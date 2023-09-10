@extends('layouts.site')
@section('content')

@push('style')

<style>

.image img {
    width: 200px;
}

</style>

@endpush

<div class="overflow-x-auto">
    <nav class="flex items-center justify-between gap-3">
        @foreach ($categories as $category)
            <a href="{{ route('acceuil', ['categorie'=> $category->slug]) }}" class="bg-green-100 text-green-800 p-2 rounded-md">
                <span>{{ $category->name }}</span>
            </a>
        @endforeach
    </nav>
</div>

@if ($postsCount > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 flex-wrap my-10">


        @foreach ($posts as $post)

            <div class="h-36 flex gap-5 shadow-xl bg-white rounded-lg">
                <a href="{{ route('post.show', Crypt::encryptString($post->id)) }}">
                    <img class="h-36 w-56 rounded-lg" src="{{ asset('/storage/'.$post->image) }}" alt="">
                </a>
                <div class="flex flex-col justify-between p-5">
                    <a href="{{ route('post.show', Crypt::encryptString($post->id)) }}" class="font-bold text-md">{{ $post->title }}</a>

                    <a href="{{ route('post.show', Crypt::encryptString($post->id)) }}" class="flex justify-between">
                        <span class="bg-gray-100 text-gray-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-gray-700 dark:text-gray-300">{{ $post->category->name }}</span>

                        <span class="bg-gray-100 text-gray-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-400 border border-gray-400">
                            <svg class="w-2.5 h-2.5 mr-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm3.982 13.982a1 1 0 0 1-1.414 0l-3.274-3.274A1.012 1.012 0 0 1 9 10V6a1 1 0 0 1 2 0v3.586l2.982 2.982a1 1 0 0 1 0 1.414Z"/>
                            </svg>
                            {{ Carbon\Carbon::parse($post->created_at->format('d M Y')) }}
                        </span>
                    </a>
                </div>
            </div>

        @endforeach

        
    </div>

    @else

    <div class="flex items-center justify-center my-10">
        Aucun article trouvé
    </div>

@endif


@endsection
