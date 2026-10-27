<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\CareerPath;
use App\Models\Consultant;
use App\Models\ExamCategory;
use App\Models\Service;
use Illuminate\Http\Response;

class SeoController extends Controller
{
    /**
     * Generate dynamic and complete XML Sitemap for search engines
     */
    public function sitemap()
    {
        $baseUrl = rtrim(config('app.url', 'https://pharmacareercompass.com'), '/');
        if (str_contains($baseUrl, 'localhost')) {
            $baseUrl = 'https://pharmacareercompass.com';
        }

        $items = [];

        // 1. High Priority Primary Landing Pages (Priority 1.0 - 0.9)
        $items[] = [
            'loc' => $baseUrl . '/',
            'lastmod' => date('Y-m-d'),
            'changefreq' => 'daily',
            'priority' => '1.0',
        ];
        $items[] = [
            'loc' => $baseUrl . '/career-paths',
            'lastmod' => date('Y-m-d'),
            'changefreq' => 'weekly',
            'priority' => '0.9',
        ];
        $items[] = [
            'loc' => $baseUrl . '/services',
            'lastmod' => date('Y-m-d'),
            'changefreq' => 'weekly',
            'priority' => '0.9',
        ];
        $items[] = [
            'loc' => $baseUrl . '/practice/exams',
            'lastmod' => date('Y-m-d'),
            'changefreq' => 'daily',
            'priority' => '0.9',
        ];
        $items[] = [
            'loc' => $baseUrl . '/practice/viva',
            'lastmod' => date('Y-m-d'),
            'changefreq' => 'weekly',
            'priority' => '0.9',
        ];

        // 2. Feature & Tool Pages (Priority 0.85 - 0.8)
        $items[] = [
            'loc' => $baseUrl . '/quiz',
            'lastmod' => date('Y-m-d'),
            'changefreq' => 'weekly',
            'priority' => '0.85',
        ];
        $items[] = [
            'loc' => $baseUrl . '/roadmap',
            'lastmod' => date('Y-m-d'),
            'changefreq' => 'weekly',
            'priority' => '0.85',
        ];
        $items[] = [
            'loc' => $baseUrl . '/consultants',
            'lastmod' => date('Y-m-d'),
            'changefreq' => 'weekly',
            'priority' => '0.85',
        ];
        $items[] = [
            'loc' => $baseUrl . '/consultation/book',
            'lastmod' => date('Y-m-d'),
            'changefreq' => 'weekly',
            'priority' => '0.85',
        ];
        $items[] = [
            'loc' => $baseUrl . '/practice/interviews',
            'lastmod' => date('Y-m-d'),
            'changefreq' => 'weekly',
            'priority' => '0.8',
        ];
        $items[] = [
            'loc' => $baseUrl . '/programs',
            'lastmod' => date('Y-m-d'),
            'changefreq' => 'weekly',
            'priority' => '0.8',
        ];
        $items[] = [
            'loc' => $baseUrl . '/blog',
            'lastmod' => date('Y-m-d'),
            'changefreq' => 'weekly',
            'priority' => '0.8',
        ];
        $items[] = [
            'loc' => $baseUrl . '/about',
            'lastmod' => date('Y-m-d'),
            'changefreq' => 'monthly',
            'priority' => '0.7',
        ];
        $items[] = [
            'loc' => $baseUrl . '/contact',
            'lastmod' => date('Y-m-d'),
            'changefreq' => 'monthly',
            'priority' => '0.7',
        ];

        // 3. Dynamic Career Path Detail Pages (Priority 0.85)
        foreach (CareerPath::where('is_active', true)->get() as $path) {
            $items[] = [
                'loc' => $baseUrl . '/career-paths/' . $path->slug,
                'lastmod' => $path->updated_at ? $path->updated_at->format('Y-m-d') : date('Y-m-d'),
                'changefreq' => 'weekly',
                'priority' => '0.85',
            ];
        }

        // 4. Dynamic Service Detail Pages (Priority 0.85)
        foreach (Service::where('is_active', true)->get() as $service) {
            $items[] = [
                'loc' => $baseUrl . '/services/' . $service->slug,
                'lastmod' => $service->updated_at ? $service->updated_at->format('Y-m-d') : date('Y-m-d'),
                'changefreq' => 'weekly',
                'priority' => '0.85',
            ];
        }

        // 5. Dynamic Consultant Profile Pages (Priority 0.8)
        foreach (Consultant::where('is_active', true)->get() as $consultant) {
            $items[] = [
                'loc' => $baseUrl . '/consultants/' . $consultant->slug,
                'lastmod' => $consultant->updated_at ? $consultant->updated_at->format('Y-m-d') : date('Y-m-d'),
                'changefreq' => 'weekly',
                'priority' => '0.8',
            ];
        }

        // 6. Dynamic Exam Categories Practice Pages (Priority 0.8)
        foreach (ExamCategory::where('is_active', true)->get() as $cat) {
            $items[] = [
                'loc' => $baseUrl . '/practice/exams/' . $cat->slug,
                'lastmod' => $cat->updated_at ? $cat->updated_at->format('Y-m-d') : date('Y-m-d'),
                'changefreq' => 'weekly',
                'priority' => '0.8',
            ];
        }

        // 7. Dynamic Published Blog Articles (Priority 0.75)
        foreach (BlogPost::where('is_published', true)->get() as $post) {
            $items[] = [
                'loc' => $baseUrl . '/blog/' . $post->slug,
                'lastmod' => $post->updated_at ? $post->updated_at->format('Y-m-d') : date('Y-m-d'),
                'changefreq' => 'monthly',
                'priority' => '0.75',
            ];
        }

        // 8. Dynamic Program Modules & Seminars (Priority 0.85)
        foreach (\App\Models\Seminar::whereIn('status', ['published', 'registration_open'])->get() as $seminar) {
            $items[] = [
                'loc' => $baseUrl . '/seminars/' . $seminar->slug,
                'lastmod' => $seminar->updated_at ? $seminar->updated_at->format('Y-m-d') : date('Y-m-d'),
                'changefreq' => 'weekly',
                'priority' => '0.85',
            ];
        }

        // Build XML
        $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
        $xml .= "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\"\n";
        $xml .= "        xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\"\n";
        $xml .= "        xsi:schemaLocation=\"http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd\">\n";

        foreach ($items as $item) {
            $xml .= "  <url>\n";
            $xml .= "    <loc>" . htmlspecialchars($item['loc']) . "</loc>\n";
            $xml .= "    <lastmod>" . $item['lastmod'] . "</lastmod>\n";
            $xml .= "    <changefreq>" . $item['changefreq'] . "</changefreq>\n";
            $xml .= "    <priority>" . $item['priority'] . "</priority>\n";
            $xml .= "  </url>\n";
        }

        $xml .= "</urlset>\n";

        // Save static copy to public/sitemap.xml if writable
        @file_put_contents(public_path('sitemap.xml'), $xml);

        return response($xml, 200)->header('Content-Type', 'application/xml; charset=utf-8');
    }

    public function robots()
    {
        $baseUrl = rtrim(config('app.url', 'https://pharmacareercompass.com'), '/');
        if (str_contains($baseUrl, 'localhost')) {
            $baseUrl = 'https://pharmacareercompass.com';
        }

        $content = "User-agent: *\n";
        $content .= "Disallow: /admin/\n";
        $content .= "Disallow: /dashboard/\n";
        $content .= "Disallow: /api/\n";
        $content .= "Allow: /\n\n";
        $content .= "Sitemap: " . $baseUrl . "/sitemap.xml\n";

        return response($content, 200)->header('Content-Type', 'text/plain');
    }
}
