@extends('layouts.admin')

@section('title', 'Manage Career Paths - Pharma Career Compass Admin')

@section('admin_content')
<div class="space-y-6">

    {{-- Flash Notifications (if not caught by layout) --}}
    @if(session('success') && !View::hasSection('admin_content_notifications'))
        <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-semibold flex items-center justify-between shadow-xs">
            <div class="flex items-center gap-2">
                <span class="text-lg">✓</span>
                <span>{{ session('success') }}</span>
            </div>
            <button type="button" onclick="this.parentElement.remove()" class="text-emerald-600 hover:text-emerald-900 font-bold">&times;</button>
        </div>
    @endif

    @if(isset($errors) && $errors->any())
        <div class="p-4 rounded-xl bg-red-50 border border-red-200 text-red-800 text-sm shadow-xs">
            <div class="font-bold mb-1 flex items-center gap-2">
                <span>⚠️</span>
                <span>Please fix the following validation errors:</span>
            </div>
            <ul class="list-disc pl-6 space-y-0.5 text-xs">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Header Bar --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-black text-[#00245A] tracking-tight">
                Pharmaceutical Career Sectors ({{ ($careerPaths ?? $paths ?? [])->count() }})
            </h1>
            <p class="text-xs text-slate-500 mt-1">
                Add, update, or remove career departments, qualifications, skill sets, and job specifications
            </p>
        </div>
        <div class="flex items-center gap-2.5 flex-wrap">
            <button type="button" onclick="openCreateModal()" id="btnOpenCreateCareerPath"
                    class="px-4 py-2 rounded-xl bg-[#0085FF] hover:bg-[#0070d9] text-white font-bold text-xs inline-flex items-center gap-1.5 shadow-sm transition">
                <span>+ Add Career Path</span>
            </button>
            <a href="{{ route('career-paths.index') }}" target="_blank"
               class="px-3.5 py-2 rounded-xl bg-[#00245A] hover:bg-[#00173B] text-white font-bold text-xs inline-flex items-center gap-1.5 shadow-sm transition">
                <span>View Public Directory ↗</span>
            </a>
        </div>
    </div>

    {{-- Career Paths Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse(($careerPaths ?? $paths ?? []) as $path)
            @php
                $iconMap = [
                    'clipboard-check' => '📋',
                    'microscope' => '🔬',
                    'cpu' => '🏭',
                    'file-text' => '📄',
                    'activity' => '🩺',
                    'sparkles' => '🧪',
                    'flask' => '🧪',
                    'flask-conical' => '🧪',
                    'shield' => '🛡️',
                    'truck' => '📦',
                    'pill' => '💊',
                    'stethoscope' => '🩺',
                    'trending-up' => '📈',
                    'heart-pulse' => '❤️',
                ];
                $displayIcon = $iconMap[$path->icon] ?? (str_contains($path->icon ?? '', '-') ? '💊' : ($path->icon ?: '💊'));
            @endphp
            <div class="bg-white rounded-2xl border-2 border-[#00245A] shadow-[4px_4px_0px_#00245a] p-6 flex flex-col justify-between hover:-translate-y-0.5 transition-transform duration-150 relative">
                
                {{-- Top Section --}}
                <div>
                    {{-- Icon & Badges --}}
                    <div class="flex items-center justify-between mb-3 gap-2">
                        <div class="flex items-center gap-2">
                            <span class="text-2xl select-none">{{ $displayIcon }}</span>
                            @if(!$path->is_active)
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase bg-red-100 text-red-700 border border-red-200">
                                    Disabled
                                </span>
                            @endif
                            @if($path->is_featured)
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase bg-emerald-100 text-emerald-800 border border-emerald-200">
                                    Featured
                                </span>
                            @endif
                        </div>
                        <span class="px-2.5 py-0.5 rounded text-[10px] font-bold uppercase bg-[#FFCD00]/30 text-[#00245A] border border-[#FFCD00] text-right truncate max-w-[150px]">
                            {{ $path->experience_level ?? 'Entry Level' }}
                        </span>
                    </div>

                    {{-- Title & Category --}}
                    <h3 class="text-lg font-black text-[#00245A] leading-snug mb-1">
                        {{ $path->title }}
                    </h3>
                    <p class="text-xs font-bold text-[#0085FF] mb-3">
                        {{ $path->category->name ?? 'Industrial Sector' }}
                    </p>

                    {{-- Summary / Description --}}
                    <p class="text-xs text-slate-600 line-clamp-3 mb-4 leading-relaxed font-normal">
                        {{ $path->short_description ?? ($path->summary ?? '') }}
                    </p>

                    {{-- Requirements Snapshot --}}
                    <div class="space-y-1.5 pt-3 border-t border-slate-100 text-[11px] text-slate-600">
                        <p class="line-clamp-2">
                            <strong class="text-slate-800">Required Degree:</strong>
                            {{ is_array($path->relevant_qualifications) ? implode(', ', $path->relevant_qualifications) : ($path->required_qualifications ?? ($path->relevant_qualifications ?? 'B.Pharm')) }}
                        </p>
                        <p>
                            <strong class="text-slate-800">Work Environment:</strong>
                            {{ $path->work_environment ?? 'Pharma Facility' }}
                        </p>
                        @if($path->salary_range)
                            <p>
                                <strong class="text-slate-800">Compensation:</strong>
                                <span class="text-[#0085FF] font-semibold">{{ $path->salary_range }}</span>
                            </p>
                        @endif
                    </div>
                </div>

                {{-- Bottom Action Bar --}}
                <div class="pt-4 border-t border-slate-100 mt-5 flex items-center justify-between gap-2 flex-wrap">
                    <a href="{{ route('career-paths.show', $path->slug) }}" target="_blank"
                       class="text-xs font-bold text-[#0085FF] hover:text-[#00245A] inline-flex items-center gap-1 transition-colors">
                        <span>View Public</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    </a>

                    <div class="flex items-center gap-1.5">
                        <button type="button"
                                onclick="openEditPath({{ $path->id }})"
                                class="btn-edit-career-path px-2.5 py-1 rounded-lg bg-[#00245A] hover:bg-[#00173B] text-white text-xs font-bold transition shadow-xs">
                            Edit
                        </button>

                        <form action="{{ route('admin.career-paths.delete', $path->id) }}" method="POST"
                              onsubmit="return confirm('Are you sure you want to delete \'{{ addslashes($path->title) }}\'? This cannot be undone.');"
                              class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="px-2.5 py-1 rounded-lg bg-red-50 hover:bg-red-100 text-red-600 hover:text-red-700 text-xs font-bold border border-red-200 transition">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        @empty
            <div class="col-span-full bg-white rounded-2xl border-2 border-dashed border-slate-300 p-12 text-center">
                <span class="text-4xl block mb-2">📋</span>
                <h3 class="text-base font-bold text-slate-800">No career paths found</h3>
                <p class="text-xs text-slate-500 mt-1 mb-4">Get started by creating your first pharmaceutical career sector.</p>
                <button type="button" onclick="openCreateModal()" class="px-4 py-2 bg-[#0085FF] text-white text-xs font-bold rounded-xl">
                    + Add Career Path
                </button>
            </div>
        @endforelse
    </div>

    {{-- Pagination if present --}}
    @if(isset($careerPaths) && method_exists($careerPaths, 'hasPages') && $careerPaths->hasPages())
        <div class="mt-8">
            {{ $careerPaths->links() }}
        </div>
    @elseif(isset($paths) && method_exists($paths, 'hasPages') && $paths->hasPages())
        <div class="mt-8">
            {{ $paths->links() }}
        </div>
    @endif

    {{-- Create Career Path Modal --}}
    <div id="createModal"
         class="fixed inset-0 z-50 overflow-y-auto bg-black/60 items-center justify-center p-4"
         style="display: none;">
        <div class="bg-white rounded-2xl border-2 border-[#00245A] shadow-[8px_8px_0px_#00245a] max-w-3xl w-full p-6 sm:p-8 my-8 relative max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-6">
                <div>
                    <h3 class="text-xl font-extrabold text-[#00245A]">Create New Career Path</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Add a new pharmaceutical career sector, qualifications, and role outline</p>
                </div>
                <button type="button" onclick="closeCreateModal()" class="w-8 h-8 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold flex items-center justify-center text-base transition-colors">&times;</button>
            </div>

            <form action="{{ route('admin.career-paths.store') }}" method="POST" class="space-y-4">
                @csrf

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Career Title *</label>
                        <input type="text" name="title" required placeholder="e.g. Clinical Research Associate"
                               class="w-full px-3.5 py-2.5 border-2 border-[#00245A] rounded-xl text-sm focus:ring-2 focus:ring-[#0085FF]">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Sector Category *</label>
                        <select name="category_id" required class="w-full px-3.5 py-2.5 border-2 border-[#00245A] rounded-xl text-sm bg-white focus:ring-2 focus:ring-[#0085FF]">
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Icon Representation *</label>
                        <select name="icon" class="w-full px-3.5 py-2.5 border-2 border-[#00245A] rounded-xl text-sm bg-white focus:ring-2 focus:ring-[#0085FF]">
                            <option value="clipboard-check">📋 Quality / Checklist (clipboard-check)</option>
                            <option value="microscope">🔬 QC / Lab Testing (microscope)</option>
                            <option value="cpu">🏭 Production / Plant (cpu)</option>
                            <option value="file-text">📄 Regulatory / Dossier (file-text)</option>
                            <option value="activity">🩺 Pharmacovigilance (activity)</option>
                            <option value="flask">🧪 R&D / Formulation (flask)</option>
                            <option value="shield">🛡️ QA & Validation (shield)</option>
                            <option value="truck">📦 Supply Chain (truck)</option>
                            <option value="pill">💊 Product Management (pill)</option>
                            <option value="trending-up">📈 Sales & Marketing (trending-up)</option>
                            <option value="heart-pulse">❤️ Medical Information (heart-pulse)</option>
                            <option value="stethoscope">🩺 Clinical Affairs (stethoscope)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Experience Level *</label>
                        <select name="experience_level" required class="w-full px-3.5 py-2.5 border-2 border-[#00245A] rounded-xl text-sm bg-white focus:ring-2 focus:ring-[#0085FF]">
                            <option value="Fresh Graduate / Entry Level">Fresh Graduate / Entry Level</option>
                            <option value="Fresh Graduate / 1-2 Years">Fresh Graduate / 1-2 Years</option>
                            <option value="Entry / Postgraduate">Entry / Postgraduate</option>
                            <option value="Mid / Senior Level">Mid / Senior Level</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Badge Tag</label>
                        <input type="text" name="badge" placeholder="e.g. High Demand, Core Sector"
                               class="w-full px-3.5 py-2.5 border-2 border-[#00245A] rounded-xl text-sm focus:ring-2 focus:ring-[#0085FF]">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Work Environment</label>
                        <input type="text" name="work_environment" placeholder="e.g. Corporate Office / Hybrid"
                               class="w-full px-3.5 py-2.5 border-2 border-[#00245A] rounded-xl text-sm focus:ring-2 focus:ring-[#0085FF]">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Salary Range</label>
                        <input type="text" name="salary_range" placeholder="e.g. BDT 35,000 - 55,000 / month"
                               class="w-full px-3.5 py-2.5 border-2 border-[#00245A] rounded-xl text-sm focus:ring-2 focus:ring-[#0085FF]">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Sort Order</label>
                        <input type="number" name="sort_order" value="0" min="0"
                               class="w-full px-3.5 py-2.5 border-2 border-[#00245A] rounded-xl text-sm focus:ring-2 focus:ring-[#0085FF]">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Role Summary (Shown on Cards) *</label>
                    <textarea name="summary" rows="2" required placeholder="Brief 1-2 sentence overview of core mission and day-to-day responsibility..."
                              class="w-full px-3.5 py-2.5 border-2 border-[#00245A] rounded-xl text-sm focus:ring-2 focus:ring-[#0085FF]"></textarea>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Detailed Role Overview (Public Page)</label>
                    <textarea name="overview" rows="3" placeholder="In-depth explanation of department function, operations, industry scope..."
                              class="w-full px-3.5 py-2.5 border-2 border-[#00245A] rounded-xl text-sm focus:ring-2 focus:ring-[#0085FF]"></textarea>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">A Typical Day on the Job</label>
                    <textarea name="typical_day" rows="2" placeholder="e.g. Reviewing batch manufacturing records, conducting lab assays..."
                              class="w-full px-3.5 py-2.5 border-2 border-[#00245A] rounded-xl text-sm focus:ring-2 focus:ring-[#0085FF]"></textarea>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">
                            Required Degree / Qualifications
                            <span class="text-[10px] text-slate-400 font-normal lowercase">(one per line or comma-separated)</span>
                        </label>
                        <textarea name="relevant_qualifications" rows="2" placeholder="B.Pharm / M.Pharm&#10;High English Technical Writing Proficiency"
                                  class="w-full px-3.5 py-2.5 border-2 border-[#00245A] rounded-xl text-xs focus:ring-2 focus:ring-[#0085FF] font-mono"></textarea>
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">
                            Core Required Skills
                            <span class="text-[10px] text-slate-400 font-normal lowercase">(one per line or comma-separated)</span>
                        </label>
                        <textarea name="required_skills" rows="2" placeholder="cGMP & WHO Guidelines&#10;Process Validation&#10;Data Integrity ALCOA+"
                                  class="w-full px-3.5 py-2.5 border-2 border-[#00245A] rounded-xl text-xs focus:ring-2 focus:ring-[#0085FF] font-mono"></textarea>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">
                            Possible Entry Designations
                            <span class="text-[10px] text-slate-400 font-normal lowercase">(one per line or comma-separated)</span>
                        </label>
                        <textarea name="possible_entry_points" rows="2" placeholder="Trainee Officer&#10;Junior Executive&#10;IPQA Officer"
                                  class="w-full px-3.5 py-2.5 border-2 border-[#00245A] rounded-xl text-xs focus:ring-2 focus:ring-[#0085FF] font-mono"></textarea>
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">
                            Recommended Preparation Steps
                            <span class="text-[10px] text-slate-400 font-normal lowercase">(one per line or comma-separated)</span>
                        </label>
                        <textarea name="recommended_preparation" rows="2" placeholder="Master cGMP Annexes&#10;Understand Root Cause Analysis&#10;Practice interview questions"
                                  class="w-full px-3.5 py-2.5 border-2 border-[#00245A] rounded-xl text-xs focus:ring-2 focus:ring-[#0085FF] font-mono"></textarea>
                    </div>
                </div>

                <div class="flex items-center gap-6 pt-2">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" checked class="w-4 h-4 rounded text-[#0085FF] focus:ring-[#0085FF]">
                        <span class="text-xs font-bold text-slate-800">Active (Visible on public site)</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_featured" value="1" class="w-4 h-4 rounded text-[#0085FF] focus:ring-[#0085FF]">
                        <span class="text-xs font-bold text-slate-800">Featured Role (Homepage Spotlight)</span>
                    </label>
                </div>

                <div class="pt-4 border-t border-slate-100 flex justify-end gap-3">
                    <button type="button" onclick="closeCreateModal()" class="px-5 py-2.5 rounded-xl border border-slate-300 text-slate-700 text-xs font-bold hover:bg-slate-50 transition-colors">
                        Cancel
                    </button>
                    <button type="submit" class="px-6 py-2.5 bg-[#0085FF] hover:bg-[#0070d9] text-white rounded-xl text-xs font-black uppercase tracking-wider shadow-sm transition-all">
                        Create Career Path
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Edit Career Path Modal --}}
    <div id="editModal"
         class="fixed inset-0 z-50 overflow-y-auto bg-black/60 items-center justify-center p-4"
         style="display: none;">
        <div class="bg-white rounded-2xl border-2 border-[#00245A] shadow-[8px_8px_0px_#00245a] max-w-3xl w-full p-6 sm:p-8 my-8 relative max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-6">
                <div>
                    <h3 class="text-xl font-extrabold text-[#00245A]">Edit Career Path</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Update department parameters, compensation, and qualifications</p>
                </div>
                <button type="button" onclick="closeEditModal()" class="w-8 h-8 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold flex items-center justify-center text-base transition-colors">&times;</button>
            </div>

            <form action="" method="POST" id="editCareerPathForm" class="space-y-4">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Career Title *</label>
                        <input type="text" name="title" id="edit_title" required
                               class="w-full px-3.5 py-2.5 border-2 border-[#00245A] rounded-xl text-sm focus:ring-2 focus:ring-[#0085FF]">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Sector Category *</label>
                        <select name="category_id" id="edit_category_id" required class="w-full px-3.5 py-2.5 border-2 border-[#00245A] rounded-xl text-sm bg-white focus:ring-2 focus:ring-[#0085FF]">
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Icon Representation *</label>
                        <select name="icon" id="edit_icon" class="w-full px-3.5 py-2.5 border-2 border-[#00245A] rounded-xl text-sm bg-white focus:ring-2 focus:ring-[#0085FF]">
                            <option value="clipboard-check">📋 Quality / Checklist (clipboard-check)</option>
                            <option value="microscope">🔬 QC / Lab Testing (microscope)</option>
                            <option value="cpu">🏭 Production / Plant (cpu)</option>
                            <option value="file-text">📄 Regulatory / Dossier (file-text)</option>
                            <option value="activity">🩺 Pharmacovigilance (activity)</option>
                            <option value="flask">🧪 R&D / Formulation (flask)</option>
                            <option value="shield">🛡️ QA & Validation (shield)</option>
                            <option value="truck">📦 Supply Chain (truck)</option>
                            <option value="pill">💊 Product Management (pill)</option>
                            <option value="trending-up">📈 Sales & Marketing (trending-up)</option>
                            <option value="heart-pulse">❤️ Medical Information (heart-pulse)</option>
                            <option value="stethoscope">🩺 Clinical Affairs (stethoscope)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Experience Level *</label>
                        <select name="experience_level" id="edit_experience_level" required class="w-full px-3.5 py-2.5 border-2 border-[#00245A] rounded-xl text-sm bg-white focus:ring-2 focus:ring-[#0085FF]">
                            <option value="Fresh Graduate / Entry Level">Fresh Graduate / Entry Level</option>
                            <option value="Fresh Graduate / 1-2 Years">Fresh Graduate / 1-2 Years</option>
                            <option value="Entry / Postgraduate">Entry / Postgraduate</option>
                            <option value="Mid / Senior Level">Mid / Senior Level</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Badge Tag</label>
                        <input type="text" name="badge" id="edit_badge"
                               class="w-full px-3.5 py-2.5 border-2 border-[#00245A] rounded-xl text-sm focus:ring-2 focus:ring-[#0085FF]">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Work Environment</label>
                        <input type="text" name="work_environment" id="edit_work_environment"
                               class="w-full px-3.5 py-2.5 border-2 border-[#00245A] rounded-xl text-sm focus:ring-2 focus:ring-[#0085FF]">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Salary Range</label>
                        <input type="text" name="salary_range" id="edit_salary_range"
                               class="w-full px-3.5 py-2.5 border-2 border-[#00245A] rounded-xl text-sm focus:ring-2 focus:ring-[#0085FF]">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Sort Order</label>
                        <input type="number" name="sort_order" id="edit_sort_order" min="0"
                               class="w-full px-3.5 py-2.5 border-2 border-[#00245A] rounded-xl text-sm focus:ring-2 focus:ring-[#0085FF]">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Role Summary (Shown on Cards) *</label>
                    <textarea name="summary" id="edit_summary" rows="2" required
                              class="w-full px-3.5 py-2.5 border-2 border-[#00245A] rounded-xl text-sm focus:ring-2 focus:ring-[#0085FF]"></textarea>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Detailed Role Overview (Public Page)</label>
                    <textarea name="overview" id="edit_overview" rows="3"
                              class="w-full px-3.5 py-2.5 border-2 border-[#00245A] rounded-xl text-sm focus:ring-2 focus:ring-[#0085FF]"></textarea>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">A Typical Day on the Job</label>
                    <textarea name="typical_day" id="edit_typical_day" rows="2"
                              class="w-full px-3.5 py-2.5 border-2 border-[#00245A] rounded-xl text-sm focus:ring-2 focus:ring-[#0085FF]"></textarea>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">
                            Required Degree / Qualifications
                            <span class="text-[10px] text-slate-400 font-normal lowercase">(one per line or comma-separated)</span>
                        </label>
                        <textarea name="relevant_qualifications" id="edit_relevant_qualifications" rows="2"
                                  class="w-full px-3.5 py-2.5 border-2 border-[#00245A] rounded-xl text-xs focus:ring-2 focus:ring-[#0085FF] font-mono"></textarea>
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">
                            Core Required Skills
                            <span class="text-[10px] text-slate-400 font-normal lowercase">(one per line or comma-separated)</span>
                        </label>
                        <textarea name="required_skills" id="edit_required_skills" rows="2"
                                  class="w-full px-3.5 py-2.5 border-2 border-[#00245A] rounded-xl text-xs focus:ring-2 focus:ring-[#0085FF] font-mono"></textarea>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">
                            Possible Entry Designations
                            <span class="text-[10px] text-slate-400 font-normal lowercase">(one per line or comma-separated)</span>
                        </label>
                        <textarea name="possible_entry_points" id="edit_possible_entry_points" rows="2"
                                  class="w-full px-3.5 py-2.5 border-2 border-[#00245A] rounded-xl text-xs focus:ring-2 focus:ring-[#0085FF] font-mono"></textarea>
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">
                            Recommended Preparation Steps
                            <span class="text-[10px] text-slate-400 font-normal lowercase">(one per line or comma-separated)</span>
                        </label>
                        <textarea name="recommended_preparation" id="edit_recommended_preparation" rows="2"
                                  class="w-full px-3.5 py-2.5 border-2 border-[#00245A] rounded-xl text-xs focus:ring-2 focus:ring-[#0085FF] font-mono"></textarea>
                    </div>
                </div>

                <div class="flex items-center gap-6 pt-2">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_active" id="edit_is_active" value="1" class="w-4 h-4 rounded text-[#0085FF] focus:ring-[#0085FF]">
                        <span class="text-xs font-bold text-slate-800">Active (Visible on public site)</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_featured" id="edit_is_featured" value="1" class="w-4 h-4 rounded text-[#0085FF] focus:ring-[#0085FF]">
                        <span class="text-xs font-bold text-slate-800">Featured Role (Homepage Spotlight)</span>
                    </label>
                </div>

                <div class="pt-4 border-t border-slate-100 flex justify-end gap-3">
                    <button type="button" onclick="closeEditModal()" class="px-5 py-2.5 rounded-xl border border-slate-300 text-slate-700 text-xs font-bold hover:bg-slate-50 transition-colors">
                        Cancel
                    </button>
                    <button type="submit" class="px-6 py-2.5 bg-[#0085FF] hover:bg-[#0070d9] text-white rounded-xl text-xs font-black uppercase tracking-wider shadow-sm transition-all">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>

<script>
    const careerPathsData = @json(($careerPaths ?? $paths ?? [])->keyBy('id'));

    function openCreateModal() {
        const modal = document.getElementById('createModal');
        if (modal) modal.style.display = 'flex';
    }

    function closeCreateModal() {
        const modal = document.getElementById('createModal');
        if (modal) modal.style.display = 'none';
    }

    function openEditPath(id) {
        const path = (typeof careerPathsData !== 'undefined' && careerPathsData[id]) ? careerPathsData[id] : null;
        if (!path) return;

        document.getElementById('editCareerPathForm').action = '{{ url("admin/career-paths") }}/' + path.id;

        document.getElementById('edit_title').value = path.title || '';
        document.getElementById('edit_category_id').value = path.category_id || '';
        document.getElementById('edit_icon').value = path.icon || 'clipboard-check';
        document.getElementById('edit_badge').value = path.badge || '';
        document.getElementById('edit_experience_level').value = path.experience_level || 'Fresh Graduate / Entry Level';
        document.getElementById('edit_salary_range').value = path.salary_range || '';
        document.getElementById('edit_work_environment').value = path.work_environment || '';
        document.getElementById('edit_sort_order').value = path.sort_order ?? 0;
        document.getElementById('edit_summary').value = path.summary || '';
        document.getElementById('edit_overview').value = path.overview || '';
        document.getElementById('edit_typical_day').value = path.typical_day || '';

        const toLines = (val) => {
            if (!val) return '';
            if (Array.isArray(val)) return val.join('\n');
            return String(val);
        };

        document.getElementById('edit_relevant_qualifications').value = toLines(path.relevant_qualifications);
        document.getElementById('edit_required_skills').value = toLines(path.required_skills);
        document.getElementById('edit_possible_entry_points').value = toLines(path.possible_entry_points);
        document.getElementById('edit_recommended_preparation').value = toLines(path.recommended_preparation);

        document.getElementById('edit_is_featured').checked = Boolean(path.is_featured);
        document.getElementById('edit_is_active').checked = (path.is_active !== false && path.is_active !== 0 && path.is_active !== '0');

        const modal = document.getElementById('editModal');
        if (modal) modal.style.display = 'flex';
    }

    function closeEditModal() {
        const modal = document.getElementById('editModal');
        if (modal) modal.style.display = 'none';
    }

    // Close on Escape or click outside backdrop
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeCreateModal();
            closeEditModal();
        }
    });

    ['createModal', 'editModal'].forEach(id => {
        const el = document.getElementById(id);
        if (el) {
            el.addEventListener('click', function(e) {
                if (e.target === this) {
                    if (id === 'createModal') closeCreateModal();
                    if (id === 'editModal') closeEditModal();
                }
            });
        }
    });
</script>
@endsection
