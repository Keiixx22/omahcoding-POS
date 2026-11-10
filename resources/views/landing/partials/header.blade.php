<a href="#fitur" class="sr-only focus:not-sr-only focus:fixed focus:top-3 focus:left-3 focus:z-[60] btn-neon">Lewati ke konten</a>

<header class="sticky top-0 z-50 backdrop-blur-xl bg-[#0E0F1A]/80 border-b border-edge">
    <div class="max-w-6xl mx-auto px-5 h-16 flex items-center justify-between gap-4">
        <a href="{{ url('/') }}" class="flex items-center gap-2.5" aria-label="TapKit beranda">
            <img src="{{ asset('img/tapkit-icon.svg') }}" alt="" width="36" height="36" class="w-9 h-9 rounded-xl shadow-[0_0_18px_rgba(210,248,57,.4)]">
            <span class="text-base sm:text-lg font-extrabold tracking-tight">Tap<span class="text-neon">Kit</span></span>
        </a>
        <nav class="hidden md:flex items-center gap-8 text-sm font-semibold text-slate-300" aria-label="Menu utama">
            <a href="#fitur" class="hover:text-neon transition-colors">Fitur</a>
            <a href="#cara-kerja" class="hover:text-neon transition-colors">Cara mulai</a>
            <a href="#faq" class="hover:text-neon transition-colors">Tanya jawab</a>
        </nav>
        <div class="flex items-center gap-2">
            @auth
                <a href="{{ auth()->user()->isAdmin() ? route('dashboard') : route('pos') }}" class="btn-neon !h-10 !px-4 sm:!px-5 whitespace-nowrap">Buka dashboard</a>
            @else
                <a href="#masuk" onclick="switchAuthTab('login')" class="text-sm font-bold text-slate-200 hover:text-neon px-2 sm:px-3 py-2">Masuk</a>
                <a href="#auth-section" onclick="switchAuthTab('register')" class="btn-neon !h-10 !px-4 sm:!px-5 whitespace-nowrap">Daftar</a>
            @endauth
        </div>
    </div>
</header>
