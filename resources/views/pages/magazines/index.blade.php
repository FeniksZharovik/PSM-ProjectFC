@extends('layouts.app')

@section('content')

{{-- HERO SECTION --}}
<section class="pt-28 pb-20 bg-gradient-to-r from-blue-950 to-blue-700 text-white text-center">
    <h1 class="text-4xl md:text-5xl font-bold">
        Majalah UKM PSM
    </h1>
    <p class="mt-5 text-blue-200">
        Dokumentasi dan publikasi resmi organisasi
    </p>
</section>

{{-- MAGAZINE GRID --}}
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6">

        @if ($magazines->isEmpty())
            <div class="text-center py-20">
                <h2 class="text-xl font-semibold text-gray-600">
                    Majalah belum tersedia.
                </h2>
            </div>
        @else

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-10">

                @foreach ($magazines as $magazine)
                    <a href="{{ route('majalah.show', $magazine->id) }}">

                        {{-- Cover --}}
                        <div class="relative aspect-[3/4] overflow-hidden">
                            <img
                                src="{{ $magazine->cover ? asset('storage/'.$magazine->cover) : 'https://via.placeholder.com/600x800' }}"
                                class="w-full h-full object-cover transition duration-500 group-hover:scale-105"
                                loading="lazy"
                                decoding="async">

                            {{-- Overlay --}}
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent flex items-end p-6">
                                <h2 class="text-white text-lg font-bold leading-tight">
                                    {{ $magazine->title }}
                                </h2>
                            </div>
                        </div>

                    </a>
                @endforeach

            </div>

            {{-- Pagination --}}
            <div class="mt-16">
                {{ $magazines->links() }}
            </div>

        @endif

    </div>
</section>

@endsection
