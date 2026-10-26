<?php

namespace App\Http\Controllers;

use App\Models\Consultant;
use App\Models\Service;
use Illuminate\Http\Request;

class ConsultantController extends Controller
{
    public function index(Request $request)
    {
        $query = Consultant::with('availabilities')->where('is_active', true);

        if ($request->filled('specialization')) {
            $query->where('specialization', 'LIKE', '%' . $request->specialization . '%');
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('title', 'LIKE', "%{$search}%")
                  ->orWhere('specialization', 'LIKE', "%{$search}%");
            });
        }

        $consultants = $query->orderBy('sort_order')->paginate(6)->withQueryString();
        $specializations = Consultant::where('is_active', true)->pluck('specialization')->unique();

        return view('pages.consultants.index', compact('consultants', 'specializations'));
    }

    public function show($slug)
    {
        $consultant = Consultant::with('availabilities')->where('slug', $slug)->where('is_active', true)->firstOrFail();
        $services = Service::where('is_active', true)->get();
        return view('pages.consultants.show', compact('consultant', 'services'));
    }
}
