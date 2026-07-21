<x-guest-layout>
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        
        <!-- Logo -->
        <div class="mb-6 flex">
            <a href="{{ route('home') }}" class="inline-block">
                <img src="{{ $siteLogo ?? '' }}" alt="Arka Global Academy" class="h-12 w-auto object-contain">
            </a>
        </div>

        <!-- Title -->
        <div class="mb-10">
            <h2 class="text-2xl lg:text-3xl font-heading font-bold text-slate-800 tracking-tight mb-2">Selamat Datang Kembali</h2>
            <p class="text-sm text-slate-500">Log in untuk mengelola Blog Arka Global Academy.</p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-sm font-bold text-slate-600 mb-2">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                    class="w-full h-12 bg-slate-50 border border-slate-200 px-4 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent rounded-xl shadow-sm transition-colors">
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600 text-sm font-medium" />
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-bold text-slate-600 mb-2">Password</label>
                <input id="password" type="password" name="password" required autocomplete="current-password"
                    class="w-full h-12 bg-slate-50 border border-slate-200 px-4 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent rounded-xl shadow-sm transition-colors">
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600 text-sm font-medium" />
            </div>

            <div class="flex items-center justify-between">
                <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                    <input id="remember_me" type="checkbox" class="rounded border-slate-300 text-orange-600 shadow-sm focus:ring-orange-600 w-4 h-4 cursor-pointer" name="remember">
                    <span class="ms-2 text-sm font-medium text-slate-600 group-hover:text-slate-900 transition-colors">Ingat saya</span>
                </label>
                @if (Route::has('password.request'))
                    <a class="text-sm font-bold text-orange-600 hover:text-slate-900 transition-colors" href="{{ route('password.request') }}">
                        Lupa password?
                    </a>
                @endif
            </div>

            <div class="pt-2">
                <button type="submit" class="w-full h-12 flex items-center justify-center bg-orange-600 text-white text-sm font-bold tracking-widest uppercase hover:bg-slate-900 transition-colors rounded-xl shadow-md focus:ring-2 focus:ring-offset-2 focus:ring-orange-600">
                    Log in
                </button>
            </div>
            
            <div class="mt-8 text-sm text-slate-500 space-y-4">
                <p>
                    Dengan melanjutkan, Anda menyetujui <a href="#" class="font-bold text-orange-600 hover:text-slate-900 transition-colors">Syarat Layanan</a> dan <a href="#" class="font-bold text-orange-600 hover:text-slate-900 transition-colors">Kebijakan Privasi</a> kami.
                </p>
                <p>
                    Belum punya akun? <span class="text-slate-900 font-bold">Hubungi administrator.</span>
                </p>
            </div>
        </form>
    </div>
</x-guest-layout>
