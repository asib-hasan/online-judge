<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>AsibOj - The Ultimate Online Judge Platform</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,600,800&display=swap" rel="stylesheet" />
        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased font-sans bg-slate-50 text-slate-800 selection:bg-blue-600 selection:text-white">
        <div class="min-h-screen flex flex-col relative overflow-hidden">
            <!-- Background gradients -->
            <div class="absolute inset-0 z-0 bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-indigo-100 via-white to-blue-50"></div>
            
            <header class="relative z-10 w-full max-w-7xl mx-auto px-6 py-6 flex justify-between items-center">
                <a href="/" class="text-3xl font-extrabold text-indigo-900 tracking-tight">
                    Asib<span class="text-blue-600">Oj</span>
                </a>
                <nav class="flex items-center gap-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 hover:underline">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="px-5 py-2.5 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition shadow-sm">Log in</a>
                        @endauth
                    @endif
                </nav>
            </header>

            <main class="relative z-10 flex-grow flex flex-col justify-center items-center text-center px-6 py-20">
                <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight text-indigo-950 mb-6 drop-shadow-sm">
                    Master Algorithms with <br class="hidden md:block"/> <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">AsibOj</span>
                </h1>
                <p class="text-lg md:text-xl text-slate-600 max-w-2xl mb-10 leading-relaxed">
                    Elevate your coding skills by solving complex algorithmic problems. Participate in contests, track your progress, and climb the leaderboard.
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    @auth
                        <a href="{{ route('problems.index') }}" class="px-8 py-4 bg-blue-600 text-white font-bold text-lg rounded-xl hover:bg-blue-700 transition shadow-lg hover:shadow-blue-600/30">Start Coding Now</a>
                    @else
                        <a href="{{ route('login') }}" class="px-8 py-4 bg-blue-600 text-white font-bold text-lg rounded-xl hover:bg-blue-700 transition shadow-lg hover:shadow-blue-600/30">Log In to Platform</a>
                    @endauth
                </div>
            </main>

            <footer class="relative z-10 text-center py-6 text-slate-500 font-medium text-sm">
                &copy; {{ date('Y') }} AsibOj. Built with Laravel v{{ Illuminate\Foundation\Application::VERSION }}.
            </footer>
        </div>
    </body>
</html>
