@extends('layouts.admin')

@section('title', 'Create User')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <a href="{{ route('admin.users.index') }}" class="text-slate-700 hover:text-brand-primary font-bold text-sm uppercase tracking-wider transition flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali
        </a>
    </div>

    <form action="{{ route('admin.users.store') }}" method="POST" class="block" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 xl:grid-cols-12 gap-8">
            
            <!-- Left Column: Main Content Area -->
            <div class="xl:col-span-8 space-y-6">
                <!-- User Details -->
                <div class="card p-6 space-y-6">
                    <div>
                        <label class="form-label" for="name">Name *</label>
                        <input type="text" name="name" id="name" class="form-input @error('name') border-red-500 @enderror" placeholder="Masukkan nama user..." value="{{ old('name') }}" required>
                        @error('name')
                            <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="form-label" for="email">Email *</label>
                        <input type="email" name="email" id="email" class="form-input @error('email') border-red-500 @enderror" placeholder="Masukkan alamat email..." value="{{ old('email') }}" required>
                        @error('email')
                            <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Profil Penulis -->
                <div class="card p-6 space-y-6">
                    <h3 class="text-sm font-bold text-slate-700 mb-4 pb-2 border-b border-slate-100 uppercase tracking-wider mt-0">Profil Penulis</h3>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="form-label" for="role_title">Jabatan / Peran (Tampil di Publik)</label>
                            <input type="text" name="role_title" id="role_title" class="form-input" value="{{ old('role_title') }}" placeholder="Contoh: Kontributor, CEO">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="form-label" for="avatar_url">Avatar URL</label>
                            <input type="url" name="avatar_url" id="avatar_url" class="form-input" value="{{ old('avatar_url') }}" placeholder="https://...">
                        </div>
                        <div>
                            <label class="form-label" for="avatar">Upload Avatar Lokal</label>
                            <input type="file" name="avatar" id="avatar" class="form-input bg-white p-1.5" accept="image/*">
                        </div>
                    </div>
                    <div>
                        <label class="form-label" for="bio">Bio Singkat</label>
                        <textarea name="bio" id="bio" rows="3" class="form-input">{{ old('bio') }}</textarea>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="form-label" for="tiktok_url">TikTok URL</label>
                            <input type="url" name="tiktok_url" id="tiktok_url" class="form-input" value="{{ old('tiktok_url') }}">
                        </div>
                        <div>
                            <label class="form-label" for="youtube_url">YouTube URL</label>
                            <input type="url" name="youtube_url" id="youtube_url" class="form-input" value="{{ old('youtube_url') }}">
                        </div>
                        <div>
                            <label class="form-label" for="newsletter_url">Newsletter URL</label>
                            <input type="url" name="newsletter_url" id="newsletter_url" class="form-input" value="{{ old('newsletter_url') }}">
                        </div>
                    </div>
                </div>

                <!-- Security Details -->
                <div class="card p-6 space-y-6">
                    <h3 class="text-sm font-bold text-slate-700 mb-4 pb-2 border-b border-slate-100 uppercase tracking-wider mt-0">Keamanan</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="form-label" for="password">Password *</label>
                            <input type="password" name="password" id="password" class="form-input @error('password') border-red-500 @enderror" required>
                            @error('password')
                                <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="form-label" for="password_confirmation">Confirm Password *</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-input" required>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Settings Area -->
            <div class="xl:col-span-4">
                <div class="space-y-6 sticky top-0">
                    <!-- Role Card -->
                    <div class="card p-6">
                        <h3 class="text-sm font-bold text-slate-700 mb-4 pb-2 border-b border-slate-100 uppercase tracking-wider mt-0">Role & Akses</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="form-label" for="role">Role *</label>
                                <select name="role" id="role" class="form-input @error('role') border-red-500 @enderror" required>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role }}" {{ old('role') == $role ? 'selected' : '' }}>
                                            {{ ucfirst($role) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('role')
                                    <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="pt-4 border-t border-slate-100 flex gap-3">
                                <button type="submit" class="w-full btn-primary py-3">Create User</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
