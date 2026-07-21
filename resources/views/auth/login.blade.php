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
                <div class="relative">
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                        class="w-full h-12 bg-slate-50 border border-slate-200 pl-4 pr-12 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent rounded-xl shadow-sm transition-colors">
                    
                    <!-- Toggle Password Button -->
                    <button type="button" 
                        onclick="const input = document.getElementById('password'); const type = input.getAttribute('type') === 'password' ? 'text' : 'password'; input.setAttribute('type', type); document.getElementById('eye-icon-closed').classList.toggle('hidden'); document.getElementById('eye-icon-open').classList.toggle('hidden');"
                        class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-orange-600 focus:outline-none transition-colors">
                        
                        <!-- Eye Closed Icon (Default) -->
                        <svg id="eye-icon-closed" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                        </svg>
                        
                        <!-- Eye Open Icon (Hidden initially) -->
                        <svg id="eye-icon-open" class="hidden h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>
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
