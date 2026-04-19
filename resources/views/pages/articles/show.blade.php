@extends('layouts.app')

@section('content')

<section class="pt-28 pb-20 bg-gradient-to-r from-blue-950 to-blue-700 text-white text-center">
    <h1 class="text-4xl md:text-5xl font-bold">
        {{ $article->title }}
    </h1>
</section>

<section class="py-16 bg-white">
    <div class="max-w-3xl mx-auto px-6">

        <img loading="lazy" decoding="async"
             src="{{ $article->thumbnail ? asset('storage/'.$article->thumbnail) : 'https://via.placeholder.com/900x500' }}"
             class="w-full mb-10 object-cover">

        <div class="text-gray-700 leading-relaxed space-y-6">
            {!! $article->content !!}
        </div>

    </div>
</section>

@endsection
