<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Dark mode: read localStorage BEFORE page renders to avoid flash --}}
    <script>
        (function() {
            var theme = localStorage.getItem('theme');
            if (theme === 'dark') {
                document.documentElement.classList.remove('light');
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
                document.documentElement.classList.add('light');
            }
        })();
    </script>

    <title>@yield('title', 'Manish Kashyap – Independent Journalist & Reporter')</title>
    <meta name="description" content="@yield('meta_description', 'Official website of Manish Kashyap. Fearless independent journalism, news, and blogs from Bihar, India.')">
    <meta name="keywords" content="@yield('meta_keywords', 'Manish Kashyap, Sach Tak News, Bihar, Journalism, India, News')">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>

<body class="font-sans antialiased min-h-screen bg-white text-charcoal-800 dark:bg-gray-900 dark:text-offwhite-100 transition-colors duration-300"
      x-data="{ darkMode: localStorage.getItem('theme') === 'dark', mobileOpen: false }"
      x-init="
        $watch('darkMode', val => {
          localStorage.setItem('theme', val ? 'dark' : 'light');
          if (val) {
            document.documentElement.classList.add('dark');
            document.documentElement.classList.remove('light');
          } else {
            document.documentElement.classList.add('light');
            document.documentElement.classList.remove('dark');
          }
        });
      ">

    {{-- ─── NAVBAR ─── --}}
    <nav class="fixed w-full z-50 bg-white/85 dark:bg-charcoal-800/95 backdrop-blur-md border-b border-offwhite-200 dark:border-charcoal-600 shadow-sm transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-18 items-center py-4">

                {{-- Logo --}}
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <span class="font-display font-extrabold text-2xl tracking-tight">
                        <span class="text-primary-600">MANISH</span><span class="text-gray-900 dark:text-white">KASHYAP</span>
                    </span>
                </a>

                {{-- Desktop Links --}}
                <div class="hidden md:flex items-center gap-8">
                    <a href="{{ route('home') }}"       class="text-sm font-semibold {{ request()->routeIs('home')     ? 'text-primary-600' : 'text-gray-600 dark:text-gray-300 hover:text-primary-600' }} transition">Home</a>
                    <a href="{{ route('about') }}"      class="text-sm font-semibold {{ request()->routeIs('about')    ? 'text-primary-600' : 'text-gray-600 dark:text-gray-300 hover:text-primary-600' }} transition">About</a>
                    <a href="{{ route('blog.index') }}" class="text-sm font-semibold {{ request()->routeIs('blog.*')   ? 'text-primary-600' : 'text-gray-600 dark:text-gray-300 hover:text-primary-600' }} transition">Journalism</a>
                    <a href="{{ route('contact') }}"    class="text-sm font-semibold {{ request()->routeIs('contact')  ? 'text-primary-600' : 'text-gray-600 dark:text-gray-300 hover:text-primary-600' }} transition">Contact</a>

                    {{-- Dark Mode Toggle --}}
                    <button id="themeToggleBtn"
                            @click="darkMode = !darkMode"
                            class="p-2 rounded-full bg-offwhite-100 dark:bg-charcoal-700 hover:bg-offwhite-200 dark:hover:bg-charcoal-600 transition border border-offwhite-200 dark:border-charcoal-500"
                            title="Toggle dark/light mode">
                        <svg x-show="!darkMode" class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                        </svg>
                        <svg x-show="darkMode" x-cloak class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </button>

                    <a href="{{ route('contact') }}" class="px-5 py-2.5 rounded-full bg-primary-600 text-white font-semibold hover:bg-primary-700 transition shadow-md">
                        Get in Touch
                    </a>
                </div>

                {{-- Mobile right --}}
                <div class="flex items-center gap-3 md:hidden">
                    <button @click="darkMode = !darkMode"
                            class="p-2 rounded-full bg-offwhite-100 dark:bg-charcoal-700 hover:bg-offwhite-200 dark:hover:bg-charcoal-600 transition border border-offwhite-200 dark:border-charcoal-500">
                        <svg x-show="!darkMode" class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                        </svg>
                        <svg x-show="darkMode" x-cloak class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </button>
                    <button @click="mobileOpen = !mobileOpen" class="text-gray-700 dark:text-gray-200">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path x-show="!mobileOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            <path x-show="mobileOpen" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- Mobile Menu --}}
        <div x-show="mobileOpen" x-cloak x-transition.opacity
             class="md:hidden bg-white dark:bg-charcoal-800 border-t border-offwhite-200 dark:border-charcoal-600 shadow-xl absolute w-full left-0">
            <div class="px-4 pt-2 pb-6 space-y-2">
                <a href="{{ route('home') }}"       class="block px-3 py-2 rounded-md text-base font-medium text-charcoal-800 dark:text-offwhite-100 hover:bg-offwhite-100 dark:hover:bg-charcoal-700">Home</a>
                <a href="{{ route('about') }}"      class="block px-3 py-2 rounded-md text-base font-medium text-charcoal-800 dark:text-offwhite-100 hover:bg-offwhite-100 dark:hover:bg-charcoal-700">About</a>
                <a href="{{ route('blog.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-charcoal-800 dark:text-offwhite-100 hover:bg-offwhite-100 dark:hover:bg-charcoal-700">Journalism</a>
                <a href="{{ route('contact') }}"    class="block px-3 py-2 rounded-md text-base font-medium text-charcoal-800 dark:text-offwhite-100 hover:bg-offwhite-100 dark:hover:bg-charcoal-700">Contact</a>
            </div>
        </div>
    </nav>

    {{-- Flash Messages --}}
    @if(session('success'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
         class="fixed top-24 right-4 z-50 bg-green-500 text-white px-6 py-3 rounded-xl shadow-xl flex items-center gap-3">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
        {{ session('success') }}
        <button @click="show = false" class="ml-2 text-white/80 hover:text-white">&times;</button>
    </div>
    @endif

    {{-- Main --}}
    <main class="pt-20 min-h-screen flex flex-col">
        <div class="flex-grow">
            @yield('content')
        </div>
    </main>

    {{-- ─── FOOTER ─── --}}
    <footer class="bg-charcoal-800 text-offwhite-300 pt-14 pb-8 border-t border-charcoal-700 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10 mb-10">

                {{-- Brand --}}
                <div class="md:col-span-1">
                    <span class="font-display font-extrabold text-2xl tracking-tight block mb-3">
                        <span class="text-primary-500">MANISH</span><span class="text-white">KASHYAP</span>
                    </span>
                    <p class="text-sm text-gray-400 mb-6 leading-relaxed">
                        Fearless independent journalism bringing the ground reality of India to the forefront. Truth above everything.
                    </p>
                    {{-- Social Icons --}}
                    <div class="flex gap-4">
                        <a href="https://x.com/ManishKasyapsob" target="_blank" rel="noopener"
                           class="w-9 h-9 rounded-full bg-gray-800 hover:bg-primary-600 flex items-center justify-center transition">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                            </svg>
                        </a>
                        <a href="https://www.instagram.com/ermanishkasyap/?hl=en" target="_blank" rel="noopener"
                           class="w-9 h-9 rounded-full bg-gray-800 hover:bg-primary-600 flex items-center justify-center transition">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </a>
                        <a href="https://www.youtube.com/@ManishKashyapsob" target="_blank" rel="noopener"
                           class="w-9 h-9 rounded-full bg-gray-800 hover:bg-red-600 flex items-center justify-center transition">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/>
                            </svg>
                        </a>
                    </div>
                </div>

                {{-- Quick Links --}}
                <div>
                    <h4 class="text-white font-semibold mb-4 text-sm uppercase tracking-wider">Quick Links</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="{{ route('home') }}"       class="hover:text-primary-400 transition">Home</a></li>
                        <li><a href="{{ route('about') }}"      class="hover:text-primary-400 transition">About Manish</a></li>
                        <li><a href="{{ route('blog.index') }}" class="hover:text-primary-400 transition">Journalism & Articles</a></li>
                        <li><a href="{{ route('contact') }}"    class="hover:text-primary-400 transition">Contact Us</a></li>
                    </ul>
                </div>

                {{-- Legal --}}
                <div>
                    <h4 class="text-white font-semibold mb-4 text-sm uppercase tracking-wider">Legal</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-primary-400 transition">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-primary-400 transition">Terms of Service</a></li>
                        <li><a href="#" class="hover:text-primary-400 transition">Disclaimer</a></li>
                        <li><a href="{{ route('login') }}" class="hover:text-primary-400 transition">Admin Login</a></li>
                    </ul>
                </div>

                {{-- Newsletter --}}
                <div>
                    <h4 class="text-white font-semibold mb-4 text-sm uppercase tracking-wider">Newsletter</h4>
                    <p class="text-sm text-gray-400 mb-4">Get the latest ground reports directly in your inbox.</p>
                    <form action="{{ route('newsletter.subscribe') }}" method="POST" class="flex flex-col gap-2">
                        @csrf
                        <input type="email" name="email" placeholder="Your email address" required
                               class="bg-charcoal-700 border border-charcoal-600 text-offwhite-100 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 w-full p-2.5 placeholder-offwhite-400">
                        <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white font-semibold rounded-lg text-sm px-5 py-2.5 transition">
                            Subscribe
                        </button>
                    </form>
                </div>
            </div>

            <div class="pt-8 border-t border-gray-800 text-sm text-center text-gray-500 flex flex-col md:flex-row justify-between items-center gap-2">
                <p>&copy; {{ date('Y') }} Manish Kashyap. All rights reserved.</p>
                <p>Designed for True Journalism &amp; Independent Media</p>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
