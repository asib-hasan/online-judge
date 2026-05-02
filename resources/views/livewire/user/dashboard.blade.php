<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Welcome Banner -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 p-8 flex flex-col md:flex-row items-center justify-between">
                <div>
                    <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight">Welcome back, <span class="text-indigo-600">{{ auth()->user()->name }}</span>!</h1>
                    <p class="mt-2 text-slate-500">Track your progress and participate in active contests.</p>
                </div>
                <div class="mt-4 md:mt-0 flex gap-4">
                    <a href="{{ route('problems.index') }}" wire:navigate class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-lg shadow-sm transition">
                        Practice Problems
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- Left Column: Statistics -->
                <div class="lg:col-span-2 space-y-6">
                    <h3 class="text-xl font-bold text-slate-800 px-1">Your Statistics</h3>
                    
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 text-center">
                            <p class="text-sm font-semibold text-slate-500 uppercase tracking-wide">Problems Solved</p>
                            <p class="text-3xl font-black text-indigo-600 mt-2">{{ $stats['unique_solved'] }}</p>
                        </div>
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 text-center">
                            <p class="text-sm font-semibold text-slate-500 uppercase tracking-wide">Total Submits</p>
                            <p class="text-3xl font-black text-slate-700 mt-2">{{ $stats['total_submissions'] }}</p>
                        </div>
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 text-center col-span-2">
                            <p class="text-sm font-semibold text-slate-500 uppercase tracking-wide">Success Rate</p>
                            <p class="text-3xl font-black text-emerald-500 mt-2">
                                {{ $stats['total_submissions'] > 0 ? round(($stats['ac'] / $stats['total_submissions']) * 100, 1) : 0 }}%
                            </p>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                        <h4 class="font-bold text-slate-700 mb-6 uppercase tracking-wider text-sm">Submission Breakdown</h4>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between p-3 bg-emerald-50 text-emerald-800 rounded-lg">
                                <span class="font-bold flex items-center gap-2"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Accepted (AC)</span>
                                <span class="font-black text-lg">{{ $stats['ac'] }}</span>
                            </div>
                            <div class="flex items-center justify-between p-3 bg-rose-50 text-rose-800 rounded-lg">
                                <span class="font-bold flex items-center gap-2"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg> Wrong Answer (WA)</span>
                                <span class="font-black text-lg">{{ $stats['wa'] }}</span>
                            </div>
                            <div class="flex items-center justify-between p-3 bg-amber-50 text-amber-800 rounded-lg">
                                <span class="font-bold flex items-center gap-2"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg> Runtime Error (RE)</span>
                                <span class="font-black text-lg">{{ $stats['re'] }}</span>
                            </div>
                            <div class="flex items-center justify-between p-3 bg-orange-50 text-orange-800 rounded-lg">
                                <span class="font-bold flex items-center gap-2"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> Time Limit Exceeded (TLE)</span>
                                <span class="font-black text-lg">{{ $stats['tle'] }}</span>
                            </div>
                            <div class="flex items-center justify-between p-3 bg-slate-50 text-slate-800 rounded-lg">
                                <span class="font-bold flex items-center gap-2"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg> Compilation Error (CE)</span>
                                <span class="font-black text-lg">{{ $stats['ce'] }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Contests -->
                <div class="space-y-6">
                    <h3 class="text-xl font-bold text-slate-800 px-1">Upcoming & Running Contests</h3>
                    
                    @if($activeContests->isEmpty())
                        <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100 text-center">
                            <p class="text-slate-500 italic">No active or upcoming contests at the moment.</p>
                        </div>
                    @else
                        <div class="space-y-4">
                            @foreach($activeContests as $contest)
                                @php
                                    $now = now();
                                    $isUpcoming = $contest->start_time && $now->lt($contest->start_time);
                                    $isEnded = $contest->end_time && $now->gt($contest->end_time);
                                @endphp
                                <a href="{{ route('contests.show', $contest) }}" wire:navigate class="block bg-white p-5 rounded-xl shadow-sm border border-gray-100 hover:border-indigo-300 hover:shadow-md transition group">
                                    <div class="flex justify-between items-start mb-2">
                                        <h4 class="font-bold text-slate-800 group-hover:text-indigo-600 transition">{{ $contest->title }}</h4>
                                        <span class="px-2 py-1 rounded text-xs font-bold whitespace-nowrap {{ $isUpcoming ? 'bg-amber-100 text-amber-800' : 'bg-emerald-100 text-emerald-800' }}">
                                            {{ $isUpcoming ? 'Upcoming' : 'Running' }}
                                        </span>
                                    </div>
                                    <div class="text-xs text-slate-500 space-y-1 mt-3">
                                        <p class="flex items-center gap-1.5"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg> Starts: {{ $contest->start_time ? $contest->start_time->format('M d, h:i A') : 'TBA' }}</p>
                                        <p class="flex items-center gap-1.5"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> Ends: {{ $contest->end_time ? $contest->end_time->format('M d, h:i A') : 'TBA' }}</p>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @endif
                    
                    <div class="text-center pt-2">
                        <a href="{{ route('contests.index') }}" wire:navigate class="text-sm font-bold text-indigo-600 hover:text-indigo-800 flex items-center justify-center gap-1">
                            View All Contests <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
