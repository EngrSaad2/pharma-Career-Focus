<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserProfile;
use App\Models\CareerCategory;
use App\Models\CareerPath;
use App\Models\Service;
use App\Models\Consultant;
use App\Models\ConsultantAvailability;
use App\Models\CareerAssessmentQuestion;
use App\Models\ExamCategory;
use App\Models\ExamQuestion;
use App\Models\VivaQuestion;
use App\Models\InterviewQuestion;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\Testimonial;
use App\Models\Faq;
use App\Models\SiteSetting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Site Settings
        $settings = [
            ['key' => 'site_name', 'value' => 'Pharma Career Compass', 'group' => 'general'],
            ['key' => 'site_tagline', 'value' => 'Discover Your Direction. Build Your Future.', 'group' => 'general'],
            ['key' => 'program_name', 'value' => 'Pharmaceutical Career Development Program', 'group' => 'program'],
            ['key' => 'program_description', 'value' => 'Building Your Future in the Pharmaceutical Industry', 'group' => 'program'],
            ['key' => 'announcement_ticker', 'value' => '• Registration Open: Pharmaceutical Career Development Program • Module 1: Industrial Operations & Module 2: Pharmaceutical Marketing • Online Sessions Every Friday & Saturday • BDT 1,000 / Session •', 'group' => 'general'],
            ['key' => 'contact_email', 'value' => 'info@pharmacareercompass.com', 'group' => 'contact'],
            ['key' => 'contact_phone', 'value' => '+880 1844 567890', 'group' => 'contact'],
            ['key' => 'contact_address', 'value' => 'Suite 7B, Pharma Innovation Hub, Gulshan-1, Dhaka 1212', 'group' => 'contact'],
            ['key' => 'social_linkedin', 'value' => 'https://linkedin.com/company/pharma-career-compass', 'group' => 'social'],
            ['key' => 'social_facebook', 'value' => 'https://facebook.com/pharmacareercompass', 'group' => 'social'],
            ['key' => 'social_youtube', 'value' => 'https://youtube.com/@pharmacareercompass', 'group' => 'social'],
            ['key' => 'meta_description', 'value' => 'Pharma Career Compass is the premier pharmaceutical career guidance, written exam preparation, viva coaching, and consultation platform for pharmacists and graduates.', 'group' => 'seo'],
        ];

        foreach ($settings as $setting) {
            SiteSetting::updateOrCreate(['key' => $setting['key']], $setting);
        }

        // 2. Users
        $admin = User::firstOrCreate(
            ['email' => 'bashar@gmail.com'],
            [
                'name' => 'MD Abul Bashar, RPh',
                'password' => Hash::make('123456'),
                'role' => 'admin',
                'phone' => '+880 1711 000111',
                'headline' => 'Founder & Lead Pharmaceutical Career Consultant',
                'bio' => 'Founder of Pharma Career Compass. Over 15 years guiding pharmaceutical graduates across Bangladesh into top tier pharmaceutical companies.',
                'is_active' => true,
            ]
        );

        $adminSaad = User::firstOrCreate(
            ['email' => 'saad@gmail.com'],
            [
                'name' => 'Engr Saad',
                'password' => Hash::make('123456'),
                'role' => 'admin',
                'phone' => '+880 1844 567890',
                'headline' => 'Platform Administrator & Tech Lead',
                'bio' => 'Lead Platform Administrator for Pharma Career Compass.',
                'is_active' => true,
            ]
        );

        User::firstOrCreate(
            ['email' => 'admin@pharmacareer.com'],
            [
                'name' => 'MD Abul Bashar, RPh',
                'password' => Hash::make('123456'),
                'role' => 'admin',
                'phone' => '+880 1711 000111',
                'headline' => 'Founder & Lead Pharmaceutical Career Consultant',
                'bio' => 'Founder of Pharma Career Compass.',
                'is_active' => true,
            ]
        );

        $consultantUser = User::firstOrCreate(
            ['email' => 'consultant@pharmacareer.com'],
            [
                'name' => 'Prof. Dr. Farhana Chowdhury',
                'password' => Hash::make('password'),
                'role' => 'consultant',
                'phone' => '+880 1711 222333',
                'headline' => 'Head of Regulatory Affairs & Former Plant QA Director',
                'bio' => '20+ years of industrial pharmacy experience, ex-Beximco & Square Pharmaceuticals, guiding pharmacy graduates to corporate leadership.',
                'is_active' => true,
            ]
        );

        $studentUser = User::firstOrCreate(
            ['email' => 'student@pharmacareer.com'],
            [
                'name' => 'Saadman Sakib',
                'password' => Hash::make('password'),
                'role' => 'user',
                'phone' => '+880 1711 444555',
                'headline' => 'B.Pharm Graduate | Aspiring QA/QC Pharmacist',
                'bio' => 'Passionate graduate from University of Dhaka seeking structured career readiness in pharmaceutical manufacturing & analytical quality.',
                'is_active' => true,
            ]
        );

        UserProfile::updateOrCreate(
            ['user_id' => $studentUser->id],
            [
                'education_level' => 'Bachelor of Pharmacy (B.Pharm Professional)',
                'university' => 'University of Dhaka',
                'graduation_year' => 2025,
                'current_status' => 'Fresh Graduate / Job Seeker',
                'target_department' => 'Quality Assurance (QA)',
                'target_role' => 'Executive, Quality Assurance',
                'years_experience' => 0.5,
                'linkedin_url' => 'https://linkedin.com/in/saadman-pharma',
                'preferred_learning_mode' => 'Interactive practice + 1-on-1 Mentorship',
                'career_summary' => 'Dedicated pharmaceutical graduate seeking industrial entry in sterile QA validation and GMP compliance.',
            ]
        );

        // 3. Career Categories & Paths
        $catIndustrial = CareerCategory::updateOrCreate(
            ['slug' => 'industrial-operations'],
            ['name' => 'Industrial Operations & Quality', 'icon' => 'factory', 'description' => 'Plant-based core pharmaceutical roles including QA, QC, and Production.', 'sort_order' => 1]
        );

        $catRegulatory = CareerCategory::updateOrCreate(
            ['slug' => 'regulatory-scientific'],
            ['name' => 'Regulatory & Scientific Affairs', 'icon' => 'shield-check', 'description' => 'Dossier submission, compliance, pharmacovigilance, and R&D.', 'sort_order' => 2]
        );

        $catCommercial = CareerCategory::updateOrCreate(
            ['slug' => 'commercial-clinical'],
            ['name' => 'Commercial, Medical & Clinical', 'icon' => 'briefcase', 'description' => 'Product management, medical affairs, clinical trials, and healthcare pharmacy.', 'sort_order' => 3]
        );

        $pathsData = [
            [
                'category_id' => $catIndustrial->id,
                'title' => 'Quality Assurance (QA)',
                'slug' => 'quality-assurance-qa',
                'icon' => 'clipboard-check',
                'badge' => 'High Demand',
                'summary' => 'Ensure all manufactured medicinal batches adhere strictly to cGMP, WHO standards, and international pharmacopoeial specifications.',
                'overview' => 'Quality Assurance (QA) in the pharmaceutical industry is responsible for building quality into the entire drug manufacturing lifecycle. Rather than merely testing finished products, QA designs systems, audits SOPs, oversees validation (process, equipment, cleaning, computer systems), manages deviations, investigations (CAPA), and change controls.',
                'required_skills' => ['cGMP & WHO Guidelines', 'Process Validation', 'CAPA & Deviation Investigation', 'Audit Readiness', 'SOP Writing', 'Data Integrity ALCOA+'],
                'relevant_qualifications' => ['B.Pharm / M.Pharm', 'Pharmacy Council Registration (Grade-A)', 'Knowledge of US FDA / EU GMP'],
                'possible_entry_points' => ['Trainee QA Officer', 'Junior Executive - Documentation', 'In-Process QA (IPQA) Officer'],
                'recommended_preparation' => ['Master cGMP Annexes (sterile vs non-sterile)', 'Understand Root Cause Analysis (Fishbone/5-Why)', 'Practise QA recruitment written tests on Pharma Career Compass'],
                'typical_day' => 'Reviewing batch manufacturing records (BMR/BPR), monitoring cleanroom differential pressures, reviewing deviation tickets, and conducting internal audits.',
                'salary_range' => 'BDT 35,000 - 55,000 (Entry) • BDT 70,000 - 120,000+ (Mid/Senior)',
                'work_environment' => 'Pharmaceutical Plant / Cleanroom & Office',
                'experience_level' => 'Fresh Graduate / Entry Level',
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'category_id' => $catIndustrial->id,
                'title' => 'Quality Control (QC)',
                'slug' => 'quality-control-qc',
                'icon' => 'microscope',
                'badge' => 'Core Analytical',
                'summary' => 'Execute rigorous instrumental and wet chemical analysis of raw materials, in-process samples, and finished pharmaceuticals.',
                'overview' => 'Quality Control is the frontline analytical bastion of pharmaceutical manufacturing. QC analysts test incoming active pharmaceutical ingredients (APIs), excipients, packaging components, and finished dosage forms using sophisticated analytical instrumentation like HPLC, GC, UV-Vis, FTIR, and dissolution apparatus.',
                'required_skills' => ['HPLC & GC Operation', 'Dissolution & Disintegration Testing', 'Method Validation (ICH Q2)', 'Good Laboratory Practice (GLP)', 'Wet Chemistry Titration'],
                'relevant_qualifications' => ['B.Pharm / M.Pharm / M.Sc Chemistry', 'Analytical Instrumentation Training'],
                'possible_entry_points' => ['Junior QC Analyst', 'Trainee Officer - Raw Material Testing', 'Stability Testing Analyst'],
                'recommended_preparation' => ['Review HPLC theory, system suitability, peak tailing, chromatography equations', 'Review pharmacopoeial monographs (BP/USP)', 'Complete analytical exam practice questions'],
                'typical_day' => 'Preparing calibration standards, injecting samples on HPLC autosamplers, calculating assay and impurity profiles, recording data in GLP logbooks.',
                'salary_range' => 'BDT 32,000 - 50,000 (Entry) • BDT 65,000 - 110,000 (Mid/Senior)',
                'work_environment' => 'Analytical Laboratory / QC Facility',
                'experience_level' => 'Fresh Graduate / Entry Level',
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'category_id' => $catIndustrial->id,
                'title' => 'Production and Manufacturing',
                'slug' => 'production-and-manufacturing',
                'icon' => 'cpu',
                'badge' => 'Core Plant Role',
                'summary' => 'Lead shop-floor operations in solid dosages, injectables, cephalosporin, or biotech facilities following strict GMP.',
                'overview' => 'Production Pharmacists oversee the transformation of active pharmaceutical ingredients and excipients into tablets, capsules, ointments, syrups, and sterile parenterals. They lead shift operators, enforce environmental control, supervise granulation, compression, coating, filling, and packaging while optimizing output and minimizing yield loss.',
                'required_skills' => ['Tablet Compression & Coating', 'Sterile Aseptic Processing', 'HVAC & Cleanroom HVAC Controls', 'Batch Record Execution', 'Lean 5S & OEE Optimization'],
                'relevant_qualifications' => ['B.Pharm (Grade-A Pharmacist license required for production head authorization)'],
                'possible_entry_points' => ['Trainee Production Officer', 'Shift Officer - Solid Dosage', 'Junior Executive - Sterile Injectables'],
                'recommended_preparation' => ['Understand tablet tooling, capping, lamination, and sticking solutions', 'Revise Lyophilization and Autoclave sterilization cycles', 'Practise viva questions on formulation troubleshooting'],
                'typical_day' => 'Managing line clearance, monitoring granulation moisture (LOD), supervising compression speed and hardness, and verifying yield reconciliation.',
                'salary_range' => 'BDT 35,000 - 55,000 (Entry) • BDT 75,000 - 140,000 (Mid/Senior)',
                'work_environment' => 'Plant Floor / Classified Cleanroom Suite',
                'experience_level' => 'Fresh Graduate / Entry Level',
                'is_featured' => true,
                'sort_order' => 3,
            ],
            [
                'category_id' => $catRegulatory->id,
                'title' => 'Regulatory Affairs',
                'slug' => 'regulatory-affairs',
                'icon' => 'file-text',
                'badge' => 'Global Corporate',
                'summary' => 'Prepare CTD/eCTD dossiers, handle international drug registrations, and liaise with DGDA, US FDA, EMA, and health authorities.',
                'overview' => 'Regulatory Affairs professionals are the strategic bridge between pharmaceutical companies and government health authorities. They ensure products comply with all regulations governing drug discovery, formulation, safety, labeling, and commercialization.',
                'required_skills' => ['CTD & ACTD Dossier Compilation', 'Module 3 Quality Summary Writing', 'DGDA Drug Rules & Regulations', 'Pharmacovigilance Compliance', 'Labeling & Artwork Approval'],
                'relevant_qualifications' => ['B.Pharm / M.Pharm', 'High English Technical Writing Proficiency'],
                'possible_entry_points' => ['Regulatory Affairs Associate', 'Junior Officer - Global Dossier Submissions', 'Product Registration Executive'],
                'recommended_preparation' => ['Study ICH guidelines (Q1A stability, Q3A impurities, M4 CTD structure)', 'Review DGDA guidelines on new molecule registration', 'Book a CV & Dossier review session'],
                'typical_day' => 'Reviewing analytical certificates of analysis, compiling Module 3 dossier sections for African/Asian export tenders, replying to health authority queries.',
                'salary_range' => 'BDT 40,000 - 65,000 (Entry) • BDT 90,000 - 180,000+ (Mid/Senior)',
                'work_environment' => 'Corporate Head Office / Hybrid',
                'experience_level' => 'Fresh Graduate / 1-2 Years',
                'is_featured' => true,
                'sort_order' => 4,
            ],
            [
                'category_id' => $catRegulatory->id,
                'title' => 'Pharmacovigilance (PV)',
                'slug' => 'pharmacovigilance',
                'icon' => 'activity',
                'badge' => 'Safety & Clinical',
                'summary' => 'Monitor adverse drug reactions (ADRs), evaluate safety signals, prepare Periodic Safety Update Reports (PSURs), and protect patient wellbeing.',
                'overview' => 'Pharmacovigilance (PV) is the science and activities relating to the detection, assessment, understanding, and prevention of adverse effects or any other medicine-related problem. PV officers maintain safety databases, triage spontaneous ADR reports, draft risk management plans (RMPs), and ensure ethical post-marketing drug safety.',
                'required_skills' => ['MedDRA Coding', 'ICSR Case Processing', 'Signal Detection', 'PSUR & PBRER Compilation', 'Good Pharmacovigilance Practices (GVP)'],
                'relevant_qualifications' => ['B.Pharm / Pharm.D / MBBS', 'Medical & Pharmacological Knowledge'],
                'possible_entry_points' => ['Drug Safety Associate', 'PV Officer', 'Clinical Safety Reviewer'],
                'recommended_preparation' => ['Understand WHO Uppsala Monitoring Centre causality assessment', 'Familiarize with MedDRA hierarchy (SOC, PT, LLT)', 'Practice pharmacovigilance viva questions'],
                'typical_day' => 'Triaging patient adverse reaction forms, entering narratives into safety software, determining seriousness and expectedness according to product inserts.',
                'salary_range' => 'BDT 38,000 - 60,000 (Entry) • BDT 80,000 - 150,000 (Mid/Senior)',
                'work_environment' => 'Corporate Office / CRO / Remote',
                'experience_level' => 'Fresh Graduate / Entry Level',
                'is_featured' => false,
                'sort_order' => 5,
            ],
            [
                'category_id' => $catRegulatory->id,
                'title' => 'Research and Development (R&D)',
                'slug' => 'research-and-development',
                'icon' => 'sparkles',
                'badge' => 'High Innovation',
                'summary' => 'Design new pharmaceutical formulations, reverse-engineer innovators, develop novel drug delivery systems, and validate analytical methods.',
                'overview' => 'Pharmaceutical R&D encompasses Formulation Development (F&D) and Analytical Method Development (AMD). Formulation scientists optimize tablet blends, dissolution kinetics, and stability, while analytical R&D scientists develop HPLC and LC-MS methods to quantify newly synthesized APIs and degradation products.',
                'required_skills' => ['Preformulation & Compatibility Testing', 'DoE (Design of Experiments)', 'Dissolution Profile Matching (f1, f2 calculation)', 'Novel Drug Delivery Systems (NDDS)', 'Polymorphism & Solid-State Characterization'],
                'relevant_qualifications' => ['M.Pharm / Ph.D in Pharmaceutics or Medicinal Chemistry'],
                'possible_entry_points' => ['R&D Executive - Formulation', 'Analytical Method Development Chemist', 'Pre-formulation Scientist'],
                'recommended_preparation' => ['Master BCS classification and in-vitro in-vivo correlation (IVIVC)', 'Revise surfactant micellization, sustained release polymer matrices', 'Review R&D case studies'],
                'typical_day' => 'Running pilot laboratory granulators, testing comparative dissolution curves against reference listed drugs (RLD), troubleshooting stability test failures.',
                'salary_range' => 'BDT 40,000 - 65,000 (Entry) • BDT 90,000 - 175,000 (Mid/Senior)',
                'work_environment' => 'R&D Laboratory & Pilot Plant',
                'experience_level' => 'Entry / Postgraduate',
                'is_featured' => true,
                'sort_order' => 6,
            ],
            [
                'category_id' => $catCommercial->id,
                'title' => 'Pharmaceutical Sales & Marketing',
                'slug' => 'pharmaceutical-sales-marketing',
                'icon' => 'trending-up',
                'badge' => 'Fastest Career Growth',
                'summary' => 'Drive product strategy, brand launches, market analytics, and medical communication for prescription and OTC pharmaceuticals.',
                'overview' => 'Product Management Teams (PMD) translate clinical science into brand strategy. Product Executives develop visual aids, promotional campaigns, conduct continuous medical education (CME) seminars, train field forces, and monitor market share and competitive therapeutic dynamics.',
                'required_skills' => ['Therapeutic Brand Positioning', 'Market Data Analysis & Forecasting', 'Doctor Communication & Presentation', 'Product Launch Execution', 'Digital Healthcare Marketing'],
                'relevant_qualifications' => ['B.Pharm / MBA (Pharma/Marketing is a plus)'],
                'possible_entry_points' => ['Product Executive (PMD)', 'Medical Services Officer', 'Market Research Associate'],
                'recommended_preparation' => ['Understand cardiovascular, diabetic, antibiotic therapeutic segments', 'Build persuasive presentation and communication skills', 'Participate in mock brand-pitch interviews'],
                'typical_day' => 'Designing campaign brochures with medical artists, analyzing IMS/IQVIA prescription audit data, coordinating symposiums with key opinion leader doctors.',
                'salary_range' => 'BDT 40,000 - 65,000 (Entry) • BDT 90,000 - 200,000+ (Mid/Senior)',
                'work_environment' => 'Corporate Head Office & Field KOL Visits',
                'experience_level' => 'Fresh Graduate / Business Oriented',
                'is_featured' => true,
                'sort_order' => 7,
            ],
            [
                'category_id' => $catCommercial->id,
                'title' => 'Medical Affairs',
                'slug' => 'medical-affairs',
                'icon' => 'stethoscope',
                'badge' => 'Scientific Leadership',
                'summary' => 'Serve as scientific authority, engage Key Opinion Leaders (KOLs), review medical literature, and support clinical queries.',
                'overview' => 'Medical Affairs acts as the unbiased scientific backbone of multinational and leading pharmaceutical firms. Medical Science Liaisons (MSLs) and Medical Advisors communicate complex clinical trial data to physicians, review promotional claims for scientific accuracy, and support medical education.',
                'required_skills' => ['Clinical Literature Appraisal', 'Evidence-Based Medicine', 'Medical Writing', 'Scientific Advisory Board Management', 'KOL Relationship Building'],
                'relevant_qualifications' => ['Pharm.D / MBBS / M.Pharm Clinical Pharmacy'],
                'possible_entry_points' => ['Medical Science Liaison (MSL)', 'Medical Information Officer', 'Medical Content Specialist'],
                'recommended_preparation' => ['Study clinical trials phases I-IV', 'Master statistical concepts (p-value, hazard ratio, ARR, NNT)', 'Practice case discussions with medical consultants'],
                'typical_day' => 'Engaging with top specialist physicians at tertiary hospitals, discussing late-stage oncological or cardiology trial findings, reviewing clinical monographs.',
                'salary_range' => 'BDT 45,000 - 75,000 (Entry) • BDT 100,000 - 220,000+ (Mid/Senior)',
                'work_environment' => 'Corporate Office & Medical Centers',
                'experience_level' => '1-3 Years / Pharm.D',
                'is_featured' => false,
                'sort_order' => 8,
            ],
            [
                'category_id' => $catCommercial->id,
                'title' => 'Clinical Research',
                'slug' => 'clinical-research',
                'icon' => 'flask-conical',
                'badge' => 'Global Protocol',
                'summary' => 'Manage clinical trials, bioequivalence studies, GCP compliance, patient safety monitoring, and trial documentation.',
                'overview' => 'Clinical Research Associates (CRAs) coordinate Phase I to IV clinical trials and Bioequivalence (BE) studies. They ensure trial sites adhere strictly to ICH-GCP (Good Clinical Practice) guidelines, ethical review board requirements, and protocol monitoring procedures.',
                'required_skills' => ['ICH-GCP Guidelines', 'Bioequivalence Protocol Design', 'eCRF (electronic Case Report Forms)', 'Clinical Site Monitoring', 'IRB/Ethics Committee Approvals'],
                'relevant_qualifications' => ['B.Pharm / M.Pharm / Pharm.D / Clinical Pharmacology'],
                'possible_entry_points' => ['Clinical Trial Assistant (CTA)', 'Junior Clinical Research Associate (CRA)', 'Clinical Data Coordinator'],
                'recommended_preparation' => ['Certify in GCP guidelines', 'Understand bioequivalence metrics (Cmax, AUC0-t, 90% confidence intervals)', 'Study ethics in human experimentation'],
                'typical_day' => 'Auditing clinical source documents at trial sites, verifying informed consent forms, counting investigational drug accountability logs.',
                'salary_range' => 'BDT 40,000 - 65,000 (Entry) • BDT 85,000 - 170,000 (Mid/Senior)',
                'work_environment' => 'Clinical Research Organizations (CRO) & Hospitals',
                'experience_level' => 'Entry / Postgraduate',
                'is_featured' => false,
                'sort_order' => 9,
            ],
            [
                'category_id' => $catCommercial->id,
                'title' => 'Hospital & Community Pharmacy',
                'slug' => 'hospital-and-community-pharmacy',
                'icon' => 'heart-pulse',
                'badge' => 'Patient Care',
                'summary' => 'Provide clinical drug therapy management, review prescriptions for interactions, optimize dosing, and counsel patients.',
                'overview' => 'Hospital and Clinical Pharmacists work alongside doctors and nurses in inpatient and outpatient hospital settings. They conduct therapeutic drug monitoring (TDM), manage total parenteral nutrition (TPN), prevent adverse drug interactions, and ensure antibiotic stewardship.',
                'required_skills' => ['Pharmacotherapy & Clinical Pharmacology', 'Drug-Drug Interaction Screening', 'Dose Adjustment in Renal/Hepatic Impairment', 'Patient Counseling', 'Cold Chain & Inventory Management'],
                'relevant_qualifications' => ['B.Pharm / Pharm.D with Pharmacy Council A-grade registration'],
                'possible_entry_points' => ['Clinical Pharmacist', 'Hospital Pharmacy Officer', 'Chemotherapy Compounding Pharmacist'],
                'recommended_preparation' => ['Revise clinical calculation formulas (Cockcroft-Gault, BSA)', 'Review high-alert medications and sound-alike look-alike (LASA) safety', 'Practice clinical viva scenarios'],
                'typical_day' => 'Reviewing ICU medication charts, advising on broad-spectrum antibiotic step-down therapy, educating discharged patients on anticoagulant regimens.',
                'salary_range' => 'BDT 30,000 - 50,000 (Entry) • BDT 65,000 - 120,000 (Senior)',
                'work_environment' => 'Tertiary Hospitals & Modern Healthcare Chains',
                'experience_level' => 'Fresh Graduate / Clinical Enthusiast',
                'is_featured' => false,
                'sort_order' => 10,
            ],
            [
                'category_id' => $catIndustrial->id,
                'title' => 'Supply Chain & Pharmaceutical Operations',
                'slug' => 'supply-chain-pharmaceutical-operations',
                'icon' => 'truck',
                'badge' => 'Logistics & Planning',
                'summary' => 'Orchestrate active pharmaceutical ingredient procurement, cold-chain logistics, GDP compliance, and production material planning.',
                'overview' => 'Pharmaceutical Supply Chain encompasses material requirements planning (MRP), international sourcing of DMF-grade APIs and excipients, temperature-monitored cold chain distribution (GDP), and warehouse inventory optimization under humidity-controlled GMP standards.',
                'required_skills' => ['Good Distribution Practice (GDP)', 'Material Requirement Planning (MRP)', 'API Global Procurement', 'Cold Chain Logistics (2-8°C)', 'Inventory Management & ERP (SAP/Oracle)'],
                'relevant_qualifications' => ['B.Pharm with supply chain / business aptitude'],
                'possible_entry_points' => ['Supply Chain Trainee', 'Procurement Officer - Active Ingredients', 'Logistics & Warehouse Executive'],
                'recommended_preparation' => ['Understand lead time calculations, reorder levels, and cold-chain temperature data loggers', 'Study international Incoterms and commercial letters of credit', 'Learn ERP fundamentals'],
                'typical_day' => 'Tracking sea/air freight shipments of active raw materials from FDA-approved sources, monitoring cold-room temperature charts, coordinating inventory with production.',
                'salary_range' => 'BDT 35,000 - 55,000 (Entry) • BDT 75,000 - 145,000 (Mid/Senior)',
                'work_environment' => 'Central Warehouse & Corporate Office',
                'experience_level' => 'Fresh Graduate / Analytical Mind',
                'is_featured' => false,
                'sort_order' => 11,
            ],
        ];

        foreach ($pathsData as $pData) {
            CareerPath::updateOrCreate(['slug' => $pData['slug']], $pData);
        }

        // 4. Services (7 Core Packages)
        $servicesData = [
            [
                'title' => 'Career Planning Consultation',
                'slug' => 'career-planning-consultation',
                'icon' => 'compass',
                'tag' => 'Foundation',
                'summary' => 'Help candidates understand their strengths, interests, qualifications, and map their optimal pharmaceutical career trajectory.',
                'description' => 'A personalized 1-on-1 strategic session with senior pharmaceutical leaders. We review your academic trajectory, thesis or internship experience, personal aptitudes, and market opportunities to identify whether Industrial QA/QC, Production, Regulatory Affairs, Medical Affairs, or Commercial PMD best suits your profile.',
                'target_audience' => 'Final year pharmacy students, fresh B.Pharm/Pharm.D/M.Pharm graduates, and early-career pharmacists seeking career clarity.',
                'expected_outcomes' => [
                    'Personalized 3-Year Pharmaceutical Career Plan',
                    'Department Fit Analysis (QA vs QC vs Production vs Regulatory)',
                    'Actionable gap analysis of your resume and technical competencies',
                    'Direct industry recruitment insights from top pharmaceutical leaders'
                ],
                'duration_minutes' => 45,
                'price' => 800.00,
                'currency' => 'BDT',
                'delivery_mode' => '1-on-1 Interactive Live Video Session',
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Written Exam Preparation',
                'slug' => 'written-exam-preparation',
                'icon' => 'book-open',
                'tag' => 'Pillar 2',
                'summary' => 'Structured study plans, practice questions, topic reviews, timed mock tests, and diagnostic performance feedback.',
                'description' => 'Master the technical written recruitment tests conducted by leading pharmaceutical companies (Square, Beximco, Incepta, Renata, Novartis, etc.) and government PSC/DGDA examinations. Covers core Pharmacology, Pharmaceutics, QC/Analysis, Biopharmaceutics, and cGMP regulations.',
                'target_audience' => 'Pharmacists applying for industrial officer/executive positions and government recruitment examinations.',
                'expected_outcomes' => [
                    'Mastery over 500+ high-probability pharmaceutical MCQ and descriptive question patterns',
                    'Topic-wise diagnostic scoring highlighting weak areas',
                    'Time management strategies for 60-minute industrial assessment tests',
                    'Comprehensive solution keys with pharmacopoeial rationale'
                ],
                'duration_minutes' => 60,
                'price' => 1000.00,
                'currency' => 'BDT',
                'delivery_mode' => 'Online Platform Access + Feedback Review',
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'Viva and Oral Examination Preparation',
                'slug' => 'viva-oral-examination-preparation',
                'icon' => 'message-circle',
                'tag' => 'Pillar 3',
                'summary' => 'Practise pharmaceutical concepts, technical questions, professional communication, and structured answers.',
                'description' => 'Overcome viva anxiety and build sharp oral articulation. In pharmaceutical board interviews, candidates face rapid-fire technical questions on dissolution, chromatography, tablet defects, cleanroom microbiology, and stability testing. We train you to deliver concise, authoritative answers.',
                'target_audience' => 'Candidates shortlisted for technical oral vivas at top pharmaceutical manufacturers and academic boards.',
                'expected_outcomes' => [
                    'Fluency in answering high-yield pharmaceutical technical prompts',
                    'Elimination of filler words and nervous pauses under pressure',
                    'Mastery of industry terminology, acronyms, and pharmacopoeial references',
                    'Instant expert critique on delivery, confidence, and accuracy'
                ],
                'duration_minutes' => 45,
                'price' => 1200.00,
                'currency' => 'BDT',
                'delivery_mode' => 'Live Mock Oral Viva with Expert Pharmacist',
                'is_featured' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'Job Interview Preparation',
                'slug' => 'job-interview-preparation',
                'icon' => 'user-check',
                'tag' => 'Pillar 4',
                'summary' => 'Mock interviews, commonly asked questions, structured feedback, confidence building, and role-specific preparation.',
                'description' => 'Simulate actual pharmaceutical recruitment panel interviews. We cover behavioral questions, situational plant crisis prompts (e.g. handling out-of-specification OOS results, cleanroom contamination, production yield drops), and salary negotiations using the STAR method.',
                'target_audience' => 'Candidates preparing for final-round executive and management interview panels.',
                'expected_outcomes' => [
                    'Confidence tackling both behavioral and plant-floor situational questions',
                    'Refined personal elevator pitch tailored for pharmaceutical recruiters',
                    'Ability to articulate past projects, thesis, and internship achievements effectively',
                    'Full session recording with actionable rubric evaluation'
                ],
                'duration_minutes' => 60,
                'price' => 1400.00,
                'currency' => 'BDT',
                'delivery_mode' => '1-on-1 Full Panel Simulation via Video',
                'is_featured' => true,
                'sort_order' => 4,
            ],
            [
                'title' => 'CV and LinkedIn Review',
                'slug' => 'cv-linkedin-review',
                'icon' => 'file-check',
                'tag' => 'High Impact',
                'summary' => 'Improve your CV structure, highlight relevant pharmaceutical skills, and strengthen your professional profile.',
                'description' => 'Transform your resume into a compelling, ATS-friendly document tailored specifically for pharmaceutical recruiters. Learn how to highlight laboratory instrument proficiencies (HPLC, Dissolution, FTIR), project work, and cGMP compliance knowledge.',
                'target_audience' => 'Graduates and professionals applying for pharmaceutical roles who need their applications noticed by HR screening systems.',
                'expected_outcomes' => [
                    'Completely optimized, ATS-compliant Pharmaceutical CV/Resume in PDF/Docx',
                    'Strong, keyword-rich LinkedIn headline and summary designed to attract recruiters',
                    'Action-verb bullet points demonstrating quantifiable lab and analytical achievements',
                    'Customizable cover letter template for pharmaceutical job applications'
                ],
                'duration_minutes' => 30,
                'price' => 800.00,
                'currency' => 'BDT',
                'delivery_mode' => 'Document Redline + 30-min Walkthrough Call',
                'is_featured' => false,
                'sort_order' => 5,
            ],
            [
                'title' => 'Pharmaceutical Industry Insights',
                'slug' => 'pharmaceutical-industry-insights',
                'icon' => 'pie-chart',
                'tag' => 'Pillar 5',
                'summary' => 'Guidance on pharmaceutical departments, recruitment expectations, professional development, and industry trends.',
                'description' => 'Deep dive into pharmaceutical organizational hierarchies, department interdependencies, global export requirements (FDA, MHRA, TGA, WHO), biosimilars, and career mobility from plant operations to corporate management.',
                'target_audience' => 'Pharmacists wanting a panoramic understanding of modern industrial pharma beyond textbook theory.',
                'expected_outcomes' => [
                    'Clear map of industrial career ladders from Officer to Director level',
                    'Understanding modern automation, ERP systems, and paperless labs (LIMS)',
                    'Knowledge of global export compliance standards and market drivers'
                ],
                'duration_minutes' => 45,
                'price' => 900.00,
                'currency' => 'BDT',
                'delivery_mode' => 'Interactive Masterclass Session',
                'is_featured' => false,
                'sort_order' => 6,
            ],
            [
                'title' => 'One to One Mentorship',
                'slug' => 'one-to-one-mentorship',
                'icon' => 'award',
                'tag' => 'All-Inclusive',
                'summary' => 'Individual sessions tailored to the candidate\'s career stage, goals, and comprehensive preparation needs.',
                'description' => 'Dedicated ongoing mentorship with a seasoned industry veteran who serves as your personal career strategist, accountability partner, and sounding board throughout your recruitment journey.',
                'target_audience' => 'Ambitious pharmacists committed to securing high-tier positions and accelerating their career trajectory.',
                'expected_outcomes' => [
                    'Comprehensive 60-day roadmap with bi-weekly milestone checkpoints',
                    'Direct WhatsApp/Email advisory access for ongoing career dilemmas and offers',
                    'Integrated prep across CV, written exams, viva, and mock interview coaching',
                    'Exclusive insider networking advice and recommendation protocols'
                ],
                'duration_minutes' => 90,
                'price' => 1500.00,
                'currency' => 'BDT',
                'delivery_mode' => 'Comprehensive 1-on-1 Multi-Session Track',
                'is_featured' => true,
                'sort_order' => 7,
            ],
        ];

        foreach ($servicesData as $sData) {
            Service::updateOrCreate(['slug' => $sData['slug']], $sData);
        }

        // 5. Consultants
        $consultantsData = [
            [
                'user_id' => $admin->id,
                'name' => 'MD Abul Bashar, RPh',
                'slug' => 'md-abul-bashar',
                'title' => 'Founder & Lead Pharmaceutical Career Consultant',
                'current_company' => 'Founder, Pharma Career Compass / Industrial Pharmacy Mentor',
                'specialization' => 'Quality Assurance, cGMP Regulatory Audits & Career Strategy',
                'qualifications' => 'B.Pharm (Hons), M.Pharm (Industrial Pharmacy), Registered Pharmacist (PCB)',
                'experience_years' => 15,
                'avatar' => null,
                'bio' => 'MD Abul Bashar is the Founder and Lead Consultant of Pharma Career Compass. A licensed pharmacist registered with the Pharmacy Council of Bangladesh, he brings over 15 years of industrial experience across plant operations, cGMP compliance, validation, and professional development in Bangladesh\'s top pharmaceutical companies. He founded Pharma Career Compass to bridge the gap between academic pharmacy education and industrial recruitment benchmarks, guiding hundreds of graduates into rewarding roles at Square, Incepta, Beximco, Renata, and multinational manufacturers.',
                'areas_of_expertise' => ['GMP & Plant Regulatory Compliance', 'Recruitment Written Exam Prep', 'Technical Viva & Interview Coaching', 'Career Ladder Strategy'],
                'hourly_rate' => 1500.00,
                'rating' => 5.00,
                'reviews_count' => 186,
                'consultation_types' => ['Career Planning Consultation', 'Job Interview Preparation', 'One to One Mentorship', 'Written Exam Preparation'],
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'user_id' => $consultantUser->id,
                'name' => 'Prof. Dr. Farhana Chowdhury',
                'slug' => 'prof-dr-farhana-chowdhury',
                'title' => 'Head of Regulatory Affairs & Global Dossier Expert',
                'current_company' => 'Senior Regulatory Affairs Consultant, Ex-Incepta & Square',
                'specialization' => 'Regulatory Affairs, CTD/eCTD & Pharmacovigilance',
                'qualifications' => 'B.Pharm, M.Pharm, Certified Regulatory Affairs Professional (RAC)',
                'experience_years' => 20,
                'avatar' => null,
                'bio' => 'With 20 years guiding regulatory filings in over 45 countries, Dr. Farhana specializes in grooming pharmacists for global regulatory strategy, clinical dossier preparation, and DGDA liaison roles.',
                'areas_of_expertise' => ['CTD & eCTD Dossiers', 'ICH Guidelines', 'CV & LinkedIn Strategy', 'Technical Viva Coaching'],
                'hourly_rate' => 1200.00,
                'rating' => 4.95,
                'reviews_count' => 112,
                'consultation_types' => ['Career Planning Consultation', 'CV and LinkedIn Review', 'Viva and Oral Examination Preparation'],
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'user_id' => null,
                'name' => 'Kazi Ahsanul Karim, M.Pharm',
                'slug' => 'kazi-ahsanul-karim',
                'title' => 'Senior QC & Analytical Instrumentation Specialist',
                'current_company' => 'Senior Analytical QC Specialist, Ex-Beximco & Renata',
                'specialization' => 'Quality Control, HPLC/GC Troubleshooting & Method Validation',
                'qualifications' => 'B.Pharm (Hons), M.Pharm in Pharmaceutical Chemistry (JU)',
                'experience_years' => 12,
                'avatar' => null,
                'bio' => 'Specializing in analytical QC, stability testing, and laboratory compliance. Kazi Ahsanul has trained dozens of fresh graduates in mastering HPLC operation, method validation, and written exam tests.',
                'areas_of_expertise' => ['HPLC & GC Analysis', 'Written Exam Prep', 'GLP & Data Integrity', 'QC Technical Vivas'],
                'hourly_rate' => 1000.00,
                'rating' => 4.92,
                'reviews_count' => 89,
                'consultation_types' => ['Written Exam Preparation', 'Viva and Oral Examination Preparation', 'Job Interview Preparation'],
                'is_featured' => true,
                'sort_order' => 3,
            ],
            [
                'user_id' => null,
                'name' => 'Tahmina Akhter, RPh',
                'slug' => 'tahmina-akhter',
                'title' => 'Senior Brand Manager (PMD) & Medical Marketing Consultant',
                'current_company' => 'Senior Product Management (PMD) Lead, Ex-Healthcare & ACI',
                'specialization' => 'Product Management (PMD), Medical Affairs & Commercial Strategy',
                'qualifications' => 'B.Pharm (DU), MBA in Marketing (IBA)',
                'experience_years' => 10,
                'avatar' => null,
                'bio' => 'Tahmina combines deep pharmaceutical science with commercial brand building. She coaches pharmacy graduates on breaking into Product Management (PMD), medical marketing, and communication leadership.',
                'areas_of_expertise' => ['Product Management (PMD)', 'Medical Science Liaison (MSL)', 'Presentation & Communication', 'Brand Strategy Vivas'],
                'hourly_rate' => 800.00,
                'rating' => 4.98,
                'reviews_count' => 76,
                'consultation_types' => ['Career Planning Consultation', 'Job Interview Preparation', 'Pharmaceutical Industry Insights'],
                'is_featured' => true,
                'sort_order' => 4,
            ],
        ];

        foreach ($consultantsData as $cData) {
            $consultant = Consultant::updateOrCreate(['slug' => $cData['slug']], $cData);

            // Add Availabilities for Sunday (0), Tuesday (2), Thursday (4), Saturday (6)
            foreach ([0, 2, 4, 6] as $day) {
                ConsultantAvailability::firstOrCreate(
                    [
                        'consultant_id' => $consultant->id,
                        'day_of_week' => $day,
                    ],
                    [
                        'start_time' => '17:00:00',
                        'end_time' => '21:00:00',
                        'slot_duration_minutes' => 30,
                        'is_active' => true,
                    ]
                );
            }
        }

        // 6. Career Assessment Questions
        $quizQuestions = [
            [
                'step_number' => 1,
                'question_text' => 'What is your current educational qualification in Pharmacy?',
                'description' => 'Select your highest degree or the qualification currently in progress.',
                'input_type' => 'radio',
                'options' => [
                    ['label' => 'Bachelor of Pharmacy (B.Pharm / B.Pharm Hons)', 'value' => 'b_pharm', 'tag' => 'undergraduate', 'weight' => 'general'],
                    ['label' => 'Doctor of Pharmacy (Pharm.D)', 'value' => 'pharm_d', 'tag' => 'clinical', 'weight' => 'clinical'],
                    ['label' => 'Master of Pharmacy (M.Pharm - Industrial / Tech / Chemistry)', 'value' => 'm_pharm_tech', 'tag' => 'postgraduate', 'weight' => 'technical'],
                    ['label' => 'Master of Pharmacy (M.Pharm - Pharmacology / Clinical)', 'value' => 'm_pharm_clinical', 'tag' => 'postgraduate', 'weight' => 'clinical'],
                    ['label' => 'Diploma in Pharmacy / Related Life Science Degree', 'value' => 'diploma_other', 'tag' => 'allied', 'weight' => 'allied'],
                ],
                'sort_order' => 1,
            ],
            [
                'step_number' => 2,
                'question_text' => 'What is your current professional stage & experience level?',
                'description' => 'This helps us calibrate our roadmap from foundational entry to strategic advancement.',
                'input_type' => 'radio',
                'options' => [
                    ['label' => 'Final Year Pharmacy Student (Graduating in 6-12 months)', 'value' => 'student', 'tag' => 'student', 'weight' => 'entry'],
                    ['label' => 'Fresh Graduate (Graduated within past 12 months)', 'value' => 'fresh_graduate', 'tag' => 'entry', 'weight' => 'entry'],
                    ['label' => 'Active Job Seeker with some internship/lab experience', 'value' => 'job_seeker', 'tag' => 'entry', 'weight' => 'entry'],
                    ['label' => 'Working Professional (1 - 3 years experience seeking growth/switch)', 'value' => 'mid_level', 'tag' => 'experienced', 'weight' => 'mid'],
                    ['label' => 'Experienced Pharmacist (3+ years seeking managerial/specialist role)', 'value' => 'senior', 'tag' => 'experienced', 'weight' => 'senior'],
                ],
                'sort_order' => 2,
            ],
            [
                'step_number' => 3,
                'question_text' => 'Which work environment inspires you the most?',
                'description' => 'Where do you envision yourself thriving on a day-to-day basis?',
                'input_type' => 'radio',
                'options' => [
                    ['label' => 'Modern Pharmaceutical Plant (Cleanrooms, Solid/Sterile Manufacturing, Shopfloor Leadership)', 'value' => 'plant', 'tag' => 'plant', 'weight' => 'production_qa'],
                    ['label' => 'High-Precision Analytical Laboratory (HPLC, GC, Spectroscopy, Chemical Experimentation)', 'value' => 'lab', 'tag' => 'lab', 'weight' => 'qc_rd'],
                    ['label' => 'Corporate Corporate Office (Regulatory Dossiers, Policy, Strategic Documentation, Hybrid)', 'value' => 'corporate_regulatory', 'tag' => 'corporate', 'weight' => 'regulatory_pv'],
                    ['label' => 'Dynamic Business & Commercial Setting (Brand Strategy, Doctor Interactions, Market Launches)', 'value' => 'commercial', 'tag' => 'commercial', 'weight' => 'pmd_sales'],
                    ['label' => 'Healthcare & Patient-Facing (Hospital Inpatient Rounds, Clinical Trials, Direct Patient Care)', 'value' => 'clinical', 'tag' => 'clinical', 'weight' => 'hospital_clinical'],
                ],
                'sort_order' => 3,
            ],
            [
                'step_number' => 4,
                'question_text' => 'Which scientific and technical domains interest you most?',
                'description' => 'Select up to 3 domains that you enjoy studying or practicing.',
                'input_type' => 'checkbox',
                'options' => [
                    ['label' => 'cGMP Auditing, Validation Protocols & Quality Systems', 'value' => 'qa_audit', 'tag' => 'qa', 'weight' => 'qa'],
                    ['label' => 'Instrumental Chemical Analysis (HPLC, Dissolution, Titrations)', 'value' => 'instrumental_qc', 'tag' => 'qc', 'weight' => 'qc'],
                    ['label' => 'Formulation Technology, Granulation & Aseptic Processing', 'value' => 'formulation_prod', 'tag' => 'production', 'weight' => 'production'],
                    ['label' => 'Global Regulatory Guidelines (ICH, CTD/eCTD, DGDA Approvals)', 'value' => 'reg_dossier', 'tag' => 'regulatory', 'weight' => 'regulatory'],
                    ['label' => 'Pharmacovigilance, Adverse Drug Event Monitoring & Drug Safety', 'value' => 'safety_pv', 'tag' => 'pv', 'weight' => 'pv'],
                    ['label' => 'Brand Marketing Strategy, Medical Science & Presentation', 'value' => 'marketing_pmd', 'tag' => 'commercial', 'weight' => 'commercial'],
                    ['label' => 'Clinical Pharmacokinetics, TDM & Hospital Dispensing', 'value' => 'clinical_tdm', 'tag' => 'clinical', 'weight' => 'clinical'],
                ],
                'sort_order' => 4,
            ],
            [
                'step_number' => 5,
                'question_text' => 'What is your primary career preparation goal right now?',
                'description' => 'Tell us what you want to achieve in the next 30 to 90 days.',
                'input_type' => 'radio',
                'options' => [
                    ['label' => 'Pass industrial written recruitment exams with high scores', 'value' => 'pass_exams', 'tag' => 'exams', 'weight' => 'written_prep'],
                    ['label' => 'Conquer technical viva anxiety and articulate concepts professionally', 'value' => 'master_viva', 'tag' => 'viva', 'weight' => 'viva_prep'],
                    ['label' => 'Ace panel job interviews and situational plant questions', 'value' => 'ace_interviews', 'tag' => 'interview', 'weight' => 'interview_prep'],
                    ['label' => 'Transform my CV and LinkedIn to get shortlisted by top pharma firms', 'value' => 'cv_upgrade', 'tag' => 'cv', 'weight' => 'cv_prep'],
                    ['label' => 'Complete end-to-end career clarity & structured 1-on-1 mentorship', 'value' => 'full_mentorship', 'tag' => 'launchpad', 'weight' => 'full_prep'],
                ],
                'sort_order' => 5,
            ],
        ];

        foreach ($quizQuestions as $q) {
            CareerAssessmentQuestion::updateOrCreate(['step_number' => $q['step_number']], $q);
        }

        // 7. Exam Categories & Questions
        $examCat1 = ExamCategory::updateOrCreate(
            ['slug' => 'cgmp-quality-assurance'],
            [
                'name' => 'cGMP, Quality Assurance & Validation',
                'description' => 'Covers WHO cGMP, cleanroom classifications, validation, ALCOA+, deviations, and CAPA principles.',
                'icon' => 'shield-check',
                'default_time_minutes' => 15,
                'sort_order' => 1,
            ]
        );

        $examCat2 = ExamCategory::updateOrCreate(
            ['slug' => 'pharmaceutics-industrial-formulation'],
            [
                'name' => 'Pharmaceutics & Industrial Formulation',
                'description' => 'Covers tablet compression defects, coatings, dissolution kinetics, stability testing, and sterile parenteral manufacturing.',
                'icon' => 'pill',
                'default_time_minutes' => 15,
                'sort_order' => 2,
            ]
        );

        $examCat3 = ExamCategory::updateOrCreate(
            ['slug' => 'pharmaceutical-analysis-qc'],
            [
                'name' => 'Pharmaceutical Analysis & QC Instrumental Methods',
                'description' => 'HPLC system suitability, peak tailing, ICH Q2 validation, spectrophotometry, and pharmacopoeial assays.',
                'icon' => 'microscope',
                'default_time_minutes' => 15,
                'sort_order' => 3,
            ]
        );

        $examCat4 = ExamCategory::updateOrCreate(
            ['slug' => 'pharmacology-therapeutics'],
            [
                'name' => 'Pharmacology & Clinical Therapeutics',
                'description' => 'Mechanism of action, pharmacokinetics, receptor classifications, adverse drug reactions, and drug interactions.',
                'icon' => 'activity',
                'default_time_minutes' => 15,
                'sort_order' => 4,
            ]
        );

        $examQuestionsData = [
            // Category 1: QA & cGMP
            [
                'category_id' => $examCat1->id,
                'question_text' => 'Under WHO cGMP guidelines, what does the data integrity acronym "ALCOA" stand for?',
                'option_a' => 'Attributable, Legible, Contemporaneous, Original, and Accurate',
                'option_b' => 'Authorized, Logical, Continuous, Operational, and Audited',
                'option_c' => 'Applicable, Linear, Consistent, Official, and Authentic',
                'option_d' => 'Attributable, Logged, Calibrated, Organized, and Archive-ready',
                'correct_option' => 'a',
                'explanation' => 'ALCOA is the fundamental data integrity framework: Attributable (who did it), Legible (readable), Contemporaneous (recorded at the time of execution), Original (primary source), and Accurate (free from errors). ALCOA+ adds Complete, Consistent, Enduring, and Available.',
                'difficulty' => 'intermediate',
                'tags' => 'cGMP, Data Integrity, QA',
            ],
            [
                'category_id' => $examCat1->id,
                'question_text' => 'According to EU GMP / ISO 14644-1, which air cleanliness classification is mandatory for high-risk aseptic operations such as filling sterile ampoules/vials?',
                'option_a' => 'Grade D (ISO Class 8)',
                'option_b' => 'Grade C (ISO Class 7)',
                'option_c' => 'Grade B (ISO Class 5 at rest)',
                'option_d' => 'Grade A (ISO Class 4.8 / laminar airflow zone)',
                'correct_option' => 'd',
                'explanation' => 'Grade A represents the local zone for high-risk operations (e.g. aseptic filling, stopper bowl). It typically requires laminar airflow with a velocity of 0.36 - 0.54 m/s and particle counts <= 3,520 particles/m3 of >= 0.5 µm (ISO 4.8 / Class 100).',
                'difficulty' => 'intermediate',
                'tags' => 'Cleanroom, Sterile, HVAC, GMP',
            ],
            [
                'category_id' => $examCat1->id,
                'question_text' => 'What is the primary difference between a "Deviation" and an "Out of Specification (OOS)" event?',
                'option_a' => 'Deviations only apply to QC testing, while OOS applies only to manufacturing shop floor.',
                'option_b' => 'A Deviation is any unplanned departure from an approved procedure (SOP/BMR), whereas OOS specifically refers to test results falling outside established acceptance criteria.',
                'option_c' => 'Deviations are always permanent changes, while OOS is always temporary.',
                'option_d' => 'Deviations do not require CAPA investigations, while OOS always requires them.',
                'correct_option' => 'b',
                'explanation' => 'A deviation occurs whenever an operational parameter, SOP, or batch instruction is violated. OOS specifically denotes laboratory analytical test results that do not conform to specifications stated in drug applications or pharmacopoeias.',
                'difficulty' => 'intermediate',
                'tags' => 'QA, Deviation, OOS, CAPA',
            ],
            [
                'category_id' => $examCat1->id,
                'question_text' => 'In process validation, what does "Prospective Validation" mean?',
                'option_a' => 'Validation conducted during routine commercial production after 20 batches.',
                'option_b' => 'Validation conducted prior to the distribution of either a new product or a product made under a modified production process.',
                'option_c' => 'Validation based strictly on historic batch review data.',
                'option_d' => 'Validation performed exclusively when an audit finding is issued.',
                'correct_option' => 'b',
                'explanation' => 'Prospective validation is carried out prior to commercial manufacturing and marketing of a drug product, usually involving three consecutive successful commercial-scale batches meeting all predetermined acceptance criteria.',
                'difficulty' => 'beginner',
                'tags' => 'Validation, QA, cGMP',
            ],
            [
                'category_id' => $examCat1->id,
                'question_text' => 'What is the acceptable differential pressure typically maintained between an aseptic cleanroom suite and an adjoining lower-grade corridor to prevent airborne contamination?',
                'option_a' => '0 to 2 Pascals',
                'option_b' => '10 to 15 Pascals (positive pressure)',
                'option_c' => 'Negative 50 Pascals',
                'option_d' => 'Pressure does not matter if HEPA filters are present',
                'correct_option' => 'b',
                'explanation' => 'A positive pressure differential of 10 to 15 Pa is standardly maintained between clean areas and surrounding areas of lower cleanliness to ensure outward airflow and prevent ingress of particulate or microbial contamination.',
                'difficulty' => 'advanced',
                'tags' => 'HVAC, Cleanroom, Pressure Differential',
            ],

            // Category 2: Pharmaceutics
            [
                'category_id' => $examCat2->id,
                'question_text' => 'During tablet manufacturing, "Capping" refers to which defect?',
                'option_a' => 'Unequal distribution of color on the tablet surface',
                'option_b' => 'Partial or complete separation of the top or bottom crowns of a tablet from the main body',
                'option_c' => 'Adhesion of tablet material to the die wall',
                'option_d' => 'Breaking of tablet edges during dedusting',
                'correct_option' => 'b',
                'explanation' => 'Capping is the partial or complete detachment of the top or bottom crown of a tablet from the body. It is primarily caused by air entrapment during high-speed compression, excessive fine powders, or improper punch tooling.',
                'difficulty' => 'beginner',
                'tags' => 'Tablet, Compression, Defect',
            ],
            [
                'category_id' => $examCat2->id,
                'question_text' => 'Under ICH Q1A(R2) guidelines, what are the standard testing conditions for "Long-Term (Real-Time)" stability testing of general pharmaceutical products in Climatic Zone IVb (hot and higher humidity)?',
                'option_a' => '25°C ± 2°C / 60% RH ± 5% RH',
                'option_b' => '30°C ± 2°C / 75% RH ± 5% RH',
                'option_c' => '40°C ± 2°C / 75% RH ± 5% RH',
                'option_d' => '50°C ± 2°C / 80% RH ± 5% RH',
                'correct_option' => 'b',
                'explanation' => 'Climatic Zone IVb (hot and higher humidity, applicable to South Asian & tropical regions) requires long-term stability testing at 30°C ± 2°C / 75% RH ± 5% RH. Accelerated testing is conducted at 40°C ± 2°C / 75% RH ± 5% RH.',
                'difficulty' => 'intermediate',
                'tags' => 'Stability, ICH Q1A, Pharmaceutics',
            ],
            [
                'category_id' => $examCat2->id,
                'question_text' => 'Which equation is used to compare the similarity of two in-vitro dissolution profiles (Reference vs Test formulation)?',
                'option_a' => 'Henderson-Hasselbalch equation',
                'option_b' => 'Noyes-Whitney equation',
                'option_c' => 'Moore and Flanner Similarity Factor (f2)',
                'option_d' => 'Michaelis-Menten equation',
                'correct_option' => 'c',
                'explanation' => 'The similarity factor f2 is a logarithmic reciprocal square root transformation of the sum of squared error and is a measurement of the similarity in the percent dissolution between the two curves. An f2 value between 50 and 100 ensures sameness or equivalence of the two curves.',
                'difficulty' => 'advanced',
                'tags' => 'Dissolution, Bioequivalence, Formulation',
            ],
            [
                'category_id' => $examCat2->id,
                'question_text' => 'What is the function of Croscarmellose Sodium (Ac-Di-Sol) when incorporated into a tablet formulation?',
                'option_a' => 'Glidant',
                'option_b' => 'Superdisintegrant',
                'option_c' => 'Lubricant',
                'option_d' => 'Enteric coating polymer',
                'correct_option' => 'b',
                'explanation' => 'Croscarmellose sodium is an internally cross-linked carboxymethylcellulose sodium that acts as a superdisintegrant, swelling rapidly without forming a gel upon contact with aqueous media, facilitating rapid tablet breakup.',
                'difficulty' => 'beginner',
                'tags' => 'Excipients, Disintegrant, Formulation',
            ],
            [
                'category_id' => $examCat2->id,
                'question_text' => 'In sterile water for injection (WFI) generation, what is the maximum permissible endotoxin limit under USP/BP standards?',
                'option_a' => '0.25 EU/mL',
                'option_b' => '5.0 EU/mL',
                'option_c' => '10 EU/mL',
                'option_d' => '0.001 EU/mL',
                'correct_option' => 'a',
                'explanation' => 'The USP and BP endotoxin limit for Water for Injection (WFI) is not more than 0.25 Endotoxin Units (EU) per mL, tested using the Limulus Amebocyte Lysate (LAL) assay.',
                'difficulty' => 'advanced',
                'tags' => 'Sterile, WFI, LAL, Endotoxin',
            ],

            // Category 3: Analysis & QC
            [
                'category_id' => $examCat3->id,
                'question_text' => 'In reverse-phase high-performance liquid chromatography (RP-HPLC), what are the standard characteristics of the stationary phase and mobile phase?',
                'option_a' => 'Stationary phase is polar (e.g. Silica); mobile phase is non-polar (e.g. Hexane)',
                'option_b' => 'Stationary phase is non-polar (e.g. C18 / Octadecylsilane); mobile phase is polar (e.g. Water/Methanol/Acetonitrile)',
                'option_c' => 'Both stationary and mobile phases must be gaseous',
                'option_d' => 'Stationary phase is an ion-exchange resin; mobile phase is pure ether',
                'correct_option' => 'b',
                'explanation' => 'In RP-HPLC, the stationary phase is non-polar (hydrophobic, commonly bonded silica such as C18 or C8), while the mobile phase is polar (aqueous buffers mixed with organic modifiers like acetonitrile or methanol). Non-polar solutes elute later.',
                'difficulty' => 'intermediate',
                'tags' => 'HPLC, Chromatography, QC',
            ],
            [
                'category_id' => $examCat3->id,
                'question_text' => 'According to the United States Pharmacopeia (USP), what is the acceptable range for the HPLC "Tailing Factor (T)" for an analyte peak?',
                'option_a' => 'Between 0.1 and 0.5',
                'option_b' => 'Between 0.95 and 1.5 (or <= 2.0 depending on monograph)',
                'option_c' => 'Exactly 0.00',
                'option_d' => 'Greater than 3.5',
                'correct_option' => 'b',
                'explanation' => 'A symmetric Gaussian peak has a tailing factor T = 1.0. USP general chapter <621> states system suitability generally requires a peak tailing factor between 0.95 and 2.0 (ideally <= 1.5). Values > 2 indicate excessive tailing due to column degradation or secondary silanol interactions.',
                'difficulty' => 'intermediate',
                'tags' => 'HPLC, System Suitability, Tailing',
            ],
            [
                'category_id' => $examCat3->id,
                'question_text' => 'Under ICH Q2(R1) validation guidelines, which parameter measures the closeness of agreement between a series of measurements obtained from multiple sampling of the same homogeneous sample?',
                'option_a' => 'Specificity',
                'option_b' => 'Precision (Repeatability / Intermediate Precision)',
                'option_c' => 'Accuracy (Trueness)',
                'option_d' => 'Robustness',
                'correct_option' => 'b',
                'explanation' => 'Precision of an analytical procedure expresses the closeness of agreement (degree of scatter) between a series of measurements obtained from multiple sampling of the same homogeneous sample under prescribed conditions.',
                'difficulty' => 'intermediate',
                'tags' => 'ICH Q2, Method Validation, Precision',
            ],
            [
                'category_id' => $examCat3->id,
                'question_text' => 'Beer-Lambert’s Law (A = ε·c·l) shows a linear relationship between absorbance and concentration. At what absorbance level does severe deviation from linearity typically begin due to stray light and detector saturation?',
                'option_a' => 'A > 0.01',
                'option_b' => 'A > 0.2',
                'option_c' => 'A > 1.5 to 2.0',
                'option_d' => 'Beer\'s law has no upper limit',
                'correct_option' => 'c',
                'explanation' => 'Most commercial UV-Vis spectrophotometers lose linearity above absorbance ~1.5 - 2.0 because transmission drops to below 1% (T < 0.01), where stray light and detector non-linearity introduce significant photometric error.',
                'difficulty' => 'advanced',
                'tags' => 'Spectrophotometry, Beer Lambert, UV',
            ],

            // Category 4: Pharmacology
            [
                'category_id' => $examCat4->id,
                'question_text' => 'Which mechanism of action distinguishes ACE Inhibitors (e.g. Enalapril) from Angiotensin II Receptor Blockers (ARBs, e.g. Losartan)?',
                'option_a' => 'ACE inhibitors block the AT1 receptor, while ARBs inhibit the ACE enzyme.',
                'option_b' => 'ACE inhibitors inhibit the conversion of Angiotensin I to Angiotensin II and prevent bradykinin degradation, while ARBs selectively block the AT1 receptor without affecting bradykinin.',
                'option_c' => 'ARBs cause a dry cough in 15% of patients due to substance P accumulation.',
                'option_d' => 'Neither drug affects the renin-angiotensin-aldosterone system.',
                'correct_option' => 'b',
                'explanation' => 'ACE inhibitors block Angiotensin Converting Enzyme, which also degrades bradykinin. Elevated bradykinin causes the characteristic dry cough and angioedema. ARBs selectively block AT1 receptors without elevating bradykinin, avoiding the dry cough.',
                'difficulty' => 'beginner',
                'tags' => 'Pharmacology, Cardiovascular, ACEI, ARB',
            ],
            [
                'category_id' => $examCat4->id,
                'question_text' => 'What is the "First-Pass Metabolism" (presystemic elimination) of a drug?',
                'option_a' => 'The rapid excretion of drugs through glomerular filtration in the kidney',
                'option_b' => 'The degradation of a drug in the bloodstream by plasma esterases',
                'option_c' => 'The metabolism of an orally administered drug in the gut wall and liver before it reaches the systemic circulation',
                'option_d' => 'The conversion of an active metabolite back into its parent prodrug',
                'correct_option' => 'c',
                'explanation' => 'First-pass metabolism is the fraction of drug lost during the process of absorption which is generally related to the liver and gut wall. It greatly reduces the systemic bioavailability of oral formulations (e.g. Nitroglycerin, Propranolol).',
                'difficulty' => 'beginner',
                'tags' => 'Pharmacokinetics, Bioavailability, First Pass',
            ],
            [
                'category_id' => $examCat4->id,
                'question_text' => 'Which enzyme superfamily is responsible for the phase I metabolic biotransformation of approximately 70-80% of all clinically used pharmaceutical drugs?',
                'option_a' => 'UDP-glucuronosyltransferases (UGT)',
                'option_b' => 'Cytochrome P450 (CYP450) monooxygenases',
                'option_c' => 'Monoamine oxidase (MAO)',
                'option_d' => 'Acetylcholinesterase (AChE)',
                'correct_option' => 'b',
                'explanation' => 'The Cytochrome P450 (CYP) heme-thiolate protein superfamily (particularly CYP3A4, CYP2D6, CYP2C9, and CYP1A2) catalyzes Phase I oxidative biotransformation of the vast majority of therapeutic agents.',
                'difficulty' => 'intermediate',
                'tags' => 'CYP450, Metabolism, Pharmacology',
            ],
        ];

        foreach ($examQuestionsData as $qData) {
            ExamQuestion::firstOrCreate(
                ['question_text' => $qData['question_text']],
                $qData
            );
        }

        // 8. Viva Questions Bank
        $vivaQuestionsData = [
            [
                'domain' => 'Quality Assurance & cGMP',
                'topic' => 'CAPA Investigation & Root Cause Analysis',
                'question_text' => 'How would you conduct a Corrective and Preventive Action (CAPA) investigation when a finished batch fails its dissolution test?',
                'model_answer' => "1. Containment & Quarantine: Immediately quarantine the affected batch and place ongoing packaging on hold.\n2. Lab Investigation (Phase I OOS): Verify analytical integrity—inspect chromatography integration, standard preparation, column log, instrument calibration, and test analyst technique. Confirm whether it is an analytical or manufacturing error.\n3. Manufacturing Investigation (Phase II): If lab error is ruled out, assemble an interdisciplinary team (QA, Production, Engineering, QC). Examine Batch Manufacturing Records (BMR), mixing time, granulation moisture content (LOD), compression force, and excipient lot variations.\n4. Root Cause Determination: Utilize systematic tools like the 5-Why analysis or Fishbone (Ishikawa) diagram to identify the true root cause rather than symptoms.\n5. Corrective Action: Address the immediate batch (reject/reprocess if validated) and calibrate/service tooling.\n6. Preventive Action: Revise SOPs, retrain operators, update equipment preventive maintenance schedules, and monitor subsequent 3 batches for effectiveness verification.",
                'interviewer_tip' => 'Always emphasize Phase I lab investigation first before jumping to plant blame. Interviewers look for strict adherence to FDA/MHRA OOS flowcharts.',
                'key_points' => ['Immediate containment', 'Phase I lab error verification', 'Cross-functional Phase II investigation', '5-Why root cause analysis', 'Effectiveness check'],
                'difficulty' => 'Standard',
                'sort_order' => 1,
            ],
            [
                'domain' => 'Industrial Pharmaceutics',
                'topic' => 'Tablet Tooling Defects (Capping, Sticking, Picking)',
                'question_text' => 'What are the main causes of "Tablet Sticking" during compression, and how would you resolve it on the production floor?',
                'model_answer' => "Causes of Tablet Sticking (adhesion of granules to punch faces):\n1. Excessive Moisture: Inadequately dried granules (high loss on drying, LOD).\n2. Insufficient Lubrication: Inadequate magnesium stearate concentration or poor blending time.\n3. Punch Tooling Issues: Scratched, worn, or unpolished punch faces; embossed logos with sharp angles.\n4. Environmental Humidity: Relative humidity in the compression cubicle exceeding 45-50% RH for hygroscopic materials.\n\nRemedies:\n- Check LOD of granules and return to fluid bed dryer if moisture is out of limits.\n- Increase lubricant blending efficiency or adjust magnesium stearate (typically 0.5 - 1.0%).\n- Polish punch faces with diamond compound or apply anti-stick coatings (e.g. Chromium Nitride / Teflon).\n- Ensure compression cubicle air conditioning maintains <= 40-45% RH.",
                'interviewer_tip' => 'Mention both formulation factors (moisture, lubricant) and mechanical/environmental factors (punch polishing, RH).',
                'key_points' => ['Moisture (LOD)', 'Lubrication deficiency', 'Punch face wear/polishing', 'Cubicle RH control'],
                'difficulty' => 'Standard',
                'sort_order' => 2,
            ],
            [
                'domain' => 'Instrumental Analysis & QC',
                'topic' => 'HPLC Troubleshooting: Peak Tailing & Retention Drift',
                'question_text' => 'What causes peak tailing in reverse-phase HPLC, and how do you troubleshoot it?',
                'model_answer' => "Primary causes of peak tailing (Asymmetry factor > 1.5):\n1. Secondary Silanol Interactions: Basic analytes interacting with residual unreacted acidic silanol (Si-OH) groups on older silica packings.\n2. Column Void or Channeling: Settling of stationary phase packing at the column inlet due to pressure shocks or high pH.\n3. Column Contamination: Strongly retained matrix components or particulate build-up on the inlet frit.\n4. Sample Overload: Injecting sample mass or volume exceeding column capacity.\n\nTroubleshooting steps:\n- Use base-deactivated silica (BDS) or end-capped high purity C18 columns.\n- Add a mobile phase modifier (such as 0.1% triethylamine or adjust buffer pH below the analyte's pKa to suppress ionization).\n- Flush column with strong organic solvents (100% Acetonitrile, Methanol, or IPA) or reverse-flush according to manufacturer specs.\n- Replace guard column or check inlet frit.\n- Dilute the sample or decrease injection volume.",
                'interviewer_tip' => 'Differentiate between physical column void (which causes tailing on all peaks) versus chemical secondary interaction (which affects only basic analytes).',
                'key_points' => ['Residual silanols', 'End-capped C18', 'Guard column replacement', 'pH optimization relative to pKa'],
                'difficulty' => 'Advanced',
                'sort_order' => 3,
            ],
            [
                'domain' => 'Regulatory Affairs',
                'topic' => 'CTD Structure & Module 3',
                'question_text' => 'Explain the structure of the Common Technical Document (CTD) and why Module 3 is critical for industrial pharmacists.',
                'model_answer' => "The Common Technical Document (CTD) is an internationally agreed format organized into 5 Modules:\n- Module 1: Administrative Information and Prescribing Info (region specific: DGDA, FDA, EMA).\n- Module 2: CTD Summaries (Quality Overall Summary, Clinical & Non-clinical overviews).\n- Module 3: Quality (Chemistry, Manufacturing, and Controls - CMC).\n- Module 4: Non-clinical Study Reports (Toxicology, Pharmacology).\n- Module 5: Clinical Study Reports (Human efficacy, safety, bioequivalence).\n\nWhy Module 3 is critical for pharmacists:\nModule 3 details everything regarding drug substance (3.2.S) and drug product (3.2.P): formula, batch manufacturing formulas, manufacturing process validation, container closure systems, analytical procedure validation, and 6-month accelerated plus real-time stability data. Industrial pharmacists directly generate and verify Module 3 data.",
                'interviewer_tip' => 'State the exact module names clearly and emphasize 3.2.S (Drug Substance) and 3.2.P (Drug Product).',
                'key_points' => ['5 Modules structure', 'Module 3 is CMC Quality', '3.2.S and 3.2.P breakdown', 'Direct industrial relevance'],
                'difficulty' => 'Standard',
                'sort_order' => 4,
            ],
            [
                'domain' => 'Aseptic Manufacturing & Microbiology',
                'topic' => 'Media Fill Trials & Sterility Assurance',
                'question_text' => 'What is a "Media Fill" trial in sterile manufacturing, and what is the allowable contamination limit for 5,000 to 10,000 units filled?',
                'model_answer' => "A Media Fill (Aseptic Process Simulation - APS) is a trial in which a nutrient growth medium (typically Soybean Casein Digest Medium / TSB) is substituted for the actual drug product and processed through the sterile filling line simulating routine manufacturing conditions (including shift changes, operator interventions, and worst-case line stoppages).\n\nAcceptance Criteria (FDA / PIC/S / WHO):\n- Filling < 5,000 units: Zero contaminated units should be detected.\n- Filling 5,000 to 10,000 units: 1 contaminated unit should prompt an investigation and consideration of repeating media fill; 2 contaminated units considered revalidation failure.\n- Filling > 10,000 units: 1 contaminated unit triggers formal investigation; 2 contaminated units revalidation.\nAll media fill units are incubated at 20-25°C and 30-35°C for not less than 14 days and inspected for turbidity.",
                'interviewer_tip' => 'Mention the growth medium (TSB/SCDM), 14-day dual temperature incubation, and zero-contamination goal.',
                'key_points' => ['Aseptic process simulation', 'TSB nutrient broth', '14-day incubation', 'Zero growth target'],
                'difficulty' => 'Advanced',
                'sort_order' => 5,
            ],
        ];

        foreach ($vivaQuestionsData as $vData) {
            VivaQuestion::firstOrCreate(
                ['question_text' => $vData['question_text']],
                $vData
            );
        }

        // 9. Interview Questions Bank
        $interviewQuestionsData = [
            [
                'target_role' => 'Quality Assurance Officer',
                'category' => 'Situational & Compliance',
                'question_text' => 'During an in-process check, you notice a senior machine operator bypassing a secondary line clearance check to meet shift hourly quotas. How do you respond?',
                'context_explanation' => 'Recruiters evaluate your ethical backbone, understanding of cGMP non-negotiables, and interpersonal tact when dealing with senior floor staff.',
                'star_situation' => 'In a high-speed packaging hall, operators face intense hourly throughput targets.',
                'star_task' => 'Ensure complete compliance with line clearance protocols without escalating into an unproductive confrontation.',
                'star_action' => 'Immediately halt line startup professionally. Explain calmly that line clearance is a regulatory safeguard designed to prevent mix-ups and protect patient lives as well as the company\'s license. Conduct the thorough physical inspection together, document the step in the BPR, and notify the shift QA in-charge.',
                'star_result' => 'The line starts verified, zero mix-up risk is incurred, and quality culture is reinforced on the floor.',
                'model_answer' => "I would respectfully but firmly halt the packaging operation before any commercial product enters the conveyor. I would explain to the operator that line clearance is not mere administrative paperwork, but a critical cGMP safeguard to prevent deadly product or label cross-contamination. I would conduct the formal physical inspection alongside him to verify the absence of previous batch components. Once complete and signed in the BMR, I would brief the production shift supervisor so line scheduling accounts for mandatory compliance time.",
                'recruiter_red_flags' => 'Saying you would ignore it because the operator is senior, or saying you would immediately file a punitive report without resolving the line risk.',
                'sort_order' => 1,
            ],
            [
                'target_role' => 'Quality Control Analyst',
                'category' => 'Technical & Analytical',
                'question_text' => 'Walk us through what you do the moment an HPLC assay injection returns at 89.2% when the release specification is 95.0% - 105.0%.',
                'context_explanation' => 'Assesses strict adherence to laboratory OOS SOPs and laboratory data integrity.',
                'star_situation' => 'A finished commercial tablet batch assay yields 89.2%, falling below the 95.0% lower specification limit.',
                'star_task' => 'Initiate Phase I Laboratory OOS investigation before touching the sample or assuming manufacturing failure.',
                'star_action' => 'Do not discard any test solutions, standards, or autosampler vials. Immediately preserve instrument conditions. Inform the QC section manager and log a formal Phase I OOS ticket. Check system suitability (RSD of standards, retention time drift, baseline noise), audit dilution volumetric glassware, verify micropipette calibration, and examine balance weighing records.',
                'star_result' => 'A clear determination is reached within 24 hours whether an identifiable lab error occurred or if Phase II manufacturing investigation must be triggered.',
                'model_answer' => "The moment I see the 89.2% result, I immediately stop further processing and preserve all solutions, chromatograms, standard vials, and volumetric flasks. Under no circumstances do I re-inject informally or test until compliance. I immediately alert the QC manager and initiate a formal Phase I OOS record. I re-check system suitability, standard purity factors, weigh sheets, volumetric dilution math, and column pressure. If a clear assignable lab error is proven with supervisor concurrence, it is documented with corrective training. If no lab error is found, Phase I is closed and Phase II plant investigation is launched.",
                'recruiter_red_flags' => 'Saying you would re-inject repeatedly until it passes or discard the sample and re-prepare without logging OOS.',
                'sort_order' => 2,
            ],
            [
                'target_role' => 'Production Pharmacist',
                'category' => 'Behavioral & Leadership',
                'question_text' => 'Tell us about a time you had to balance strict GMP compliance with urgent production deadlines.',
                'context_explanation' => 'Recruiters want candidates who understand that pharmaceutical manufacturing prioritizes product quality and patient safety above volume.',
                'star_situation' => 'During an urgent export batch compression shift, a vacuum dust collector filter clogged, causing mild powder dispersion.',
                'star_task' => 'Ensure batch integrity and operator safety while meeting the shipment departure schedule.',
                'star_action' => 'Suspended machine operation immediately. Called engineering for rapid HEPA filter replacement, conducted surface cleaning verification, and verified that tablet hardness and friability remained within limits before resuming.',
                'star_result' => 'Batch was released with zero contamination, passing full QC testing, and dispatched safely.',
                'model_answer' => "In pharmaceutical manufacturing, compliance and safety can never be compromised for volume, because a defective batch recall costs millions and jeopardizes lives. When faced with tight deadlines, I focus on proactive operational readiness—conducting pre-shift line clearance, staging raw materials in advance, and ensuring equipment maintenance is up-to-date rather than cutting corners during execution.",
                'recruiter_red_flags' => 'Suggesting that rules can be relaxed slightly if the batch is needed urgently by marketing.',
                'sort_order' => 3,
            ],
            [
                'target_role' => 'Regulatory Affairs Executive',
                'category' => 'HR & Career Strategy',
                'question_text' => 'Why did you choose Regulatory Affairs over Plant Operations or Hospital Pharmacy?',
                'context_explanation' => 'Tests genuine passion, career research, and long-term commitment to regulatory documentation.',
                'star_situation' => 'Choosing an initial pharmaceutical career path as a pharmacy graduate.',
                'star_task' => 'Align personal analytical strengths and technical writing with global regulatory challenges.',
                'star_action' => 'Highlighted interest in global drug laws, ICH guidelines, international health authority approvals, and commercial dossier strategy.',
                'star_result' => 'Demonstrated readiness for long-term specialized career growth in regulatory submissions.',
                'model_answer' => "While I deeply respect plant operations and hospital care, my core strength lies in analytical synthesis, technical writing, and scientific regulatory strategy. Regulatory Affairs is the strategic gateway that enables life-saving medicines to cross international borders. I am fascinated by ICH standards, CTD documentation, and the intellectual rigor of addressing health authority inquiries to get pharmaceutical products approved in export markets.",
                'recruiter_red_flags' => 'Saying they just want a desk job with AC rather than a genuine interest in drug regulations.',
                'sort_order' => 4,
            ],
        ];

        foreach ($interviewQuestionsData as $iData) {
            InterviewQuestion::firstOrCreate(
                ['question_text' => $iData['question_text']],
                $iData
            );
        }

        // 10. Blog Categories & Posts
        $blogCat1 = BlogCategory::updateOrCreate(['slug' => 'career-strategy'], ['name' => 'Career Strategy', 'description' => 'Guidance on choosing departments, navigating interviews, and career progression.']);
        $blogCat2 = BlogCategory::updateOrCreate(['slug' => 'industrial-pharmacy'], ['name' => 'Industrial Pharmacy', 'description' => 'In-depth insights into QA, QC, Production, and Plant Operations.']);
        $blogCat3 = BlogCategory::updateOrCreate(['slug' => 'exam-viva-prep'], ['name' => 'Exam & Viva Prep', 'description' => 'Preparation tips, question banks, and oral examination advice.']);

        $blogPostsData = [
            [
                'category_id' => $blogCat1->id,
                'author_id' => $admin->id,
                'title' => 'QA vs. QC: Which Pharmaceutical Career Path Is Right for You?',
                'slug' => 'qa-vs-qc-which-pharmaceutical-career-path-is-right-for-you',
                'summary' => 'Demystifying the core differences between Quality Assurance (QA) and Quality Control (QC) in modern pharmaceutical manufacturing.',
                'content' => "<p>For pharmacy graduates entering the pharmaceutical sector, deciding between <strong>Quality Assurance (QA)</strong> and <strong>Quality Control (QC)</strong> is often the first major crossroads.</p><h3>The Fundamental Difference</h3><p>A simple industry adage captures the distinction: <em>\"QC is product-oriented; QA is process-oriented.\"</em></p><h4>What Does Quality Control (QC) Involve?</h4><p>QC is the analytical frontline. Working in QC means operating in sophisticated laboratory environments with instruments like HPLC, Gas Chromatography (GC), UV-Vis Spectrophotometers, and Dissolution apparatus. You test raw materials, packaging components, and finished batches against strict pharmacopoeial specifications.</p><h4>What Does Quality Assurance (QA) Involve?</h4><p>QA is responsible for designing, auditing, and maintaining the quality systems that guarantee every pill manufactured conforms to cGMP. QA officers oversee validation protocols, write and audit Standard Operating Procedures (SOPs), investigate deviations, and lead audit inspections.</p><h3>Which One Fits Your Personality?</h3><ul><li><strong>Choose QC if:</strong> You love hands-on bench chemistry, instrument troubleshooting, precise numerical measurements, and laboratory analytical rigor.</li><li><strong>Choose QA if:</strong> You have strong organizational acumen, high attention to documentation, auditing instincts, and want a bird’s-eye view of plant-wide manufacturing compliance.</li></ul>",
                'author_name' => 'Dr. Tanvir Rahman, RPh',
                'author_title' => 'Chief Career Advisor',
                'read_time_minutes' => 6,
                'tags' => ['QA', 'QC', 'Career Advice', 'Industrial Pharmacy'],
                'is_published' => true,
                'published_at' => now()->subDays(5),
                'meta_title' => 'QA vs QC in Pharma: Which Career Path Should You Choose?',
                'meta_description' => 'Explore the real differences between Quality Assurance and Quality Control careers for pharmacy graduates with salary, skills, and growth prospects.',
            ],
            [
                'category_id' => $blogCat3->id,
                'author_id' => $admin->id,
                'title' => 'Top 20 Pharmaceutical Written Exam Questions and How to Solve Them',
                'slug' => 'top-20-pharmaceutical-written-exam-questions-how-to-solve',
                'summary' => 'A comprehensive breakdown of the most frequently asked technical questions in pharmaceutical recruitment assessments.',
                'content' => "<p>Securing an officer or executive position at top pharmaceutical manufacturers requires passing a rigorous written recruitment assessment. Here are the core technical domains you must master:</p><h3>1. HPLC System Suitability & Calculations</h3><p>Expect questions asking for the theoretical plates formula (N = 16 * (tR / W)^2), resolution (Rs), and peak tailing factor. Make sure you can calculate assay percentages from peak areas without hesitation.</p><h3>2. Tablet Defects and Mechanical Causes</h3><p>Capping, lamination, sticking, picking, and mottling are perennial exam staples. Know both the formulation causes (moisture, binder concentration, lubricant ratio) and mechanical machine causes (punch speed, cup depth, die wear).</p><h3>3. Cleanroom Classifications</h3><p>Be crystal clear on WHO/EU GMP Grade A, B, C, D parameters. Know the maximum allowable airborne particles at rest vs. in operation for 0.5 µm and 5.0 µm particle sizes.</p>",
                'author_name' => 'Pharma Career Compass Editorial Team',
                'author_title' => 'Technical Examination Board',
                'read_time_minutes' => 8,
                'tags' => ['Written Exam', 'MCQs', 'Recruitment', 'Study Guide'],
                'is_published' => true,
                'published_at' => now()->subDays(10),
                'meta_title' => 'Top Pharmaceutical Written Recruitment Exam Questions & Answers',
                'meta_description' => 'Master pharmaceutical recruitment tests with authentic technical question patterns, calculation formulas, and study tips.',
            ],
            [
                'category_id' => $blogCat2->id,
                'author_id' => $consultantUser->id,
                'title' => 'The Complete Roadmap to a High-Impact Career in Regulatory Affairs',
                'slug' => 'complete-roadmap-high-impact-career-regulatory-affairs',
                'summary' => 'How pharmacy graduates can build the documentation, ICH knowledge, and dossier compilation skills required for international regulatory affairs.',
                'content' => "<p>Regulatory Affairs (RA) is one of the highest-paying and internationally mobile sectors in the pharmaceutical industry. RA professionals act as the vital bridge between pharmaceutical manufacturers and regulatory health authorities worldwide.</p><h3>Key Milestones to Break Into RA:</h3><ol><li><strong>Master the CTD Structure:</strong> Understand the five modules of the Common Technical Document (ICH M4). Pay specific attention to Module 3 (Quality/CMC).</li><li><strong>Study Pharmacopoeial Guidelines:</strong> Familiarize yourself with how BP, USP, and EP monographs structure active substance standards.</li><li><strong>Develop Impeccable English Technical Writing:</strong> Clear, unambiguous scientific writing is the primary weapon of an RA officer when responding to health authority deficiency letters.</li></ol>",
                'author_name' => 'Prof. Dr. Farhana Chowdhury',
                'author_title' => 'Head of Regulatory Affairs',
                'read_time_minutes' => 7,
                'tags' => ['Regulatory Affairs', 'CTD', 'ICH', 'Global Career'],
                'is_published' => true,
                'published_at' => now()->subDays(14),
                'meta_title' => 'How to Build a Career in Pharmaceutical Regulatory Affairs',
                'meta_description' => 'Essential roadmap for pharmacy graduates seeking careers in international regulatory affairs, CTD submissions, and compliance.',
            ],
            [
                'category_id' => $blogCat1->id,
                'author_id' => $admin->id,
                'title' => 'Crafting an ATS-Optimized CV for Pharmacists: What Recruiters Look For',
                'slug' => 'crafting-ats-optimized-cv-for-pharmacists',
                'summary' => 'Avoid common mistakes that get pharmacy resumes rejected by automated applicant tracking systems and HR screening teams.',
                'content' => "<p>Many brilliant pharmacy graduates submit dozens of applications without receiving an interview call. In over 80% of cases, the culprit is a generic, unoptimized CV that fails automated Applicant Tracking System (ATS) parsing.</p><h3>Crucial Sections for Pharmaceutical Resumes:</h3><ul><li><strong>Instrumental Proficiencies:</strong> List specific analytical equipment (e.g. Waters HPLC with Empower Software, Shimadzu UV Spectrophotometer, Erweka Dissolution Tester).</li><li><strong>Academic Project / Thesis:</strong> Include 2-3 bullet points specifying your formulation technique, dissolution profile comparison, or analytical method.</li><li><strong>Quantifiable Action Bullets:</strong> Instead of saying <em>\"Responsible for lab testing\"</em>, write <em>\"Executed 40+ dissolution assays adhering strictly to USP Monograph standards with zero documentation deviations.\"</em></li></ul>",
                'author_name' => 'Dr. Tanvir Rahman, RPh',
                'author_title' => 'Chief Career Advisor',
                'read_time_minutes' => 5,
                'tags' => ['CV Writing', 'Resume', 'ATS', 'Job Search'],
                'is_published' => true,
                'published_at' => now()->subDays(20),
                'meta_title' => 'How to Write an ATS-Friendly Pharmaceutical CV',
                'meta_description' => 'Step-by-step CV writing guide for pharmacy students and job seekers to land interviews at top pharmaceutical companies.',
            ],
        ];

        foreach ($blogPostsData as $bData) {
            BlogPost::updateOrCreate(['slug' => $bData['slug']], $bData);
        }

        // 11. FAQs
        $faqsData = [
            [
                'category' => 'General',
                'question' => 'Who can join Pharma Career Launchpad?',
                'answer' => 'Pharma Career Launchpad is designed specifically for pharmacy undergraduate students (3rd & 4th year B.Pharm/Pharm.D), fresh graduates, active job seekers, and early-career pharmacists looking to transition or advance into quality, production, regulatory, commercial, or clinical roles.',
                'sort_order' => 1,
            ],
            [
                'category' => 'General',
                'question' => 'Is the program suitable for fresh graduates with no industrial experience?',
                'answer' => 'Yes, absolutely. The program was specifically built to bridge the gap between academic textbook knowledge and shop-floor industrial reality. We walk you through practical cGMP, analytical testing, line clearance, and common recruitment exam patterns from ground zero.',
                'sort_order' => 2,
            ],
            [
                'category' => 'Consultations',
                'question' => 'How does a 1-on-1 career consultation work?',
                'answer' => 'You choose a specialized pharmaceutical consultant and an available time slot through our interactive booking calendar. After providing your academic background and target goals, you meet 1-on-1 via secure video call for an intensive, personalized strategic session.',
                'sort_order' => 3,
            ],
            [
                'category' => 'Preparation',
                'question' => 'What is included in the Written Exam Preparation module?',
                'answer' => 'Our written exam preparation includes categorized question banks across Pharmacology, Pharmaceutics, QC/Analysis, Biopharmaceutics, and cGMP. You get timed mock tests, instant scoring, question-by-question explanations, and attempt history tracking.',
                'sort_order' => 4,
            ],
            [
                'category' => 'Preparation',
                'question' => 'Can candidates practise technical viva and job interviews?',
                'answer' => 'Yes. We offer dedicated Viva Practice Hubs with model answers, interviewer tips, and bookmarking, as well as STAR-method job interview preparation question sets covering both technical and behavioral interview panels.',
                'sort_order' => 5,
            ],
            [
                'category' => 'Booking',
                'question' => 'How can someone book a consultation session?',
                'answer' => 'Simply click "Book a Consultation", choose your desired service (or select from our expert consultants), choose a date and time slot from the live availability calendar, fill in your details, and submit. You will receive immediate booking confirmation and instructions.',
                'sort_order' => 6,
            ],
            [
                'category' => 'Consultations',
                'question' => 'Are online sessions available globally?',
                'answer' => 'Yes, all our consultations and coaching sessions are conducted online via live interactive video conferencing, allowing pharmacy candidates across Bangladesh, South Asia, the Middle East, and beyond to access senior pharmaceutical mentors.',
                'sort_order' => 7,
            ],
            [
                'category' => 'Payment',
                'question' => 'What payment options and introductory offers are supported?',
                'answer' => 'We offer complimentary introductory 15-minute career guidance sessions as well as transparent pricing on advanced 1-on-1 packages. All operational pricing and formats are clearly displayed with no hidden fees.',
                'sort_order' => 8,
            ],
            [
                'category' => 'Progress',
                'question' => 'How can candidates track their learning and preparation progress?',
                'answer' => 'When you create an account, your User Dashboard automatically aggregates your Career Assessment Quiz results, personalized Career Roadmap milestones, Exam Practice attempt history and scores, bookmarked viva questions, and consultation bookings.',
                'sort_order' => 9,
            ],
        ];

        foreach ($faqsData as $fData) {
            Faq::updateOrCreate(['question' => $fData['question']], $fData);
        }

        // 12. Testimonials (Demonstration Feedback - clearly marked per brief requirements)
        $testimonialsData = [
            [
                'name' => 'Farhan Chowdhury',
                'role' => 'Trainee QA Officer at Leading National Pharma',
                'previous_status' => 'B.Pharm 2024 Graduate',
                'avatar' => null,
                'content' => 'The written exam question bank and cGMP viva preparation transformed my confidence. Walking into my recruitment board interview, I felt completely prepared for every question on deviation handling and cleanroom HVAC.',
                'rating' => 5,
                'service_tag' => 'Pharma Career Launchpad',
                'is_demo' => true,
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Nusrat Jahan, RPh',
                'role' => 'Junior Executive, Regulatory Affairs',
                'previous_status' => 'M.Pharm Graduate',
                'avatar' => null,
                'content' => 'My 1-on-1 consultation session gave me complete clarity on CTD dossier compilation and helped me reformat my CV to showcase my analytical thesis work. I received two interview calls within two weeks of updating my profile.',
                'rating' => 5,
                'service_tag' => 'Career Planning & CV Review',
                'is_demo' => true,
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Arifur Rahman',
                'role' => 'QC Analyst (HPLC Laboratory)',
                'previous_status' => 'Fresh Pharmacy Graduate',
                'avatar' => null,
                'content' => 'The mock viva and chromatography troubleshooting practice questions were identical to what my interview panel asked during my analytical test. A must-have preparation platform for any serious pharmacy graduate.',
                'rating' => 5,
                'service_tag' => 'Viva & Written Exam Prep',
                'is_demo' => true,
                'is_featured' => true,
                'sort_order' => 3,
            ],
        ];

        foreach ($testimonialsData as $tData) {
            Testimonial::updateOrCreate(['name' => $tData['name']], $tData);
        }
    }
}
