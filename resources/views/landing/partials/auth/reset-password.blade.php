
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Atur Ulang Kata Sandi | CashierStore</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body class="min-h-screen bg-slate-50 flex items-center justify-center p-5">

    <main class="w-full max-w-md">

        {{-- Brand --}}
        <div class="text-center mb-8">
            <a href="{{ route('landing') }}"
                class="inline-flex items-center gap-2 text-2xl font-extrabold tracking-tight text-slate-900">
                <span class="flex items-center justify-center w-10 h-10 rounded-xl bg-blue-600 text-white">
                    C
                </span>
                CashierStore
            </a>

            <p class="text-xs text-slate-400 mt-2 font-medium">
                Next-Gen POS & Operating System
            </p>
        </div>

        {{-- Card --}}
        <div class="bg-white border border-slate-200 rounded-3xl shadow-xl shadow-slate-200/50 p-7 sm:p-9">

            {{-- Icon --}}
            <div class="w-14 h-14 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="11" width="18" height="11" rx="2" />
                    <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                    <path d="m10 16 2 2 4-4" />
                </svg>
            </div>

            <div class="space-y-2 mb-7">
                <h1 class="text-2xl font-extrabold text-slate-900">
                    Buat kata sandi baru
                </h1>

                <p class="text-sm text-slate-500 leading-relaxed">
                    Silakan buat kata sandi baru untuk akun CashierStore Anda.
                    Gunakan kata sandi yang kuat dan mudah Anda ingat.
                </p>
            </div>

            {{-- Validation errors --}}
            @if ($errors->any())
                <div class="mb-5 p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-700 text-xs font-semibold space-y-1">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            {{-- Form --}}
            <form action="{{ route('password.update') }}" method="POST" class="space-y-5">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <div>
                    <label for="email"
                        class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        Alamat Email
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email', $email) }}"
                        required
                        readonly
                        autocomplete="email"
                        class="w-full px-4 py-3.5 rounded-xl border border-slate-200 bg-slate-100 text-sm text-slate-500 outline-none cursor-not-allowed"
                    >

                    @error('email')
                        <p class="text-xs text-rose-600 font-semibold mt-2">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label for="password"
                        class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        Kata Sandi Baru
                    </label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        required
                        autofocus
                        autocomplete="new-password"
                        placeholder="Masukkan kata sandi baru"
                        class="w-full px-4 py-3.5 rounded-xl border border-slate-200 bg-slate-50 text-sm text-slate-800 outline-none transition-all focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 @error('password') border-rose-400 @enderror"
                    >

                    @error('password')
                        <p class="text-xs text-rose-600 font-semibold mt-2">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation"
                        class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        Konfirmasi Kata Sandi
                    </label>

                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        required
                        autocomplete="new-password"
                        placeholder="Ulangi kata sandi baru"
                        class="w-full px-4 py-3.5 rounded-xl border border-slate-200 bg-slate-50 text-sm text-slate-800 outline-none transition-all focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10"
                    >
                </div>

                <button type="submit"
                    class="w-full py-4 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-sm font-extrabold shadow-lg shadow-blue-600/20 transition-all active:scale-[0.98]">
                    Simpan Kata Sandi Baru
                </button>
            </form>

            {{-- Back to login --}}
            <div class="mt-7 pt-6 border-t border-slate-100 text-center">
                <a href="{{ route('login') }}"
                    class="inline-flex items-center gap-2 text-xs font-bold text-slate-500 hover:text-blue-600 transition-colors">
                    <span aria-hidden="true">&larr;</span>
                    Kembali ke halaman login
                </a>
            </div>

        </div>

        <p class="text-center text-[10px] text-slate-400 mt-7">
            &copy; {{ date('Y') }} CashierStore. All rights reserved.
        </p>

    </main>

</body>
</html>
