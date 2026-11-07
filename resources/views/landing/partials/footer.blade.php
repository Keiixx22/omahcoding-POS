<footer class="border-t border-edge">
    <div class="max-w-6xl mx-auto px-5 py-10 flex flex-col sm:flex-row items-center justify-between gap-4 text-sm text-slate-400">
        <div class="flex items-center gap-2.5">
            <img src="{{ asset('img/tapkit-icon.svg') }}" alt="" width="32" height="32" class="w-8 h-8 rounded-lg">
            <span class="font-extrabold text-white">Tap<span class="text-neon">Kit</span></span>
        </div>
        <nav class="flex gap-6 font-medium" aria-label="Footer">
            <a href="#fitur" class="hover:text-neon">Fitur</a>
            <a href="#cara-kerja" class="hover:text-neon">Cara mulai</a>
            <a href="#faq" class="hover:text-neon">Tanya jawab</a>
        </nav>
        <p>&copy; {{ date('Y') }} TapKit</p>
    </div>
</footer>
