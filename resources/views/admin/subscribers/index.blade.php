@extends('layouts.admin')

@section('page_title', 'Subscribers')

@section('content')
    <div class="mb-6 flex justify-between items-center">
        <h2 class="text-xl font-heading font-bold text-slate-700 tracking-tight">Pelanggan Buletin</h2>
    </div>



    <div class="card bg-white mt-4">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50">
                        <th class="py-4 px-6 text-xs font-bold text-slate-700 uppercase tracking-wider border-b border-slate-100">Nama</th>
                        <th class="py-4 px-6 text-xs font-bold text-slate-700 uppercase tracking-wider border-b border-slate-100">Email</th>
                        <th class="py-4 px-6 text-xs font-bold text-slate-700 uppercase tracking-wider border-b border-slate-100">Subscribed</th>
                        <th class="py-4 px-6 text-xs font-bold text-slate-700 uppercase tracking-wider border-b border-slate-100 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($subscribers as $subscriber)
                        <tr class="hover:bg-slate-50 transition-colors group">
                            <td class="py-4 px-6 text-sm font-bold text-slate-700">{{ $subscriber->name ?? '-' }}</td>
                            <td class="py-4 px-6 text-sm font-semibold text-slate-700">{{ $subscriber->email }}</td>
                            <td class="py-4 px-6 text-sm font-semibold text-slate-700">
                                {{ optional($subscriber->subscribed_at)->diffForHumans() ?? '-' }}
                            </td>
                            <td class="py-4 px-6 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <form action="{{ route('admin.subscribers.destroy', $subscriber) }}" method="POST"
                                        onsubmit="confirmDelete(event, this, 'Hapus Subscriber?', 'Subscriber ini akan dihapus dari daftar.')" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center px-3 py-1.5 border border-slate-100 bg-white text-red-600 hover:bg-[#ffccb0] hover:text-red-700 transition-colors text-xs font-bold uppercase tracking-wider">
                                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            DELETE
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-8 text-center text-slate-700 font-semibold">Belum ada subscriber.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($subscribers->hasPages())
            <div class="p-6 border-t border-slate-100">
                {{ $subscribers->links() }}
            </div>
        @endif
    </div>
@endsection
