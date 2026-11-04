@extends('landing.partials.auth.recovery-layout')

@section('title', 'Atur Ulang Kata Sandi')

@section('content')
    <div class="icon-badge" aria-hidden="true">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="11" width="18" height="11" rx="2" />
            <path d="M7 11V7a5 5 0 0 1 10 0v4" />
            <path d="m10 16 2 2 4-4" />
        </svg>
    </div>

    <span class="eyebrow">Pemulihan akun</span>
    <h1>Buat kata sandi baru</h1>
    <p class="lead">Atur kata sandi baru untuk akun CashierStore Anda. Gunakan kombinasi yang kuat dan mudah diingat.</p>

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

    <form action="{{ route('password.update') }}" method="POST" class="form" id="reset-form">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

        <div>
            <label for="email" class="label">Alamat Email</label>
            <input type="email" id="email" name="email" value="{{ old('email', $email) }}" required readonly
                autocomplete="username" class="input">
        </div>

        <div>
            <label for="password" class="label">Kata Sandi Baru</label>
            <div class="input-wrap">
                <input type="password" id="password" name="password" required autofocus minlength="8"
                    autocomplete="new-password" placeholder="Minimal 8 karakter"
                    class="input has-btn @error('password') is-error @enderror">
                <button type="button" class="eye" data-toggle="password" aria-pressed="false" aria-label="Tampilkan kata sandi">
                    <svg class="on" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12z" /><circle cx="12" cy="12" r="3" /></svg>
                    <svg class="off" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M17.9 17.9A10.7 10.7 0 0 1 12 19c-6.5 0-10-7-10-7a17.6 17.6 0 0 1 4.1-4.9M9.9 5.2A9.7 9.7 0 0 1 12 5c6.5 0 10 7 10 7a17.7 17.7 0 0 1-2.2 3.2M1 1l22 22" /><path d="M9.9 9.9a3 3 0 0 0 4.2 4.2" /></svg>
                </button>
            </div>
            <div class="meter" id="meter" data-s="0" aria-hidden="true"><i></i><i></i><i></i><i></i></div>
            <p class="meter-txt" id="meter-txt">Gunakan huruf dan angka.</p>
        </div>

        <div>
            <label for="password_confirmation" class="label">Konfirmasi Kata Sandi</label>
            <div class="input-wrap">
                <input type="password" id="password_confirmation" name="password_confirmation" required
                    autocomplete="new-password" placeholder="Ulangi kata sandi baru" class="input has-btn">
                <button type="button" class="eye" data-toggle="password_confirmation" aria-pressed="false" aria-label="Tampilkan konfirmasi kata sandi">
                    <svg class="on" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12z" /><circle cx="12" cy="12" r="3" /></svg>
                    <svg class="off" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M17.9 17.9A10.7 10.7 0 0 1 12 19c-6.5 0-10-7-10-7a17.6 17.6 0 0 1 4.1-4.9M9.9 5.2A9.7 9.7 0 0 1 12 5c6.5 0 10 7 10 7a17.7 17.7 0 0 1-2.2 3.2M1 1l22 22" /><path d="M9.9 9.9a3 3 0 0 0 4.2 4.2" /></svg>
                </button>
            </div>
            <p class="match" id="match" aria-live="polite"></p>
        </div>

        <button type="submit" class="btn" id="reset-btn">
            <span class="spin" aria-hidden="true"></span>
            <span>Simpan Kata Sandi Baru</span>
        </button>
    </form>

    <div class="divider">
        <a href="{{ route('login') }}" class="back">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M19 12H5M12 19l-7-7 7-7" /></svg>
            Kembali ke halaman login
        </a>
    </div>
@endsection

@push('scripts')
    <script>
        (function () {
            var pw = document.getElementById('password');
            var cf = document.getElementById('password_confirmation');
            var meter = document.getElementById('meter');
            var txt = document.getElementById('meter-txt');
            var match = document.getElementById('match');
            var labels = ['Gunakan huruf dan angka.', 'Lemah', 'Cukup', 'Kuat', 'Sangat kuat'];

            // tampil / sembunyi kata sandi
            document.querySelectorAll('.eye').forEach(function (b) {
                b.addEventListener('click', function () {
                    var inp = document.getElementById(b.dataset.toggle);
                    var show = inp.type === 'password';
                    inp.type = show ? 'text' : 'password';
                    b.setAttribute('aria-pressed', show ? 'true' : 'false');
                    b.setAttribute('aria-label', (show ? 'Sembunyikan ' : 'Tampilkan ') + 'kata sandi');
                });
            });

            function score(v) {
                if (!v) return 0;
                var s = 0;
                if (v.length >= 8) s++;
                if (/[A-Za-z]/.test(v) && /\d/.test(v)) s++;
                if (v.length >= 12) s++;
                if (/[^A-Za-z0-9]/.test(v) || (/[a-z]/.test(v) && /[A-Z]/.test(v))) s++;
                return Math.max(1, Math.min(4, s));
            }

            function checkMatch() {
                if (!cf.value) { match.textContent = ''; match.className = 'match'; return; }
                var ok = cf.value === pw.value;
                match.textContent = ok ? 'Kata sandi cocok.' : 'Kata sandi belum sama.';
                match.className = 'match ' + (ok ? 'ok' : 'bad');
            }

            pw.addEventListener('input', function () {
                var s = score(pw.value);
                meter.dataset.s = s;
                txt.textContent = labels[s];
                checkMatch();
            });
            cf.addEventListener('input', checkMatch);

            // cegah klik ganda + blokir kalau konfirmasi beda
            document.getElementById('reset-form').addEventListener('submit', function (e) {
                if (pw.value !== cf.value) {
                    e.preventDefault();
                    checkMatch();
                    cf.focus();
                    return;
                }
                var b = document.getElementById('reset-btn');
                b.disabled = true;
                b.classList.add('loading');
            });
        })();
    </script>
@endpush
