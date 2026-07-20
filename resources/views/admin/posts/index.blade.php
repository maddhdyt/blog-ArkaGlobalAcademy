@extends('layouts.admin')

@section('page_title', 'Post Management')

@section('content')
    <div class="mb-6 flex justify-between items-center">
        <h2 class="text-xl font-heading font-bold text-slate-700 tracking-tight">Semua Postingan</h2>
        <a href="{{ route('admin.posts.create') }}" class="inline-flex items-center px-4 py-2 bg-slate-900 border border-slate-100 text-white text-sm font-bold uppercase tracking-wider hover:bg-slate-50 hover:text-slate-700 transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Create New Post
        </a>
    </div>

    <div class="card bg-white mt-4">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50">
                        <th class="py-4 px-6 text-xs font-bold text-slate-700 uppercase tracking-wider border-b border-slate-100">Title</th>
                        <th class="py-4 px-6 text-xs font-bold text-slate-700 uppercase tracking-wider border-b border-slate-100">Category</th>
                        <th class="py-4 px-6 text-xs font-bold text-slate-700 uppercase tracking-wider border-b border-slate-100">Author</th>
                        <th class="py-4 px-6 text-xs font-bold text-slate-700 uppercase tracking-wider border-b border-slate-100">Status</th>
                        <th class="py-4 px-6 text-xs font-bold text-slate-700 uppercase tracking-wider border-b border-slate-100">Date</th>
                        <th class="py-4 px-6 text-xs font-bold text-slate-700 uppercase tracking-wider border-b border-slate-100">Views</th>
                        <th class="py-4 px-6 text-xs font-bold text-slate-700 uppercase tracking-wider border-b border-slate-100 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($posts as $post)
                        <tr class="hover:bg-slate-50 transition-colors group">
                            <td class="py-4 px-6">
                                <a href="{{ route('admin.posts.edit', $post) }}"
                                    class="text-slate-700 font-bold hover:underline">
                                    {{ $post->title }}
                                </a>
                            </td>
                            <td class="py-4 px-6">
                                <span class="inline-flex items-center px-2 py-1 bg-slate-100 text-slate-700 rounded-md px-2.5 py-1 text-xs font-semibold">
                                    {{ $post->category->name }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-sm font-semibold text-slate-700">{{ $post->user->name }}</td>
                            <td class="py-4 px-6">
                                @if ($post->status === 'published')
                                    <span class="inline-flex items-center px-2 py-1 bg-green-100 text-green-700 rounded-md px-2.5 py-1 text-xs font-semibold">Published</span>
                                @else
                                    <span class="inline-flex items-center px-2 py-1 bg-orange-100 text-orange-700 rounded-md px-2.5 py-1 text-xs font-semibold">Draft</span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-sm font-semibold text-slate-700">{{ $post->created_at->format('M d, Y') }}</td>
                            <td class="py-4 px-6 text-sm font-semibold text-slate-700">{{ number_format($post->views) }}</td>
                            <td class="py-4 px-6 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    @if ($post->status === 'published')
                                        <a href="{{ route('posts.show', $post->slug) }}" target="_blank"
                                            class="inline-flex items-center px-3 py-1.5 bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 hover:text-slate-700 rounded-xl transition-colors text-xs font-bold uppercase tracking-wider shadow-sm">
                                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                            VIEW
                                        </a>
                                    @endif
                                    <a href="{{ route('admin.posts.edit', $post) }}"
                                        class="inline-flex items-center px-3 py-1.5 bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 hover:text-slate-700 rounded-xl transition-colors text-xs font-bold uppercase tracking-wider shadow-sm">
                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                        EDIT
                                    </a>
                                    <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" class="inline"
                                        onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-white border border-red-200 text-red-600 hover:bg-red-50 hover:text-red-700 rounded-xl transition-colors text-xs font-bold uppercase tracking-wider shadow-sm">
                                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            DELETE
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-8 text-center text-slate-700 font-semibold">No posts yet</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($posts->hasPages())
            <div class="p-6 border-t border-slate-100">
                {{ $posts->links() }}
            </div>
        @endif
    </div>
@endsection
