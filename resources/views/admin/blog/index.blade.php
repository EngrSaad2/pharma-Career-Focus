@extends('layouts.admin')

@section('title', 'Manage Blog & Articles - Pharma Career Compass Admin')

@push('head')
    <!-- Quill.js WYSIWYG Editor Styles -->
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet">
    <style>
        .ql-toolbar.ql-snow {
            border-top-left-radius: 0.75rem;
            border-top-right-radius: 0.75rem;
            border-color: #CBD5E1;
            background: #F8FAFC;
        }
        .ql-container.ql-snow {
            border-bottom-left-radius: 0.75rem;
            border-bottom-right-radius: 0.75rem;
            border-color: #CBD5E1;
            font-family: inherit;
            font-size: 0.95rem;
            line-height: 1.7;
        }
        .ql-editor {
            min-height: 240px;
            max-height: 480px;
            overflow-y: auto;
        }
        .ql-editor p {
            margin-bottom: 0.85rem;
        }
    </style>
@endpush

@section('admin_content')
<div class="space-y-6">

    {{-- Flash Notifications --}}
    @if(session('success'))
        <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-semibold flex items-center gap-2 shadow-xs">
            <span class="text-lg">✓</span>
            <div>{{ session('success') }}</div>
        </div>
    @endif

    @if(session('error'))
        <div class="p-4 rounded-xl bg-red-50 border border-red-200 text-red-800 text-sm font-semibold flex items-center gap-2 shadow-xs">
            <span class="text-lg">⚠️</span>
            <div>{{ session('error') }}</div>
        </div>
    @endif

    @if($errors->any())
        <div class="p-4 rounded-xl bg-red-50 border border-red-200 text-red-800 text-sm">
            <div class="font-bold mb-1">Please fix the following:</div>
            <ul class="list-disc pl-5 space-y-0.5 text-xs">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Header Bar --}}
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 pb-2">
        <div>
            <h1 class="text-2xl font-black text-[#00245A]">Articles & Career Guides</h1>
            <p class="text-xs text-slate-500 mt-1">Publish pharmaceutical industry guides, interview tutorials, and career insights with rich text formatting</p>
        </div>
        <button type="button" onclick="openCreateModal()"
                class="px-4 py-2.5 rounded-xl bg-[#0085FF] hover:bg-[#0070d9] text-white text-xs font-bold uppercase tracking-wider shadow-sm transition-all flex items-center gap-2">
            <span>+ Write New Article</span>
        </button>
    </div>

    {{-- Blog Posts Table --}}
    <div class="bg-white rounded-2xl border border-slate-200/90 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-[#00245A]">
                <thead class="bg-slate-50 border-b border-slate-200 text-xs font-bold uppercase tracking-wider text-slate-600">
                    <tr>
                        <th class="px-6 py-4">Article Title</th>
                        <th class="px-6 py-4">Category</th>
                        <th class="px-6 py-4">Author</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Date</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($posts as $post)
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="px-6 py-4 max-w-md">
                                <strong class="font-bold text-sm text-[#00245A] block line-clamp-1">{{ $post->title }}</strong>
                                <span class="text-xs text-slate-500 line-clamp-1 mt-0.5">{{ $post->summary }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 rounded-full text-[11px] font-bold bg-blue-50 text-[#0085FF]">
                                    {{ $post->category->name ?? 'Career' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-xs font-semibold text-slate-700">
                                {{ $post->author_name }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase {{ $post->is_published ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-amber-50 text-amber-700 border border-amber-200' }}">
                                    {{ $post->is_published ? 'Published' : 'Draft' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-xs text-slate-500">
                                {{ $post->published_at ? $post->published_at->format('M d, Y') : $post->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="inline-flex items-center gap-2">
                                    <a href="{{ route('blog.show', $post->slug) }}" target="_blank" class="px-2.5 py-1 rounded-lg text-xs font-bold text-[#0085FF] hover:bg-blue-50 transition-colors" title="Preview Article">
                                        Preview ↗
                                    </a>
                                    <button type="button" 
                                            onclick='openEditModal(@json($post))' 
                                            class="px-2.5 py-1 rounded-lg text-xs font-bold text-slate-700 hover:bg-slate-100 transition-colors">
                                        Edit
                                    </button>
                                    <form action="{{ route('admin.blog.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this article?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-2.5 py-1 rounded-lg text-xs font-bold text-red-600 hover:bg-red-50 transition-colors">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-slate-500 text-sm">
                                No blog articles found. Click "+ Write New Article" to publish your first guide!
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($posts->hasPages())
            <div class="p-6 border-t border-slate-100">
                {{ $posts->links() }}
            </div>
        @endif
    </div>

    {{-- Create Modal --}}
    <div id="createModal" class="fixed inset-0 z-50 overflow-y-auto bg-black/60 hidden items-center justify-center p-4">
        <div class="bg-white rounded-3xl border border-slate-200 shadow-2xl max-w-4xl w-full p-6 sm:p-8 my-8 relative max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-6">
                <div>
                    <h3 class="text-xl font-extrabold text-[#00245A]">Write New Career Article</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Use the visual rich text editor below to format headings, lists, quotes, and links without seeing HTML tags</p>
                </div>
                <button type="button" onclick="closeCreateModal()" class="w-8 h-8 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold flex items-center justify-center text-base transition-colors">&times;</button>
            </div>

            <form action="{{ route('admin.blog.store') }}" method="POST" id="createArticleForm" class="space-y-5">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Category *</label>
                        <select name="category_id" required class="w-full px-3.5 py-2.5 border border-slate-200 rounded-xl text-sm bg-white focus:ring-2 focus:ring-[#0085FF] focus:border-transparent">
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Author Name *</label>
                        <input type="text" name="author_name" value="{{ auth()->user()->name ?? 'Pharma Career Compass Editorial Board' }}" required class="w-full px-3.5 py-2.5 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-[#0085FF] focus:border-transparent">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Article Title *</label>
                    <input type="text" name="title" required class="w-full px-3.5 py-2.5 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-[#0085FF] focus:border-transparent" placeholder="e.g. Navigating QA Audits: Essential Guidelines for Fresh Graduates">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Summary / Excerpt *</label>
                    <textarea name="summary" rows="2" required class="w-full px-3.5 py-2.5 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-[#0085FF] focus:border-transparent" placeholder="Brief summary displayed on article cards..."></textarea>
                </div>

                {{-- Visual WYSIWYG Editor Container --}}
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700">Full Article Content (Visual Editor) *</label>
                        <span class="text-[11px] text-emerald-600 font-semibold flex items-center gap-1">
                            <span>✓</span> Visual formatting enabled (No raw HTML tags)
                        </span>
                    </div>
                    <div id="createQuillEditor" class="bg-white"></div>
                    <input type="hidden" name="content" id="createContentInput" required>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 items-center pt-2">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Est. Reading Time (Mins) *</label>
                        <input type="number" name="read_time_minutes" value="5" min="1" max="60" required class="w-full px-3.5 py-2.5 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-[#0085FF]">
                    </div>
                    <div class="flex items-center gap-2 sm:pt-6">
                        <input type="checkbox" name="is_published" id="create_is_published" value="1" checked class="w-4 h-4 rounded text-[#0085FF] focus:ring-[#0085FF]">
                        <label for="create_is_published" class="text-xs font-bold text-slate-800 cursor-pointer">Publish Immediately</label>
                    </div>
                </div>

                <div class="pt-4 border-t border-slate-100 flex justify-end gap-3">
                    <button type="button" onclick="closeCreateModal()" class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-700 text-xs font-bold hover:bg-slate-50 transition-colors">Cancel</button>
                    <button type="submit" class="px-6 py-2.5 bg-[#0085FF] hover:bg-[#0070d9] text-white rounded-xl text-xs font-black uppercase tracking-wider shadow-sm transition-all">Publish Article</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Edit Modal --}}
    <div id="editModal" class="fixed inset-0 z-50 overflow-y-auto bg-black/60 hidden items-center justify-center p-4">
        <div class="bg-white rounded-3xl border border-slate-200 shadow-2xl max-w-4xl w-full p-6 sm:p-8 my-8 relative max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-6">
                <div>
                    <h3 class="text-xl font-extrabold text-[#00245A]">Edit Career Article</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Edit article content smoothly in the visual editor without seeing any raw &lt;p&gt; or HTML tags</p>
                </div>
                <button type="button" onclick="closeEditModal()" class="w-8 h-8 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold flex items-center justify-center text-base transition-colors">&times;</button>
            </div>

            <form action="" method="POST" id="editArticleForm" class="space-y-5">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Category *</label>
                        <select name="category_id" id="edit_category_id" required class="w-full px-3.5 py-2.5 border border-slate-200 rounded-xl text-sm bg-white focus:ring-2 focus:ring-[#0085FF]">
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Author Name *</label>
                        <input type="text" name="author_name" id="edit_author_name" required class="w-full px-3.5 py-2.5 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-[#0085FF]">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Article Title *</label>
                    <input type="text" name="title" id="edit_title" required class="w-full px-3.5 py-2.5 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-[#0085FF]">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Summary / Excerpt *</label>
                    <textarea name="summary" id="edit_summary" rows="2" required class="w-full px-3.5 py-2.5 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-[#0085FF]"></textarea>
                </div>

                {{-- Visual WYSIWYG Editor Container for Edit --}}
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700">Full Article Content (Visual Editor) *</label>
                        <span class="text-[11px] text-emerald-600 font-semibold flex items-center gap-1">
                            <span>✓</span> Clean visual editing
                        </span>
                    </div>
                    <div id="editQuillEditor" class="bg-white"></div>
                    <input type="hidden" name="content" id="editContentInput" required>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 items-center pt-2">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Est. Reading Time (Mins) *</label>
                        <input type="number" name="read_time_minutes" id="edit_read_time_minutes" min="1" max="60" required class="w-full px-3.5 py-2.5 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-[#0085FF]">
                    </div>
                    <div class="flex items-center gap-2 sm:pt-6">
                        <input type="checkbox" name="is_published" id="edit_is_published" value="1" class="w-4 h-4 rounded text-[#0085FF] focus:ring-[#0085FF]">
                        <label for="edit_is_published" class="text-xs font-bold text-slate-800 cursor-pointer">Published Status</label>
                    </div>
                </div>

                <div class="pt-4 border-t border-slate-100 flex justify-end gap-3">
                    <button type="button" onclick="closeEditModal()" class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-700 text-xs font-bold hover:bg-slate-50 transition-colors">Cancel</button>
                    <button type="submit" class="px-6 py-2.5 bg-[#0085FF] hover:bg-[#0070d9] text-white rounded-xl text-xs font-black uppercase tracking-wider shadow-sm transition-all">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

</div>

<!-- Quill.js WYSIWYG Library -->
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
<script>
    const toolbarOptions = [
        [{ 'header': [2, 3, 4, false] }],
        ['bold', 'italic', 'underline', 'strike'],
        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
        ['blockquote', 'link'],
        ['clean']
    ];

    // Initialize Create Quill Editor
    const createQuill = new Quill('#createQuillEditor', {
        theme: 'snow',
        placeholder: 'Write your comprehensive article here with headings, bullet points, and quotes...',
        modules: { toolbar: toolbarOptions }
    });

    // Initialize Edit Quill Editor
    const editQuill = new Quill('#editQuillEditor', {
        theme: 'snow',
        placeholder: 'Edit your article here...',
        modules: { toolbar: toolbarOptions }
    });

    // Sync create editor content to hidden input on form submit
    document.getElementById('createArticleForm').addEventListener('submit', function(e) {
        const html = createQuill.root.innerHTML;
        if (createQuill.getText().trim().length === 0) {
            e.preventDefault();
            alert('Please enter article content.');
            return;
        }
        document.getElementById('createContentInput').value = html;
    });

    // Sync edit editor content to hidden input on form submit
    document.getElementById('editArticleForm').addEventListener('submit', function(e) {
        const html = editQuill.root.innerHTML;
        if (editQuill.getText().trim().length === 0) {
            e.preventDefault();
            alert('Please enter article content.');
            return;
        }
        document.getElementById('editContentInput').value = html;
    });

    // Modal Control Functions
    function openCreateModal() {
        document.getElementById('createModal').classList.remove('hidden');
        document.getElementById('createModal').classList.add('flex');
    }

    function closeCreateModal() {
        document.getElementById('createModal').classList.add('hidden');
        document.getElementById('createModal').classList.remove('flex');
    }

    function openEditModal(post) {
        document.getElementById('editArticleForm').action = '/admin/blog/' + post.id;
        document.getElementById('edit_title').value = post.title || '';
        document.getElementById('edit_author_name').value = post.author_name || '';
        document.getElementById('edit_category_id').value = post.category_id || '';
        document.getElementById('edit_summary').value = post.summary || '';
        document.getElementById('edit_read_time_minutes').value = post.read_time_minutes || 5;
        document.getElementById('edit_is_published').checked = !!post.is_published;

        // Set rich HTML into Quill visual editor (user never sees <p> tags)
        editQuill.root.innerHTML = post.content || '';

        document.getElementById('editModal').classList.remove('hidden');
        document.getElementById('editModal').classList.add('flex');
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
        document.getElementById('editModal').classList.remove('flex');
    }

    // Close on outside backdrop click
    window.addEventListener('click', function(e) {
        const createModal = document.getElementById('createModal');
        const editModal = document.getElementById('editModal');
        if (e.target === createModal) closeCreateModal();
        if (e.target === editModal) closeEditModal();
    });
</script>
@endsection
