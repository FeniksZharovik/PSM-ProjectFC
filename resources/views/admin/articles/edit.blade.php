@extends('admin.layouts.app')
@section('title', 'Edit Artikel')
@section('page-title', 'Edit Artikel')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/quill@2/dist/quill.snow.css" rel="stylesheet">
<style>
    #quillEditor { min-height: 220px; }
    @media (min-width: 640px) { #quillEditor { min-height: 300px; } }
    .ql-toolbar { flex-wrap: wrap; }
    .ql-editor.ql-blank::before { color: #94a3b8; font-style: normal; font-size: 0.875rem; }
    .field-error { border-color: #f87171 !important; }
    .error-msg { display: none; color: #ef4444; font-size: 0.75rem; margin-top: 0.25rem; }
    .error-msg.show { display: block; }
</style>
@endpush

@section('content')
<form id="articleForm" method="POST" action="{{ route('admin.articles.update', $article) }}" enctype="multipart/form-data" class="space-y-4 sm:space-y-5" novalidate>
    @csrf @method('PUT')

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 sm:gap-5">

        <div class="lg:col-span-2 space-y-4 sm:space-y-5">

            <div class="bg-white rounded-xl sm:rounded-2xl border border-slate-200 p-4 sm:p-5 space-y-3 sm:space-y-4">
                <h2 class="font-semibold text-slate-800 text-xs sm:text-sm">Informasi Artikel</h2>

                <div>
                    <label class="block text-xs sm:text-sm font-medium text-slate-700 mb-1.5">Judul <span class="text-red-500">*</span></label>
                    <input type="text" name="title" id="titleInput" value="{{ old('title', $article->title) }}"
                        placeholder="Masukkan judul artikel..."
                        class="w-full rounded-xl border border-slate-300 px-3 sm:px-4 py-2 sm:py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500 @error('title') field-error @enderror">
                    <p class="error-msg @error('title') show @enderror" id="titleError">
                        @error('title') {{ $message }} @else Judul wajib diisi. @enderror
                    </p>
                </div>

                <div>
                    <label class="block text-xs sm:text-sm font-medium text-slate-700 mb-1.5">Slug <span class="text-red-500">*</span></label>
                    <input type="text" name="slug" id="slugInput" value="{{ old('slug', $article->slug) }}"
                        placeholder="judul-artikel-anda"
                        class="w-full rounded-xl border border-slate-300 px-3 sm:px-4 py-2 sm:py-2.5 text-sm font-mono focus:outline-none focus:ring-2 focus:ring-sky-500 @error('slug') field-error @enderror">
                    <p class="error-msg @error('slug') show @enderror" id="slugError">
                        @error('slug') {{ $message }} @else Slug wajib diisi. @enderror
                    </p>
                </div>

                <div>
                    <label class="block text-xs sm:text-sm font-medium text-slate-700 mb-1.5">Ringkasan <span class="text-slate-400 font-normal text-[10px]">(opsional)</span></label>
                    {{--
                        Fix &nbsp;: strip_tags + html_entity_decode untuk bersihkan
                        entity HTML yang tersimpan dari konten rich text sebelumnya
                    --}}
                    <textarea name="excerpt" rows="2" maxlength="300"
                        placeholder="Ringkasan singkat artikel, otomatis dari konten jika dikosongkan..."
                        class="w-full rounded-xl border border-slate-300 px-3 sm:px-4 py-2 sm:py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500 resize-none">{{ old('excerpt', html_entity_decode(strip_tags($article->excerpt ?? ''), ENT_QUOTES | ENT_HTML5, 'UTF-8')) }}</textarea>
                </div>
            </div>

            <div class="bg-white rounded-xl sm:rounded-2xl border border-slate-200 p-4 sm:p-5">
                <label class="block text-xs sm:text-sm font-medium text-slate-700 mb-3">Konten <span class="text-red-500">*</span></label>
                <div id="quillEditor">{!! old('content', $article->content) !!}</div>
                <input type="hidden" name="content" id="contentInput">
                <p class="error-msg @error('content') show @enderror" id="contentError">
                    @error('content') {{ $message }} @else Konten wajib diisi. @enderror
                </p>
            </div>
        </div>

        <div class="space-y-4 sm:space-y-5">

            <div class="bg-white rounded-xl sm:rounded-2xl border border-slate-200 p-4 sm:p-5">
                <h2 class="font-semibold text-slate-800 text-xs sm:text-sm mb-1">Thumbnail</h2>
                <p class="text-[10px] sm:text-xs text-slate-400 mb-3">
                    @if($article->thumbnail) Gambar saat ini ditampilkan. Upload baru untuk menggantinya.
                    @else Thumbnail wajib diupload. @endif
                </p>
                <div x-data="imagePreview('{{ $article->thumbnail ? Storage::url($article->thumbnail) : '' }}')" class="space-y-2">
                    <div @click="$refs.fileInput.click()"
                        id="thumbnailBox"
                        class="border-2 border-dashed border-slate-200 hover:border-sky-400 rounded-xl aspect-video flex flex-col items-center justify-center cursor-pointer transition-colors overflow-hidden bg-slate-50 touch-manipulation">
                        <img x-show="preview" :src="preview" class="w-full h-full object-cover" alt="">
                        <div x-show="!preview" class="flex flex-col items-center gap-2 p-4 text-center">
                            <svg class="w-7 h-7 sm:w-8 sm:h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <p class="text-xs text-slate-400">Klik untuk {{ $article->thumbnail ? 'ganti' : 'upload' }} gambar</p>
                        </div>
                    </div>
                    <input x-ref="fileInput" type="file" name="thumbnail" id="thumbnailInput" accept="image/*"
                        @change="handleFile($event)" class="hidden">
                    <p class="error-msg @error('thumbnail') show @enderror" id="thumbnailError">
                        @error('thumbnail') {{ $message }} @else Thumbnail wajib diupload. @enderror
                    </p>
                </div>
            </div>

            <div class="bg-white rounded-xl sm:rounded-2xl border border-slate-200 p-4 sm:p-5 space-y-2 sm:space-y-3">
                <button type="submit"
                    class="w-full bg-sky-600 hover:bg-sky-700 active:bg-sky-800 text-white font-semibold py-2.5 rounded-xl transition-colors text-sm touch-manipulation">
                    Perbarui Artikel
                </button>
                <a href="{{ route('admin.articles.index') }}"
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
        placeholder: 'Tulis konten artikel di sini...',
        modules: {
            toolbar: [
                ['bold', 'italic', 'underline', 'strike'],
                [{ 'header': [2, 3, false] }],
                [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                ['blockquote', 'link'],
                ['clean']
            ]
        }
    });

    // Auto slug
    document.getElementById('titleInput').addEventListener('input', function() {
        document.getElementById('slugInput').value = this.value
            .toLowerCase().replace(/[^a-z0-9\s-]/g, '').replace(/\s+/g, '-').replace(/-+/g, '-').trim();
    });

    function imagePreview(initial = null) {
        return {
            preview: initial || null,
            handleFile(e) {
                const r = new FileReader();
                r.onload = ev => this.preview = ev.target.result;
                r.readAsDataURL(e.target.files[0]);
            }
        }
    }

    // Apakah sudah ada thumbnail dari server
    const hasExistingThumbnail = {{ $article->thumbnail ? 'true' : 'false' }};

    document.getElementById('articleForm').addEventListener('submit', function(e) {
        let valid = true;
        const content = quill.root.innerHTML;
        const contentText = quill.getText().trim();
        document.getElementById('contentInput').value = content;

        const hasNewFile = document.getElementById('thumbnailInput').files.length > 0;

        const checks = [
            {
                id: 'titleInput', errId: 'titleError',
                test: () => document.getElementById('titleInput').value.trim() !== '',
                msg: 'Judul wajib diisi.'
            },
            {
                id: 'slugInput', errId: 'slugError',
                test: () => document.getElementById('slugInput').value.trim() !== '',
                msg: 'Slug wajib diisi.'
            },
            {
                id: null, errId: 'contentError',
                test: () => contentText.length > 0,
                msg: 'Konten wajib diisi.'
            },
            {
                id: 'thumbnailInput', errId: 'thumbnailError',
                // Edit: valid jika sudah ada gambar sebelumnya ATAU upload baru
                test: () => hasExistingThumbnail || hasNewFile,
                msg: 'Thumbnail wajib diupload.'
            },
        ];

        checks.forEach(({ id, errId, test, msg }) => {
            const errEl = document.getElementById(errId);
            const fieldEl = id ? document.getElementById(id) : null;
            if (!test()) {
                errEl.textContent = msg;
                errEl.classList.add('show');
                if (fieldEl) fieldEl.classList.add('field-error');
                if (errId === 'thumbnailError') document.getElementById('thumbnailBox').classList.add('border-red-400');
                valid = false;
            } else {
                errEl.classList.remove('show');
                if (fieldEl) fieldEl.classList.remove('field-error');
                if (errId === 'thumbnailError') document.getElementById('thumbnailBox').classList.remove('border-red-400');
            }
        });

        if (!valid) {
            e.preventDefault();
            document.querySelector('.error-msg.show')?.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    });
</script>
@endpush
