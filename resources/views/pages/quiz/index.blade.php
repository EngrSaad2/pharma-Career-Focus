@extends('layouts.app')

@section('title', 'Pharmaceutical Career Assessment Quiz | Pharma Career Compass')
@section('meta_description', 'Take our 3-minute pharmaceutical career assessment quiz to discover which pharmaceutical department and career path best matches your qualifications, interests, and strengths.')

@section('content')
<section class="py-12 md:py-16 bg-white border-b border-slate-100 min-h-[85vh] flex items-center">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 w-full" 
         x-data="{
            currentStep: 1,
            totalSteps: 5,
            edu: '',
            exp: '',
            env: '',
            interests: [],
            goal: '',
            nextStep() {
                if (this.currentStep === 1 && !this.edu) { alert('Please select your educational qualification.'); return; }
                if (this.currentStep === 2 && !this.exp) { alert('Please select your current professional stage.'); return; }
                if (this.currentStep === 3 && !this.env) { alert('Please choose your preferred work environment.'); return; }
                if (this.currentStep === 4 && this.interests.length === 0) { alert('Please pick at least one technical interest.'); return; }
                if (this.currentStep < this.totalSteps) {
                    this.currentStep++;
                    window.scrollTo({ top: 100, behavior: 'smooth' });
                }
            },
            prevStep() {
                if (this.currentStep > 1) {
                    this.currentStep--;
                    window.scrollTo({ top: 100, behavior: 'smooth' });
                }
            }
         }">

        <!-- Header -->
        <div class="text-center mb-8 space-y-2">
            <span class="text-xs font-bold uppercase tracking-widest text-[#0085FF] bg-blue-50 px-3 py-1 rounded-full border border-blue-200">
                Self-Assessment
            </span>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-[#00245A]">
                Pharmaceutical Career Assessment Quiz
            </h1>
            <p class="text-xs sm:text-sm text-slate-600 max-w-lg mx-auto">
                Answer 5 quick questions to receive your personalized pharmaceutical career direction, department match, and recommended preparation roadmap.
            </p>
        </div>

        <!-- Progress Bar -->
        <div class="mb-8">
            <div class="flex items-center justify-between text-xs font-semibold text-slate-500 mb-2">
                <span>Step <span x-text="currentStep"></span> of 5</span>
                <span x-text="Math.round((currentStep / totalSteps) * 100) + '% Completed'"></span>
            </div>
            <div class="w-full h-2.5 bg-slate-200 rounded-full overflow-hidden">
                <div class="h-full bg-gradient-to-r from-[#0085FF] to-[#00245A] transition-all duration-300 rounded-full"
                     :style="'width: ' + ((currentStep / totalSteps) * 100) + '%'"></div>
            </div>
        </div>

        <!-- Form Card Container -->
        <form action="{{ route('quiz.submit') }}" method="POST" class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8 shadow-sm text-left">
            @csrf

            <!-- STEP 1: Education -->
            <div x-show="currentStep === 1" x-transition>
                <div class="mb-6">
                    <span class="text-xs font-bold text-[#0085FF] uppercase tracking-wider">Question 1 of 5</span>
                    <h2 class="text-xl font-bold text-[#00245A] mt-1">What is your current pharmaceutical qualification?</h2>
                    <p class="text-xs text-slate-500 mt-0.5">Select your highest degree completed or currently in progress.</p>
                </div>

                <div class="space-y-3">
                    <label class="block p-4 rounded-xl border-2 cursor-pointer transition-all"
                           :class="edu === 'b_pharm' ? 'border-[#0085FF] bg-blue-50/60 shadow-xs' : 'border-slate-200 hover:border-slate-300 bg-white'">
                        <div class="flex items-center gap-3">
                            <input type="radio" name="step_1" value="b_pharm" x-model="edu" class="w-4 h-4 text-[#0085FF] focus:ring-[#0085FF]">
                            <div>
                                <div class="font-bold text-sm text-[#00245A]">Bachelor of Pharmacy (B.Pharm / B.Pharm Hons)</div>
                                <div class="text-xs text-slate-500">Undergraduate 4-year degree (or final year)</div>
                            </div>
                        </div>
                    </label>

                    <label class="block p-4 rounded-xl border-2 cursor-pointer transition-all"
                           :class="edu === 'pharm_d' ? 'border-[#0085FF] bg-blue-50/60 shadow-xs' : 'border-slate-200 hover:border-slate-300 bg-white'">
                        <div class="flex items-center gap-3">
                            <input type="radio" name="step_1" value="pharm_d" x-model="edu" class="w-4 h-4 text-[#0085FF] focus:ring-[#0085FF]">
                            <div>
                                <div class="font-bold text-sm text-[#00245A]">Doctor of Pharmacy (Pharm.D)</div>
                                <div class="text-xs text-slate-500">Professional clinical and patient care doctorate</div>
                            </div>
                        </div>
                    </label>

                    <label class="block p-4 rounded-xl border-2 cursor-pointer transition-all"
                           :class="edu === 'm_pharm_tech' ? 'border-[#0085FF] bg-blue-50/60 shadow-xs' : 'border-slate-200 hover:border-slate-300 bg-white'">
                        <div class="flex items-center gap-3">
                            <input type="radio" name="step_1" value="m_pharm_tech" x-model="edu" class="w-4 h-4 text-[#0085FF] focus:ring-[#0085FF]">
                            <div>
                                <div class="font-bold text-sm text-[#00245A]">Master of Pharmacy (M.Pharm - Industrial / Tech / Chemistry)</div>
                                <div class="text-xs text-slate-500">Postgraduate specialization in manufacturing or analytical chemistry</div>
                            </div>
                        </div>
                    </label>

                    <label class="block p-4 rounded-xl border-2 cursor-pointer transition-all"
                           :class="edu === 'm_pharm_clinical' ? 'border-[#0085FF] bg-blue-50/60 shadow-xs' : 'border-slate-200 hover:border-slate-300 bg-white'">
                        <div class="flex items-center gap-3">
                            <input type="radio" name="step_1" value="m_pharm_clinical" x-model="edu" class="w-4 h-4 text-[#0085FF] focus:ring-[#0085FF]">
                            <div>
                                <div class="font-bold text-sm text-[#00245A]">Master of Pharmacy (M.Pharm - Pharmacology / Clinical)</div>
                                <div class="text-xs text-slate-500">Postgraduate specialization in therapeutics or pharmacokinetics</div>
                            </div>
                        </div>
                    </label>

                    <label class="block p-4 rounded-xl border-2 cursor-pointer transition-all"
                           :class="edu === 'diploma_other' ? 'border-[#0085FF] bg-blue-50/60 shadow-xs' : 'border-slate-200 hover:border-slate-300 bg-white'">
                        <div class="flex items-center gap-3">
                            <input type="radio" name="step_1" value="diploma_other" x-model="edu" class="w-4 h-4 text-[#0085FF] focus:ring-[#0085FF]">
                            <div>
                                <div class="font-bold text-sm text-[#00245A]">Diploma in Pharmacy / Allied Biomedical Science</div>
                                <div class="text-xs text-slate-500">Diploma or related life science qualification</div>
                            </div>
                        </div>
                    </label>
                </div>
            </div>

            <!-- STEP 2: Experience Stage -->
            <div x-show="currentStep === 2" x-transition style="display: none;">
                <div class="mb-6">
                    <span class="text-xs font-bold text-[#0085FF] uppercase tracking-wider">Question 2 of 5</span>
                    <h2 class="text-xl font-bold text-[#00245A] mt-1">What is your current career stage?</h2>
                    <p class="text-xs text-slate-500 mt-0.5">This allows us to calibrate recommendations from entry level to senior progression.</p>
                </div>

                <div class="space-y-3">
                    <label class="block p-4 rounded-xl border-2 cursor-pointer transition-all"
                           :class="exp === 'student' ? 'border-[#0085FF] bg-blue-50/60' : 'border-slate-200 hover:border-slate-300'">
                        <div class="flex items-center gap-3">
                            <input type="radio" name="step_2" value="student" x-model="exp" class="w-4 h-4 text-[#0085FF]">
                            <div>
                                <div class="font-bold text-sm text-[#00245A]">Final Year Student</div>
                                <div class="text-xs text-slate-500">Preparing early for upcoming recruitment cycles</div>
                            </div>
                        </div>
                    </label>

                    <label class="block p-4 rounded-xl border-2 cursor-pointer transition-all"
                           :class="exp === 'fresh_graduate' ? 'border-[#0085FF] bg-blue-50/60' : 'border-slate-200 hover:border-slate-300'">
                        <div class="flex items-center gap-3">
                            <input type="radio" name="step_2" value="fresh_graduate" x-model="exp" class="w-4 h-4 text-[#0085FF]">
                            <div>
                                <div class="font-bold text-sm text-[#00245A]">Fresh Graduate</div>
                                <div class="text-xs text-slate-500">Graduated within the past 12 months, actively preparing</div>
                            </div>
                        </div>
                    </label>

                    <label class="block p-4 rounded-xl border-2 cursor-pointer transition-all"
                           :class="exp === 'job_seeker' ? 'border-[#0085FF] bg-blue-50/60' : 'border-slate-200 hover:border-slate-300'">
                        <div class="flex items-center gap-3">
                            <input type="radio" name="step_2" value="job_seeker" x-model="exp" class="w-4 h-4 text-[#0085FF]">
                            <div>
                                <div class="font-bold text-sm text-[#00245A]">Active Job Seeker</div>
                                <div class="text-xs text-slate-500">Currently applying and attending written tests and interviews</div>
                            </div>
                        </div>
                    </label>

                    <label class="block p-4 rounded-xl border-2 cursor-pointer transition-all"
                           :class="exp === 'mid_level' ? 'border-[#0085FF] bg-blue-50/60' : 'border-slate-200 hover:border-slate-300'">
                        <div class="flex items-center gap-3">
                            <input type="radio" name="step_2" value="mid_level" x-model="exp" class="w-4 h-4 text-[#0085FF]">
                            <div>
                                <div class="font-bold text-sm text-[#00245A]">Working Professional (1 - 3 Years)</div>
                                <div class="text-xs text-slate-500">Seeking faster promotion or department lateral switch</div>
                            </div>
                        </div>
                    </label>
                </div>
            </div>

            <!-- STEP 3: Environment -->
            <div x-show="currentStep === 3" x-transition style="display: none;">
                <div class="mb-6">
                    <span class="text-xs font-bold text-[#0085FF] uppercase tracking-wider">Question 3 of 5</span>
                    <h2 class="text-xl font-bold text-[#00245A] mt-1">Which work environment inspires you most?</h2>
                    <p class="text-xs text-slate-500 mt-0.5">Where do you envision yourself thriving day-to-day?</p>
                </div>

                <div class="space-y-3">
                    <label class="block p-4 rounded-xl border-2 cursor-pointer transition-all"
                           :class="env === 'plant' ? 'border-[#0085FF] bg-blue-50/60' : 'border-slate-200 hover:border-slate-300'">
                        <div class="flex items-center gap-3">
                            <input type="radio" name="step_3" value="plant" x-model="env" class="w-4 h-4 text-[#0085FF]">
                            <div>
                                <div class="font-bold text-sm text-[#00245A]">Modern Pharmaceutical Plant Floor</div>
                                <div class="text-xs text-slate-500">Cleanrooms, granulation, packaging, and QA/production shop-floor operations</div>
                            </div>
                        </div>
                    </label>

                    <label class="block p-4 rounded-xl border-2 cursor-pointer transition-all"
                           :class="env === 'lab' ? 'border-[#0085FF] bg-blue-50/60' : 'border-slate-200 hover:border-slate-300'">
                        <div class="flex items-center gap-3">
                            <input type="radio" name="step_3" value="lab" x-model="env" class="w-4 h-4 text-[#0085FF]">
                            <div>
                                <div class="font-bold text-sm text-[#00245A]">Analytical Quality & R&D Laboratory</div>
                                <div class="text-xs text-slate-500">HPLC, GC, UV-Vis instruments, method validation, and formulation stability</div>
                            </div>
                        </div>
                    </label>

                    <label class="block p-4 rounded-xl border-2 cursor-pointer transition-all"
                           :class="env === 'corporate_regulatory' ? 'border-[#0085FF] bg-blue-50/60' : 'border-slate-200 hover:border-slate-300'">
                        <div class="flex items-center gap-3">
                            <input type="radio" name="step_3" value="corporate_regulatory" x-model="env" class="w-4 h-4 text-[#0085FF]">
                            <div>
                                <div class="font-bold text-sm text-[#00245A]">Corporate Office & Global Regulatory</div>
                                <div class="text-xs text-slate-500">Dossier compilation (CTD), international health authority liaison, hybrid schedule</div>
                            </div>
                        </div>
                    </label>

                    <label class="block p-4 rounded-xl border-2 cursor-pointer transition-all"
                           :class="env === 'commercial' ? 'border-[#0085FF] bg-blue-50/60' : 'border-slate-200 hover:border-slate-300'">
                        <div class="flex items-center gap-3">
                            <input type="radio" name="step_3" value="commercial" x-model="env" class="w-4 h-4 text-[#0085FF]">
                            <div>
                                <div class="font-bold text-sm text-[#00245A]">Commercial Product Management & Marketing</div>
                                <div class="text-xs text-slate-500">Therapeutic brand positioning, medical scientific communication, and launches</div>
                            </div>
                        </div>
                    </label>

                    <label class="block p-4 rounded-xl border-2 cursor-pointer transition-all"
                           :class="env === 'clinical' ? 'border-[#0085FF] bg-blue-50/60' : 'border-slate-200 hover:border-slate-300'">
                        <div class="flex items-center gap-3">
                            <input type="radio" name="step_3" value="clinical" x-model="env" class="w-4 h-4 text-[#0085FF]">
                            <div>
                                <div class="font-bold text-sm text-[#00245A]">Healthcare, Hospital & Patient Care</div>
                                <div class="text-xs text-slate-500">Inpatient medication review, clinical pharmacokinetics, therapeutic monitoring</div>
                            </div>
                        </div>
                    </label>
                </div>
            </div>

            <!-- STEP 4: Scientific & Technical Interests (Multi-select) -->
            <div x-show="currentStep === 4" x-transition style="display: none;">
                <div class="mb-6">
                    <span class="text-xs font-bold text-[#0085FF] uppercase tracking-wider">Question 4 of 5</span>
                    <h2 class="text-xl font-bold text-[#00245A] mt-1">Which scientific areas do you enjoy most?</h2>
                    <p class="text-xs text-slate-500 mt-0.5">Select all topics that align with your interests (at least 1).</p>
                </div>

                <div class="space-y-3">
                    <label class="block p-3.5 rounded-xl border-2 cursor-pointer transition-all"
                           :class="interests.includes('qa_audit') ? 'border-[#0085FF] bg-blue-50/60' : 'border-slate-200 hover:border-slate-300'">
                        <div class="flex items-center gap-3">
                            <input type="checkbox" name="step_4[]" value="qa_audit" x-model="interests" class="w-4 h-4 text-[#0085FF] rounded">
                            <span class="text-sm font-semibold text-slate-800">cGMP Auditing, Validation Protocols & Quality Systems (QA)</span>
                        </div>
                    </label>

                    <label class="block p-3.5 rounded-xl border-2 cursor-pointer transition-all"
                           :class="interests.includes('instrumental_qc') ? 'border-[#0085FF] bg-blue-50/60' : 'border-slate-200 hover:border-slate-300'">
                        <div class="flex items-center gap-3">
                            <input type="checkbox" name="step_4[]" value="instrumental_qc" x-model="interests" class="w-4 h-4 text-[#0085FF] rounded">
                            <span class="text-sm font-semibold text-slate-800">Instrumental Analytical Testing (HPLC, Dissolution, GC) (QC)</span>
                        </div>
                    </label>

                    <label class="block p-3.5 rounded-xl border-2 cursor-pointer transition-all"
                           :class="interests.includes('formulation_prod') ? 'border-[#0085FF] bg-blue-50/60' : 'border-slate-200 hover:border-slate-300'">
                        <div class="flex items-center gap-3">
                            <input type="checkbox" name="step_4[]" value="formulation_prod" x-model="interests" class="w-4 h-4 text-[#0085FF] rounded">
                            <span class="text-sm font-semibold text-slate-800">Solid/Sterile Manufacturing, Granulation & Packaging (Production)</span>
                        </div>
                    </label>

                    <label class="block p-3.5 rounded-xl border-2 cursor-pointer transition-all"
                           :class="interests.includes('reg_dossier') ? 'border-[#0085FF] bg-blue-50/60' : 'border-slate-200 hover:border-slate-300'">
                        <div class="flex items-center gap-3">
                            <input type="checkbox" name="step_4[]" value="reg_dossier" x-model="interests" class="w-4 h-4 text-[#0085FF] rounded">
                            <span class="text-sm font-semibold text-slate-800">CTD/eCTD Dossiers, Drug Laws & Export Registrations (Regulatory)</span>
                        </div>
                    </label>

                    <label class="block p-3.5 rounded-xl border-2 cursor-pointer transition-all"
                           :class="interests.includes('safety_pv') ? 'border-[#0085FF] bg-blue-50/60' : 'border-slate-200 hover:border-slate-300'">
                        <div class="flex items-center gap-3">
                            <input type="checkbox" name="step_4[]" value="safety_pv" x-model="interests" class="w-4 h-4 text-[#0085FF] rounded">
                            <span class="text-sm font-semibold text-slate-800">Adverse Drug Reaction Monitoring & Signal Detection (PV)</span>
                        </div>
                    </label>

                    <label class="block p-3.5 rounded-xl border-2 cursor-pointer transition-all"
                           :class="interests.includes('marketing_pmd') ? 'border-[#0085FF] bg-blue-50/60' : 'border-slate-200 hover:border-slate-300'">
                        <div class="flex items-center gap-3">
                            <input type="checkbox" name="step_4[]" value="marketing_pmd" x-model="interests" class="w-4 h-4 text-[#0085FF] rounded">
                            <span class="text-sm font-semibold text-slate-800">Brand Management, Medical Campaigns & Market Analytics (PMD)</span>
                        </div>
                    </label>
                </div>
            </div>

            <!-- STEP 5: Preparation Goal & Submission -->
            <div x-show="currentStep === 5" x-transition style="display: none;">
                <div class="mb-6">
                    <span class="text-xs font-bold text-[#0085FF] uppercase tracking-wider">Question 5 of 5</span>
                    <h2 class="text-xl font-bold text-[#00245A] mt-1">What is your primary preparation goal?</h2>
                    <p class="text-xs text-slate-500 mt-0.5">Tell us what you want to achieve over the next 30 to 90 days.</p>
                </div>

                <div class="space-y-3 mb-6">
                    <label class="block p-3.5 rounded-xl border-2 cursor-pointer transition-all"
                           :class="goal === 'pass_exams' ? 'border-[#0085FF] bg-blue-50/60' : 'border-slate-200 hover:border-slate-300'">
                        <div class="flex items-center gap-3">
                            <input type="radio" name="step_5" value="pass_exams" x-model="goal" class="w-4 h-4 text-[#0085FF]">
                            <span class="text-sm font-semibold text-slate-800">Pass industrial recruitment written assessments with high marks</span>
                        </div>
                    </label>

                    <label class="block p-3.5 rounded-xl border-2 cursor-pointer transition-all"
                           :class="goal === 'master_viva' ? 'border-[#0085FF] bg-blue-50/60' : 'border-slate-200 hover:border-slate-300'">
                        <div class="flex items-center gap-3">
                            <input type="radio" name="step_5" value="master_viva" x-model="goal" class="w-4 h-4 text-[#0085FF]">
                            <span class="text-sm font-semibold text-slate-800">Overcome viva anxiety and articulate technical answers fluently</span>
                        </div>
                    </label>

                    <label class="block p-3.5 rounded-xl border-2 cursor-pointer transition-all"
                           :class="goal === 'ace_interviews' ? 'border-[#0085FF] bg-blue-50/60' : 'border-slate-200 hover:border-slate-300'">
                        <div class="flex items-center gap-3">
                            <input type="radio" name="step_5" value="ace_interviews" x-model="goal" class="w-4 h-4 text-[#0085FF]">
                            <span class="text-sm font-semibold text-slate-800">Master situational panel interviews using the STAR method</span>
                        </div>
                    </label>

                    <label class="block p-3.5 rounded-xl border-2 cursor-pointer transition-all"
                           :class="goal === 'full_mentorship' ? 'border-[#0085FF] bg-blue-50/60' : 'border-slate-200 hover:border-slate-300'">
                        <div class="flex items-center gap-3">
                            <input type="radio" name="step_5" value="full_mentorship" x-model="goal" class="w-4 h-4 text-[#0085FF]">
                            <span class="text-sm font-semibold text-slate-800">Complete end-to-end Launchpad (CV + Exams + Viva + 1-on-1 Mentorship)</span>
                        </div>
                    </label>
                </div>

                <!-- Optional Details for Report Personalization -->
                <div class="pt-4 border-t border-slate-100 grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Your Name (Optional)</label>
                        <input type="text" name="full_name" value="{{ auth()->user()?->name ?? '' }}" placeholder="e.g. Saadman Sakib" class="w-full text-xs px-3 py-2.5 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0085FF]">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Your Email (Optional)</label>
                        <input type="email" name="email" value="{{ auth()->user()?->email ?? '' }}" placeholder="e.g. saadman@example.com" class="w-full text-xs px-3 py-2.5 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0085FF]">
                    </div>
                </div>
            </div>

            <!-- Form Navigation Buttons -->
            <div class="mt-8 pt-5 border-t border-slate-100 flex items-center justify-between">
                <button type="button" 
                        @click="prevStep()" 
                        x-show="currentStep > 1" 
                        class="btn-secondary text-xs py-2 px-4">
                    &larr; Back
                </button>
                <div x-show="currentStep === 1"></div>

                <button type="button" 
                        @click="nextStep()" 
                        x-show="currentStep < totalSteps" 
                        class="btn-primary text-xs py-2.5 px-6">
                    Continue &rarr;
                </button>

                <button type="submit" 
                        x-show="currentStep === totalSteps" 
                        :disabled="!goal"
                        class="btn-accent text-xs py-2.5 px-6 font-bold">
                    Generate My Career Guidance Summary &rarr;
                </button>
            </div>
        </form>

        <!-- Transparent Guidance Notice -->
        <div class="mt-6 text-center text-xs text-slate-500 max-w-lg mx-auto">
            <span class="font-semibold text-slate-700">Notice:</span> Recommendations are structured career guidance based on objective algorithmic weighting of your inputs. Not guaranteed employment outcomes.
        </div>

    </div>
</section>
@endsection
