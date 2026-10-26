@extends('layouts.admin')

@section('title', 'Manage Blog & Articles - Pharma Career Compass Admin')

@section('admin_content')
<div class="space-y-8" x-data="{ addModal: false }">
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-black text-[#00245A]">Articles & Career Guides</h1>
            <p class="text-xs text-[#00245A]/70 mt-1">Publish pharmaceutical industry guides, interview tutorials, and career insights</p>
        </div>
        <button type="button" @click="addModal = true"
                class="px-4 py-2.5 rounded-lg bg-[#0085FF] text-white text-xs font-bold uppercase tracking-wider border border-[#00245A] shadow-[2px_2px_0px_#00245a] hover:bg-blue-600">
            + Write New Article
        </button>
    </div>

    <!-- Blog Posts Table -->
    <div class="bg-white rounded-2xl border-2 border-[#00245A] shadow-[4px_4px_0px_#00245a] overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-[#00245A]">
                <thead class="bg-[#F4F9FF] border-b border-[#00245A]/15 text-xs font-bold uppercase tracking-wider text-[#00245A]/70">
                    <tr>
                        <th class="px-6 py-4">Article Title</th>
                        <th class="px-6 py-4">Category</th>
                        <th class="px-6 py-4">Author</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Date</th>
                        <th class="px-6 py-4 text-right">View</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($posts as $post)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4">
                                <strong class="font-bold text-sm text-[#00245A] block">{{ $post->title }}</strong>
                                <span class="text-xs text-[#00245A]/60 line-clamp-1">{{ $post->excerpt }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase bg-slate-100 text-[#00245A] border border-slate-300">
                                    {{ $post->category->name ?? 'Career' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-xs font-semibold text-[#00245A]/80">
                                {{ $post->author_name }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase {{ $post->is_published ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ $post->is_published ? 'Published' : 'Draft' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-xs text-[#00245A]/70">
                                {{ $post->published_at ? $post->published_at->format('M d, Y') : $post->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('blog.show', $post->slug) }}" target="_blank" class="text-xs font-bold text-[#0085FF] hover:underline">
                                    Preview &rarr;
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="p-6 border-t border-[#00245A]/10">
            {{ $posts->links() }}
        </div>
    </div>

    <!-- Modal for adding blog post -->
    <div x-show="addModal" class="fixed inset-0 z-50 overflow-y-auto bg-black/60 flex items-center justify-center p-4" x-cloak>
        <div class="bg-white rounded-2xl border-2 border-[#00245A] shadow-[8px_8px_0px_#00245a] max-w-2xl w-full p-6 sm:p-8" @click.away="addModal = false">
            <div class="flex items-center justify-between pb-4 border-b border-[#00245A]/10 mb-6">
                <h3 class="text-xl font-black text-[#00245A]">Publish Career Article</h3>
                <button type="button" @click="addModal = false" class="text-lg font-bold text-slate-500 hover:text-black">&times;</button>
            </div>

            <form action="{{ route('admin.blog.store') }}" method="POST" class="space-y-4">
                @csrf
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Category *</label>
                        <select name="blog_category_id" required class="w-full px-3 py-2 border-2 border-[#00245A] rounded-lg text-sm bg-white">
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Author Name *</label>
                        <input type="text" name="author_name" value="{{ auth()->user()->name }}" required class="w-full px-3 py-2 border-2 border-[#00245A] rounded-lg text-sm">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Article Title *</label>
                    <input type="text" name="title" required class="w-full px-3 py-2 border-2 border-[#00245A] rounded-lg text-sm" placeholder="e.g. Navigating QA Audits: Essential Guidelines for Fresh Graduates">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Excerpt (Summary) *</label>
                    <textarea name="excerpt" rows="2" required class="w-full px-3 py-2 border-2 border-[#00245A] rounded-lg text-sm" placeholder="Brief summary of article..."></textarea>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Full Content *</label>
                    <textarea name="content" rows="6" required class="w-full px-3 py-2 border-2 border-[#00245A] rounded-lg text-sm" placeholder="Write comprehensive guide..."></textarea>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase text-[#00245A] mb-1">Est. Reading Time (Mins) *</label>
                        <input type="number" name="reading_time" value="5" required class="w-full px-3 py-2 border-2 border-[#00245A] rounded-lg text-sm">
                    </div>
                    <div class="flex items-center gap-2 pt-6">
                        <input type="checkbox" name="is_published" value="1" checked class="rounded text-[#0085FF]">
                        <span class="text-xs font-bold text-[#00245A]">Publish Immediately</span>
                    </div>
                </div>

                <div class="pt-4 flex justify-end gap-3">
                    <button type="button" @click="addModal = false" class="px-4 py-2 border border-slate-300 rounded-lg text-xs font-bold">Cancel</button>
                    <button type="submit" class="px-5 py-2 bg-[#0085FF] text-white rounded-lg text-xs font-black uppercase tracking-wider border border-[#00245A]">Publish Article</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
