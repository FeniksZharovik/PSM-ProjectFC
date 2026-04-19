@extends('layouts.app')

@section('content')

    <section class="pt-28 pb-20 bg-gradient-to-r from-blue-950 to-blue-700 text-white text-center">
        <h1 class="text-4xl md:text-5xl font-bold">Program Kerja</h1>
        <p class="mt-5 text-blue-200">Rangkaian kegiatan UKM PSM Polije</p>
    </section>

    <section class="py-16 bg-white">
        <div class="max-w-6xl mx-auto px-4">

            @if ($programs->isEmpty())
                <div class="text-center py-20">
                    <h2 class="text-xl font-semibold text-gray-600">
                        Program belum tersedia.
                    </h2>
                </div>
            @else
                <div class="grid grid-cols-2 md:grid-cols-3 gap-6">

                    @foreach ($programs as $program)
                        <div class="group border rounded-lg overflow-hidden hover:shadow-md transition">

                            <img width="600" height="400" loading="lazy" decoding="async"
                                src="{{ $program->image ? asset('storage/' . $program->image) : 'https://via.placeholder.com/600x400' }}"
                                class="w-full h-48 object-cover transition duration-300 group-hover:scale-105">

                            <div class="p-5">
                                <h3 class="font-semibold text-gray-900">
                                    {{ $program->title }}
                                </h3>

                                <p class="text-gray-600 text-sm mt-3">
                                    {{ Str::limit($program->description, 120) }}
                                </p>
                            </div>

                        </div>
                    @endforeach

                </div>

                <div class="mt-12">
                    {{ $programs->links() }}
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
