@extends('landing.partials.auth.recovery-layout')

@section('title', 'Lupa Kata Sandi')

@section('content')
    <div class="icon-badge" aria-hidden="true">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="5" width="18" height="14" rx="2" />
            <path d="m3 7 9 6 9-6" />
        </svg>
    </div>

    @if (session('status'))
        {{-- Sukses: form disembunyikan, user diarahkan cek email --}}
        <span class="eyebrow">Email terkirim</span>
        <h1>Cek kotak masuk Anda</h1>

        <div class="alert alert-ok" role="status">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="9" /><path d="m8 12 3 3 5-6" /></svg>
            <p>{{ session('status') }}</p>
        </div>

        <p class="lead">Belum ada email? Cek folder spam atau promosi. Tautan berlaku terbatas, jadi segera gunakan.</p>

        <a href="{{ route('password.request') }}" class="btn btn-ghost">Gunakan email lain</a>
    @else
        <span class="eyebrow">Pemulihan akun</span>
        <h1>Lupa kata sandi?</h1>
        <p class="lead">Masukkan email akun CashierStore Anda. Kami kirim tautan untuk mengatur ulang kata sandi.</p>

        @if ($errors->any())
            <div class="alert alert-err" role="alert">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="9" /><path d="M12 8v5M12 16h.01" /></svg>
                <div>
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            </div>
        @endif

        <form action="{{ route('password.email') }}" method="POST" class="form" id="forgot-form">
            @csrf
            <div>
                <label for="email" class="label">Alamat Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                    autocomplete="email" inputmode="email" autocapitalize="off" spellcheck="false"
                    placeholder="owner@tokomu.id" class="input @error('email') is-error @enderror">
            </div>

            <button type="submit" class="btn" id="forgot-btn">
                <span class="spin" aria-hidden="true"></span>
                <span>Kirim Tautan Reset</span>
            </button>
        </form>
    @endif

    <div class="divider">
        <a href="{{ route('login') }}" class="back">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M19 12H5M12 19l-7-7 7-7" /></svg>
            Kembali ke halaman login
        </a>
    </div>
@endsection

@push('scripts')
    <script>
        // cegah klik ganda saat kirim
        (function () {
            var f = document.getElementById('forgot-form');
            if (!f) return;
            f.addEventListener('submit', function () {
                var b = document.getElementById('forgot-btn');
                b.disabled = true;
                b.classList.add('loading');
            });
        })();
    </script>
@endpush
