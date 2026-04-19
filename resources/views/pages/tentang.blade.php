@extends('layouts.app')

@section('content')
    {{-- HERO SECTION --}}
    <section class="pt-28 pb-20 bg-gradient-to-r from-blue-950 to-blue-700 text-white text-center">
        <div class="max-w-4xl mx-auto px-6">
            <h1 class="text-4xl md:text-5xl font-bold">
                Tentang UKM PSM
            </h1>
            <p class="mt-5 text-blue-200">
                Harmoni dalam keberagaman, prestasi dalam kebersamaan.
            </p>
        </div>
    </section>

    <section class="max-w-6xl mx-auto px-6 lg:px-12 py-20">

        {{-- SEJARAH --}}
        <div class="mb-20">
            <h2 class="text-3xl font-bold text-primary mb-6">
                Sejarah
            </h2>

            <div class="space-y-6 text-lg leading-relaxed text-gray-700 max-w-4xl">
                <p>
                    UKM Paduan Suara Mahasiswa (PSM) Politeknik Negeri Jember
                    didirikan sebagai wadah bagi mahasiswa yang memiliki minat
                    dan bakat dalam bidang seni vokal dan musik. Berawal dari
                    komunitas kecil pecinta paduan suara di lingkungan kampus,
                    UKM ini kemudian berkembang menjadi organisasi resmi yang
                    aktif berkontribusi dalam berbagai kegiatan akademik maupun non-akademik.
                </p>

                <p>
                    Seiring berjalannya waktu, PSM Polije terus mengalami
                    perkembangan baik dari segi kualitas musikalitas,
                    jumlah anggota, maupun prestasi yang diraih. Melalui
                    latihan rutin, pembinaan vokal, dan partisipasi dalam
                    berbagai konser serta kompetisi, PSM Polije berkomitmen
                    untuk menjaga eksistensi seni paduan suara di lingkungan kampus.
                </p>

                <p>
                    Hingga saat ini, UKM PSM Polije tidak hanya menjadi wadah
                    pengembangan bakat, tetapi juga menjadi ruang kebersamaan
                    yang mempererat solidaritas antar mahasiswa dalam harmoni
                    dan semangat kekeluargaan.
                </p>
            </div>
        </div>

        {{-- VISI --}}
        <div class="mb-20">
            <h2 class="text-3xl font-bold text-primary mb-6">
                Visi
            </h2>
            <p class="text-lg leading-relaxed text-gray-700 max-w-3xl">
                Organisasi yang menjadi wadah pengembangan minat dan bakat mahasiswa
                Politeknik Negeri Jember dalam bidang seni vokal, musikalitas,
                dan kebudayaan secara profesional dan berprestasi.
            </p>
        </div>

        {{-- MISI --}}
        <div>
            <h2 class="text-3xl font-bold text-primary mb-12">
                Misi
            </h2>

            <div class="grid md:grid-cols-2 gap-16">

                <div class="flex items-start gap-6">
                    <span class="text-5xl font-bold text-primary">1</span>
                    <p class="text-lg text-gray-700 leading-relaxed">
                        Mengakomodir mahasiswa yang memiliki minat dan bakat dalam bidang seni vokal dan musikal.
                    </p>
                </div>

                <div class="flex items-start gap-6">
                    <span class="text-5xl font-bold text-primary">2</span>
                    <p class="text-lg text-gray-700 leading-relaxed">
                        Mengadakan kegiatan dan pelatihan rutin untuk meningkatkan kualitas vokal anggota.
                    </p>
                </div>

                <div class="flex items-start gap-6">
                    <span class="text-5xl font-bold text-primary">3</span>
                    <p class="text-lg text-gray-700 leading-relaxed">
                        Menjalin kerja sama dengan organisasi seni di dalam maupun luar kampus.
                    </p>
                </div>

                <div class="flex items-start gap-6">
                    <span class="text-5xl font-bold text-primary">4</span>
                    <p class="text-lg text-gray-700 leading-relaxed">
                        Meningkatkan apresiasi seni dan budaya melalui konser serta kompetisi.
                    </p>
                </div>

            </div>
        </div>

    </section>
@endsection
