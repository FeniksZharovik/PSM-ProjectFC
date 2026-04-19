@extends('admin.layouts.app')
@section('title', 'Tambah Anggota')
@section('page-title', 'Tambah Anggota')

@push('styles')
<style>
    .field-error { border-color: #f87171 !important; }
    .error-msg { display: none; color: #ef4444; font-size: 0.75rem; margin-top: 0.25rem; }
    .error-msg.show { display: block; }
</style>
@endpush

@section('content')
<form id="memberForm" method="POST" action="{{ route('admin.members.store') }}" enctype="multipart/form-data" class="space-y-4 sm:space-y-5" novalidate>
    @csrf

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 sm:gap-5">

        <div class="lg:col-span-2 space-y-4 sm:space-y-5">

            <div class="bg-white rounded-xl sm:rounded-2xl border border-slate-200 p-4 sm:p-5 space-y-3 sm:space-y-4">
                <h2 class="font-semibold text-slate-800 text-xs sm:text-sm">Data Anggota</h2>

                <div>
                    <label class="block text-xs sm:text-sm font-medium text-slate-700 mb-1.5">Nama Lengkap <span class="text-red-500">*</span></label>
                    <input type="text" name="name" id="nameInput" value="{{ old('name') }}"
                        placeholder="Masukkan nama lengkap anggota..."
                        class="w-full rounded-xl border border-slate-300 px-3 sm:px-4 py-2 sm:py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500 @error('name') field-error @enderror">
                    <p class="error-msg @error('name') show @enderror" id="nameError">
                        @error('name') {{ $message }} @else Nama wajib diisi. @enderror
                    </p>
                </div>

                <div>
                    <label class="block text-xs sm:text-sm font-medium text-slate-700 mb-1.5">Jabatan <span class="text-red-500">*</span></label>
                    <input type="text" name="position" id="positionInput" value="{{ old('position') }}"
                        placeholder="contoh: Ketua Umum, Sekretaris I..."
                        class="w-full rounded-xl border border-slate-300 px-3 sm:px-4 py-2 sm:py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500 @error('position') field-error @enderror">
                    <p class="error-msg @error('position') show @enderror" id="positionError">
                        @error('position') {{ $message }} @else Jabatan wajib diisi. @enderror
                    </p>
                </div>

                <div>
                    <label class="block text-xs sm:text-sm font-medium text-slate-700 mb-1.5">Divisi <span class="text-red-500">*</span></label>
                    <input type="text" name="division" id="divisionInput" value="{{ old('division') }}"
                        placeholder="contoh: Divisi Kreatif, Divisi Operasional..."
                        class="w-full rounded-xl border border-slate-300 px-3 sm:px-4 py-2 sm:py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500 @error('division') field-error @enderror">
                    <p class="error-msg @error('division') show @enderror" id="divisionError">
                        @error('division') {{ $message }} @else Divisi wajib diisi. @enderror
                    </p>
                </div>
            </div>

        </div>

        <div class="space-y-4 sm:space-y-5">

            <div class="bg-white rounded-xl sm:rounded-2xl border border-slate-200 p-4 sm:p-5">
                <h2 class="font-semibold text-slate-800 text-xs sm:text-sm mb-3">Foto <span class="text-red-500">*</span></h2>
                <div x-data="imagePreview()" class="space-y-2">
                    <div @click="$refs.fileInput.click()" id="photoBox"
                        class="border-2 border-dashed border-slate-200 hover:border-sky-400 rounded-xl aspect-square flex flex-col items-center justify-center cursor-pointer transition-colors overflow-hidden bg-slate-50 touch-manipulation"
                        style="max-height:220px">
                        <img x-show="preview" :src="preview" class="w-full h-full object-cover" alt="">
                        <div x-show="!preview" class="flex flex-col items-center gap-2 p-4 text-center">
                            <svg class="w-8 h-8 sm:w-10 sm:h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            <p class="text-xs text-slate-400">Klik untuk upload foto</p>
                            <p class="text-[10px] text-slate-300">JPG, PNG — maks. 2MB</p>
                        </div>
                    </div>
                    <input x-ref="fileInput" type="file" name="photo" id="photoInput" accept="image/*"
                        @change="handleFile($event)" class="hidden">
                    <p class="error-msg @error('photo') show @enderror" id="photoError">
                        @error('photo') {{ $message }} @else Foto wajib diupload. @enderror
                    </p>
                </div>
            </div>

            <div class="bg-white rounded-xl sm:rounded-2xl border border-slate-200 p-4 sm:p-5 space-y-2 sm:space-y-3">
                <button type="submit"
                    class="w-full bg-sky-600 hover:bg-sky-700 active:bg-sky-800 text-white font-semibold py-2.5 rounded-xl transition-colors text-sm touch-manipulation">
                    Simpan Anggota
                </button>
                <a href="{{ route('admin.members.index') }}"
                    class="block w-full text-center bg-slate-100 hover:bg-slate-200 text-slate-700 font-medium py-2.5 rounded-xl transition-colors text-sm touch-manipulation">
                    Batal
                </a>
            </div>

        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
    function imagePreview(initial = null) {
        return { preview: initial || null, handleFile(e) {
            const r = new FileReader(); r.onload = ev => this.preview = ev.target.result;
            r.readAsDataURL(e.target.files[0]);
        }};
    }

    document.getElementById('memberForm').addEventListener('submit', function(e) {
        let valid = true;
        const checks = [
            { id: 'nameInput',     errId: 'nameError',     boxId: null,      test: () => document.getElementById('nameInput').value.trim() !== '',     msg: 'Nama wajib diisi.' },
            { id: 'positionInput', errId: 'positionError', boxId: null,      test: () => document.getElementById('positionInput').value.trim() !== '', msg: 'Jabatan wajib diisi.' },
            { id: 'divisionInput', errId: 'divisionError', boxId: null,      test: () => document.getElementById('divisionInput').value.trim() !== '', msg: 'Divisi wajib diisi.' },
            { id: 'photoInput',    errId: 'photoError',    boxId: 'photoBox',test: () => document.getElementById('photoInput').files.length > 0,       msg: 'Foto wajib diupload.' },
        ];

        checks.forEach(({ id, errId, boxId, test, msg }) => {
            const errEl = document.getElementById(errId);
            if (!test()) {
                errEl.textContent = msg; errEl.classList.add('show');
                document.getElementById(id)?.classList.add('field-error');
                if (boxId) document.getElementById(boxId).classList.add('border-red-400');
                valid = false;
            } else {
                errEl.classList.remove('show');
                document.getElementById(id)?.classList.remove('field-error');
                if (boxId) document.getElementById(boxId).classList.remove('border-red-400');
            }
        });

        if (!valid) { e.preventDefault(); document.querySelector('.error-msg.show')?.scrollIntoView({ behavior: 'smooth', block: 'center' }); }
    });
</script>
@endpush
