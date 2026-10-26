<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\CareerPath;
use App\Models\Consultant;
use App\Models\Service;
use Illuminate\Http\Response;

class SeoController extends Controller
{
    public function sitemap()
    {
        $urls = [
            url('/'),
            url('/about'),
            url('/programs'),
            url('/services'),
            url('/career-paths'),
            url('/consultants'),
            url('/consultation/book'),
            url('/career-quiz'),
            url('/career-roadmap'),
            url('/practice/exams'),
            url('/practice/viva'),
            url('/practice/interviews'),
            url('/blog'),
            url('/contact'),
        ];

        foreach (CareerPath::where('is_active', true)->get() as $path) {
            $urls[] = route('career-paths.show', $path->slug);
        }

        foreach (Service::where('is_active', true)->get() as $service) {
            $urls[] = route('services.show', $service->slug);
        }

        foreach (Consultant::where('is_active', true)->get() as $consultant) {
            $urls[] = route('consultants.show', $consultant->slug);
        }

        foreach (BlogPost::where('is_published', true)->get() as $post) {
            $urls[] = route('blog.show', $post->slug);
        }

        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
        
        foreach ($urls as $url) {
            $xml .= '<url>';
            $xml .= '<loc>' . htmlspecialchars($url) . '</loc>';
            $xml .= '<lastmod>' . date('Y-m-d') . '</lastmod>';
            $xml .= '<changefreq>weekly</changefreq>';
            $xml .= '<priority>0.8</priority>';
            $xml .= '</url>';
        }

        $xml .= '</urlset>';

        return response($xml, 200)->header('Content-Type', 'text/xml');
    }

    public function robots()
    {
        $content = "User-agent: *\n";
        $content .= "Disallow: /admin/\n";
        $content .= "Disallow: /dashboard/\n";
        $content .= "Allow: /\n\n";
        $content .= "Sitemap: " . url('/sitemap.xml') . "\n";

        return response($content, 200)->header('Content-Type', 'text/plain');
    }
}
