@extends('layouts.app')
@section('title', 'Terms and Conditions - GCEP')

@section('content')
    <div class="bg-gray-50 min-h-screen py-20 mt-16 text-zinc-800">
        <div class="max-w-4xl mx-auto bg-white p-10 md:p-14 rounded-3xl shadow-sm border border-gray-100">
            <div class="flex flex-col md:flex-row justify-between items-start mb-8 border-b pb-6">
                <div>
                    <h1 class="text-4xl font-extrabold text-green-700 mb-4 font-sans">Terms and Conditions</h1>
                    <p class="text-sm text-gray-500">Effective Date: April 2026</p>
                </div>
                <img src="{{ asset('assets/gclogo.png') }}" alt="GCEF Logo" class="w-24 h-24 mt-4 md:mt-0 object-contain">
            </div>

            <div class="space-y-8 text-base leading-relaxed">
                <section>
                    <h2 class="text-2xl font-bold text-gray-900 mb-3">1. Introduction</h2>
                    <p>Welcome to the <strong>Gordon College Event Portal (GCEP)</strong>. By registering, accessing, or
                        using our platform, you agree to be bound by these Terms and Conditions. Please read them carefully.
                        If you do not agree to these terms, do not use the service.</p>
                </section>

                <section>
                    <h2 class="text-2xl font-bold text-gray-900 mb-3">2. User Accounts and Responsibilities</h2>
                    <ul class="list-disc pl-6 space-y-2 mt-2">
                        <li><strong>Eligibility:</strong> The portal is strictly for bonafide students and authorized
                            personnel of Gordon College.</li>
                        <li><strong>Account Accuracy:</strong> You agree to provide true, accurate, current, and complete
                            information during registration (First Name, Last Name, Student Number, Email, Department, Year
                            Level). You must use your valid institutional email account.</li>
                        <li><strong>Security:</strong> You are strictly responsible for maintaining the confidentiality of
                            your account credentials. You must immediately notify the administration of any unauthorized use
                            of your account.</li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-2xl font-bold text-gray-900 mb-3">3. Event Registration and Participation</h2>
                    <p>GCEP functions as a central hub for campus events. When participating:</p>
                    <ul class="list-disc pl-6 space-y-2 mt-2">
                        <li>Registering for an event implies a commitment to attend. Habitual non-attendance may result in
                            restricted access to future events.</li>
                        <li>Users are expected to conduct themselves appropriately and abide by the Gordon College Student
                            Handbook during all registered activities.</li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-2xl font-bold text-gray-900 mb-3">4. Platform Misuse and Prohibited Conduct</h2>
                    <p>To ensure a safe environment, you agree NOT to:</p>
                    <ul class="list-disc pl-6 space-y-2 mt-2">
                        <li>Attempt to hack, destabilize, or breach the security mechanisms of GCEP.</li>
                        <li>Impersonate another student, faculty member, or admin.</li>
                        <li>Use the platform to distribute spam, malicious software, or inappropriate content.</li>
                    </ul>
                    <p class="mt-2 text-red-600 font-medium">Violation of these rules will result in immediate account
                        suspension and may be reported to the College Disciplinary Office.</p>
                </section>

                <section>
                    <h2 class="text-2xl font-bold text-gray-900 mb-3">5. Intellectual Property</h2>
                    <p>All software, branding, designs, and content featured on GCEP are the intellectual property of Gordon
                        College and its development team. Replicating or utilizing these elements outside of the platform
                        without permission is prohibited.</p>
                </section>

                <section>
                    <h2 class="text-2xl font-bold text-gray-900 mb-3">6. Limitation of Liability</h2>
                    <p>While we strive to keep GCEP bug-free and secure, the platform is provided on an "AS IS" and "AS
                        AVAILABLE" basis. Gordon College and the developers of GCEP are not liable for scheduling disputes,
                        eventual cancellation of real-world events, or incidental damages resulting from platform downtime.
                    </p>
                </section>

                <section>
                    <h2 class="text-2xl font-bold text-gray-900 mb-3">7. Modifications to the Terms</h2>
                    <p>We reserve the right to modify these terms at any time to reflect updates to our platform or legal
                        requirements. Material changes will be communicated via your registered institutional email.</p>
                </section>

                <section class="bg-green-50 p-6 rounded-xl mt-8">
                    <h2 class="text-xl font-bold text-green-800 mb-2">Governing Law</h2>
                    <p class="text-sm text-green-900">These Terms shall be governed according to the standard institutional
                        policies of Gordon College and the applicable laws of the Republic of the Philippines.</p>
                </section>
            </div>

            <div class="mt-12 text-center">
                <a href="{{ route('landing') }}"
                    class="text-green-600 hover:text-green-800 font-bold underline transition-colors">Return to Home</a>
            </div>
        </div>
    </div>
@endsection
