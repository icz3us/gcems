@extends('layouts.app')
@section('title', 'Privacy Policy - GCEP')

@section('content')
    <div class="bg-gray-50 min-h-screen py-20 mt-16 text-zinc-800">
        <div class="max-w-4xl mx-auto bg-white p-10 md:p-14 rounded-3xl shadow-sm border border-gray-100">
            <div class="flex flex-col md:flex-row justify-between items-start mb-8 border-b pb-6">
                <div>
                    <h1 class="text-4xl font-extrabold text-green-700 mb-4 font-sans">Privacy Policy</h1>
                    <p class="text-sm text-gray-500">Effective Date: April 2026</p>
                </div>
                <img src="{{ asset('assets/gclogo.png') }}" alt="GCEF Logo" class="w-24 h-24 mt-4 md:mt-0 object-contain">
            </div>

            <div class="space-y-8 text-base leading-relaxed">
                <section>
                    <h2 class="text-2xl font-bold text-gray-900 mb-3">1. Introduction</h2>
                    <p>The <strong>Gordon College Event Portal (GCEP)</strong> respects your right to privacy. This Privacy
                        Policy details how we collect, use, store, and protect your personal information when you use our
                        platform, in full compliance with the <strong>Data Privacy Act of 2012 (Republic Act No.
                            10173)</strong> and global data protection standards.</p>
                </section>

                <section>
                    <h2 class="text-2xl font-bold text-gray-900 mb-3">2. Information We Collect</h2>
                    <p>When you register and interact with GCEP, we collect the following personal and academic data:</p>
                    <ul class="list-disc pl-6 space-y-2 mt-2">
                        <li><strong>Personal Details:</strong> First Name, Last Name.</li>
                        <li><strong>Academic/Institutional Data:</strong> Student Number, Institutional Email Address, Department, and Year Level.</li>
                        <li><strong>Activity Data:</strong> Events you view, register for, and participate in.</li>
                        <li><strong>Technical Data:</strong> Standard logged details like IP addresses, browser types, and
                            usage analytical patterns required to keep the system optimized.</li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-2xl font-bold text-gray-900 mb-3">3. How We Use Your Information</h2>
                    <p>We process your data strictly for legitimate institutional purposes:</p>
                    <ul class="list-disc pl-6 space-y-2 mt-2">
                        <li>To verify your identity as an enrolled student of Gordon College.</li>
                        <li>To manage event registrations, generate digital certificates/passes, and track attendances
                            efficiently.</li>
                        <li>To allow administrators to perform analytics for improving overall campus engagement.</li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-2xl font-bold text-gray-900 mb-3">4. Data Sharing and Disclosure</h2>
                    <p><strong>We do NOT sell, rent, or trade your personal information.</strong> Your data is shared
                        exclusively with:</p>
                    <ul class="list-disc pl-6 space-y-2 mt-2">
                        <li><strong>Authorized Administrators:</strong> Gordon College staff and department heads managing
                            the events.</li>
                        <li><strong>Legal Compliance:</strong> If strictly required by law or local regulatory bodies
                            involving public safety or institutional security.</li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-2xl font-bold text-gray-900 mb-3">5. Data Protection and Storage</h2>
                    <p> Your password is securely hashed using industry-standard algorithms (e.g., bcrypt) before being
                        stored in our MySQL database. Access to system data is strictly controlled and monitored. While we
                        implement strong security measures, no system can guarantee absolute security during internet
                        transmission.</p>
                    <p class="mt-2 text-sm text-gray-500 italic">Data is stored in a secure MySQL database maintained under
                        institutional guidelines. Records will be archived or securely deleted upon graduation or upon
                        leaving Gordon College.</p>
                </section>

                <section>
                    <h2 class="text-2xl font-bold text-gray-900 mb-3">6. Cookies and Tracking</h2>
                    <p>GCEP uses "cookies" solely to maintain user sessions (keeping you logged in securely) and preventing
                        CSRF (Cross-Site Request Forgery) attacks. We do not use invasive third-party tracking or
                        advertising cookies. By using GCEP, you consent to essential session cookies.</p>
                </section>

                <section>
                    <h2 class="text-2xl font-bold text-gray-900 mb-3">7. Your Rights as a Data Subject</h2>
                    <p>Under the Data Privacy Act of 2012, you possess strict rights over your information:</p>
                    <ul class="list-disc pl-6 space-y-2 mt-2">
                        <li><strong>The Right to be Informed:</strong> To know what data we hold and why.</li>
                        <li><strong>The Right to Access & Correct:</strong> To view your profile and correct inaccurate
                            information via the portal or College Registrar.</li>
                        <li><strong>The Right to Object & Erase:</strong> To suspend, withdraw, or order the
                            blocking/removal of your data if you believe it is unlawfully processed (terminating your
                            ability to use GCEP).</li>
                    </ul>
                </section>

                <section class="bg-gray-100 p-6 rounded-xl mt-8">
                    <h2 class="text-xl font-bold text-gray-800 mb-2">Contacting Us</h2>
                    <p class="text-sm text-gray-700">If you have any questions or concerns regarding this Privacy Policy,
                        please contact the Gordon College Administration or the Management Information Systems (MIS) Office
                        directly.</p>
                </section>
            </div>

            <div class="mt-12 text-center">
                <a href="{{ route('landing') }}"
                    class="text-green-600 hover:text-green-800 font-bold underline transition-colors">Return to Home</a>
            </div>
        </div>
    </div>
@endsection
