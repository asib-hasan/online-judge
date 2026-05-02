<div>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $contest->title ?? 'Contest #' . $contest->id }}
            </h2>
            <a href="{{ route('contests.index') }}" wire:navigate class="text-sm text-indigo-600 hover:underline">
                &larr; Back to Contests
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <div>
                        <h3 class="text-2xl font-bold">Contest Information</h3>
                        <p class="text-gray-600 mt-1">
                            Starts: {{ $contest->start_time ? $contest->start_time->format('M d, Y h:i A') : 'TBA' }} | 
                            Ends: {{ $contest->end_time ? $contest->end_time->format('M d, Y h:i A') : 'TBA' }}
                        </p>
                    </div>
                    @php
                        $now = now();
                        $isUpcoming = $contest->start_time && $now->lt($contest->start_time);
                        $isEnded = $contest->end_time && $now->gt($contest->end_time);
                    @endphp
                    <span class="px-4 py-2 rounded-full text-sm font-bold {{ 
                        $isUpcoming ? 'bg-yellow-100 text-yellow-800' : 
                        ($isEnded ? 'bg-gray-100 text-gray-800' : 'bg-green-100 text-green-800') 
                    }}">
                        {{ $isUpcoming ? 'Upcoming' : ($isEnded ? 'Ended' : 'Running') }}
                    </span>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-xl font-bold mb-4">Problems</h3>
                
                @if($isUpcoming)
                    <div class="text-center py-8 text-gray-500">
                        <svg class="mx-auto h-12 w-12 text-gray-400 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        <p class="text-lg">The problems will be revealed when the contest starts.</p>
                    </div>
                @else
                    @if($contest->problems->isEmpty())
                        <div class="text-gray-500 italic">No problems have been added to this contest yet.</div>
                    @else
                        <div class="space-y-4">
                            @foreach($contest->problems as $index => $problem)
                                <div class="border rounded p-4 flex justify-between items-center hover:bg-gray-50 transition">
                                    <div class="flex items-center gap-3">
                                        <h4 class="font-bold text-lg">
                                            <span class="text-indigo-600 mr-2">{{ chr(65 + $index) }}.</span> 
                                            {{ $problem->title }}
                                        </h4>
                                        @if(auth()->check() && isset($userStatuses[$problem->id]))
                                            @if($userStatuses[$problem->id] === 'solved')
                                                <span class="bg-emerald-100 text-emerald-800 text-xs font-bold px-2 py-1 rounded border border-emerald-200">Solved</span>
                                            @elseif($userStatuses[$problem->id] === 'tried')
                                                <span class="bg-amber-100 text-amber-800 text-xs font-bold px-2 py-1 rounded border border-amber-200">Tried</span>
                                            @endif
                                        @endif
                                    </div>
                                    <a href="{{ route('problems.show', ['problem' => $problem, 'contest' => $contest]) }}" wire:navigate class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded text-sm font-bold">
                                        Solve Problem
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endif
                @endif
            </div>

        </div>
    </div>
</div>
