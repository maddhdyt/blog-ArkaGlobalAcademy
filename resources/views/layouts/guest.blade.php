<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ isset($title) ? $title . ' - ' . config('app.name', 'Arka Global Academy') : config('app.name', 'Arka Global Academy') }}</title>

        <!-- Favicon -->
        <link rel="icon" href="https://res.cloudinary.com/dzwbyqnau/image/upload/v1772547450/logoap_ph63ev.webp" type="image/webp">
        <link rel="apple-touch-icon" href="https://res.cloudinary.com/dzwbyqnau/image/upload/v1772547450/logoap_ph63ev.webp">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap" rel="stylesheet">
        
        <style>
            @font-face {
                font-family: 'Feature';
                src: local('Georgia'), local('Times New Roman'), serif;
            }
            .font-heading { font-family: 'Feature', serif; }
            .font-sans { font-family: 'DM Sans', sans-serif; }
            .text-brand-primary { color: #ea580c; }
            .bg-brand-primary { background-color: #ea580c; }
        </style>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-slate-600 bg-white">
        <div class="min-h-screen flex">
            <!-- Left Side: Form Container -->
            <div class="flex-1 flex flex-col justify-center px-6 py-12 sm:px-12 lg:px-20 xl:px-24">
                <div class="w-full max-w-sm mx-auto">
                    {{ $slot }}
                </div>
            </div>
            
            <!-- Right Side: Graphic/Branding Pane -->
            <div class="hidden lg:flex lg:flex-1 relative bg-slate-900 overflow-hidden">
                <!-- Dynamic Mesh Gradient Background -->
                <div class="absolute inset-0">
                    <div class="absolute inset-0 bg-slate-900"></div>
                    <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-orange-600/30 rounded-full blur-[100px] transform translate-x-1/3 -translate-y-1/3"></div>
                    <div class="absolute bottom-0 left-0 w-[600px] h-[600px] bg-blue-600/20 rounded-full blur-[120px] transform -translate-x-1/3 translate-y-1/3"></div>
                </div>

                <!-- Decorative Pattern -->
                <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMiIgY3k9IjIiIHI9IjIiIGZpbGw9IiNmZmZmZmYiIGZpbGwtb3BhY2l0eT0iMC4wNSIvPjwvc3ZnPg==')] [mask-image:linear-gradient(to_bottom,white,transparent)]"></div>

                <!-- Glassmorphism Content Card -->
                <div class="absolute inset-0 flex items-center justify-center p-12 lg:p-20 relative z-10">
                    <div class="w-full max-w-lg bg-white/10 backdrop-blur-xl border border-white/20 rounded-3xl p-10 shadow-2xl relative overflow-hidden">
                        <!-- Card Highlight -->
                        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-orange-500 to-orange-300"></div>
                        
                        <div class="w-16 h-16 bg-orange-500 rounded-2xl flex items-center justify-center mb-8 shadow-lg shadow-orange-500/30 border border-orange-400/50">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                        <h2 class="text-4xl font-heading text-white font-bold mb-6 leading-tight tracking-tight">Masa Depan Digital <br>Dimulai Dari Sini.</h2>
                        <p class="text-slate-300 text-lg leading-relaxed mb-8">Arka Global Academy memberikan wawasan eksklusif, riset mendalam, dan analisis tajam tentang tren digital marketing untuk memajukan bisnis Anda ke level berikutnya.</p>
                        
                        <!-- Testimonial/Metrics -->
                        <div class="flex items-center gap-4 pt-8 border-t border-white/10">
                            <div class="flex -space-x-3">
                                <img class="w-10 h-10 rounded-full border-2 border-slate-800" src="https://ui-avatars.com/api/?name=Budi&background=0D8ABC&color=fff" alt="User">
                                <img class="w-10 h-10 rounded-full border-2 border-slate-800" src="https://ui-avatars.com/api/?name=Siti&background=EA580C&color=fff" alt="User">
                                <img class="w-10 h-10 rounded-full border-2 border-slate-800" src="https://ui-avatars.com/api/?name=Agus&background=10B981&color=fff" alt="User">
                            </div>
                            <div class="text-sm">
                                <p class="text-white font-bold">Bergabung bersama kami</p>
                                <p class="text-slate-400">ribuan profesional lainnya.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
