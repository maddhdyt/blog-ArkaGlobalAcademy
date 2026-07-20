@extends('layouts.admin')

@section('page_title', 'Menu Management')

@section('content')
    <div class="mb-6 flex justify-between items-center">
        <h2 class="text-xl font-heading font-bold text-slate-700 tracking-tight">Daftar Menu</h2>
        <a href="{{ route('admin.menus.create') }}" class="inline-flex items-center px-6 py-2.5 bg-orange-600 text-white text-sm font-bold uppercase tracking-wider hover:bg-orange-700 transition-colors rounded-xl shadow-sm">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Add New Menu
        </a>
    </div>



    <div class="card bg-white mt-4">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50">
                        <th class="py-4 px-6 text-xs font-bold text-slate-700 uppercase tracking-wider border-b border-slate-100">Title</th>
                        <th class="py-4 px-6 text-xs font-bold text-slate-700 uppercase tracking-wider border-b border-slate-100">Type</th>
                        <th class="py-4 px-6 text-xs font-bold text-slate-700 uppercase tracking-wider border-b border-slate-100">Parent</th>
                        <th class="py-4 px-6 text-xs font-bold text-slate-700 uppercase tracking-wider border-b border-slate-100">Order</th>
                        <th class="py-4 px-6 text-xs font-bold text-slate-700 uppercase tracking-wider border-b border-slate-100">Status</th>
                        <th class="py-4 px-6 text-xs font-bold text-slate-700 uppercase tracking-wider border-b border-slate-100 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($menus as $menu)
                        <tr class="hover:bg-slate-50 transition-colors group">
                            <td class="py-4 px-6 whitespace-nowrap">
                                <div class="text-sm font-bold text-slate-700">{{ $menu->title }}</div>
                            </td>
                            <td class="py-4 px-6 whitespace-nowrap">
                                <span class="inline-flex items-center px-2 py-1 border border-slate-100 bg-[#b5dbff] text-slate-700 text-xs font-bold uppercase">
                                    {{ ucfirst($menu->url_type) }}
                                </span>
                            </td>
                            <td class="py-4 px-6 whitespace-nowrap text-sm text-slate-700 font-semibold">
                                {{ $menu->parent ? $menu->parent->title : '-' }}
                            </td>
                            <td class="py-4 px-6 whitespace-nowrap text-sm text-slate-700 font-semibold">
                                {{ $menu->order }}
                            </td>
                            <td class="py-4 px-6 whitespace-nowrap">
                                @if ($menu->is_active)
                                    <span class="inline-flex items-center px-2 py-1 border border-slate-100 bg-[#b4f3b4] text-slate-700 text-xs font-bold uppercase">Active</span>
                                @else
                                    <span class="inline-flex items-center px-2 py-1 border border-slate-100 bg-[#ffccb0] text-slate-700 text-xs font-bold uppercase">Inactive</span>
                                @endif
                            </td>
                            <td class="py-4 px-6 whitespace-nowrap text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.menus.edit', $menu) }}"
                                        class="inline-flex items-center px-3 py-1.5 border border-slate-100 bg-white text-slate-700 hover:bg-[#b5dbff] transition-colors text-xs font-bold uppercase tracking-wider">
                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                        EDIT
                                    </a>
                                    <form action="{{ route('admin.menus.destroy', $menu) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center px-3 py-1.5 border border-slate-100 bg-white text-red-600 hover:bg-[#ffccb0] hover:text-red-700 transition-colors text-xs font-bold uppercase tracking-wider"
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
                            <td colspan="6" class="px-6 py-8 text-center text-slate-700 font-semibold">
                                No menus found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">
        {{ $menus->links() }}
    </div>
@endsection
