<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Contests') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-6">Upcoming and Past Contests</h3>
                    
                    @if($contests->isEmpty())
                        <div class="text-gray-500 italic">No contests available at the moment.</div>
                    @else
                        <div class="grid gap-6">
                            @foreach($contests as $contest)
                                <div class="border rounded-lg p-6 hover:shadow-md transition">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h4 class="text-xl font-bold text-indigo-600">{{ $contest->title ?? 'Contest #' . $contest->id }}</h4>
                                            <div class="text-sm text-gray-600 mt-2">
                                                <strong>Starts:</strong> {{ $contest->start_time ? $contest->start_time->format('M d, Y h:i A') : 'TBA' }}<br>
                                                <strong>Ends:</strong> {{ $contest->end_time ? $contest->end_time->format('M d, Y h:i A') : 'TBA' }}
                                            </div>
                                        </div>
                                        @php
                                            $now = now();
                                            $isUpcoming = $contest->start_time && $now->lt($contest->start_time);
                                            $isEnded = $contest->end_time && $now->gt($contest->end_time);
                                        @endphp
                                        <span class="px-3 py-1 rounded-full text-xs font-bold {{ 
                                            $isUpcoming ? 'bg-yellow-100 text-yellow-800' : 
                                            ($isEnded ? 'bg-gray-100 text-gray-800' : 'bg-green-100 text-green-800') 
                                        }}">
                                            {{ $isUpcoming ? 'Upcoming' : ($isEnded ? 'Ended' : 'Running') }}
                                        </span>
                                    </div>
                                    <div class="mt-4">
                                        <a href="{{ route('contests.show', $contest) }}" wire:navigate class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm font-bold transition">
                                            Enter Contest
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
