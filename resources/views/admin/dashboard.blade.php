@extends('admin.layouts.app')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="space-y-4 sm:space-y-6">

    {{-- Stats grid: 2 kolom di semua layar kecil, 4 kolom di lg+ --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">
        @php
            $cards = [
                ['label' => 'Artikel',  'value' => $stats['articles'],  'color' => 'bg-blue-500',    'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
                ['label' => 'Majalah',  'value' => $stats['magazines'], 'color' => 'bg-violet-500',  'icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253'],
                ['label' => 'Anggota',  'value' => $stats['members'],   'color' => 'bg-emerald-500', 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z'],
                ['label' => 'Program',  'value' => $stats['programs'],  'color' => 'bg-orange-500',  'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2'],
            ];
        @endphp

        @foreach($cards as $card)
        <div class="bg-white rounded-xl sm:rounded-2xl border border-slate-200 p-3 sm:p-5 flex items-center gap-3 sm:gap-4">
            <div class="h-9 w-9 sm:h-11 sm:w-11 rounded-lg sm:rounded-xl {{ $card['color'] }} flex items-center justify-center flex-shrink-0">
                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="{{ $card['icon'] }}"/>
                </svg>
            </div>
            <div class="min-w-0">
                <p class="text-xl sm:text-2xl font-bold text-slate-900 leading-tight">{{ $card['value'] }}</p>
                <p class="text-[11px] sm:text-xs text-slate-500 mt-0.5 truncate">{{ $card['label'] }}</p>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Recent content: stack di mobile, 2 kolom di lg+ --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6">

        {{-- Latest Articles --}}
        <div class="bg-white rounded-xl sm:rounded-2xl border border-slate-200 overflow-hidden">
            <div class="flex items-center justify-between px-4 sm:px-5 py-3 sm:py-4 border-b border-slate-100">
                <h2 class="font-semibold text-slate-800 text-xs sm:text-sm">Artikel Terbaru</h2>
                <a href="{{ route('admin.articles.index') }}" class="text-xs text-sky-600 hover:underline whitespace-nowrap">Lihat semua</a>
            </div>
            <ul class="divide-y divide-slate-100">
                @forelse($latestArticles as $article)
                <li class="flex items-center gap-3 px-4 sm:px-5 py-2.5 sm:py-3">
                    @if($article->thumbnail)
                        <img src="{{ Storage::url($article->thumbnail) }}"
                             class="h-9 w-9 sm:h-10 sm:w-10 rounded-lg object-cover flex-shrink-0" alt="">
                    @else
                        <div class="h-9 w-9 sm:h-10 sm:w-10 rounded-lg bg-slate-100 flex-shrink-0"></div>
                    @endif
                    <div class="flex-1 min-w-0">
                        <p class="text-xs sm:text-sm font-medium text-slate-800 truncate">{{ $article->title }}</p>
                        <p class="text-[10px] sm:text-xs text-slate-400 mt-0.5">{{ $article->created_at->format('d M Y') }}</p>
                    </div>
                    <a href="{{ route('admin.articles.edit', $article) }}"
                       class="text-slate-400 hover:text-sky-600 flex-shrink-0 p-1">
                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                        </svg>
                    </a>
                </li>
                @empty
                <li class="px-5 py-8 text-center text-xs sm:text-sm text-slate-400">Belum ada artikel</li>
                @endforelse
            </ul>
        </div>

        {{-- Latest Magazines --}}
        <div class="bg-white rounded-xl sm:rounded-2xl border border-slate-200 overflow-hidden">
            <div class="flex items-center justify-between px-4 sm:px-5 py-3 sm:py-4 border-b border-slate-100">
                <h2 class="font-semibold text-slate-800 text-xs sm:text-sm">Majalah Terbaru</h2>
                <a href="{{ route('admin.magazines.index') }}" class="text-xs text-sky-600 hover:underline whitespace-nowrap">Lihat semua</a>
            </div>
            <ul class="divide-y divide-slate-100">
                @forelse($latestMagazines as $magazine)
                <li class="flex items-center gap-3 px-4 sm:px-5 py-2.5 sm:py-3">
                    @if($magazine->cover)
                        <img src="{{ Storage::url($magazine->cover) }}"
                             class="h-9 w-9 sm:h-10 sm:w-10 rounded-lg object-cover flex-shrink-0" alt="">
                    @else
                        <div class="h-9 w-9 sm:h-10 sm:w-10 rounded-lg bg-slate-100 flex-shrink-0"></div>
                    @endif
                    <div class="flex-1 min-w-0">
                        <p class="text-xs sm:text-sm font-medium text-slate-800 truncate">{{ $magazine->title }}</p>
                        <p class="text-[10px] sm:text-xs text-slate-400 mt-0.5">{{ $magazine->created_at->format('d M Y') }}</p>
                    </div>
                    <a href="{{ route('admin.magazines.edit', $magazine) }}"
                       class="text-slate-400 hover:text-sky-600 flex-shrink-0 p-1">
                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                        </svg>
                    </a>
                </li>
                @empty
                <li class="px-5 py-8 text-center text-xs sm:text-sm text-slate-400">Belum ada majalah</li>
                @endforelse
            </ul>
        </div>

    </div>
</div>
@endsection
