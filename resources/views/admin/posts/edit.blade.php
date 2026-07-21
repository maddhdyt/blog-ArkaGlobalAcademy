@extends('layouts.admin')

@section('page_title', 'Edit Post')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <a href="{{ route('admin.posts.index') }}" class="text-slate-700 hover:text-brand-primary font-bold text-sm uppercase tracking-wider transition flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Back to Posts
        </a>
    </div>

    <form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data" class="block" id="post-form">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 xl:grid-cols-12 gap-8">
            
            <!-- Left Column: Main Content Area -->
            <div class="xl:col-span-8 space-y-6">
                <!-- Title & Slug -->
                <div class="card p-6 space-y-6">
                    <div>
                        <label class="form-label" for="title">Title *</label>
                        <input type="text" name="title" id="title" class="form-input @error('title') border-red-500 @enderror" placeholder="Masukkan judul postingan..." value="{{ old('title', $post->title) }}" required>
                        @error('title')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="form-label" for="slug">Slug (Optional)</label>
                        <input type="text" name="slug" id="slug" class="form-input" value="{{ old('slug', $post->slug) }}" placeholder="Leave blank to auto-generate from title">
                    </div>
                </div>

                <!-- Editor -->
                <div class="card p-0 !overflow-visible">
                    <style>
                        #toolbar-container {
                            background-color: transparent !important;
                            border-color: transparent !important;
                            box-shadow: none !important;
                            transition: all 0.3s ease !important;
                        }
                        #toolbar-container.is-stuck {
                            background-color: rgba(255, 255, 255, 0.95) !important;
                            backdrop-filter: blur(12px) !important;
                            border-color: rgba(226, 232, 240, 0.6) !important;
                            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05) !important;
                        }
                        /* Fix Quill Paste Blink Bug */
                        .ql-clipboard {
                            position: fixed !important;
                            left: 50% !important;
                            top: 50% !important;
                            opacity: 0 !important;
                        }
                            /* Increase Editor Text Size & Override Pasted Inline Styles */
                        .ql-editor,
                        .ql-editor p,
                        .ql-editor li,
                        .ql-editor span {
                            font-family: inherit !important;
                            font-size: 16px !important;
                            line-height: 1.7 !important;
                        }
                    </style>
                    <div id="editor-header" class="rounded-t-2xl transition-all duration-300 relative">
                        <div id="sticky-sentinel" class="absolute w-full h-px pointer-events-none" style="top: 8px;"></div>
                        <div class="p-4 border-b border-slate-100/50">
                            <label class="form-label mb-0" for="content-editor">Content *</label>
                        </div>
                    </div>

                    <!-- Sticky Pill Wrapper -->
                    <div class="sticky top-0 z-50 w-full flex justify-end -mt-12 mb-2 pointer-events-none px-4" id="sticky-toolbar-wrapper">
                        <div id="toolbar-container" class="pointer-events-auto w-max max-w-full bg-transparent rounded-full shadow-none border border-transparent transition-all duration-300">
                        </div>
                    </div>
                    <div id="content-editor" class="bg-white min-h-[500px] text-lg text-[#433836] rounded-b-2xl overflow-hidden relative" aria-label="Content editor">{!! old('content', $post->content) !!}</div>
                    <input type="hidden" name="content" id="content" value="{{ old('content', $post->content) }}" required>
                </div>

                <!-- Excerpt & SEO -->
                <div class="card p-6 space-y-6">
                    <div>
                        <label class="form-label" for="excerpt">Excerpt</label>
                        <textarea name="excerpt" id="excerpt" rows="3" class="form-input" placeholder="Ringkasan singkat artikel...">{{ old('excerpt', $post->excerpt) }}</textarea>
                    </div>
                    <div>
                        <label class="form-label" for="meta_description">Meta Description (SEO)</label>
                        <textarea name="meta_description" id="meta_description" rows="2" class="form-input" maxlength="160" placeholder="Max 160 characters for search engines...">{{ old('meta_description', $post->meta_description) }}</textarea>
                        <p class="text-xs font-bold text-gray-500 mt-2 uppercase tracking-wider">Direkomendasikan untuk SEO yang lebih baik.</p>
                    </div>
                </div>

                <!-- SEO Analyzer -->
                <div class="card p-6 space-y-6">
                    <h3 class="text-xl font-bold text-slate-700 mb-4 pb-2 border-b border-slate-100 uppercase tracking-wider">SEO Analyzer</h3>
                    
                    <div>
                        <label class="form-label" for="focus_keyword">Focus Keyword</label>
                        <input type="text" name="focus_keyword" id="focus_keyword" class="form-input" placeholder="Masukkan kata kunci utama (contoh: belajar laravel)..." value="{{ old('focus_keyword', $post->focus_keyword) }}">
                    </div>

                    <!-- Google Search Preview -->
                    <div class="mt-6 border border-gray-200 rounded-lg p-4 bg-white shadow-sm">
                        <h4 class="text-sm font-bold text-gray-500 mb-2 uppercase tracking-wider">Google Search Preview</h4>
                        <div class="google-preview" style="font-family: Arial, sans-serif; max-width: 600px;">
                            <div class="text-[14px] text-[#202124] mb-1 flex items-center gap-2">
                                <span class="bg-gray-200 w-5 h-5 rounded-full inline-block"></span> 
                                <span id="seo-preview-url">https://blog.nusaeducation.com/post/judul-post</span>
                            </div>
                            <div class="text-[20px] text-[#1a0dab] font-normal hover:underline cursor-pointer truncate" id="seo-preview-title">Judul Postingan Akan Muncul Di Sini - Arka Global Academy</div>
                            <div class="text-[14px] text-[#4d5156] line-clamp-2 leading-[1.58] mt-1" id="seo-preview-desc">Deskripsi meta belum diisi. Masukkan deskripsi meta agar muncul di hasil pencarian Google dengan rapi.</div>
                        </div>
                    </div>

                    <!-- Analysis Checklist -->
                    <div class="mt-6">
                        <h4 class="text-sm font-bold text-gray-500 mb-3 uppercase tracking-wider">Analysis Results</h4>
                        <ul class="space-y-3" id="seo-checklist">
                            <li class="flex items-center gap-2 text-sm text-gray-500"><span class="w-3 h-3 rounded-full bg-gray-300"></span> Masukkan Focus Keyword terlebih dahulu.</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Right Column: Settings Area -->
            <div class="xl:col-span-4">
                <div class="space-y-6 sticky top-0">
                    <!-- Action Card -->
                    <div class="card p-6">
                        <h3 class="text-sm font-bold text-slate-700 mb-4 pb-2 border-b border-slate-100 uppercase tracking-wider mt-0">Publish</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="form-label" for="status">Status *</label>
                            <select name="status" id="status" class="form-input" required>
                                <option value="draft" {{ old('status', $post->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="published" {{ old('status', $post->status) == 'published' ? 'selected' : '' }}>Published</option>
                            </select>
                        </div>
                        <div>
                            <label class="form-label" for="published_at">Publish Date</label>
                            <input type="datetime-local" name="published_at" id="published_at" class="form-input" value="{{ old('published_at', $post->published_at?->format('Y-m-d\TH:i')) }}">
                        </div>
                        <div class="pt-4 border-t border-slate-100 flex flex-col gap-2">
                            <button type="submit" class="w-full btn-primary py-3">Update Post</button>
                            <p id="autosave-indicator" class="text-xs text-slate-400 text-center font-medium opacity-0 transition-opacity duration-300"></p>
                        </div>
                    </div>
                </div>

                <!-- Organization Card -->
                <div class="card p-6 !overflow-visible">
                    <h3 class="text-sm font-bold text-slate-700 mb-4 pb-2 border-b border-slate-100 uppercase tracking-wider">Organization</h3>
                    <div>
                        <label class="form-label" for="category_id">Category *</label>
                        <select name="category_id" id="category_id" class="form-input" required>
                            <option value="">Select a Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Media Card -->
                <div class="card p-6">
                    <h3 class="text-sm font-bold text-slate-700 mb-4 pb-2 border-b border-slate-100 uppercase tracking-wider">Media</h3>
                    <div>
                        <label class="form-label" for="thumbnail">Thumbnail Image</label>
                        <div class="relative group" id="thumbnail-preview-container">
                            @if ($post->thumbnail)
                                <div class="mb-4 border border-slate-100 relative">
                                    <img src="{{ $post->thumbnail_url }}" alt="Current thumbnail" class="w-full h-auto object-cover block">
                                    <div class="bg-slate-50 border-t border-slate-100 p-2 text-center text-xs font-bold uppercase tracking-wider text-slate-700">Current Thumbnail</div>
                                </div>
                            @endif
                        </div>
                        <div class="flex items-center gap-2">
                            <input type="file" name="thumbnail" id="thumbnail" class="form-input flex-1" accept="image/*">
                            <button type="button" id="remove-thumbnail-btn" class="p-3 text-red-500 bg-red-50 hover:bg-red-100 border border-red-200 rounded-xl transition-colors shrink-0" title="Batal Pilih">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </div>
                        <p class="text-xs font-bold text-gray-500 mt-2 uppercase tracking-wider">PNG, JPG, GIF up to 2MB</p>
                        <p id="thumbnail-warning" class="text-xs font-bold mt-1 uppercase tracking-wider hidden"></p>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </form>

    {{-- TomSelect assets --}}
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
    <style>
        .ts-wrapper.form-input {
            padding: 0 !important;
            border: none !important;
            box-shadow: none !important;
            background: transparent !important;
        }
        .ts-wrapper {
            margin-top: 0.25rem;
        }
        .ts-control {
            border: 1px solid #e2e8f0;
            border-radius: 0.75rem;
            padding: 0.75rem 1rem;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            background-color: #fff;
            transition: all 0.2s;
            font-size: 1rem;
        }
        .ts-control.focus {
            border-color: #f97316;
            box-shadow: 0 0 0 2px rgba(249, 115, 22, 0.2);
        }
        .ts-wrapper.single .ts-control:after {
            right: 1.25rem;
        }
        .ts-dropdown {
            border-radius: 0.75rem;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            padding: 0.5rem 0;
            margin-top: 0.25rem;
        }
        .ts-dropdown .create {
            color: #f97316;
            font-weight: 500;
        }
        .ts-dropdown .option, .ts-dropdown .create {
            padding: 0.5rem 1rem;
        }
        .ts-dropdown .option.active, .ts-dropdown .create.active {
            background-color: #fff7ed;
            color: #ea580c;
        }
    </style>

    {{-- Quill & Compressor assets --}}
    <link href="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/compressorjs@1.2.1/dist/compressor.min.js"></script>
    <script>
        function imageHandler() {
            const input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'image/*');
            input.click();

            input.onchange = () => {
                const originalFile = input.files[0];
                if (!originalFile) return;

                new Compressor(originalFile, {
                    quality: 0.8,
                    maxWidth: 1920,
                    maxHeight: 1920,
                    async success(result) {
                        if (result.size > 2 * 1024 * 1024) {
                            alert(`Gambar terlalu besar (${(result.size / 1024 / 1024).toFixed(2)}MB). Harap pilih gambar di bawah 2MB.`);
                            return;
                        }

                        const formData = new FormData();
                        formData.append('image', result, result.name || 'image.jpg');

                        try {
                            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                            const response = await fetch("{{ route('admin.posts.upload-image') }}", {
                                method: 'POST',
                                body: formData,
                                headers: {
                                    'X-CSRF-TOKEN': csrfToken
                                }
                            });

                            if (response.ok) {
                                const data = await response.json();
                                let range = quill.getSelection(true);
                                quill.insertEmbed(range.index, 'image', data.url);
                                quill.setSelection(range.index + 1);
                            } else {
                                alert('Gagal mengunggah gambar.');
                            }
                        } catch (error) {
                            console.error('Error:', error);
                        }
                    },
                    error(err) {
                        console.error(err.message);
                    },
                });
            };
        }

        const quill = new Quill('#content-editor', {
            theme: 'snow',
            placeholder: 'Tulis konten di sini...',
            scrollingContainer: 'main',
            modules: {
                toolbar: {
                    container: [
                        [{ header: [1, 2, 3, false] }],
                        ['bold', 'italic', 'underline', 'strike'],
                        [{ list: 'ordered' }, { list: 'bullet' }],
                        ['link', 'image'],
                        ['blockquote', 'code-block'],
                        [{ align: [] }],
                        ['clean']
                    ],
                    handlers: {
                        image: imageHandler
                    }
                }
            }
        });

        const toolbar = quill.getModule('toolbar').container;
        document.getElementById('toolbar-container').appendChild(toolbar);

        const sentinel = document.getElementById('sticky-sentinel');
        const tbContainer = document.getElementById('toolbar-container');
        const mainScroll = document.querySelector('main');
        
        if (sentinel && tbContainer && mainScroll) {
            const observer = new IntersectionObserver((entries) => {
                tbContainer.classList.toggle('is-stuck', !entries[0].isIntersecting);
            }, { root: mainScroll, threshold: 0, rootMargin: "0px" });
            observer.observe(sentinel);
        }

        const contentInput = document.getElementById('content');
        quill.on('text-change', () => {
            contentInput.value = quill.root.innerHTML;
        });

        // Auto-Save Logic (LocalStorage)
        const form = document.getElementById('post-form');
        const indicator = document.getElementById('autosave-indicator');
        const draftKey = 'arka_post_draft_{{ $post->id }}';
        let autoSaveTimer;

        function restoreDraft() {
            const draftStr = localStorage.getItem(draftKey);
            if (draftStr) {
                try {
                    const draft = JSON.parse(draftStr);
                    if (draft.title) document.getElementById('title').value = draft.title;
                    if (draft.slug !== undefined) document.getElementById('slug').value = draft.slug;
                    if (draft.excerpt !== undefined) document.getElementById('excerpt').value = draft.excerpt;
                    if (draft.meta_description !== undefined) document.getElementById('meta_description').value = draft.meta_description;
                    if (draft.focus_keyword !== undefined) document.getElementById('focus_keyword').value = draft.focus_keyword;
                    if (draft.category_id) document.getElementById('category_id').value = draft.category_id;
                    if (draft.status) document.getElementById('status').value = draft.status;
                    if (draft.content) quill.clipboard.dangerouslyPasteHTML(draft.content);
                } catch (e) { console.error("Error restoring draft", e); }
            }
        }

        function saveDraft() {
            const draft = {
                title: document.getElementById('title').value,
                slug: document.getElementById('slug').value,
                excerpt: document.getElementById('excerpt').value,
                meta_description: document.getElementById('meta_description').value,
                focus_keyword: document.getElementById('focus_keyword').value,
                category_id: document.getElementById('category_id').value,
                status: document.getElementById('status').value,
                content: quill.root.innerHTML
            };
            localStorage.setItem(draftKey, JSON.stringify(draft));
            const now = new Date();
            indicator.textContent = `Tersimpan pukul ${now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' })}`;
            indicator.classList.remove('opacity-0');
        }

        form.querySelectorAll('input, select, textarea').forEach(el => {
            el.addEventListener('input', () => {
                if (el.type === 'file') return;
                clearTimeout(autoSaveTimer);
                indicator.textContent = 'Menyimpan...';
                indicator.classList.remove('opacity-0');
                autoSaveTimer = setTimeout(saveDraft, 2000);
            });
        });

        quill.on('text-change', () => {
            clearTimeout(autoSaveTimer);
            indicator.textContent = 'Menyimpan...';
            indicator.classList.remove('opacity-0');
            autoSaveTimer = setTimeout(saveDraft, 2000);
        });

        form.addEventListener('submit', () => localStorage.removeItem(draftKey));
        setTimeout(restoreDraft, 500);

        // Thumbnail removal and compression logic
        const removeThumbnailBtn = document.getElementById('remove-thumbnail-btn');
        const thumbnailInput = document.getElementById('thumbnail');
        const removeThumbnailInput = document.getElementById('remove_thumbnail');
        const thumbnailWarning = document.getElementById('thumbnail-warning');
        const submitBtn = document.querySelector('button[type="submit"]');

        if (removeThumbnailBtn && thumbnailInput) {
            removeThumbnailBtn.addEventListener('click', () => {
                thumbnailInput.value = '';
                if (removeThumbnailInput) {
                    removeThumbnailInput.value = '1';
                }
                const currentThumbnail = document.getElementById('current-thumbnail-container');
                if (currentThumbnail) currentThumbnail.style.display = 'none';
                thumbnailWarning.classList.add('hidden');
                submitBtn.disabled = false;
                submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            });
        }

        if (thumbnailInput) {
            thumbnailInput.addEventListener('change', (e) => {
                const file = e.target.files[0];
                if (file && removeThumbnailInput) {
                    removeThumbnailInput.value = '0';
                }
                
                if (!file) {
                    thumbnailWarning.classList.add('hidden');
                    submitBtn.disabled = false;
                    submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                    return;
                }

                if (file.size > 2 * 1024 * 1024) {
                    thumbnailWarning.textContent = `Ukuran asli ${(file.size / 1024 / 1024).toFixed(2)}MB. Sedang mengompresi...`;
                    thumbnailWarning.classList.remove('hidden', 'text-red-500', 'text-green-500');
                    thumbnailWarning.classList.add('text-orange-500');
                    submitBtn.disabled = true;
                    submitBtn.classList.add('opacity-50', 'cursor-not-allowed');

                    new Compressor(file, {
                        quality: 0.8,
                        maxWidth: 1920,
                        maxHeight: 1920,
                        success(result) {
                            if (result.size > 2 * 1024 * 1024) {
                                thumbnailWarning.textContent = `Gagal! Setelah dikompresi ukuran masih ${(result.size / 1024 / 1024).toFixed(2)}MB (>2MB). Harap ganti gambar.`;
                                thumbnailWarning.classList.remove('text-orange-500', 'text-green-500');
                                thumbnailWarning.classList.add('text-red-500');
                            } else {
                                thumbnailWarning.textContent = `Sukses! Dikompresi menjadi ${(result.size / 1024).toFixed(0)}KB. Aman diunggah.`;
                                thumbnailWarning.classList.remove('text-orange-500', 'text-red-500');
                                thumbnailWarning.classList.add('text-green-500');
                                submitBtn.disabled = false;
                                submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                                
                                const dataTransfer = new DataTransfer();
                                dataTransfer.items.add(new File([result], result.name || 'thumbnail.jpg', { type: result.type }));
                                thumbnailInput.files = dataTransfer.files;
                            }
                        },
                        error(err) {
                            console.error(err.message);
                            thumbnailWarning.textContent = 'Gagal mengompresi gambar.';
                            thumbnailWarning.classList.remove('text-orange-500', 'text-green-500');
                            thumbnailWarning.classList.add('text-red-500');
                        },
                    });
                } else {
                    thumbnailWarning.classList.add('hidden');
                    submitBtn.disabled = false;
                    submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                }
            });
        }

        // Initialize TomSelect for Category
        new TomSelect("#category_id", {
            create: function(input, callback) {
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                indicator.textContent = 'Menambahkan kategori...';
                indicator.classList.remove('opacity-0');
                
                fetch("{{ route('admin.categories.api-store') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({ name: input })
                })
                .then(response => {
                    if (response.ok) return response.json();
                    throw new Error('Failed to create category');
                })
                .then(data => {
                    callback({ value: data.id, text: data.name });
                    indicator.textContent = 'Kategori berhasil ditambahkan!';
                    setTimeout(() => indicator.classList.add('opacity-0'), 2000);
                    // trigger change for autosave
                    document.getElementById('category_id').dispatchEvent(new Event('change'));
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Gagal membuat kategori. Pastikan nama unik (belum ada).');
                    indicator.classList.add('opacity-0');
                    callback(false);
                });
            },
            placeholder: "Pilih atau ketik Kategori...",
            render: {
                option_create: function(data, escape) {
                    return '<div class="create">Tambahkan kategori <strong>' + escape(data.input) + '</strong>&hellip;</div>';
                },
                no_results: function(data, escape) {
                    return '<div class="no-results p-2 text-slate-500">Kategori tidak ditemukan</div>';
                },
            }
        });

    </script>
    <script src="{{ asset('js/seo-analyzer.js') }}"></script>
@endsection
