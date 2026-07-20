<div class="fixed top-4 md:top-6 left-0 right-0 z-50 flex justify-center px-4 font-sans">
    <nav class="w-full max-w-6xl bg-white/80 backdrop-blur-2xl backdrop-saturate-150 border border-white/50 shadow-2xl shadow-slate-400/10 rounded-full transition-all duration-300 ring-1 ring-slate-900/5 relative">
        <div class="px-6 md:px-10">
            <div class="flex justify-between items-center h-16 md:h-20">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center gap-2">
                        <img src="{{ $siteLogo }}" alt="Arka Global Academy" class="h-8 md:h-10 w-auto">
                    </a>
                </div>

            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center space-x-8">
                @foreach ($menus as $menu)
                    @if ($menu->children->isEmpty())
                        <a href="{{ $menu->getUrl() }}" class="text-[14px] md:text-[15px] font-bold text-slate-600 font-sans hover:text-slate-900 transition">
                            {{ $menu->title }}
                        </a>
                    @else
                        <div class="relative group">
                            <button type="button"
                                class="flex items-center gap-1.5 text-[14px] md:text-[15px] font-bold text-slate-600 font-sans hover:text-slate-900 transition py-2">
                                {{ $menu->title }}
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                    class="h-4 w-4 text-slate-400 group-hover:text-slate-900 transition">
                                    <path fill-rule="evenodd"
                                        d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 10.94l3.71-3.71a.75.75 0 1 1 1.06 1.06l-4.24 4.25a.75.75 0 0 1-1.06 0L5.21 8.29a.75.75 0 0 1 .02-1.08Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>

                            <div
                                class="absolute left-1/2 top-full mt-2 w-[320px] -translate-x-1/2 bg-white/95 backdrop-blur-xl border border-white/50 shadow-2xl rounded-3xl opacity-0 invisible group-hover:opacity-100 group-hover:visible group-focus-within:opacity-100 group-focus-within:visible transition-all z-50 ring-1 ring-slate-900/5 overflow-hidden">
                                <div class="p-5 grid gap-3">
                                    @foreach ($menu->children as $child)
                                        @php
                                            $iconClass = 'h-5 w-5';
                                            $iconName = $child->icon ?? 'document';
                                            $bgColor = $child->icon_color ?? 'bg-slate-800';
                                            
                                            if ($iconName === 'search') {
                                                $icon = '<svg class="'.$iconClass.'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.5 7.5v6m3-3h-6" /></svg>';
                                            } elseif ($iconName === 'code') {
                                                $icon = '<svg class="'.$iconClass.'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 9l3 3-3 3m5 0h3M4 17h16a1 1 0 001-1V8a1 1 0 00-1-1H4a1 1 0 00-1 1v8a1 1 0 001 1z" /></svg>';
                                            } elseif ($iconName === 'globe') {
                                                $icon = '<svg class="'.$iconClass.'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" /></svg>';
                                            } elseif ($iconName === 'chart') {
                                                $icon = '<svg class="'.$iconClass.'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941" /></svg>';
                                            } elseif ($iconName === 'design') {
                                                $icon = '<svg class="'.$iconClass.'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.53 16.122a3 3 0 00-5.78 1.128 2.25 2.25 0 01-2.4 2.245 4.5 4.5 0 008.4-2.245c0-.399-.078-.78-.22-1.128zm0 0a15.998 15.998 0 003.388-1.62m-5.043-.025a15.994 15.994 0 011.622-3.395m3.42 3.42a15.995 15.995 0 004.764-4.648l3.813-6.837c.31-.555.05-1.282-.575-1.477a1.35 1.35 0 00-1.632.7c-1.326 2.65-2.652 5.3-4.628 7.373z" /></svg>';
                                            } else {
                                                $icon = '<svg class="'.$iconClass.'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" /></svg>';
                                            }
                                        @endphp
                                        <a href="{{ $child->getUrl() }}"
                                            class="flex items-start gap-4 p-3 hover:bg-slate-50 transition group/child rounded-2xl">
                                            <span
                                                class="inline-flex h-10 w-10 shrink-0 items-center justify-center {{ $bgColor }} text-white rounded-xl shadow-sm group-hover/child:scale-110 transition-transform">
                                                {!! $icon !!}
                                            </span>
                                            <span class="flex flex-col gap-1">
                                                <span
                                                    class="text-[15px] font-medium text-slate-900 font-sans group-hover/child:text-brand-primary transition">{{ $child->title }}</span>
                                                <span
                                                    class="text-[13px] text-slate-600 leading-relaxed">{{ $child->description ?? 'Learn more about ' . $child->title }}</span>
                                            </span>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <!-- Desktop Search & Actions -->
            <div class="hidden md:flex items-center space-x-4">
                <div class="relative">
                    <button type="button" id="navSearchToggle"
                        class="p-2 text-slate-900 hover:text-brand-primary focus:outline-none transition"
                        aria-label="Cari artikel">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.5" class="h-6 w-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m21 21-4.35-4.35m0 0A7.5 7.5 0 1 0 5 5a7.5 7.5 0 0 0 11.65 11.65Z" />
                        </svg>
                    </button>

                    <div id="navSearchPanel"
                        class="hidden absolute right-0 mt-4 w-96 bg-white border border-slate-200 p-6 shadow-xl z-50">
                        <form action="{{ route('posts.search') }}" method="GET" class="space-y-4">
                            <div class="flex items-center gap-2">
                                <input type="text" name="q" placeholder="Cari artikel..." autocomplete="off"
                                    class="flex-1 min-w-0 px-4 py-2.5 bg-slate-50 border border-transparent focus:border-slate-900 focus:bg-white focus:ring-0 transition-colors text-sm">
                                <button type="submit" class="px-5 py-2.5 text-sm font-bold tracking-widest text-white uppercase bg-slate-900 hover:bg-black transition-colors font-mono">
                                    Cari
                                </button>
                            </div>
                            <p class="text-xs text-slate-500 font-mono tracking-wide uppercase">Cari artikel terbaru dan populer.</p>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden flex items-center gap-4">
                <button type="button" id="mobileSearchBtn" class="text-slate-900 hover:text-brand-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-4.35-4.35m0 0A7.5 7.5 0 1 0 5 5a7.5 7.5 0 0 0 11.65 11.65Z" />
                    </svg>
                </button>
                <button type="button" id="mobileMenuBtn" class="text-slate-900 hover:text-brand-primary transition">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"></path>
                    </svg>
                </button>
            </div>
        </div>
    </nav>
</div>

<!-- Mobile Search Overlay -->
<div id="mobileSearchOverlay" class="fixed inset-0 bg-white z-[60] hidden flex-col">
    <div class="flex items-center justify-between p-4 border-b border-slate-200">
        <span class="text-sm font-bold font-mono uppercase tracking-widest text-slate-900">Pencarian</span>
        <button type="button" id="closeMobileSearchBtn" class="p-2 text-slate-900">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
    <div class="p-6">
        <form action="{{ route('posts.search') }}" method="GET" class="space-y-4">
            <input type="text" name="q" placeholder="Cari artikel..." autocomplete="off"
                class="w-full px-4 py-3 bg-slate-50 border border-transparent focus:border-slate-900 focus:bg-white focus:ring-0 transition-colors text-sm">
            <button type="submit" class="w-full px-5 py-3 text-sm font-bold tracking-widest text-white uppercase bg-slate-900 hover:bg-black transition-colors font-mono">
                Cari Artikel
            </button>
        </form>
    </div>
</div>

<!-- Mobile Menu Overlay -->
<div id="mobileMenuOverlay" class="fixed inset-0 bg-black/50 z-[60] hidden backdrop-blur-sm">
    <div id="mobileMenuDrawer" class="absolute right-0 top-0 bottom-0 w-4/5 max-w-sm bg-white shadow-2xl flex flex-col translate-x-full transition-transform duration-300">
        <div class="flex items-center justify-between p-6 border-b border-slate-200">
            <span class="text-sm font-bold font-mono uppercase tracking-widest text-slate-900">Menu</span>
            <button type="button" id="closeMobileMenuBtn" class="p-2 -mr-2 text-slate-900">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="p-6 overflow-y-auto flex-1">
            <ul class="space-y-6">
                @foreach ($menus as $menu)
                    @if ($menu->children->isEmpty())
                        <li>
                            <a href="{{ $menu->getUrl() }}" class="block text-xl font-medium text-slate-900 font-sans">
                                {{ $menu->title }}
                            </a>
                        </li>
                    @else
                        <li class="space-y-4">
                            <span class="block text-xl font-medium text-slate-900 font-sans border-b border-slate-200 pb-2">
                                {{ $menu->title }}
                            </span>
                            <ul class="space-y-4 pl-4 border-l border-slate-200">
                                @foreach ($menu->children as $child)
                                    <li>
                                        <a href="{{ $child->getUrl() }}" class="block text-[15px] text-slate-600">
                                            {{ $child->title }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Desktop Search
        const toggle = document.getElementById('navSearchToggle');
        const panel = document.getElementById('navSearchPanel');

        if (toggle && panel) {
            const closePanel = () => panel.classList.add('hidden');
            toggle.addEventListener('click', (event) => {
                event.stopPropagation();
                panel.classList.toggle('hidden');
            });
            document.addEventListener('click', (event) => {
                if (!panel.contains(event.target) && !toggle.contains(event.target)) {
                    closePanel();
                }
            });
        }

        // Mobile Menu
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const closeMobileMenuBtn = document.getElementById('closeMobileMenuBtn');
        const mobileMenuOverlay = document.getElementById('mobileMenuOverlay');
        const mobileMenuDrawer = document.getElementById('mobileMenuDrawer');

        if (mobileMenuBtn && mobileMenuOverlay) {
            mobileMenuBtn.addEventListener('click', () => {
                mobileMenuOverlay.classList.remove('hidden');
                // Trigger reflow
                void mobileMenuDrawer.offsetWidth;
                mobileMenuDrawer.classList.remove('translate-x-full');
            });

            const closeMobileMenu = () => {
                mobileMenuDrawer.classList.add('translate-x-full');
                setTimeout(() => {
                    mobileMenuOverlay.classList.add('hidden');
                }, 300);
            };

            closeMobileMenuBtn.addEventListener('click', closeMobileMenu);
            mobileMenuOverlay.addEventListener('click', (e) => {
                if (e.target === mobileMenuOverlay) closeMobileMenu();
            });
        }

        // Mobile Search
        const mobileSearchBtn = document.getElementById('mobileSearchBtn');
        const closeMobileSearchBtn = document.getElementById('closeMobileSearchBtn');
        const mobileSearchOverlay = document.getElementById('mobileSearchOverlay');

        if (mobileSearchBtn && mobileSearchOverlay) {
            mobileSearchBtn.addEventListener('click', () => {
                mobileSearchOverlay.classList.remove('hidden');
                mobileSearchOverlay.classList.add('flex');
            });
            closeMobileSearchBtn.addEventListener('click', () => {
                mobileSearchOverlay.classList.add('hidden');
                mobileSearchOverlay.classList.remove('flex');
            });
        }
    });
</script>
