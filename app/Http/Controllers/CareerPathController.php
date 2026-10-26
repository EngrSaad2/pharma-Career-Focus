<?php

namespace App\Http\Controllers;

use App\Models\CareerCategory;
use App\Models\CareerPath;
use App\Models\Service;
use Illuminate\Http\Request;

class CareerPathController extends Controller
{
    public function index(Request $request)
    {
        $categories = CareerCategory::orderBy('sort_order')->get();
        
        $query = CareerPath::with('category')->where('is_active', true);

        if ($request->filled('category')) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        if ($request->filled('experience')) {
            $query->where('experience_level', 'LIKE', '%' . $request->experience . '%');
        }

        if ($request->filled('environment')) {
            $query->where('work_environment', 'LIKE', '%' . $request->environment . '%');
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('summary', 'LIKE', "%{$search}%");
            });
        }

        $paths = $query->orderBy('sort_order')->paginate(9)->withQueryString();

        return view('pages.career-paths.index', compact('paths', 'categories'));
    }

    public function show($slug)
    {
        $path = CareerPath::with('category')->where('slug', $slug)->where('is_active', true)->firstOrFail();
        $relatedPaths = CareerPath::where('id', '!=', $path->id)
            ->where('category_id', $path->category_id)
            ->where('is_active', true)
            ->take(3)
            ->get();
        $relevantServices = Service::where('is_active', true)->take(3)->get();

        return view('pages.career-paths.show', compact('path', 'relatedPaths', 'relevantServices'));
    }
}
