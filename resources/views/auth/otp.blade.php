<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-50 dark:bg-gray-900">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP - Admin Panel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 font-sans antialiased">
    <div class="max-w-md w-full space-y-8 bg-white dark:bg-gray-800 p-10 rounded-2xl shadow-xl">
        <div>
            <h2 class="mt-6 text-center text-3xl font-display font-extrabold text-gray-900 dark:text-white">
                Verify OTP
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600 dark:text-gray-400">
                A 6-digit verification code has been sent to contactmanishkasyap@gmail.com
            </p>
        </div>
        <form class="mt-8 space-y-6" action="{{ route('login.otp.post') }}" method="POST">
            @csrf
            
            @if (session('success'))
                <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-4">
                    <div class="flex">
                        <div class="ml-3">
                            <p class="text-sm text-green-700">
                                {{ session('success') }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-red-700">
                                {{ $errors->first() }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            <div class="rounded-md shadow-sm -space-y-px">
                <div>
                    <label for="otp" class="sr-only">OTP Code</label>
                    <input id="otp" name="otp" type="text" autocomplete="off" required class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-primary-500 focus:border-primary-500 focus:z-10 sm:text-lg text-center tracking-widest font-mono" placeholder="------" maxlength="6">
                </div>
            </div>

            <div x-data="{ loading: false }">
                <button type="submit" x-on:click="loading = true" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition">
                    <span x-show="!loading">Verify Code</span>
                    <span x-show="loading">Verifying...</span>
                </button>
            </div>
            
            <div class="text-center mt-4 text-sm text-gray-500 flex justify-between items-center">
                <a href="{{ route('login') }}" class="hover:text-primary-600">&larr; Back to Login</a>
            </div>
        </form>

        <form action="{{ route('login.otp.resend') }}" method="POST" class="mt-4" x-data="{ loading: false }" @submit="loading = true">
            @csrf
            <button type="submit" :disabled="loading" class="w-full text-sm text-primary-600 hover:text-primary-500 focus:outline-none disabled:opacity-50">
                <span x-show="!loading">Resend OTP</span>
                <span x-show="loading">Resending...</span>
            </button>
        </form>
    </div>
</body>
</html>
