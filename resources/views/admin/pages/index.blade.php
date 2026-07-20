@extends('layouts.admin')

@section('page_title', 'Page Management')

@section('content')
    <div class="mb-6 flex justify-between items-center">
        <h2 class="text-xl font-heading font-bold text-slate-900 tracking-tight">Daftar Halaman</h2>
        <a href="{{ route('admin.pages.create') }}" class="inline-flex items-center px-4 py-2 bg-slate-900 border border-slate-900 text-white text-sm font-bold uppercase tracking-wider hover:bg-slate-50 hover:text-slate-900 transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Add New Page
        </a>
    </div>



    <div class="card bg-white mt-4">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50">
                        <th class="py-4 px-6 text-xs font-bold text-slate-900 uppercase tracking-wider border-b border-slate-900">Title</th>
                        <th class="py-4 px-6 text-xs font-bold text-slate-900 uppercase tracking-wider border-b border-slate-900">Slug</th>
                        <th class="py-4 px-6 text-xs font-bold text-slate-900 uppercase tracking-wider border-b border-slate-900">Status</th>
                        <th class="py-4 px-6 text-xs font-bold text-slate-900 uppercase tracking-wider border-b border-slate-900">Created</th>
                        <th class="py-4 px-6 text-xs font-bold text-slate-900 uppercase tracking-wider border-b border-slate-900 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-900/10">
                    @forelse($pages as $page)
                        <tr class="hover:bg-slate-50 transition-colors group">
                            <td class="py-4 px-6">
                                <div class="text-sm font-bold text-slate-900">{{ $page->title }}</div>
                                <div class="text-xs text-slate-900/70">{{ Str::limit($page->excerpt, 50) }}</div>
                            </td>
                            <td class="py-4 px-6 whitespace-nowrap text-sm text-slate-900 font-semibold">
                                {{ $page->slug }}
                            </td>
                            <td class="py-4 px-6 whitespace-nowrap">
                                @if ($page->is_published)
                                    <span class="inline-flex items-center px-2 py-1 bg-green-100 text-green-700 rounded-md px-2.5 py-1 text-xs font-semibold">Published</span>
                                @else
                                    <span class="inline-flex items-center px-2 py-1 bg-orange-100 text-orange-700 rounded-md px-2.5 py-1 text-xs font-semibold">Draft</span>
                                @endif
                            </td>
                            <td class="py-4 px-6 whitespace-nowrap text-sm text-slate-900 font-semibold">
                                {{ $page->created_at->format('M d, Y') }}
                            </td>
                            <td class="py-4 px-6 whitespace-nowrap text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('pages.show', $page->slug) }}" target="_blank"
                                        class="inline-flex items-center px-3 py-1.5 bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 hover:text-slate-900 rounded-md transition-colors text-xs font-semibold uppercase tracking-wider shadow-sm">
                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        VIEW
                                    </a>
                                    <a href="{{ route('admin.pages.edit', $page) }}"
                                        class="inline-flex items-center px-3 py-1.5 bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 hover:text-slate-900 rounded-md transition-colors text-xs font-semibold uppercase tracking-wider shadow-sm">
                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                        EDIT
                                    </a>
                                    <form action="{{ route('admin.pages.destroy', $page) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-white border border-red-200 text-red-600 hover:bg-red-50 hover:text-red-700 rounded-md transition-colors text-xs font-semibold uppercase tracking-wider shadow-sm"
                                            onclick="return confirm('Are you sure?')">
                                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            DELETE
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-slate-900 font-semibold">
                                No pages found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if ($pages->hasPages())
        <div class="mt-6">
            {{ $pages->links() }}
        </div>
    @endif
@endsection
