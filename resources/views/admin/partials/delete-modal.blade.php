{{--
    Partial: admin/partials/delete-modal.blade.php
    Dipanggil sekali di bawah tiap halaman index.
    Pada tombol hapus gunakan:
      @click="openDeleteModal('{{ route('...destroy', $item) }}', '{{ $item->title }}')"
--}}
<div
    x-data="deleteModal()"
    x-show="open"
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    @keydown.escape.window="open = false"
    @open-delete-modal.window="openDeleteModal($event.detail.url, $event.detail.name)"
    class="fixed inset-0 z-50 flex items-center justify-center p-4"
    style="display:none"
>
    <div class="absolute inset-0 bg-black/50" @click="open = false"></div>

    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="relative bg-white rounded-2xl shadow-xl w-full max-w-sm mx-auto p-6"
        @click.stop
    >
        <div class="flex items-center justify-center w-12 h-12 rounded-full bg-red-50 mx-auto mb-4">
            <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
            </svg>
        </div>

        <h3 class="text-base font-semibold text-slate-900 text-center mb-1">Hapus Data?</h3>
        <p class="text-sm text-slate-500 text-center">Anda akan menghapus</p>
        <p class="text-sm font-semibold text-slate-800 text-center mt-1 mb-2 px-4 break-words" x-text='"«" + itemName + "»"'></p>
        <p class="text-xs text-slate-400 text-center mb-6">Tindakan ini tidak dapat dibatalkan.</p>

        <div class="flex gap-3">
            <button type="button" @click="open = false"
                class="flex-1 bg-slate-100 hover:bg-slate-200 text-slate-700 font-medium py-2.5 rounded-xl transition-colors text-sm touch-manipulation">
                Batal
            </button>
            <form :action="deleteUrl" method="POST" class="flex-1">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="w-full bg-red-500 hover:bg-red-600 active:bg-red-700 text-white font-semibold py-2.5 rounded-xl transition-colors text-sm touch-manipulation">
                    Ya, Hapus
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    function deleteModal() {
        return {
            open: false,
            deleteUrl: '',
            itemName: '',
            openDeleteModal(url, name) {
                this.deleteUrl = url;
                this.itemName = name;
                this.open = true;
            }
        }
    }

    // Global helper — dipanggil dari tombol hapus di luar scope Alpine modal
    function confirmDelete(url, name) {
        window.dispatchEvent(new CustomEvent('open-delete-modal', {
            detail: { url, name }
        }));
    }
</script>
