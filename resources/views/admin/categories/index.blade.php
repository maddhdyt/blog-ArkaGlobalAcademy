@extends('layouts.admin')

@section('page_title', 'Category Management')

@section('content')
    <div class="mb-6 flex justify-between items-center">
        <h2 class="text-xl font-heading font-bold text-slate-700 tracking-tight">Kategori</h2>
        <a href="{{ route('admin.categories.create') }}" class="inline-flex items-center px-6 py-2.5 bg-orange-600 text-white text-sm font-bold uppercase tracking-wider hover:bg-orange-700 transition-colors rounded-xl shadow-sm">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Add New Category
        </a>
    </div>



    <div class="card bg-white mt-4">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50">
                        <th class="py-4 px-6 text-xs font-bold text-slate-700 uppercase tracking-wider border-b border-slate-100">Name</th>
                        <th class="py-4 px-6 text-xs font-bold text-slate-700 uppercase tracking-wider border-b border-slate-100">Slug</th>
                        <th class="py-4 px-6 text-xs font-bold text-slate-700 uppercase tracking-wider border-b border-slate-100">Parent</th>
                        <th class="py-4 px-6 text-xs font-bold text-slate-700 uppercase tracking-wider border-b border-slate-100">Posts</th>
                        <th class="py-4 px-6 text-xs font-bold text-slate-700 uppercase tracking-wider border-b border-slate-100 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($categories as $category)
                        <tr class="hover:bg-slate-50 transition-colors group">
                            <td class="py-4 px-6">
                                <div class="text-sm font-bold text-slate-700">{{ $category->name }}</div>
                                @if ($category->description)
                                    <div class="text-xs text-slate-700/70">{{ Str::limit($category->description, 50) }}</div>
                                @endif
                            </td>
                            <td class="py-4 px-6 whitespace-nowrap text-sm text-slate-700 font-semibold">
                                {{ $category->slug }}
                            </td>
                            <td class="py-4 px-6 whitespace-nowrap text-sm text-slate-700 font-semibold">
                                {{ $category->parent ? $category->parent->name : '-' }}
                            </td>
                            <td class="py-4 px-6 whitespace-nowrap text-sm text-slate-700 font-semibold">
                                <span class="inline-flex items-center px-2 py-1 bg-slate-100 text-slate-700 rounded-md px-2.5 py-1 text-xs font-semibold">{{ $category->posts_count ?? $category->posts->count() }}</span>
                            </td>
                            <td class="py-4 px-6 whitespace-nowrap text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('categories.show', $category->slug) }}" target="_blank"
                                        class="inline-flex items-center px-3 py-1.5 bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 hover:text-slate-700 rounded-xl transition-colors text-xs font-bold uppercase tracking-wider shadow-sm">
                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        VIEW
                                    </a>
                                    <a href="{{ route('admin.categories.edit', $category) }}"
                                        class="inline-flex items-center px-3 py-1.5 bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 hover:text-slate-700 rounded-xl transition-colors text-xs font-bold uppercase tracking-wider shadow-sm">
                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                        EDIT
                                    </a>
                                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-white border border-red-200 text-red-600 hover:bg-red-50 hover:text-red-700 rounded-xl transition-colors text-xs font-bold uppercase tracking-wider shadow-sm"
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
                            <td colspan="5" class="px-6 py-8 text-center text-slate-700 font-semibold">
                                No categories found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if ($categories->hasPages())
        <div class="mt-6">
            {{ $categories->links() }}
        </div>
    @endif
@endsection
