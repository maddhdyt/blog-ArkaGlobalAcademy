@extends('layouts.frontend')

@section('meta_description')
{{ $post->meta_description ?? \Illuminate\Support\Str::limit(strip_tags($post->content), 160) }}
@endsection

@section('og_type', 'article')

@if($post->thumbnail)
@section('og_image')
{{ asset('storage/' . $post->thumbnail) }}
@endsection
@endif

@section('structured_data')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Article",
  "headline": "{{ $post->title }}",
  "image": [
    "{{ $post->thumbnail ? asset('storage/' . $post->thumbnail) : '' }}"
   ],
  "datePublished": "{{ optional($post->published_at)->toIso8601String() }}",
  "dateModified": "{{ $post->updated_at->toIso8601String() }}",
  "author": [{
      "@type": "Person",
      "name": "{{ $post->user->name ?? 'Admin' }}"
  }]
}
</script>
@endsection
@section('content')
    <link href="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.snow.css" rel="stylesheet">
    <style>
        .quill-content {
            color: #334155;
            font-size: 1.0625rem; /* 17px for mobile */
            line-height: 1.7;
        }
        @media (min-width: 768px) {
            .quill-content {
                font-size: 1.25rem; /* 20px for desktop */
                line-height: 1.8;
            }
        }
        .quill-content img {
            max-width: 100%;
            height: auto;
            border-radius: 1rem;
            margin: 3rem 0;
            border: 1px solid #e2e8f0;
        }
        .quill-content iframe {
            width: 100%;
            min-height: 400px;
            margin: 3rem 0;
            border-radius: 1rem;
        }
        .quill-content a {
            color: #ea580c;
            text-decoration: underline;
            text-underline-offset: 4px;
            font-weight: 600;
        }
        .quill-content a:hover {
            color: #c2410c;
        }
        .quill-content h2, .quill-content h3, .quill-content h4 {
            color: #0f172a;
            font-family: inherit;
            font-weight: 700;
            margin-top: 3rem;
            margin-bottom: 1.25rem;
            line-height: 1.3;
        }
        .quill-content h2 { font-size: 1.75rem; }
        .quill-content h3 { font-size: 1.5rem; }
        @media (min-width: 768px) {
            .quill-content h2 { font-size: 2.25rem; }
            .quill-content h3 { font-size: 1.75rem; }
        }
        .quill-content ul {
            list-style: disc;
            padding-left: 1.5rem;
            margin: 1.5rem 0;
        }
        .quill-content ol {
            list-style: decimal;
            padding-left: 1.5rem;
            margin: 1.5rem 0;
        }
        .quill-content blockquote {
            border-left: 4px solid #ea580c;
            padding-left: 1.5rem;
            margin: 2rem 0;
            color: #475569;
            font-style: italic;
            font-size: 1.25rem;
            line-height: 1.6;
            background: #fff7ed;
            padding: 1.5rem;
            border-radius: 0 1rem 1rem 0;
        }
        @media (min-width: 768px) {
            .quill-content blockquote {
                padding-left: 2rem;
                margin: 2.5rem 0;
                font-size: 1.5rem;
                padding: 2rem;
            }
        }
        .quill-content pre {
            background: #0f172a;
            color: #f8fafc;
            padding: 1.5rem;
            border-radius: 1rem;
            overflow: auto;
            margin: 2rem 0;
            font-family: monospace;
            font-size: 1rem;
        }
    </style>

    <div class="bg-slate-50">
        <div class="max-w-[1440px] mx-auto px-6 lg:px-12 py-12 lg:py-16">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 lg:gap-0">
                
                <!-- Main Article Column -->
                <article class="lg:col-span-8 xl:col-span-9 lg:pr-12 xl:pr-20">
                    <nav class="flex flex-wrap items-center gap-2 text-[11px] font-mono tracking-widest uppercase text-slate-500 mb-10">
                        <a href="{{ route('home') }}" class="hover:text-orange-600 transition">Home</a>
                        <span>/</span>
                        @if (!empty($post->category))
                            <a href="{{ route('categories.show', $post->category->slug) }}"
                                class="hover:text-orange-600 transition">{{ $post->category->name }}</a>
                            <span>/</span>
                        @endif
                        <span class="font-bold text-slate-900 line-clamp-1">{{ $post->title }}</span>
                    </nav>

                    <div class="space-y-8 max-w-[900px]">
                        <h1 class="text-3xl sm:text-4xl lg:text-[3.5rem] font-bold text-slate-900 font-heading tracking-tight leading-[1.1]">
                            {{ $post->title }}
                        </h1>

                        @if ($post->excerpt)
                            <p class="text-base sm:text-lg lg:text-xl text-slate-600 leading-relaxed">{{ $post->excerpt }}</p>
                        @endif

                        <div class="flex flex-wrap items-center gap-4 text-xs font-mono uppercase tracking-widest text-slate-500 py-6 border-b border-slate-200">
                            @if (!empty($post->category))
                                <a href="{{ route('categories.show', $post->category->slug) }}"
                                    class="px-3 py-1 font-bold text-orange-600 bg-orange-50 rounded-full hover:bg-orange-100 transition">
                                    {{ $post->category->name }}
                                </a>
                            @endif
                            <span class="hidden sm:inline">&middot;</span>
                            <span>{{ optional($post->published_at ?? $post->created_at)->translatedFormat('d M Y') }}</span>
                            <span class="hidden sm:inline">&middot;</span>
                            <span class="flex items-center gap-2">
                                <img src="{{ $post->user->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($post->user->name ?? 'Author') . '&background=0f172a&color=fff' }}"
                                alt="{{ $post->user->name ?? 'Author' }}" class="h-6 w-6 rounded-full object-cover" />
                                Oleh <span class="font-bold text-slate-900">{{ $post->user->name ?? 'Admin' }}</span>
                            </span>
                            <span class="hidden sm:inline">&middot;</span>
                            <span class="flex items-center gap-1.5" title="Jumlah Kunjungan">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                {{ number_format($post->views) }}
                            </span>
                        </div>
                    </div>

                    @if ($post->thumbnail)
                        <div class="mt-10 mb-16 rounded-3xl overflow-hidden shadow-sm border border-slate-200">
                            <img src="{{ $post->thumbnail_url }}" alt="{{ $post->title }}"
                                class="w-full h-auto max-h-[600px] object-cover">
                        </div>
                    @endif

                    <!-- Article Body -->
                    <div class="mt-12">
                        <div class="quill-content w-full">
                            {!! $post->content !!}
                        </div>
                    </div>

                    <!-- Related Posts -->
                    @if ($relatedPosts->isNotEmpty())
                        <div class="mt-24 pt-16 border-t border-slate-200 max-w-[900px]">
                            <h2 class="text-3xl font-bold text-slate-900 font-heading mb-10">Artikel Terkait</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                @foreach ($relatedPosts as $related)
                                    <article class="group bg-white p-5 rounded-3xl shadow-sm border border-slate-200 hover:shadow-md transition">
                                        <div class="aspect-video rounded-2xl overflow-hidden mb-5 bg-slate-100">
                                            @if ($related->thumbnail)
                                                <img src="{{ $related->thumbnail_url }}" alt="{{ $related->title }}"
                                                    class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                                            @endif
                                        </div>
                                        <div class="space-y-3">
                                            <div class="inline-flex items-center gap-2 text-[11px] text-slate-500 font-mono tracking-widest uppercase">
                                                <span class="font-bold text-orange-600">{{ $related->category->name ?? 'Umum' }}</span>
                                                <span>&middot;</span>
                                                <time>{{ optional($related->published_at ?? $related->created_at)->translatedFormat('d M Y') }}</time>
                                            </div>
                                            <h3 class="text-xl font-bold text-slate-900 font-heading leading-snug group-hover:text-orange-600 transition">
                                                <a href="{{ route('posts.show', $related->slug) }}">{{ $related->title }}</a>
                                            </h3>
                                        </div>
                                    </article>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </article>

                <!-- Sidebar -->
                <aside class="lg:col-span-4 xl:col-span-3 space-y-12 lg:border-l border-slate-200 lg:pl-10 xl:pl-12">
                    
                    {{-- Author Profile Widget --}}
                    <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-200 space-y-6">
                        <div class="border-b border-slate-100 pb-4">
                            <p class="text-[11px] font-bold uppercase tracking-widest text-slate-500 font-mono">Profil Penulis</p>
                        </div>
                        <div class="flex items-center gap-4">
                            @php
                                $avatar = optional($sidebar)->author_avatar_url ?:
                                    'https://ui-avatars.com/api/?name=' . urlencode(optional($sidebar)->author_name ?? ($post->user->name ?? 'Author')) . '&background=0f172a&color=fff';
                            @endphp
                            <img src="{{ $avatar }}"
                                alt="{{ optional($sidebar)->author_name ?? ($post->user->name ?? 'Author') }}"
                                class="h-16 w-16 rounded-full border border-slate-200 object-cover" />
                            <div>
                                <p class="text-lg font-bold text-slate-900 font-sans">
                                    {{ optional($sidebar)->author_name ?? ($post->user->name ?? 'Author') }}
                                </p>
                                <p class="text-[11px] text-orange-600 font-bold font-mono tracking-widest uppercase mt-1">
                                    {{ optional($sidebar)->author_role ?? 'Kontributor' }}
                                </p>
                            </div>
                        </div>
                        <p class="text-sm text-slate-600 leading-relaxed">
                            {{ optional($sidebar)->author_bio ?? 'Ikuti akun kami untuk update terbaru seputar strategi digital dan artikel inspiratif.' }}
                        </p>
                        <div class="flex flex-wrap gap-2">
                            @if (optional($sidebar)->author_tiktok_url)
                                <a href="{{ optional($sidebar)->author_tiktok_url }}"
                                    class="bg-slate-50 border border-slate-200 hover:border-orange-600 hover:bg-orange-600 hover:text-white px-4 py-2 rounded-full text-[10px] font-bold uppercase tracking-widest font-mono text-slate-700 transition">TikTok</a>
                            @endif
                            @if (optional($sidebar)->author_youtube_url)
                                <a href="{{ optional($sidebar)->author_youtube_url }}"
                                    class="bg-slate-50 border border-slate-200 hover:border-orange-600 hover:bg-orange-600 hover:text-white px-4 py-2 rounded-full text-[10px] font-bold uppercase tracking-widest font-mono text-slate-700 transition">YouTube</a>
                            @endif
                            @if (optional($sidebar)->author_newsletter_url)
                                <a href="{{ optional($sidebar)->author_newsletter_url }}"
                                    class="bg-slate-50 border border-slate-200 hover:border-orange-600 hover:bg-orange-600 hover:text-white px-4 py-2 rounded-full text-[10px] font-bold uppercase tracking-widest font-mono text-slate-700 transition">Newsletter</a>
                            @endif
                        </div>
                    </div>

                    {{-- Trending Widget --}}
                    <div class="space-y-6">
                        <div class="border-b border-slate-200 pb-2 flex items-center justify-between">
                            <p class="text-lg font-bold text-slate-900 font-heading">
                                {{ optional($sidebar)->trending_title ?? 'Sedang Tren' }}
                            </p>
                            @if (optional($sidebar)->trending_link_url && optional($sidebar)->trending_link_text)
                                <a href="{{ optional($sidebar)->trending_link_url }}"
                                    class="text-[11px] font-bold uppercase tracking-widest text-orange-600 hover:text-slate-900 font-mono transition">
                                    {{ optional($sidebar)->trending_link_text }}
                                </a>
                            @endif
                        </div>
                        <div class="space-y-4">
                            @if(isset($trendingPosts) && count($trendingPosts) > 0)
                                @foreach ($trendingPosts as $trend)
                                    <article class="flex gap-4 group">
                                        <div class="w-20 h-20 shrink-0 rounded-xl overflow-hidden bg-slate-100">
                                            @if($trend->thumbnail_url)
                                                <img src="{{ $trend->thumbnail_url }}" alt="{{ $trend->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                                            @endif
                                        </div>
                                        <div>
                                            <h4 class="text-sm font-bold text-slate-900 leading-snug group-hover:text-orange-600 transition line-clamp-2 mb-1">
                                                <a href="{{ route('posts.show', $trend->slug) }}">{{ $trend->title }}</a>
                                            </h4>
                                            <div class="text-[10px] text-slate-500 font-mono uppercase tracking-widest">
                                                {{ optional($trend->published_at ?? $trend->created_at)->translatedFormat('d M Y') }}
                                            </div>
                                        </div>
                                    </article>
                                @endforeach
                            @else
                                <p class="text-sm text-slate-500">Belum ada artikel tren minggu ini.</p>
                            @endif
                        </div>
                    </div>

                    {{-- CTA Widget --}}
                    <div class="bg-slate-900 text-slate-50 p-8 rounded-3xl space-y-6 overflow-hidden relative">
                        <div class="absolute -top-12 -right-12 w-32 h-32 bg-orange-600/20 rounded-full blur-2xl pointer-events-none"></div>
                        @if (optional($sidebar)->cta_badge)
                            <p class="text-[11px] font-bold uppercase tracking-widest text-orange-500 font-mono">
                                {{ optional($sidebar)->cta_badge }}
                            </p>
                        @endif
                        @if (optional($sidebar)->cta_title)
                            <h3 class="text-2xl font-bold font-heading leading-tight">{{ optional($sidebar)->cta_title }}</h3>
                        @endif
                        @if (optional($sidebar)->cta_subtitle)
                            <p class="text-sm text-slate-300 leading-relaxed">{{ optional($sidebar)->cta_subtitle }}</p>
                        @endif
                        <div class="pt-4 space-y-3">
                            @if (optional($sidebar)->cta_primary_text && optional($sidebar)->cta_primary_url)
                                <a href="{{ optional($sidebar)->cta_primary_url }}"
                                    class="block w-full rounded-full bg-orange-600 hover:bg-orange-700 text-white px-6 py-3.5 text-center text-xs font-bold uppercase tracking-widest font-mono transition">
                                    {{ optional($sidebar)->cta_primary_text }}
                                </a>
                            @endif
                            @if (optional($sidebar)->cta_secondary_text && optional($sidebar)->cta_secondary_url)
                                <a href="{{ optional($sidebar)->cta_secondary_url }}"
                                    class="block w-full rounded-full border border-slate-700 hover:border-slate-50 hover:bg-slate-50 hover:text-slate-900 px-6 py-3.5 text-center text-xs font-bold uppercase tracking-widest font-mono transition">
                                    {{ optional($sidebar)->cta_secondary_text }}
                                </a>
                            @endif
                        </div>
                    </div>

                </aside>
            </div>
        </div>
    </div>
@endsection
