<!DOCTYPE html>
<html lang="id" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#0E0F1A">
    <meta name="robots" content="noindex, nofollow">
    <title>@yield('title') | TapKit</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('img/tapkit-icon.svg') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @verbatim
    <style>
        :root { --neon:#D2F839; --ink:#0E0F1A; --panel:#181928; --field:#111222; --edge:#272942; --edge2:#34364F; --text:#F1F2F8; --muted:#A5A9B8; --dim:#6F7491; }
        *, *::before, *::after { box-sizing: border-box; }
        html { -webkit-tap-highlight-color: transparent; -webkit-text-size-adjust: 100%; }
        body { margin:0; min-height:100vh; min-height:100dvh; background:var(--ink); color:var(--text); font-family:'Plus Jakarta Sans', system-ui, -apple-system, 'Segoe UI', sans-serif; line-height:1.5; position:relative; overflow-x:hidden; }
        ::selection { background:var(--neon); color:#181829; }
        a { color:inherit; text-decoration:none; }
        :is(a, button, input):focus-visible { outline:2px solid var(--neon); outline-offset:3px; }

        /* latar: grid + glow neon, sama seperti hero landing */
        .bg-grid { position:absolute; inset:0; pointer-events:none; z-index:0;
            background-image: radial-gradient(60% 45% at 50% 0%, rgba(210,248,57,.14), transparent 70%), linear-gradient(rgba(255,255,255,.04) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,.04) 1px, transparent 1px);
            background-size: auto, 44px 44px, 44px 44px;
            -webkit-mask-image: linear-gradient(#000 60%, transparent); mask-image: linear-gradient(#000 60%, transparent); }

        .shell { position:relative; z-index:1; min-height:100vh; min-height:100dvh; display:flex; flex-direction:column;
            padding: max(1rem, env(safe-area-inset-top)) max(1rem, env(safe-area-inset-right)) max(1rem, env(safe-area-inset-bottom)) max(1rem, env(safe-area-inset-left)); }

        /* topbar */
        .topbar { width:100%; max-width:72rem; margin:0 auto; display:flex; align-items:center; justify-content:space-between; gap:1rem; padding:.25rem 0 0; }
        .brand { display:inline-flex; align-items:center; gap:.65rem; font-weight:800; font-size:1.125rem; letter-spacing:-.01em; }
        .brand-mark { width:2.25rem; height:2.25rem; border-radius:.75rem; box-shadow:0 0 18px rgba(210,248,57,.4); }
        .brand b { color:var(--neon); font-weight:800; }
        .toplink { display:inline-flex; align-items:center; gap:.4rem; font-size:.8125rem; font-weight:700; color:#C5C8D8; padding:.5rem .75rem; border-radius:999px; border:1px solid transparent; transition:color .2s, border-color .2s; }
        .toplink:hover { color:var(--neon); border-color:var(--edge); }
        .toplink svg { width:1rem; height:1rem; }

        /* konten */
        .main { flex:1; display:flex; align-items:center; justify-content:center; padding:1.75rem 0 1.25rem; }
        .card { width:100%; max-width:27.5rem; background:var(--panel); border:1px solid var(--edge); border-radius:1.5rem; padding:clamp(1.25rem, 5vw, 2.25rem); box-shadow:0 30px 80px -30px rgba(210,248,57,.22); }
        .icon-badge { width:3.5rem; height:3.5rem; border-radius:1rem; background:rgba(210,248,57,.1); border:1px solid rgba(210,248,57,.28); color:var(--neon); display:flex; align-items:center; justify-content:center; margin-bottom:1.25rem; box-shadow:0 0 28px -6px rgba(210,248,57,.4); }
        .icon-badge svg { width:1.75rem; height:1.75rem; }
        .eyebrow { display:inline-block; font-size:.6875rem; font-weight:800; letter-spacing:.08em; text-transform:uppercase; color:var(--neon); margin-bottom:.5rem; }
        h1 { margin:0 0 .5rem; font-size:clamp(1.5rem, 5.5vw, 1.75rem); line-height:1.2; font-weight:800; letter-spacing:-.02em; color:#F8F9FC; }
        .lead { margin:0 0 1.5rem; font-size:.875rem; color:var(--muted); }
        .lead strong { color:var(--text); font-weight:700; word-break:break-all; }

        /* alert */
        .alert { display:flex; gap:.65rem; align-items:flex-start; padding:.875rem 1rem; border-radius:.875rem; font-size:.8125rem; font-weight:600; line-height:1.45; margin-bottom:1.25rem; }
        .alert svg { flex:none; width:1.125rem; height:1.125rem; margin-top:.1rem; }
        .alert p { margin:0; }
        .alert p + p { margin-top:.25rem; }
        .alert-ok { background:rgba(210,248,57,.08); border:1px solid rgba(210,248,57,.35); color:var(--neon); }
        .alert-err { background:rgba(239,68,68,.13); border:1px solid rgba(239,68,68,.35); color:#F87171; }

        /* form */
        .form { display:grid; gap:1.25rem; }
        .label { display:block; margin-bottom:.5rem; font-size:.75rem; font-weight:700; letter-spacing:.04em; text-transform:uppercase; color:#E2E4EE; }
        .input-wrap { position:relative; }
        .input { width:100%; height:3.25rem; padding:0 1rem; border-radius:.875rem; border:1px solid var(--edge2); background:var(--field); color:var(--text); font:inherit; font-size:1rem; font-weight:600; outline:none; transition:border-color .2s, box-shadow .2s; -webkit-appearance:none; appearance:none; }
        .input::placeholder { color:var(--dim); font-weight:500; }
        .input:focus { border-color:var(--neon); box-shadow:0 0 0 4px rgba(210,248,57,.12); }
        .input.is-error { border-color:#F87171; }
        .input[readonly] { background:#0E0F1A; color:var(--muted); cursor:not-allowed; }
        .input.has-btn { padding-right:3.25rem; }
        .input:-webkit-autofill { -webkit-box-shadow:0 0 0 1000px #111222 inset; -webkit-text-fill-color:#F1F2F8; caret-color:#F1F2F8; }
        .eye { position:absolute; top:50%; right:.375rem; transform:translateY(-50%); width:2.5rem; height:2.5rem; border:0; border-radius:.625rem; background:transparent; color:var(--muted); display:flex; align-items:center; justify-content:center; cursor:pointer; transition:color .2s, background .2s; }
        .eye:hover { color:var(--neon); background:rgba(210,248,57,.08); }
        .eye svg { width:1.25rem; height:1.25rem; }
        .eye .off { display:none; }
        .eye[aria-pressed="true"] .on { display:none; }
        .eye[aria-pressed="true"] .off { display:block; }
        .field-err { margin:.5rem 0 0; font-size:.75rem; font-weight:600; color:#F87171; }
        .hint { margin:.5rem 0 0; font-size:.75rem; color:var(--dim); }

        /* indikator kekuatan sandi */
        .meter { display:grid; grid-template-columns:repeat(4, 1fr); gap:.3rem; margin-top:.625rem; }
        .meter i { height:.25rem; border-radius:999px; background:var(--edge2); transition:background .25s; }
        .meter[data-s="1"] i:nth-child(-n+1) { background:#F87171; }
        .meter[data-s="2"] i:nth-child(-n+2) { background:#FBBF24; }
        .meter[data-s="3"] i:nth-child(-n+3) { background:#A3E635; }
        .meter[data-s="4"] i { background:var(--neon); }
        .meter-txt { margin:.4rem 0 0; font-size:.75rem; color:var(--dim); min-height:1.1em; }
        .match { margin:.5rem 0 0; font-size:.75rem; font-weight:600; min-height:1.1em; }
        .match.ok { color:var(--neon); }
        .match.bad { color:#F87171; }

        /* tombol */
        .btn { display:inline-flex; align-items:center; justify-content:center; gap:.5rem; width:100%; height:3.25rem; padding:0 1.5rem; border:0; border-radius:999px; background:var(--neon); color:#181829; font:inherit; font-size:.9375rem; font-weight:800; cursor:pointer; box-shadow:0 0 0 0 rgba(210,248,57,.5); transition:transform .15s, box-shadow .2s, opacity .2s; }
        .btn:hover { transform:translateY(-2px); box-shadow:0 0 28px rgba(210,248,57,.45); }
        .btn:active { transform:scale(.98); }
        .btn[disabled] { opacity:.6; cursor:progress; transform:none; box-shadow:none; }
        .btn-ghost { background:transparent; color:var(--text); border:1px solid var(--edge2); box-shadow:none; }
        .btn-ghost:hover { border-color:var(--neon); background:rgba(210,248,57,.06); box-shadow:none; }
        .spin { width:1.125rem; height:1.125rem; border:2px solid rgba(24,24,41,.3); border-top-color:#181829; border-radius:50%; animation:sp .7s linear infinite; display:none; }
        .btn.loading .spin { display:inline-block; }
        @keyframes sp { to { transform:rotate(360deg); } }

        .divider { margin-top:1.5rem; padding-top:1.25rem; border-top:1px solid var(--edge); text-align:center; }
        .back { display:inline-flex; align-items:center; gap:.4rem; font-size:.8125rem; font-weight:700; color:var(--muted); padding:.5rem .75rem; border-radius:999px; transition:color .2s; }
        .back:hover { color:var(--neon); }
        .back svg { width:1rem; height:1rem; }

        .foot { text-align:center; font-size:.6875rem; color:var(--dim); padding:.5rem 0 0; }

        /* layar sangat kecil + HP landscape pendek */
        @media (max-width: 380px) { .brand { font-size:1rem; } .toplink span { display:none; } }
        @media (max-height: 560px) and (orientation: landscape) { .main { align-items:flex-start; padding-top:1rem; } .icon-badge { display:none; } }
        @media (prefers-reduced-motion: reduce) { * { transition:none !important; animation:none !important; } }
    </style>
    @endverbatim
</head>

<body>
    <div class="bg-grid" aria-hidden="true"></div>

    <div class="shell">
        <header class="topbar">
            <a href="{{ route('landing') }}" class="brand" aria-label="TapKit beranda">
                <img class="brand-mark" src="{{ asset('img/tapkit-icon.svg') }}" alt="" width="36" height="36">
                <span>Tap<b>Kit</b></span>
            </a>
            <a href="{{ route('login') }}" class="toplink">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4M10 17l5-5-5-5M15 12H3" /></svg>
                <span>Masuk</span>
            </a>
        </header>

        <main class="main">
            <section class="card">
                @yield('content')
            </section>
        </main>

        <p class="foot">&copy; {{ date('Y') }} TapKit. All rights reserved.</p>
    </div>

    @stack('scripts')
</body>

</html>
