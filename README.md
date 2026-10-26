# Pharma Career Compass (🧭)
> **Discover Your Direction. Build Your Future.**  
> Flagship Program: **PHARMA CAREER LAUNCHPAD** — *A Practical Career Preparation Program for Pharmacists*  
> Core Pillars: **Career Planning • Written Exam Preparation • Viva Skills • Interview Readiness • Pharmaceutical Industry Insights**

---

## 🚀 Overview

**Pharma Career Compass** is a modern, full-stack pharmaceutical career consultation, examination, and mentorship platform built on **Laravel 12**, **MySQL**, **Tailwind CSS v4**, and **Alpine.js**.

It recreates and elevates the high-contrast aesthetic and responsive interactions of the reference benchmark ([Gritty Mentor](https://grittymentor.com/)) with custom pharmaceutical branding, a signature gold ticker (`#FFCD00`), navy typography (`#00245A`), vibrant electric blue CTAs (`#0085FF`), solid offset shadow elevation (`shadow-[3px_3px_0px_#00245a]`), and authentic industry content.

---

## 📦 System Architecture & Features

### 1. Public Portals
- **Homepage (`/`)**: Hero section, 5 program pillars, 11 sector directory preview, 7 consultation packages, step-by-step preparation flow, verified consultant profiles, transparent demonstration feedback badges, collapsible FAQs, and SEO-optimized footer.
- **Career Launchpad (`/programs`)**: In-depth curriculum and learning tracks across industrial disciplines.
- **Career Path Directory (`/career-paths`)**: 11 pharmaceutical disciplines (Quality Assurance, Quality Control, Production, Regulatory Affairs, Pharmacovigilance, R&D, Sales & Marketing, Medical Affairs, Clinical Research, Hospital/Community Pharmacy, Supply Chain).
- **Service Catalog (`/services`)**: Transparent pricing, outcomes, duration, and direct booking actions.
- **Mentors Directory (`/consultants`)**: Real consultant profiles with credentials, industrial track record, session pricing, and weekly availability slots.
- **Consultation Booking Engine (`/consultation/book`)**: Live AJAX slot calculation by consultant and day-of-week, anti-double-booking validation, and instant video link generation.
- **Career Assessment Quiz (`/quiz`)**: 5-step algorithm analyzing qualification, stage, environment, and technical interests to recommend top 3 sector matches with a 4-step action plan.
- **Roadmap Builder (`/roadmap`)**: Interactive milestone roadmap generator customized by sector and commitment.
- **Written Exam Practice Hub (`/practice/exams`)**: Timed MCQ examinations with auto-submit, countdown timers, randomized options, real-time scorecards, and rationale breakdowns.
- **Viva Practice Hub (`/practice/viva`)**: High-yield viva questions, domain filtering, toggleable model answers, board tips, and candidate practice logging.
- **Job Interview Center (`/practice/interviews`)**: Behavioral and technical prompts structured with the STAR method (Situation, Task, Action, Result) and recruiter red flag indicators.
- **Knowledge Articles CMS (`/blog`)**: Searchable, tagged, categorized pharmaceutical career guides.
- **Contact Center (`/contact`)**: Form validation, direct email/phone channels, and institutional partnership inquiries.
- **Technical SEO (`/sitemap.xml`, `/robots.txt`)**: Dynamic XML sitemap generator, JSON-LD structured data (`EducationalOrganization`), OpenGraph meta, and canonical URLs.

### 2. Candidate Dashboard (`/dashboard`)
- **Dashboard Overview**: Roadmap completion gauge, exam performance metrics, practiced viva counter, and upcoming video consultations.
- **My Assessments (`/dashboard/assessment`)**: Historical quiz reports and career recommendations.
- **My Roadmap (`/dashboard/roadmap`)**: Interactive milestone checklist with real-time toggle persistence.
- **Exam History (`/dashboard/exams`)**: Historical mock scores, percentages, and scorecard reviews.
- **Viva & Interview Progress (`/dashboard/viva`)**: Saved and bookmarked technical prompts.
- **Consultation Bookings (`/dashboard/bookings`)**: Upcoming sessions, video meeting links, and cancellation rules.
- **Profile & Security (`/dashboard/profile`)**: Degree background, graduation year, target sector, and password management.

### 3. Protected Administration Suite (`/admin`)
- **Metrics Dashboard (`/admin`)**: Real-time counts of users, bookings, MCQs, viva guides, and contact inquiries.
- **Bookings Management (`/admin/bookings`)**: Approve, cancel, and update video call meeting links.
- **Services Manager (`/admin/services`)**: Manage consultation titles, descriptions, pricing, and duration.
- **Career Paths (`/admin/career-paths`)**: 11 pharmaceutical sectors and qualification criteria.
- **Consultants & Availability (`/admin/consultants`)**: Manage consultants and weekly slot schedules.
- **Question Bank Manager (`/admin/exams`)**: Add written questions with options and rationales.
- **Viva Bank Manager (`/admin/viva`)**: Add oral questions with model answers and evaluation points.
- **Blog CMS (`/admin/blog`)**: Article creation and draft/publishing controls.
- **Testimonials Manager (`/admin/testimonials`)**: Manage feedback with explicit demonstration indicators.
- **FAQs Manager (`/admin/faqs`)**: Manage questions, categories, and display sort order.
- **Inquiries (`/admin/messages`)**: View incoming submissions and reply via email.
- **Branding & Settings (`/admin/settings`)**: Update site name, taglines, top ticker text, contact info, and social links.

---

## 🔑 Demo Access Credentials

The database is pre-seeded with authentic demonstration profiles:

| Role | Email | Password | Access Level |
|---|---|---|---|
| **Administrator** | `admin@pharmacareer.com` | `password` | Full Admin Suite (`/admin`) + Candidate Portal |
| **Consultant** | `consultant@pharmacareer.com` | `password` | Profile & Candidate Portal |
| **Candidate / Student** | `student@pharmacareer.com` | `password` | Candidate Portal (`/dashboard`) |

---

## ⚙️ Local Development Setup

### 1. Requirements
- PHP 8.2+
- MySQL / MariaDB (running on default port 3306)
- Composer
- Node.js & npm

### 2. Database Setup
```bash
# In MySQL console:
CREATE DATABASE IF NOT EXISTS pharmacareer CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 3. Environment Configuration
Verify in `.env`:
```env
APP_NAME="Pharma Career Compass"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pharmacareer
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Migrate and Seed
```bash
php artisan migrate:fresh --seed
```

### 5. Compile Assets
```bash
npm install
npm run build
```

### 6. Run Application
```bash
php artisan serve
```
Open [http://localhost:8000](http://localhost:8000) in your browser.

---

## 🧪 Automated Testing

Run the automated test suite:
```bash
php artisan test
```
**Results:** `18 passed (60 assertions)` covering all public pages, authentication, assessment submission, roadmap generation, exam scoring, consultation booking with conflict prevention, dashboard access, and admin authorization.
