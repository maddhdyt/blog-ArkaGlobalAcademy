@extends('layouts.admin')

@section('page_title', 'Dashboard')

@section('content')
    <div class="flex justify-end mb-6">
        <a href="{{ route('admin.posts.create') }}" class="btn-primary flex items-center gap-2 px-6 py-2.5 text-sm uppercase tracking-wider">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tulis Artikel Baru
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Stat Card 1 -->
        <div class="bg-white border border-slate-200 rounded-xl shadow-sm p-6 group transition-all hover:-translate-y-1 hover:shadow-md">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-slate-500 text-sm font-bold tracking-wider uppercase mb-1">Total Menus</p>
                    <p class="text-4xl font-heading font-bold text-slate-900">{{ $stats['menus'] }}</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 group-hover:bg-orange-500 group-hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </div>
            </div>
        </div>

        <!-- Stat Card 2 -->
        <div class="bg-white border border-slate-200 rounded-xl shadow-sm p-6 group transition-all hover:-translate-y-1 hover:shadow-md">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-slate-500 text-sm font-bold tracking-wider uppercase mb-1">Total Pages</p>
                    <p class="text-4xl font-heading font-bold text-slate-900">{{ $stats['pages'] }}</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 group-hover:bg-orange-500 group-hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
            </div>
        </div>

        <!-- Stat Card 3 -->
        <div class="bg-white border border-slate-200 rounded-xl shadow-sm p-6 group transition-all hover:-translate-y-1 hover:shadow-md">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-slate-500 text-sm font-bold tracking-wider uppercase mb-1">Categories</p>
                    <p class="text-4xl font-heading font-bold text-slate-900">{{ $stats['categories'] }}</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 group-hover:bg-orange-500 group-hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                </div>
            </div>
        </div>

        <!-- Stat Card 4 -->
        <div class="bg-white border border-slate-200 rounded-xl shadow-sm p-6 group transition-all hover:-translate-y-1 hover:shadow-md">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-slate-500 text-sm font-bold tracking-wider uppercase mb-1">Total Posts</p>
                    <p class="text-4xl font-heading font-bold text-slate-900">{{ $stats['posts'] }}</p>
                    <p class="text-xs font-semibold text-slate-400 mt-1">{{ $stats['published_posts'] }} published &middot; {{ $stats['draft_posts'] }} drafts</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-orange-50 flex items-center justify-center text-orange-500 group-hover:bg-orange-500 group-hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                </div>
            </div>
        </div>

        <!-- Stat Card 5 (Views) -->
        <div class="bg-white border border-slate-200 rounded-xl shadow-sm p-6 group transition-all hover:-translate-y-1 hover:shadow-md">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-slate-500 text-sm font-bold tracking-wider uppercase mb-1">Total Views</p>
                    <p class="text-4xl font-heading font-bold text-slate-900">{{ number_format($stats['views']) }}</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-orange-50 flex items-center justify-center text-orange-500 group-hover:bg-orange-500 group-hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                </div>
            </div>
        </div>

        <!-- Stat Card 6 (Users) -->
        <div class="bg-white border border-slate-200 rounded-xl shadow-sm p-6 group transition-all hover:-translate-y-1 hover:shadow-md">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-slate-500 text-sm font-bold tracking-wider uppercase mb-1">Total Users</p>
                    <p class="text-4xl font-heading font-bold text-slate-900">{{ $stats['users'] }}</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 group-hover:bg-orange-500 group-hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
            </div>
        </div>

        <!-- Stat Card 7 (Subscribers) -->
        <div class="bg-white border border-slate-200 rounded-xl shadow-sm p-6 group transition-all hover:-translate-y-1 hover:shadow-md">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-slate-500 text-sm font-bold tracking-wider uppercase mb-1">Subscribers</p>
                    <p class="text-4xl font-heading font-bold text-slate-900">{{ $stats['subscribers'] }}</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 group-hover:bg-orange-500 group-hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                </div>
            </div>
        </div>

        <!-- Stat Card 8 (Galleries) -->
        <div class="bg-white border border-slate-200 rounded-xl shadow-sm p-6 group transition-all hover:-translate-y-1 hover:shadow-md">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-slate-500 text-sm font-bold tracking-wider uppercase mb-1">Galleries</p>
                    <p class="text-4xl font-heading font-bold text-slate-900">{{ $stats['galleries'] }}</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 group-hover:bg-orange-500 group-hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-8 mb-8">
        <!-- Views Chart -->
        <div class="card bg-white flex flex-col p-6 border-0 shadow-sm">
            <h2 class="text-lg font-bold text-slate-700 tracking-wide mb-4 uppercase">Top 7 Artikel</h2>
            <div class="relative flex-1 w-full" style="min-h: 300px;">
                <canvas id="viewsChart"></canvas>
            </div>
        </div>

        <!-- Categories Chart -->
        <div class="card bg-white flex flex-col p-6 border-0 shadow-sm">
            <h2 class="text-lg font-bold text-slate-700 tracking-wide mb-4 uppercase">Distribusi Kategori</h2>
            <div class="relative flex-1 w-full flex items-center justify-center" style="min-h: 300px;">
                <canvas id="categoryChart"></canvas>
            </div>
        </div>
    </div>

    <!-- No Quick Actions -->

    <div class="grid grid-cols-1 xl:grid-cols-2 gap-8 mt-8">
        <!-- Recent Posts Table -->
        <div class="card bg-white flex flex-col border-0 shadow-sm">
            <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between">
                <h2 class="text-lg font-bold text-slate-700 tracking-wide">Postingan Terbaru</h2>
                <a href="{{ route('admin.posts.index') }}" class="text-xs font-bold uppercase tracking-wider text-slate-500 hover:text-orange-600 transition-colors">Semua &rarr;</a>
            </div>
            <div class="overflow-x-auto flex-1">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50">
                            <th class="py-3 px-4 text-[11px] font-bold text-slate-500 uppercase tracking-wider border-b border-slate-100">Artikel</th>
                            <th class="py-3 px-4 text-[11px] font-bold text-slate-500 uppercase tracking-wider border-b border-slate-100">Status</th>
                            <th class="py-3 px-4 text-[11px] font-bold text-slate-500 uppercase tracking-wider border-b border-slate-100 text-right">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($recentPosts as $post)
                            <tr class="hover:bg-slate-50 transition-colors group">
                                <td class="py-3 px-4">
                                    <a href="{{ route('admin.posts.edit', $post) }}" class="font-bold text-slate-700 hover:text-orange-600 transition-colors block truncate w-48">
                                        {{ $post->title }}
                                    </a>
                                </td>
                                <td class="py-3 px-4">
                                    @if ($post->status === 'published')
                                        <span class="inline-flex items-center px-2 py-1 bg-green-50 text-green-600 rounded-md text-[10px] font-bold tracking-wider">
                                            Published
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2 py-1 bg-orange-50 text-orange-600 rounded-md text-[10px] font-bold tracking-wider">
                                            Draft
                                        </span>
                                    @endif
                                </td>
                                <td class="py-3 px-4 text-[11px] font-bold uppercase tracking-wider text-slate-400 text-right">{{ $post->created_at->format('d M y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="py-8 text-center text-sm font-medium text-gray-500">
                                    Belum ada postingan
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Popular Posts -->
        <div class="card bg-white flex flex-col border-0 shadow-sm">
            <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between">
                <h2 class="text-lg font-bold text-slate-700 tracking-wide">Artikel Terpopuler</h2>
                <span class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Berdasarkan Views</span>
            </div>
            <div class="overflow-x-auto flex-1">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50">
                            <th class="py-3 px-4 text-[11px] font-bold text-slate-500 uppercase tracking-wider border-b border-slate-100">Artikel</th>
                            <th class="py-3 px-4 text-[11px] font-bold text-slate-500 uppercase tracking-wider border-b border-slate-100 text-right">Views</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($popularPosts as $post)
                            <tr class="hover:bg-slate-50 transition-colors group">
                                <td class="py-3 px-4">
                                    <a href="{{ route('admin.posts.edit', $post) }}" class="font-bold text-slate-700 hover:text-orange-600 transition-colors block truncate w-64">
                                        {{ $post->title }}
                                    </a>
                                </td>
                                <td class="py-3 px-4 text-right">
                                    <span class="inline-flex items-center gap-1 font-bold text-slate-600">
                                        {{ number_format($post->views) }}
                                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="py-8 text-center text-sm font-medium text-gray-500">
                                    Belum ada data
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    Chart.defaults.font.family = "'Karla', sans-serif";
    Chart.defaults.color = '#0f172a';
    Chart.defaults.scale.grid.color = 'rgba(15, 23, 42, 0.05)';
    
    // Views Chart
    const viewsCtx = document.getElementById('viewsChart').getContext('2d');
    new Chart(viewsCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($viewsChartData['labels']) !!},
            datasets: [{
                label: 'Total Views',
                data: {!! json_encode($viewsChartData['data']) !!},
                backgroundColor: '#f97316',
                borderRadius: 4,
                hoverBackgroundColor: '#ea580c',
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: { beginAtZero: true, border: { display: false } },
                x: { border: { display: false }, grid: { display: false } }
            }
        }
    });

    // Category Chart
    const categoryCtx = document.getElementById('categoryChart').getContext('2d');
    new Chart(categoryCtx, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($chartData['labels']) !!},
            datasets: [{
                data: {!! json_encode($chartData['data']) !!},
                backgroundColor: ['#f97316', '#fb923c', '#fdba74', '#0f172a', '#334155', '#475569', '#cbd5e1'],
                borderColor: '#ffffff',
                borderWidth: 2,
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'right', labels: { font: { weight: 'bold', family: "'Karla', sans-serif" } } }
            },
            layout: { padding: 20 },
            cutout: '70%'
        }
    });
});
</script>
@endpush
