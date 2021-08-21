@extends('layouts.main')

@section('content')

    <!-- tv info -->

    <div class="tv-info border-b border-gray-800">
        <div class="container mx-auto px-4 py-16 flex flex-col md:flex-row">
            <img src=" {{ $tvshow['poster_path'] }}" alt="blackwidow" class="w-64 md:w-96">
            <div class="md:ml-24">
                <h2 class="text-4xl font-semibold">{{ $tvshow['name'] }}</h2>
                <div class="flex flex-wrap items-center text-gray-400 text-sm mt-1">
                    <svg class="fill-current text-yellow-600 w-4" viewBox="0 0 24 24">
                        <g data-name="Layer 2">
                            <path d="M17.56 21a1 1 0 01-.46-.11L12 18.22l-5.1 2.67a1 
                                                                                        1 0 01-1.45-1.06l1-5.63-4.12-4a1 1 0 01-.25-1 1 1 0 01.81-.68l5.7-.83 2.51-5.13a1 1 
                                                                                        0 011.8 0l2.54 5.12 5.7.83a1 1 0 01.81.68 1 1 0 01-.25 1l-4.12 4 1 5.63a1 1 0 01-.4 1 
                                                                                        1 1 0 01-.62.18z"
                                data-name="star" />
                        </g>
                    </svg>
                    <span class="ml-1">{{ $tvshow['vote_average'] }}</span>
                    <span class="mx-2">|</span>
                    <span>{{ $tvshow['first_air_date'] }}</span>
                    <span class="mx-2">|</span>
                    <span>


                        {{ $tvshow['genres'] }}


                    </span>

                </div>

                <p class="text-gray-300 mt-8">{{ $tvshow['overview'] }}
                </p>

                <div class="mt-12">
                    <h4 class="text-white font-semibold">Created By</h4>

                    <div class="flex mt-4">
                        @foreach ($tvshow['created_by'] as $creator)



                            <div class="mr-8">
                                <div>{{ $creator['name'] }}</div>
                                <div class="text-sm text-gray-400">Creator</div>

                            </div>

                        @endforeach
                    </div>
                </div>

                <div x-data="{ isOpen: false}">
                    @if (count($tvshow['videos']['results']) > 0)

                        <div class="mt-12">
                            <button @click="isOpen = true"
                                class="flex inline-flex items-center bg-yellow-600 text-gray-900 rounded font-semibold px-5 py-4 hover:bg-yellow-700 transition ease-in-out duration-150">
                                <svg class="w-6 fill-current" viewBox="0 0 24 24">
                                    <path d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M10 16.5l6-4.5-6-4.5v9zM12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-
                                                                                        10S17.52 2 12 2zm0 18c-4.41 
                                                                                        0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z" />
                                </svg>
                                <span class="ml-2">Play Trailer</span>
                            </button>
                        </div>

                    @endif

                    {{-- <template x-if="isOpen"> --}}
                    <div style="background-color: rgba(0, 0, 0, .5);"
                        class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
                        x-show.transition.opacity="isOpen">

                        <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                            <div class="bg-gray-900 rounded">
                                <div class="flex justify-end pr-4 pt-2">
                                    <button @click="isOpen = false"
                                        class="text-3xl leading-none hover:text-gray-300">&times;
                                    </button>
                                </div>
                                <div class="modal-body px-8 py-8">
                                    <div class="responsive-container overflow-hidden relative" style="padding-top: 56.25%">
                                        <iframe width="560" height="315"
                                            class="responsive-iframe absolute top-0 left-0 w-full h-full"
                                            src="{{ $tvshow['video_embed'] }}" style="border:0;"
                                            allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- </template> --}}

                </div>

                @foreach ($tvshow['reviews'] as $review)

                    <h2 class="text-xl font-semibold mt-5">{{ $review['author'] }}</h2>
                    <div class="flex flex-wrap items-center text-gray-400 text-sm mt-1">
                        <svg class="fill-current text-yellow-600 w-4" viewBox="0 0 24 24">
                            <g data-name="Layer 2">
                                <path d="M17.56 21a1 1 0 01-.46-.11L12 18.22l-5.1 2.67a1 
                                                                                    1 0 01-1.45-1.06l1-5.63-4.12-4a1 1 0 01-.25-1 1 1 0 01.81-.68l5.7-.83 2.51-5.13a1 1 
                                                                                    0 011.8 0l2.54 5.12 5.7.83a1 1 0 01.81.68 1 1 0 01-.25 1l-4.12 4 1 5.63a1 1 0 01-.4 1 
                                                                                    1 1 0 01-.62.18z" data-name="star" />
                            </g>
                        </svg>
                        <span class="ml-1">{{ $review['author_details']['rating'] }}</span>
                        <span class="mx-2">|</span>
                        <span>{{ Helper::moviedateformat($review['created_at']) }}</span>



                    </div>


                    <p class="text-gray-300 mt-8 overflow-auto h-32 w-100">{{ $review['content'] }}
                    </p>

                @endforeach
            </div>
        </div>
    </div>

    <!-- end tv info -->

    <!-- tv cast -->

    <div class="tvshow-cast border-b border-gray-800">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl font-semibold">Cast</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">

                @foreach ($tvshow['cast'] as $cast)

                    <div class="mt-8">

                        <a href="{{ route('actors.show', $cast['id']) }}">

                            @if ($cast['profile_path'])

                                <img src="{{ 'https://image.tmdb.org/t/p/w500/' . $cast['profile_path'] }}"
                                    alt="Placeholder" class="hover:opacity-75 transition ease-in-out duration-150">


                            @else
                                <img src="https://via.placeholder.com/173x260" alt="Placeholder"
                                    class="hover:opacity-75 transition ease-in-out duration-150">


                            @endif
                        </a>
                        <div class="mt-2">

                            <a href="{{ route('actors.show', $cast['id']) }}"
                                class="text-lg mt-2 hover:text-gray-600">{{ $cast['name'] }}</a>

                            <div class="text=gray-400 text-sm">
                                {{ $cast['character'] }}
                            </div>
                        </div>
                    </div>


                @endforeach

            </div>
        </div>
    </div>

    <!-- end tv cast -->

    <!-- tv images -->

    <div class="tvshow-images border-b border-gray-800" x-data="{ isOpen: false, image: ''}">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl font-semibold">Images</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-8">


                @foreach ($tvshow['images'] as $image)

                    <div class="mt-8">

                        <a @click.prevent="
                                                            isOpen = true
                                                            image = '{{ 'https://image.tmdb.org/t/p/original/' . $image['file_path'] }}'"
                            href="#">

                            <img src="{{ 'https://image.tmdb.org/t/p/w500/' . $image['file_path'] }}" alt=""
                                class="hover:opacity-75 transition ease-in-out duration-150">
                        </a>
                    </div>
                @endforeach


            </div>

            <div style="background-color: rgba(0, 0, 0, .5);"
                class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
                x-show.transition.opacity="isOpen">

                <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                    <div class="bg-gray-900 rounded">
                        <div class="flex justify-end pr-4 pt-2">
                            <button @click="isOpen = false" @keydown.escape.window="isOpen = false"
                                class="text-3xl leading-none hover:text-gray-300">&times;
                            </button>
                        </div>
                        <div class="modal-body px-8 py-8">

                            <img :src="image" alt="poster">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- end tv images -->


@endsection
