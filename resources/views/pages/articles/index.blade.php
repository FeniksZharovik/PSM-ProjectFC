@extends('layouts.app')

@section('content')

    <section class="pt-28 pb-20 bg-gradient-to-r from-blue-950 to-blue-700 text-white text-center">
        <h1 class="text-4xl md:text-5xl font-bold">Artikel & Berita</h1>
        <p class="mt-5 text-blue-200">Informasi terbaru UKM PSM Polije</p>
    </section>

    <section class="py-16 bg-white">
        <div class="max-w-6xl mx-auto px-4">

            @if ($articles->isEmpty())
                <div class="text-center py-20">
                    <h2 class="text-xl font-semibold text-gray-600">
                        Artikel belum tersedia.
                    </h2>
                </div>
            @else
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">

                    @foreach ($articles as $article)
                        <a href="{{ route('artikel.show', $article->slug) }}"
                            class="relative group overflow-hidden aspect-square">
                            <img loading="lazy"
                                src="{{ $article->thumbnail ? asset('storage/' . $article->thumbnail) : 'https://via.placeholder.com/600' }}"
                                class="w-full h-full object-cover transition duration-300 group-hover:scale-105">

                            {{-- Overlay seperti Instagram --}}
                            <div
                                class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition duration-300 flex items-center justify-center">
                                <h2
                                    class="text-white text-sm font-semibold opacity-0 group-hover:opacity-100 text-center px-3">
                                    {{ $article->title }}
                                </h2>
                            </div>

                        </a>
                    @endforeach

                </div>

                {{-- Pagination --}}
                <div class="mt-12">
                    {{ $articles->links() }}
                </div>
            @endif

        </div>
    </section>

@endsection

@push('styles')
    <style>
        .animate-fade {
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
@endpush
