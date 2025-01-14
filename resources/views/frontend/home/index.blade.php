<x-app-layout>
    <!-- Hero Section - Fullscreen Gradient Background -->
    <div class="min-h-screen text-white bg-gradient-to-r from-blue-500 via-purple-500 to-indigo-700">
        <div class="px-4 mx-auto max-w-7xl">
            <div class="flex flex-col items-center justify-center min-h-screen">
                <div class="max-w-3xl text-center">
                    <h1 class="mb-4 text-3xl font-bold md:text-5xl">Learn Without Limits</h1>
                    <p class="px-4 mb-8 text-lg">Access thousands of courses from expert instructors
                        worldwide. Start your learning journey today!</p>
                    <div class="space-y-4 md:space-y-0 md:space-x-4">
                        @auth
                            <a href="{{ url('/dashboard') }}"
                                class="inline-block px-6 py-3 font-semibold text-blue-600 bg-white rounded-md hover:bg-gray-100">
                                Go to Dashboard
                            </a>
                        @else
                            <a href="{{ route('register') }}"
                                class="inline-block px-6 py-3 mb-4 font-semibold text-blue-600 bg-white rounded-md hover:bg-gray-100 md:mb-0">
                                Get Started
                            </a>
                            <a href="{{ route('login') }}"
                                class="inline-block px-6 py-3 font-semibold text-white border border-white rounded-md hover:bg-white hover:text-blue-600">
                                Sign In
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Features Section -->
    <div class="py-12 bg-white md:py-20">
        <div class="px-4 mx-auto max-w-7xl">
            <h2 class="mb-8 text-2xl font-bold text-center text-gray-800 md:text-3xl md:mb-12">Why Choose Us</h2>
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3 md:gap-8">
                <!-- Feature 1 -->
                <div class="p-6 bg-white border border-gray-100 rounded-lg shadow-lg">
                    <div class="flex items-center justify-center w-12 h-12 mb-4 bg-blue-100 rounded-full">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                            </path>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-xl font-semibold text-gray-800">Expert Instructors</h3>
                    <p class="text-gray-600">Learn from industry professionals with years of experience in their fields.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="p-6 bg-white border border-gray-100 rounded-lg shadow-lg">
                    <div class="flex items-center justify-center w-12 h-12 mb-4 bg-blue-100 rounded-full">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-xl font-semibold text-gray-800">Self-Paced Learning</h3>
                    <p class="text-gray-600">Study at your own pace with lifetime access to all course materials.</p>
                </div>

                <!-- Feature 3 -->
                <div class="p-6 bg-white border border-gray-100 rounded-lg shadow-lg">
                    <div class="flex items-center justify-center w-12 h-12 mb-4 bg-blue-100 rounded-full">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-xl font-semibold text-gray-800">Affordable Pricing</h3>
                    <p class="text-gray-600">Get access to quality education at competitive prices with regular
                        discounts.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Popular Courses Section -->
    <div id="courses" class="py-12 bg-white md:py-20">
        <div class="px-4 mx-auto max-w-7xl">
            <h2 class="mb-8 text-2xl font-bold text-center text-gray-800 md:text-3xl md:mb-12">Popular Courses</h2>
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3 md:gap-8">
                <!-- Course 1 -->
                <div class="overflow-hidden bg-white border border-gray-100 rounded-lg shadow-lg">
                    <div class="w-full h-48">
                        <img src="{{ asset('images/courses1.png') }}" alt="Course thumbnail"
                            class="object-cover w-full h-full">
                    </div>
                    <div class="p-6">
                        <h3 class="mb-2 text-xl font-semibold text-gray-800">Mathematics for High School</h3>
                        <p class="mb-4 text-gray-600">Master the concepts of high school math with our expert tutors.
                        </p>
                        <div
                            class="flex flex-col items-start justify-between space-y-4 sm:flex-row sm:items-center sm:space-y-0">
                            <span class="font-semibold text-blue-600">$49.99</span>
                            <a href="#"
                                class="w-full px-4 py-2 text-center text-white bg-blue-600 rounded-md sm:w-auto hover:bg-blue-700">Enroll
                                Now</a>
                        </div>
                    </div>
                </div>

                <!-- Course 2 -->
                <div class="overflow-hidden bg-white border border-gray-100 rounded-lg shadow-lg">
                    <div class="w-full h-48">
                        <img src="{{ asset('images/courses2.png') }}" alt="Course thumbnail"
                            class="object-cover w-full h-full">
                    </div>
                    <div class="p-6">
                        <h3 class="mb-2 text-xl font-semibold text-gray-800">English for Beginners</h3>
                        <p class="mb-4 text-gray-600">Improve your English speaking and writing skills with our
                            lessons.</p>
                        <div
                            class="flex flex-col items-start justify-between space-y-4 sm:flex-row sm:items-center sm:space-y-0">
                            <span class="font-semibold text-blue-600">$39.99</span>
                            <a href="#"
                                class="w-full px-4 py-2 text-center text-white bg-blue-600 rounded-md sm:w-auto hover:bg-blue-700">Enroll
                                Now</a>
                        </div>
                    </div>
                </div>

                <!-- Course 3 -->
                <div class="overflow-hidden bg-white border border-gray-100 rounded-lg shadow-lg">
                    <div class="w-full h-48">
                        <img src="{{ asset('images/courses3.png') }}" alt="Course thumbnail"
                            class="object-cover w-full h-full">
                    </div>
                    <div class="p-6">
                        <h3 class="mb-2 text-xl font-semibold text-gray-800">Science Experiments</h3>
                        <p class="mb-4 text-gray-600">Engage with fun and interactive science experiments for all ages.
                        </p>
                        <div
                            class="flex flex-col items-start justify-between space-y-4 sm:flex-row sm:items-center sm:space-y-0">
                            <span class="font-semibold text-blue-600">$59.99</span>
                            <a href="#"
                                class="w-full px-4 py-2 text-center text-white bg-blue-600 rounded-md sm:w-auto hover:bg-blue-700">Enroll
                                Now</a>
                        </div>
                    </div>
                </div>
                <!-- Course 1 -->
                <div class="overflow-hidden bg-white border border-gray-100 rounded-lg shadow-lg">
                    <div class="w-full h-48">
                        <img src="{{ asset('images/courses1.png') }}" alt="Course thumbnail"
                            class="object-cover w-full h-full">
                    </div>
                    <div class="p-6">
                        <h3 class="mb-2 text-xl font-semibold text-gray-800">Mathematics for High School</h3>
                        <p class="mb-4 text-gray-600">Master the concepts of high school math with our expert tutors.
                        </p>
                        <div
                            class="flex flex-col items-start justify-between space-y-4 sm:flex-row sm:items-center sm:space-y-0">
                            <span class="font-semibold text-blue-600">$49.99</span>
                            <a href="#"
                                class="w-full px-4 py-2 text-center text-white bg-blue-600 rounded-md sm:w-auto hover:bg-blue-700">Enroll
                                Now</a>
                        </div>
                    </div>
                </div>

                <!-- Course 2 -->
                <div class="overflow-hidden bg-white border border-gray-100 rounded-lg shadow-lg">
                    <div class="w-full h-48">
                        <img src="{{ asset('images/courses2.png') }}" alt="Course thumbnail"
                            class="object-cover w-full h-full">
                    </div>
                    <div class="p-6">
                        <h3 class="mb-2 text-xl font-semibold text-gray-800">English for Beginners</h3>
                        <p class="mb-4 text-gray-600">Improve your English speaking and writing skills with our
                            lessons.</p>
                        <div
                            class="flex flex-col items-start justify-between space-y-4 sm:flex-row sm:items-center sm:space-y-0">
                            <span class="font-semibold text-blue-600">$39.99</span>
                            <a href="#"
                                class="w-full px-4 py-2 text-center text-white bg-blue-600 rounded-md sm:w-auto hover:bg-blue-700">Enroll
                                Now</a>
                        </div>
                    </div>
                </div>

                <!-- Course 3 -->
                <div class="overflow-hidden bg-white border border-gray-100 rounded-lg shadow-lg">
                    <div class="w-full h-48">
                        <img src="{{ asset('images/courses3.png') }}" alt="Course thumbnail"
                            class="object-cover w-full h-full">
                    </div>
                    <div class="p-6">
                        <h3 class="mb-2 text-xl font-semibold text-gray-800">Science Experiments</h3>
                        <p class="mb-4 text-gray-600">Engage with fun and interactive science experiments for all ages.
                        </p>
                        <div
                            class="flex flex-col items-start justify-between space-y-4 sm:flex-row sm:items-center sm:space-y-0">
                            <span class="font-semibold text-blue-600">$59.99</span>
                            <a href="#"
                                class="w-full px-4 py-2 text-center text-white bg-blue-600 rounded-md sm:w-auto hover:bg-blue-700">Enroll
                                Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- CTA Section - Made Responsive -->
    <div class="py-12 text-white bg-gray-900 md:py-16">
        <div class="px-4 mx-auto text-center max-w-7xl">
            <h2 class="mb-4 text-2xl font-bold md:text-3xl">Start Your Learning Journey Today</h2>
            <p class="mb-8 text-lg">Join thousands of students who are already learning on our platform</p>
            <a href="#"
                class="inline-block w-full px-8 py-3 font-semibold text-white bg-blue-600 rounded-md sm:w-auto hover:bg-blue-700">Get
                Started Now</a>
        </div>
    </div>
    <!-- Footer -->
    <footer class="py-12 text-white bg-gray-800">
        <div class="px-4 mx-auto max-w-7xl">
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-4">
                <div>
                    <h3 class="mb-4 text-xl font-bold">EduLearn</h3>
                    <p class="text-gray-400">Empowering learners worldwide with quality education.</p>
                </div>
                <div>
                    <h4 class="mb-4 text-lg font-semibold">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white">About Us</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Courses</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Instructors</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="mb-4 text-lg font-semibold">Support</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white">Help Center</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Terms of Service</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Privacy Policy</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">FAQ</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="mb-4 text-lg font-semibold">Contact Us</h4>
                    <ul class="space-y-2">
                        <li class="text-gray-400">Email: info@edulearn.com</li>
                        <li class="text-gray-400">Phone: +1 234 567 890</li>
                        <li class="text-gray-400">Address: 123 Learning Street, Education City</li>
                    </ul>
                </div>
            </div>
            <div class="pt-8 mt-8 text-center border-t border-gray-700">
                <p class="text-gray-400">&copy; 2025 EduLearn. All rights reserved.</p>
            </div>
        </div>
    </footer>
    </div>
</x-app-layout>
