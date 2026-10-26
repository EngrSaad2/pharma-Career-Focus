<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Consultant;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::where('is_active', true)->orderBy('sort_order')->get();
        $consultants = Consultant::where('is_active', true)->take(4)->get();
        return view('pages.services.index', compact('services', 'consultants'));
    }

    public function show($slug)
    {
        $service = Service::where('slug', $slug)->where('is_active', true)->firstOrFail();
        $otherServices = Service::where('id', '!=', $service->id)->where('is_active', true)->take(3)->get();
        $consultants = Consultant::where('is_active', true)->get();

        return view('pages.services.show', compact('service', 'otherServices', 'consultants'));
    }
}
