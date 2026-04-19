@extends('admin.layouts.app')
@section('title', 'Tambah Program')
@section('page-title', 'Tambah Program')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/quill@2/dist/quill.snow.css" rel="stylesheet">
<style>
    #quillEditor { min-height: 200px; }
    @media (min-width: 640px) { #quillEditor { min-height: 250px; } }
    .ql-toolbar { flex-wrap: wrap; }
    .ql-editor.ql-blank::before { color: #94a3b8; font-style: normal; font-size: 0.875rem; }
    .field-error { border-color: #f87171 !important; }
    .error-msg { display: none; color: #ef4444; font-size: 0.75rem; margin-top: 0.25rem; }
    .error-msg.show { display: block; }
</style>
@endpush

@section('content')
<form id="programForm" method="POST" action="{{ route('admin.programs.store') }}" enctype="multipart/form-data" class="space-y-4 sm:space-y-5" novalidate>
    @csrf

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 sm:gap-5">

        <div class="lg:col-span-2 space-y-4 sm:space-y-5">

            <div class="bg-white rounded-xl sm:rounded-2xl border border-slate-200 p-4 sm:p-5 space-y-3 sm:space-y-4">
                <h2 class="font-semibold text-slate-800 text-xs sm:text-sm">Informasi Program</h2>

                <div>
                    <label class="block text-xs sm:text-sm font-medium text-slate-700 mb-1.5">Judul Program <span class="text-red-500">*</span></label>
                    <input type="text" name="title" id="titleInput" value="{{ old('title') }}"
                        placeholder="Masukkan nama program kegiatan..."
                        class="w-full rounded-xl border border-slate-300 px-3 sm:px-4 py-2 sm:py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500 @error('title') field-error @enderror">
                    <p class="error-msg @error('title') show @enderror" id="titleError">
                        @error('title') {{ $message }} @else Judul wajib diisi. @enderror
                    </p>
                </div>

                <div>
                    <label class="block text-xs sm:text-sm font-medium text-slate-700 mb-3">Deskripsi <span class="text-red-500">*</span></label>
                    <div id="quillEditor">{!! old('description') !!}</div>
                    <input type="hidden" name="description" id="descriptionInput">
                    <p class="error-msg @error('description') show @enderror" id="descError">
                        @error('description') {{ $message }} @else Deskripsi wajib diisi. @enderror
                    </p>
                </div>
            </div>

        </div>

        <div class="space-y-4 sm:space-y-5">

            <div class="bg-white rounded-xl sm:rounded-2xl border border-slate-200 p-4 sm:p-5">
                <h2 class="font-semibold text-slate-800 text-xs sm:text-sm mb-3">Gambar Program <span class="text-red-500">*</span></h2>
                <div x-data="imagePreview()" class="space-y-2">
                    <div @click="$refs.fileInput.click()" id="imageBox"
                        class="border-2 border-dashed border-slate-200 hover:border-sky-400 rounded-xl aspect-video flex flex-col items-center justify-center cursor-pointer transition-colors overflow-hidden bg-slate-50 touch-manipulation">
                        <img x-show="preview" :src="preview" class="w-full h-full object-cover" alt="">
                        <div x-show="!preview" class="flex flex-col items-center gap-2 p-4 text-center">
                            <svg class="w-7 h-7 sm:w-8 sm:h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <p class="text-xs text-slate-400">Klik untuk upload gambar</p>
                            <p class="text-[10px] text-slate-300">JPG, PNG — maks. 2MB</p>
                        </div>
                    </div>
                    <input x-ref="fileInput" type="file" name="image" id="imageInput" accept="image/*"
                        @change="handleFile($event)" class="hidden">
                    <p class="error-msg @error('image') show @enderror" id="imageError">
                        @error('image') {{ $message }} @else Gambar wajib diupload. @enderror
                    </p>
                </div>
            </div>

            <div class="bg-white rounded-xl sm:rounded-2xl border border-slate-200 p-4 sm:p-5 space-y-2 sm:space-y-3">
                <button type="submit"
                    class="w-full bg-sky-600 hover:bg-sky-700 active:bg-sky-800 text-white font-semibold py-2.5 rounded-xl transition-colors text-sm touch-manipulation">
                    Simpan Program
                </button>
                <a href="{{ route('admin.programs.index') }}"
                    class="block w-full text-center bg-slate-100 hover:bg-slate-200 text-slate-700 font-medium py-2.5 rounded-xl transition-colors text-sm touch-manipulation">
                    Batal
                </a>
            </div>

        </div>
    </div>
</form>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/quill@2/dist/quill.js"></script>
<script>
    const quill = new Quill('#quillEditor', {
        theme: 'snow',
        placeholder: 'Tulis deskripsi program kegiatan di sini...',
        modules: { toolbar: [['bold','italic','underline'],[{'header':[2,3,false]}],[{'list':'ordered'},{'list':'bullet'}],['blockquote','link'],['clean']] }
    });

    function imagePreview(initial = null) {
        return { preview: initial || null, handleFile(e) {
            const r = new FileReader(); r.onload = ev => this.preview = ev.target.result;
            r.readAsDataURL(e.target.files[0]);
        }};
    }

    document.getElementById('programForm').addEventListener('submit', function(e) {
        let valid = true;
        const desc = quill.getText().trim();
        document.getElementById('descriptionInput').value = quill.root.innerHTML;

        const checks = [
            { id: 'titleInput', errId: 'titleError', boxId: null,      test: () => document.getElementById('titleInput').value.trim() !== '', msg: 'Judul wajib diisi.' },
            { id: null,         errId: 'descError',  boxId: null,      test: () => desc.length > 0,                                          msg: 'Deskripsi wajib diisi.' },
            { id: 'imageInput', errId: 'imageError', boxId: 'imageBox',test: () => document.getElementById('imageInput').files.length > 0,   msg: 'Gambar wajib diupload.' },
        ];

        checks.forEach(({ id, errId, boxId, test, msg }) => {
            const errEl = document.getElementById(errId);
            if (!test()) {
                errEl.textContent = msg; errEl.classList.add('show');
                if (id) document.getElementById(id)?.classList.add('field-error');
                if (boxId) document.getElementById(boxId).classList.add('border-red-400');
                valid = false;
            } else {
                errEl.classList.remove('show');
                if (id) document.getElementById(id)?.classList.remove('field-error');
                if (boxId) document.getElementById(boxId).classList.remove('border-red-400');
            }
        });

        if (!valid) { e.preventDefault(); document.querySelector('.error-msg.show')?.scrollIntoView({ behavior: 'smooth', block: 'center' }); }
    });
</script>
@endpush
