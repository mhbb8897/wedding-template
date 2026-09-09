<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Dalam Pembangunan - MyWedd</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Tailwind CSS & Custom Styles -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <script src="https://cdn.tailwindcss.com"></script>
        @endif

        <style>
            @keyframes spin-slow { to { transform: rotate(360deg); } }
            @keyframes float { 0%, 100% { transform: translateY(0px); } 50% { transform: translateY(-8px); } }
            @keyframes shimmer {
                0% { background-position: -200% 0; }
                100% { background-position: 200% 0; }
            }
            .animate-spin-slow { animation: spin-slow 12s linear infinite; }
            .animate-float { animation: float 3s ease-in-out infinite; }
            .animate-shimmer {
                background: linear-gradient(90deg, #f43f5e 0%, #fb7185 25%, #f59e0b 50%, #fb7185 75%, #f43f5e 100%);
                background-size: 200% 100%;
                animation: shimmer 2.5s infinite linear;
            }
        </style>
    </head>
    <body class="font-sans antialiased bg-slate-900 text-slate-100 min-h-screen md:h-screen md:overflow-hidden flex flex-col justify-between selection:bg-rose-500 selection:text-white">

        <!-- Background Ambient Glow -->
        <div class="fixed inset-0 pointer-events-none overflow-hidden z-0">
            <div class="absolute -top-24 left-1/2 -translate-x-1/2 w-96 h-96 bg-rose-500/15 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-24 right-10 w-80 h-80 bg-amber-500/10 rounded-full blur-3xl"></div>
        </div>

        <!-- Header -->
        <header class="relative z-10 w-full max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="h-10 w-10 bg-rose-500/20 rounded-xl flex items-center justify-center text-rose-500 ring-1 ring-rose-500/30">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                    </svg>
                </div>
                <span class="font-extrabold text-2xl tracking-tight text-white">My<span class="text-rose-500">Wedd</span></span>
            </div>

            @if (Route::has('login'))
                <nav class="flex gap-3 items-center">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm font-semibold text-slate-300 hover:text-white transition">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-semibold text-slate-300 hover:text-white transition px-3 py-1.5">Masuk</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="text-sm font-semibold px-4 py-2 bg-rose-600 text-white rounded-lg hover:bg-rose-500 transition shadow-lg shadow-rose-600/30">Daftar</a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header>

        <!-- Main Content -->
        <main class="relative z-10 flex-1 flex items-center justify-center px-6 py-4 md:py-0">
            <div class="max-w-xl w-full text-center space-y-6">

                <!-- Graphic & Animation Container -->
                <div class="relative w-28 h-28 sm:w-32 sm:h-32 mx-auto flex items-center justify-center">
                    <!-- Outer Ring (Spinning Gear) -->
                    <svg class="absolute w-full h-full text-slate-700 animate-spin-slow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>

                    <!-- Center Floating Icon -->
                    <div class="relative z-10 bg-gradient-to-tr from-rose-600 to-rose-400 text-white p-3.5 rounded-2xl shadow-xl shadow-rose-600/30 animate-float">
                        <svg class="w-7 h-7 sm:w-8 sm:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4a2 2 0 114 0v1a2 2 0 01-2 2 2 2 0 01-2-2V4zm-6 8a2 2 0 100-4 2 2 0 000 4zm12 0a2 2 0 100-4 2 2 0 000 4zM5 20h14a2 2 0 002-2v-5a2 2 0 00-2-2H5a2 2 0 00-2 2v5a2 2 0 002 2z" />
                        </svg>
                    </div>
                </div>

                <!-- Status Badge -->
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-rose-500/10 border border-rose-500/20 text-rose-400 text-xs font-medium">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-rose-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-rose-500"></span>
                    </span>
                    Tahap Pengembangan
                </div>

                <!-- Text Headings -->
                <div class="space-y-2">
                    <h1 class="text-2xl sm:text-4xl font-extrabold tracking-tight text-white leading-tight">
                        Momen Spesial Anda <br class="hidden sm:inline"/>Sedang Kami Siapkan
                    </h1>
                    <p class="text-xs sm:text-sm text-slate-400 max-w-md mx-auto leading-relaxed">
                        <span class="font-semibold text-rose-400">MyWedd</span> sedang membangun pengalaman baru untuk membantu Anda mengelola hari bahagia dengan sempurna.
                    </p>
                </div>

                <!-- Dynamic Progress Bar -->
                <div class="w-full max-w-xs mx-auto space-y-2 pt-2">
                    <div class="h-2 w-full bg-slate-800 rounded-full overflow-hidden p-0.5 border border-slate-700/80">
                        <!-- Progress bar fill with Shimmer Effect -->
                        <div id="progress-bar" class="h-full rounded-full animate-shimmer transition-all duration-75 ease-out" style="width: 0%;"></div>
                    </div>
                    <div class="flex justify-between items-center text-[11px] sm:text-xs text-slate-400">
                        <span>Progres Pengerjaan</span>
                        <span id="progress-text" class="font-bold text-rose-400">0%</span>
                    </div>
                </div>

            </div>
        </main>

        <!-- Footer -->
        <footer class="relative z-10 py-4 text-center text-xs text-slate-500">
            &copy; {{ date('Y') }} <span class="text-slate-400 font-medium">MyWedd</span>. Seluruh Hak Cipta Dilindungi.
        </footer>

        <!-- Script Animasi Progress -->
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                let currentProgress = 0;
                const targetProgress = 80; // Persentase target
                const progressBar = document.getElementById('progress-bar');
                const progressText = document.getElementById('progress-text');

                const interval = setInterval(() => {
                    if (currentProgress < targetProgress) {
                        currentProgress++;
                        progressBar.style.width = currentProgress + '%';
                        progressText.textContent = currentProgress + '%';
                    } else {
                        clearInterval(interval);
                    }
                }, 20); // Kecepatan animasi (20ms per 1%)
            });
        </script>

    </body>
</html>