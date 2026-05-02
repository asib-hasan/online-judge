<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-gray-100">
                <div class="p-8 text-gray-900 flex flex-col items-center justify-center text-center">
                    <h1 class="text-4xl font-extrabold text-indigo-900 tracking-tight mb-4">Welcome to Asib<span class="text-blue-500">Oj</span>!</h1>
                    <p class="text-lg text-gray-600 mb-8 max-w-2xl">
                        You are successfully logged in. Head over to the Problems section to start coding, test your skills, and climb the leaderboard!
                    </p>
                    <a href="{{ route('problems.index') }}" wire:navigate class="px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg shadow-lg transition-transform transform hover:scale-105">
                        View Problems
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
