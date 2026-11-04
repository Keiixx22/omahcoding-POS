<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Lupa Kata Sandi | CashierStore</title>

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
                    <rect x="3" y="5" width="18" height="14" rx="2" />
                    <path d="m3 7 9 6 9-6" />
                    <path d="M16 3v4" />
                </svg>
            </div>

            <div class="space-y-2 mb-7">
                <h1 class="text-2xl font-extrabold text-slate-900">
                    Lupa kata sandi?
                </h1>

                <p class="text-sm text-slate-500 leading-relaxed">
                    Jangan khawatir. Masukkan alamat email akun CashierStore
                    Anda. Kami akan mengirimkan tautan untuk mengatur ulang kata sandi.
                </p>
            </div>

            {{-- Success message --}}
            @if (session('status'))
                <div class="mb-5 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs font-semibold">
                    {{ session('status') }}
                </div>
            @endif

            {{-- Validation errors --}}
            @if ($errors->any())
                <div class="mb-5 p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-700 text-xs font-semibold">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            {{-- Form --}}
            <form action="{{ route('password.email') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label for="email"
                        class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        Alamat Email
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        autocomplete="email"
                        placeholder="owner@tokomu.id"
                        class="w-full px-4 py-3.5 rounded-xl border border-slate-200 bg-slate-50 text-sm text-slate-800 outline-none transition-all focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 @error('email') border-rose-400 @enderror"
                    >

                    @error('email')
                        <p class="text-xs text-rose-600 font-semibold mt-2">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <button type="submit"
                    class="w-full py-4 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-sm font-extrabold shadow-lg shadow-blue-600/20 transition-all active:scale-[0.98]">
                    Kirim Tautan Reset Password
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