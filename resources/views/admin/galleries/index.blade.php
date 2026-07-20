@extends('layouts.admin')

@section('page_title', 'Gallery')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-heading font-bold text-slate-700 tracking-tight">Galeri Foto</h2>
        <a href="{{ route('admin.galleries.create') }}" class="inline-flex items-center px-6 py-2.5 bg-orange-600 text-white text-sm font-bold uppercase tracking-wider hover:bg-orange-700 transition-colors rounded-xl shadow-sm">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Foto
        </a>
    </div>

    <div class="card p-6 border-0 shadow-sm">
        @if ($items->isEmpty())
            <p class="text-slate-700 font-semibold text-center py-8">Belum ada foto.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($items as $item)
                    <div class="border border-slate-100 bg-white group rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                        <div class="aspect-[4/3] bg-slate-50 overflow-hidden border-b border-slate-100">
                            <img src="{{ $item->image_url }}" alt="{{ $item->title }}" class="w-full h-full object-cover transition-transform group-hover:scale-105 duration-300">
                        </div>
                        <div class="p-4 space-y-3">
                            <h3 class="text-base font-bold text-slate-700">{{ $item->title }}</h3>
                            @if ($item->description)
                                <p class="text-sm text-slate-700/70 line-clamp-2 font-medium">{{ $item->description }}</p>
                            @endif
                            <div class="flex items-center justify-between text-xs text-slate-700 font-semibold pt-2 border-t border-slate-100/10 mt-2">
                                <span>{{ $item->created_at->format('d M Y') }}</span>
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('admin.galleries.edit', $item) }}"
                                        class="hover:underline font-bold uppercase">Edit</a>
                                    <span class="text-slate-700/30">|</span>
                                    <form action="{{ route('admin.galleries.destroy', $item) }}" method="POST"
                                        onsubmit="return confirm('Hapus foto ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline font-bold uppercase">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if ($items->hasPages())
                <div class="mt-8">
                    {{ $items->links() }}
                </div>
            @endif
        @endif
    </div>
@endsection
