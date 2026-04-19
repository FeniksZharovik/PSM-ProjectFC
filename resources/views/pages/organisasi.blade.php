@extends('layouts.app')

@section('content')

    <section class="pt-28 pb-20 bg-gradient-to-r from-blue-950 to-blue-700 text-white text-center">
        <h1 class="text-4xl md:text-5xl font-bold">Struktur Organisasi</h1>
        <p class="mt-5 text-blue-200">Pengurus UKM PSM Polije</p>
    </section>

    <section class="py-20 bg-blue-50">
        <div class="max-w-7xl mx-auto px-6">

            @if ($members->isEmpty())
                <div class="text-center py-20">
                    <h2 class="text-xl font-semibold text-blue-900">
                        Struktur organisasi belum tersedia.
                    </h2>
                </div>
            @else
                @foreach ($members->groupBy('division') as $division => $group)
                    <div class="mb-20 text-center">

                        <h2 class="text-2xl font-bold text-blue-900 mb-10">
                            {{ $division }}
                        </h2>

                        <div class="flex flex-wrap justify-center gap-12">

                            @foreach ($group as $member)
                                <div class="w-40 text-center">

                                    <img loading="lazy" decoding="async" src="{{ asset('storage/' . $member->photo) }}"
                                        class="w-28 h-28 mx-auto rounded-full object-cover">

                                    <h3 class="mt-4 font-semibold text-blue-900">
                                        {{ $member->name }}
                                    </h3>

                                    <p class="text-sm text-gray-600">
                                        {{ $member->position }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </section>

@endsection
