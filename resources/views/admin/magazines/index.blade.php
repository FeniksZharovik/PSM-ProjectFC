@extends('admin.layouts.app')
@section('title', 'Majalah')
@section('page-title', 'Majalah')

@section('header-actions')
    <a href="{{ route('admin.magazines.create') }}"
       class="inline-flex items-center justify-center gap-1.5 bg-sky-600 hover:bg-sky-700 active:bg-sky-800 text-white font-medium transition-colors touch-manipulation rounded-lg sm:rounded-xl text-xs sm:text-sm px-3 sm:px-4 py-2 whitespace-nowrap">
        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        <span class="hidden xs:inline sm:hidden">Tambah</span>
        <span class="hidden sm:inline">Tambah Majalah</span>
    </a>
@endsection

@section('content')
<div class="bg-white rounded-xl sm:rounded-2xl border border-slate-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-xs sm:text-sm">
            <thead>
                <tr class="border-b border-slate-200 bg-slate-50 text-left">
                    <th class="px-3 sm:px-5 py-3 font-medium text-slate-500 w-10 sm:w-14">Cover</th>
                    <th class="px-2 sm:px-5 py-3 font-medium text-slate-500">Judul</th>
                    <th class="px-2 sm:px-5 py-3 font-medium text-slate-500 hidden md:table-cell whitespace-nowrap">Tanggal</th>
                    <th class="px-2 sm:px-4 py-3 font-medium text-slate-500 w-24 sm:w-32 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($magazines as $magazine)
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-3 sm:px-5 py-2 sm:py-3">
                        @if($magazine->cover)
                            <img src="{{ Storage::url($magazine->cover) }}" class="h-10 w-7 sm:h-14 sm:w-10 rounded-lg object-cover" alt="">
                        @else
                            <div class="h-10 w-7 sm:h-14 sm:w-10 rounded-lg bg-slate-100"></div>
                        @endif
                    </td>
                    <td class="px-2 sm:px-5 py-2 sm:py-3 max-w-0">
                        <p class="font-medium text-slate-800 truncate">{{ $magazine->title }}</p>
                    </td>
                    <td class="px-2 sm:px-5 py-2 sm:py-3 text-slate-500 hidden md:table-cell whitespace-nowrap">
                        {{ $magazine->created_at->format('d M Y') }}
                    </td>
                    <td class="px-2 sm:px-4 py-2 sm:py-3 w-24 sm:w-32">
                        <div class="flex items-center justify-end gap-1 sm:gap-2">
                            <a href="{{ route('admin.magazines.edit', $magazine) }}"
                               class="text-[11px] sm:text-xs font-medium text-slate-600 hover:text-sky-600 bg-slate-100 hover:bg-sky-50 px-2 py-1.5 rounded-lg transition-colors touch-manipulation whitespace-nowrap">
                                Edit
                            </a>
                            <button type="button"
                                onclick="confirmDelete('{{ route('admin.magazines.destroy', $magazine) }}', '{{ addslashes($magazine->title) }}')"
                                class="text-[11px] sm:text-xs font-medium text-red-500 hover:text-red-700 bg-red-50 hover:bg-red-100 px-2 py-1.5 rounded-lg transition-colors touch-manipulation whitespace-nowrap">
                                Hapus
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-5 py-10 sm:py-12 text-center text-xs sm:text-sm text-slate-400">
                        Belum ada majalah. <a href="{{ route('admin.magazines.create') }}" class="text-sky-600 hover:underline">Tambah sekarang</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($magazines->hasPages())
    <div class="border-t border-slate-100 px-3 sm:px-5 py-3">{{ $magazines->links() }}</div>
    @endif
</div>

@include('admin.partials.delete-modal')
@endsection
