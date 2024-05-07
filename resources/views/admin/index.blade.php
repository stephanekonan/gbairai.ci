@extends('admin.layouts.layout')
@section('content')

@push('style')

<style>

    .text-overlay {
        background: #00000050;
        color: white;
    }

</style>

@endpush

<div class="max-w-screen-xl flex flex-wrap items-center gap-3 mx-auto p-4">

    <div class="w-full">

        <form class="w-full" action="{{ route('admin.dashboard') }}" method="GET">
            <label for="search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </div>
                <input type="search" name="search" id="search" class="block w-full p-3 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500" placeholder="Recherchez un article" required>
                <button type="submit" class="text-white px-2 py-1 rounded-md bg-green-500 right-2.5 bottom-2 absolute">
                    Rechercher
                </button>
            </div>
        </form>

        <div class="mt-5 flex justify-end items-center gap-2">
            <button data-modal-target="small-modal" data-modal-toggle="small-modal" class="flex bg-green-100 text-green-800 border-green-500 font-bold rounded-full px-3 py-1.5">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                </span>
                <span class="mx-2">Ajouter une nouvelle catégorie</span>
            </button>
            <button data-modal-target="defaultModal" data-modal-toggle="defaultModal" class="flex bg-green-500 text-white font-bold rounded-full px-3 py-1.5">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                </span>
                <span class="mx-2">Créer un nouveau article</span>
            </button>
        </div>

        <div class="flex mt-10">
            <div class="grid grid-cols-5 gap-2 flex-wrap">
                <div class="grid col-span-4 gap-3 bg-white p-4">

                    @if($postsCount > 0)

                        @if ($search)
                        {{ $posts->count() }} résultat(s) trouvé(s) pour "{{ $search }}"
                        @elseif ($categorie)
                            {{ $posts->count() }} résultat(s) trouvé(s) pour la catégorie "{{ $categorie }}"
                        @else
                            {{ $posts->count() }} articles enregistrés au total
                        @endif

                    <div class="grid grid-cols-4 gap-5">
                        
                                @foreach ($posts as $post)

                                <div class="w-56 h-72 my-3 flex flex-col bg-gray-100 justify-between rounded-lg shadow-md hover:shadow-xl">
                                    <div class="relative w-full">
                                        <img src="{{ asset('/storage/'.$post->image) }}" alt="" class="rounded-lg">
                                        <span class="absolute top-2 right-2 p-1 bg-green-100 text-green-400 text-sm rounded-md">
                                            {{ $post->category->name }}
                                        </span>
                                        <div class="absolute text-overlay bottom-1 m-2 p-2 rounded-md">
                                            <span class="text-sm">
                                                {{ Illuminate\Support\Str::limit($post->title, $limit = 50, $end = '...') }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="">
                                        <div class="flex justify-between px-2 text-sm">
                                            <span>Auteur:</span>
                                            <span class="font-bold">{{ $post->user->username }}</span>
                                        </div>
                                        <div class="flex justify-between px-2 text-sm">
                                            <span>Puliée:</span>
                                            <span>{{ Carbon\Carbon::parse($post->created_at)->format('d M Y') }}</span>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="grid grid-cols-2 gap-2.5 px-2 mt-4 text-sm">
                                            <button data-modal-target="updatetModal" data-modal-toggle="updatetModal" class="border border-green-800 text-green-600 hover:text-white hover:bg-green-500 hover:border-none rounded p-1.5">
                                                Modifier
                                            </button>
                                            <form action="{{ route('post.delete', $post->id) }}" method="post" id="removerForm">
                                                @csrf
                                                @method('DELETE')
                                                <button class="border confirm border-red-800 text-red-600 hover:text-white hover:bg-red-500 hover:border-none rounded p-1.5">
                                                    Supprimer
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                @endforeach
                            </div>


                        @else

                        <div class="flex items-center justify-center">
                            <span>Aucun article trouvé !</span>
                        </div>

                    @endif
                </div>

                <div class="card">
                    <div class="bg-white rounded-md p-5">
                        <span class="text-xl font-semibold">Catégories</span>
                        <div class="flex flex-wrap gap-2 mt-5">
                            @foreach ($categories as $category)
                                <a href="{{ route('admin.dashboard', ['categorie'=> $category->slug]) }}" class="bg-green-100 text-green-800 p-2 rounded-md">
                                    <span>{{ $category->name }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>



</div>




<!-- Create Category Modal -->
<div id="small-modal" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                    Ajouter une nouvelle catégorie
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="small-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 space-y-6">
                <form class="space-y-4 md:space-y-6" action="{{ route('category.store') }}" method="POST">
                    @csrf
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Libellé de la catégorie</label>
                        <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500" placeholder="Sports" required="">
                    </div>
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Slug</label>
                        <input type="text" name="slug" id="slug" placeholder="sports" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500" required="">
                    </div>
                    <button type="submit" class="w-full text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                        Enregister
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Create Article modal -->
<div id="defaultModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Enregister un nouveau article
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="defaultModal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 space-y-6">
                <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                        <div class="sm:col-span-2">
                            <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Titre de l'article</label>
                            <input type="text" name="title" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type product name" required="">
                        </div>
                        <div class="sm:col-span-2">
                            <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Catégories</label>
                            <select onchange="updateSlug()" name="category" id="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option selected="">Selectionnez une categorie</option>
                                @foreach ($categories as $category )
                                    <option value="{{ $category->id }}"  data-slug="{{ $category->slug }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <input type="file" name="image" class="hidden" onchange="displayImage()" id="image"/>
                            <div class="flex gap-3">
                                <div data-tooltip-target="tooltip-right" data-tooltip-placement="right" class="rounded-lg cursor-pointer" id="image-display"  ondblclick="removeImage()"></div>
                                <div id="tooltip-right" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                    Double clique pour supprimer
                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                </div>
                                <div onclick="triggerFileInput()" style="width: 100px; height: 100px" class="flex items-center justify-center bg-gray-100 rounded-lg p-1 cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="0.5" stroke="currentColor" class="w-8 h-8">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                                      </svg>
                                </div>
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                            <textarea id="description" name="description" rows="8" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Your description here"></textarea>
                        </div>
                        <div class="sm:col-span-2">
                            <button type="submit" class="text-white w-full bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                Enregister
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Update poste modal -->
<div id="updatetModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Enregister un nouveau article
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="defaultModal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 space-y-6">
                <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                        <div class="sm:col-span-2">
                            <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Titre de l'article</label>
                            <input type="text" name="title" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type product name" required="">
                        </div>
                        <div class="sm:col-span-2">
                            <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Catégories</label>
                            <select onchange="updateSlug()" name="category" id="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option selected="">Selectionnez une categorie</option>
                                @foreach ($categories as $category )
                                    <option value="{{ $category->id }}"  data-slug="{{ $category->slug }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <input type="file" name="image" class="hidden" onchange="displayImage()" id="image"/>
                            <div class="flex gap-3">
                                <div data-tooltip-target="tooltip-right" data-tooltip-placement="right" class="rounded-lg cursor-pointer" id="image-display"  ondblclick="removeImage()"></div>
                                <div id="tooltip-right" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                    Double clique pour supprimer
                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                </div>
                                <div onclick="triggerFileInput()" style="width: 100px; height: 100px" class="flex items-center justify-center bg-gray-100 rounded-lg p-1 cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="0.5" stroke="currentColor" class="w-8 h-8">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                                      </svg>
                                </div>
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                            <textarea id="description" name="description" rows="8" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Your description here"></textarea>
                        </div>
                        <div class="sm:col-span-2">
                            <button type="submit" class="text-white w-full bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                Enregister
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('script')

<script>

    function triggerFileInput() {
        document.getElementById('image').click();
    }

    function displayImage() {
        var fileInput = document.getElementById('image');
        var imageDisplay = document.getElementById('image-display');

        if (fileInput.files && fileInput.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {

                var img = new Image();
                img.src = e.target.result;
                img.className = 'rounded-lg';

                img.style.width = '100px';
                img.style.height = '100px';

                while (imageDisplay.firstChild) {
                    imageDisplay.removeChild(imageDisplay.firstChild);
                }

                imageDisplay.appendChild(img);
            };

            reader.readAsDataURL(fileInput.files[0]);
        }
    }

    function removeImage() {
        var imageDisplay = document.getElementById('image-display');

        while (imageDisplay.firstChild) {
            imageDisplay.removeChild(imageDisplay.firstChild);
        }
    }

</script>

{{-- <script src="{{ asset('js/sweetalert2.js') }}"></script>
<script src="{{asset('js/sweetalert2.all.min.js')}}"></script>

<script>

    $('.confirm').click(function(event) {

        var form = $("#removerForm");

        event.preventDefault();

        Swal.fire({
            title: 'Êtes-vous sûr de vouloir supprimer cet poste ?',
            text: 'Cette action est irréversible!',
            confirmButtonText: 'Oui, supprime !'
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
        }).then((result) => {

            if (result.isConfirmed) {
                form.submit();
            }
        })
    });

</script> --}}

@endpush

@endsection
