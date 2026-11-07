<!DOCTYPE html>
<html lang="id">
<head>
  <title>Masuk · TapKit Platform</title>
  <meta name="robots" content="noindex,nofollow">
  @include('partials.head')
  <style>.label { color:#565B75; }</style>
</head>
<body class="min-h-screen bg-sidebar-bg">
<main class="min-h-screen grid place-items-center p-4">
  <div class="w-full max-w-md">
    <div class="flex items-center gap-3 mb-6 text-white">
      <img src="{{ asset('img/tapkit-icon.svg') }}" alt="" width="44" height="44" class="w-11 h-11 rounded-2xl shrink-0">
      <div class="leading-tight"><div class="font-extrabold text-xl tracking-tight">Tap<span class="text-lime-accent">Kit</span></div><div class="text-sm font-bold text-slate-400">Platform</div></div>
    </div>
    <div class="rounded-3xl bg-white p-6 sm:p-8">
      <h1 class="text-2xl font-extrabold tracking-tight text-slate-900">Masuk admin platform</h1>
      <p class="text-sm font-medium text-slate-500 mt-1 mb-6">Khusus pemilik TapKit. Bukan untuk pemilik toko atau kasir.</p>

      <form method="POST" action="{{ route('platform.login.store') }}" class="space-y-4">
        @csrf
        <div>
          <label for="email" class="label">Email</label>
          <input id="email" class="input" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" autofocus>
        </div>
        <div>
          <label for="password" class="label">Kata sandi</label>
          <input id="password" class="input" type="password" name="password" required autocomplete="current-password">
        </div>
        @if ($errors->any())<p class="rounded-2xl bg-red-50 border border-red-100 text-red-700 px-4 py-2.5 text-sm font-semibold" role="alert">{{ $errors->first() }}</p>@endif
        <button type="submit" class="btn-primary w-full h-12">Masuk</button>
      </form>
    </div>
    <p class="text-center text-sm text-slate-400 mt-5">Pemilik toko atau kasir? <a class="text-lime-accent font-bold hover:underline" href="{{ route('landing') }}#masuk">Masuk di sini</a></p>
  </div>
</main>
</body>
</html>
