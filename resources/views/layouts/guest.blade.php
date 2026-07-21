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
    <body class="font-sans antialiased text-slate-600 bg-slate-50 relative">
        <!-- Subtle Background Pattern -->
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMSIgY3k9IjEiIHI9IjEiIGZpbGw9IiNlMmU4ZjAiLz48L3N2Zz4=')] opacity-60"></div>
        
        <div class="min-h-screen flex flex-col justify-center items-center py-12 sm:px-6 lg:px-8 relative z-10">
            <div class="w-full sm:max-w-md px-8 py-10 bg-white rounded-3xl shadow-xl border border-slate-100">
                {{ $slot }}
            </div>
            
            <div class="mt-8 text-center text-sm text-slate-500">
                &copy; {{ date('Y') }} Arka Global Academy. Hak Cipta Dilindungi.
            </div>
        </div>
    </body>
</html>
