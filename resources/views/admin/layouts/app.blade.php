<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/jpeg" href="{{ asset('assets/IC-PSM.jpg') }}">
    <title>@yield('title', 'Admin') — Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50:  '#f0f9ff',
                            100: '#e0f2fe',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                            800: '#075985',
                            900: '#0c4a6e',
                        }
                    },
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    },
                    screens: {
                        'xs': '375px',
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        /* Scrollbar sidebar */
        .sidebar-nav::-webkit-scrollbar { width: 4px; }
        .sidebar-nav::-webkit-scrollbar-track { background: transparent; }
        .sidebar-nav::-webkit-scrollbar-thumb { background: #334155; border-radius: 4px; }

        /* Prevent layout shift when sidebar opens on mobile */
        body.sidebar-lock { overflow: hidden; }
    </style>
    @stack('styles')
</head>
<body class="h-full bg-slate-50 font-sans" x-data="{ sidebarOpen: false }" :class="{ 'overflow-hidden': sidebarOpen }">

    {{-- Mobile overlay --}}
    <div
        x-show="sidebarOpen"
        x-transition:enter="transition-opacity duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity duration-300"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click="sidebarOpen = false"
        class="fixed inset-0 z-20 bg-black/50 lg:hidden"
    ></div>

    {{-- Sidebar --}}
    <aside
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
        class="fixed inset-y-0 left-0 z-30 w-64 bg-slate-900 text-white transition-transform duration-300 ease-in-out lg:translate-x-0 flex flex-col"
    >
        {{-- Logo --}}
        <div class="flex h-14 sm:h-16 items-center gap-3 px-4 sm:px-6 border-b border-slate-700/60 flex-shrink-0">
            <div class="h-7 w-7 sm:h-8 sm:w-8 rounded-lg bg-primary-500 flex items-center justify-center flex-shrink-0">
                <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
            </div>
            <span class="font-bold text-sm sm:text-base tracking-tight truncate">Admin Panel</span>
            {{-- Close button visible on mobile --}}
            <button @click="sidebarOpen = false" class="ml-auto text-slate-400 hover:text-white lg:hidden flex-shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        {{-- Nav --}}
        <nav class="sidebar-nav flex-1 overflow-y-auto py-4 px-2 sm:px-3 space-y-0.5">

            <p class="px-3 pt-2 pb-1.5 text-[10px] font-semibold uppercase tracking-widest text-slate-500">Menu</p>

            @php
                $navItems = [
                    ['route' => 'admin.dashboard',       'label' => 'Dashboard',  'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
                    ['route' => 'admin.articles.index',  'label' => 'Artikel',    'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
                    ['route' => 'admin.magazines.index', 'label' => 'Majalah',    'icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253'],
                    ['route' => 'admin.members.index',   'label' => 'Organisasi', 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z'],
                    ['route' => 'admin.programs.index',  'label' => 'Program',    'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2'],
                ];
            @endphp

            @foreach($navItems as $item)
                @php
                    $routePrefix = str_replace('.index', '', $item['route']);
                    $isActive = request()->routeIs($item['route'])
                        || str_starts_with(request()->route()?->getName() ?? '', $routePrefix);
                @endphp
                <a
                    href="{{ route($item['route']) }}"
                    @click="sidebarOpen = false"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all
                        {{ $isActive ? 'bg-primary-600 text-white shadow-sm' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}"
                >
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="{{ $item['icon'] }}"/>
                    </svg>
                    <span class="truncate">{{ $item['label'] }}</span>
                </a>
            @endforeach
        </nav>

        {{-- User info --}}
        <div class="border-t border-slate-700/60 p-3 sm:p-4 flex-shrink-0">
            <div class="flex items-center gap-2 sm:gap-3">
                <div class="h-8 w-8 sm:h-9 sm:w-9 rounded-full bg-primary-500/20 flex items-center justify-center flex-shrink-0">
                    <span class="text-primary-400 text-xs sm:text-sm font-semibold">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </span>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs sm:text-sm font-medium text-white truncate">{{ auth()->user()->name }}</p>
                    <p class="text-[10px] sm:text-xs text-slate-500 truncate">{{ auth()->user()->email }}</p>
                </div>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="text-slate-500 hover:text-red-400 transition-colors p-1" title="Logout">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    {{-- Main wrapper --}}
    <div class="lg:pl-64 flex flex-col min-h-screen">

        {{-- Topbar --}}
        <header class="sticky top-0 z-10 bg-white border-b border-slate-200 h-14 sm:h-16 flex items-center px-3 sm:px-4 lg:px-6 gap-3">
            {{-- Hamburger --}}
            <button
                @click="sidebarOpen = !sidebarOpen"
                class="lg:hidden flex items-center justify-center w-9 h-9 rounded-lg text-slate-500 hover:bg-slate-100 hover:text-slate-800 transition-colors flex-shrink-0"
                aria-label="Buka menu"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>

            {{-- Page title --}}
            <div class="flex-1 min-w-0">
                <h1 class="text-sm sm:text-base font-semibold text-slate-800 truncate">
                    @yield('page-title', 'Dashboard')
                </h1>
            </div>

            {{-- Header actions (tombol tambah dll) --}}
            <div class="flex-shrink-0">
                @yield('header-actions')
            </div>
        </header>

        {{-- Content --}}
        <main class="flex-1 p-3 sm:p-4 lg:p-6">

            {{-- Flash success --}}
            @if(session('success'))
                <div
                    x-data="{ show: true }"
                    x-show="show"
                    x-init="setTimeout(() => show = false, 4000)"
                    x-transition:leave="transition-opacity duration-300"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="mb-4 flex items-start gap-3 bg-green-50 border border-green-200 text-green-700 rounded-xl px-4 py-3 text-sm"
                >
                    <svg class="w-5 h-5 text-green-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            {{-- Flash error --}}
            @if(session('error'))
                <div class="mb-4 flex items-start gap-3 bg-red-50 border border-red-200 text-red-700 rounded-xl px-4 py-3 text-sm">
                    <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    @stack('scripts')
</body>
</html>
