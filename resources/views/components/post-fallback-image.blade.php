@props(['category' => 'A'])

<div class="h-full w-full flex items-center justify-center bg-gradient-to-br from-slate-100 to-slate-200 transition duration-700 relative overflow-hidden group-hover:scale-105">
    <!-- Decorative abstract elements -->
    <div class="absolute -right-10 -top-10 w-40 h-40 bg-orange-500/10 rounded-full blur-3xl"></div>
    <div class="absolute -left-10 -bottom-10 w-32 h-32 bg-blue-500/10 rounded-full blur-2xl"></div>
    
    <!-- Diagonal grid pattern for texture -->
    <div class="absolute inset-0 opacity-[0.03]" style="background-image: repeating-linear-gradient(45deg, #000 0, #000 1px, transparent 0, transparent 50%); background-size: 10px 10px;"></div>
    
    <!-- Center Text -->
    <div class="relative z-10 px-6 py-3 bg-white/60 backdrop-blur-md rounded-2xl shadow-sm border border-white/50 flex items-center justify-center text-lg sm:text-xl font-bold text-orange-600 font-heading tracking-wide">
        {{ $category }}
    </div>
</div>
