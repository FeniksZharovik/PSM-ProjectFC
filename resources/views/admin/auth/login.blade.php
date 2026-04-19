<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Plus Jakarta Sans', sans-serif; } </style>
</head>
<body class="h-full bg-slate-50 flex items-center justify-center p-3 sm:p-4">

    <div class="w-full max-w-[320px] xs:max-w-sm sm:max-w-md">

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-5 sm:p-8">

            {{-- Logo --}}
            <div class="mb-6 sm:mb-8 text-center">
                <div class="inline-flex h-10 w-10 sm:h-12 sm:w-12 rounded-xl bg-sky-600 items-center justify-center mb-3 sm:mb-4">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <h1 class="text-lg sm:text-xl font-bold text-slate-900">Masuk ke Admin</h1>
                <p class="mt-1 text-xs sm:text-sm text-slate-500">Kelola konten website Anda</p>
            </div>

            {{-- Form --}}
            <form method="POST" action="{{ route('admin.login.post') }}" class="space-y-4 sm:space-y-5">
                @csrf

                <div>
                    <label for="email" class="block text-xs sm:text-sm font-medium text-slate-700 mb-1.5">Email</label>
                    <input
                        id="email" name="email" type="email"
                        value="{{ old('email') }}"
                        autocomplete="email" required
                        placeholder="admin@example.com"
                        class="w-full rounded-xl border border-slate-300 px-3 sm:px-4 py-2 sm:py-2.5 text-sm text-slate-900 placeholder-slate-400
                               focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent
                               @error('email') border-red-400 bg-red-50 @enderror"
                    >
                    @error('email')
                        <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-xs sm:text-sm font-medium text-slate-700 mb-1.5">Password</label>
                    <input
                        id="password" name="password" type="password"
                        autocomplete="current-password" required
                        placeholder="••••••••"
                        class="w-full rounded-xl border border-slate-300 px-3 sm:px-4 py-2 sm:py-2.5 text-sm text-slate-900 placeholder-slate-400
                               focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent
                               @error('password') border-red-400 bg-red-50 @enderror"
                    >
                    @error('password')
                        <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center gap-2">
                    <input id="remember" name="remember" type="checkbox"
                        class="h-4 w-4 rounded border-slate-300 text-sky-600 focus:ring-sky-500">
                    <label for="remember" class="text-xs sm:text-sm text-slate-600 select-none">Ingat saya</label>
                </div>

                <button type="submit"
                    class="w-full bg-sky-600 hover:bg-sky-700 active:bg-sky-800 text-white font-semibold py-2 sm:py-2.5 px-4 rounded-xl transition-colors text-sm touch-manipulation">
                    Masuk
                </button>
            </form>
        </div>

        <p class="text-center mt-4 sm:mt-5 text-xs text-slate-400">&copy; {{ date('Y') }} Admin Panel</p>
    </div>

</body>
</html>
