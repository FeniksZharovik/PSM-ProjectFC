@extends('layouts.app')

@section('content')

{{-- HERO SECTION --}}
<section class="pt-28 pb-20 bg-gradient-to-r from-blue-950 to-blue-700 text-white text-center">
    <div class="max-w-7xl mx-auto px-6 lg:px-12 text-center">

        <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold mb-6">
            UKM Paduan Suara Polije
        </h1>

        <p class="text-base sm:text-lg md:text-xl opacity-90">
            Harmoni • Kreativitas • Prestasi
        </p>

        <div class="mt-10 flex flex-wrap justify-center gap-4">
            <a href="{{ route('tentang') }}"
               class="bg-white text-primary px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
                Tentang Kami
            </a>

            <a href="{{ route('program') }}"
               class="border border-white px-6 py-3 rounded-lg hover:bg-white hover:text-primary transition">
                Lihat Program
            </a>
        </div>

    </div>
</section>


{{-- TENTANG SINGKAT --}}
<section class="py-20 bg-white">
    <div class="max-w-6xl mx-auto px-6 text-center">

        <h2 class="text-3xl font-bold mb-6">
            Tentang UKM PSM
        </h2>

        <p class="text-gray-600 leading-relaxed max-w-3xl mx-auto">
            UKM Paduan Suara Mahasiswa Politeknik Negeri Jember merupakan wadah
            pengembangan minat dan bakat mahasiswa dalam bidang seni vokal dan musikalitas.
            Melalui latihan rutin, konser, dan kompetisi, kami berkomitmen
            menghadirkan harmoni serta prestasi di tingkat regional maupun nasional.
        </p>

        <div class="mt-8">
            <a href="{{ route('tentang') }}"
               class="text-primary font-semibold hover:underline">
                Baca Selengkapnya →
            </a>
        </div>

    </div>
</section>


{{-- PROGRAM UNGGULAN --}}
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6">

        <h2 class="text-3xl font-bold text-center mb-12">
            Program Unggulan
        </h2>

        @if($programs->isEmpty())
            <div class="text-center text-gray-500">
                Program belum tersedia.
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($programs as $program)
                    <div class="bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden">

                        <img
                            src="{{ $program->image ? asset('storage/'.$program->image) : 'https://via.placeholder.com/600x400' }}"
                            class="w-full h-48 object-cover"
                            loading="lazy"
                            decoding="async"
                        >

                        <div class="p-6">
                            <h3 class="font-semibold text-lg mb-3">
                                {{ $program->title }}
                            </h3>

                            <p class="text-gray-600 text-sm">
                                {{ \Illuminate\Support\Str::limit($program->description, 100) }}
                            </p>
                        </div>

                    </div>
                @endforeach
            </div>
        @endif

    </div>
</section>

{{-- ARTIKEL TERBARU --}}
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6">

        <h2 class="text-3xl font-bold text-center mb-12">
            Artikel Terbaru
        </h2>

        @if($articles->isEmpty())
            <div class="text-center text-gray-500">
                Artikel belum tersedia.
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

                @foreach ($articles as $article)
                    <a href="{{ route('artikel.show', $article->slug) }}"
                       class="group bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden">

                        <img
                            src="{{ $article->thumbnail ? asset('storage/'.$article->thumbnail) : 'https://via.placeholder.com/600x400' }}"
                            class="w-full h-48 object-cover group-hover:scale-105 transition duration-300"
                            loading="lazy"
                            decoding="async"
                        >

                        <div class="p-6">
                            <h3 class="font-semibold text-lg mb-3">
                                {{ $article->title }}
                            </h3>

                            <p class="text-gray-600 text-sm">
                                {{ \Illuminate\Support\Str::limit(strip_tags($article->content), 100) }}
                            </p>
                        </div>

                    </a>
                @endforeach

            </div>

            <div class="text-center mt-10">
                <a href="{{ route('artikel.index') }}"
                   class="text-primary font-semibold hover:underline">
                    Lihat Semua Artikel →
                </a>
            </div>

        @endif

    </div>
</section>

@endsection
