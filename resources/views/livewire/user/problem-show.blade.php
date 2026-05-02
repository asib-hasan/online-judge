<div>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $problem->title }}
            </h2>
            @if($contest)
                <div class="flex flex-col sm:flex-row items-start sm:items-center gap-3 sm:gap-6">
                    <div x-data="{
                            endTime: new Date('{{ $contest->end_time->toIso8601String() }}').getTime(),
                            nowOffset: new Date('{{ now()->toIso8601String() }}').getTime() - new Date().getTime(),
                            remaining: '',
                            init() {
                                setInterval(() => {
                                    let current = new Date().getTime() + this.nowOffset;
                                    let distance = this.endTime - current;
                                    if (distance < 0) {
                                        this.remaining = 'Contest Ended';
                                        return;
                                    }
                                    let h = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                    let m = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                    let s = Math.floor((distance % (1000 * 60)) / 1000);
                                    this.remaining = `${h}h ${m}m ${s}s`;
                                }, 1000);
                            }
                        }" 
                        class="bg-red-100 text-red-700 px-4 py-1.5 rounded-full font-mono font-bold text-sm shadow-sm flex items-center gap-2">
                        <svg class="w-4 h-4 animate-pulse shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span x-text="remaining" class="whitespace-nowrap">Loading timer...</span>
                    </div>
                    <a href="{{ route('contests.show', $contest) }}" wire:navigate class="text-sm text-indigo-600 hover:underline font-semibold whitespace-nowrap">
                        &larr; Back to Contest
                    </a>
                </div>
            @else
                <a href="{{ route('problems.index') }}" wire:navigate class="text-sm text-indigo-600 hover:underline font-semibold">
                    &larr; Back to Problems
                </a>
            @endif
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto py-8 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row gap-8">
            
            <!-- Left Column: Problem Details -->
            <div class="w-full lg:w-1/2 space-y-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl p-8 border border-gray-100">
                    <h3 class="text-sm uppercase tracking-wider text-gray-500 font-bold mb-4">Problem Description</h3>
                    <div class="prose max-w-none text-gray-700 leading-relaxed text-lg">
                        {!! nl2br(e($problem->description)) !!}
                    </div>
                    
                    @php
                        $sampleCases = [];
                        if (!empty($problem->sample_test_cases)) {
                            $sampleCases = json_decode($problem->sample_test_cases, true) ?? [];
                        } else if (!empty($problem->test_cases)) {
                            $allTestCases = json_decode($problem->test_cases, true) ?? [];
                            if (count($allTestCases) > 0) {
                                $sampleCases = [$allTestCases[0]];
                            }
                        }
                    @endphp

                    @if(count($sampleCases) > 0)
                        <div class="mt-10 pt-8 border-t border-gray-100">
                            <h3 class="text-sm uppercase tracking-wider text-gray-500 font-bold mb-4">Examples</h3>
                            <div class="space-y-4">
                                @foreach($sampleCases as $index => $tc)
                                    <div class="bg-slate-50 border border-slate-200 rounded-lg p-5">
                                        <div class="mb-3">
                                            <strong class="text-slate-700 text-sm uppercase tracking-wide">Input:</strong>
                                            <div class="bg-white border border-slate-200 font-mono text-sm p-3 rounded mt-1 text-slate-800 overflow-x-auto whitespace-pre-wrap">{{ $tc['input'] ?? '' }}</div>
                                        </div>
                                        <div>
                                            <strong class="text-slate-700 text-sm uppercase tracking-wide">Output:</strong>
                                            <div class="bg-white border border-slate-200 font-mono text-sm p-3 rounded mt-1 text-slate-800 overflow-x-auto whitespace-pre-wrap">{{ $tc['output'] ?? '' }}</div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Right Column: Submission Workspace -->
            <div class="w-full lg:w-1/2 flex flex-col gap-6">
                
                <!-- Code Editor Card -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl p-6 border border-gray-100">
                    <div class="flex items-center justify-between mb-4 border-b pb-3">
                        <h3 class="text-lg font-bold text-gray-800">Your Solution</h3>
                        <div class="flex items-center gap-2">
                            <label class="text-sm font-semibold text-gray-600">Language:</label>
                            <select wire:model="language" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm font-bold bg-slate-50">
                                <option value="python">Python 3</option>
                                <option value="php">PHP</option>
                                <option value="c">C</option>
                                <option value="cpp">C++</option>
                                <option value="java">Java</option>
                            </select>
                        </div>
                    </div>
                    
                    @if($message)
                        <div class="bg-indigo-50 border-l-4 border-indigo-500 text-indigo-800 p-4 rounded mb-4 shadow-sm animate-pulse">
                            {{ $message }}
                        </div>
                    @endif

                    @php
                        $isContestEnded = $contest && $contest->end_time && now()->gt($contest->end_time);
                        $isContestUpcoming = $contest && $contest->start_time && now()->lt($contest->start_time);
                        $isDisabled = $isContestEnded || $isContestUpcoming;
                    @endphp

                    <form wire:submit.prevent="submit">
                        <div class="mb-4">
                            <textarea wire:model="code" {{ $isDisabled ? 'disabled' : '' }} class="w-full {{ $isDisabled ? 'bg-slate-800 cursor-not-allowed opacity-75' : 'bg-slate-900' }} text-slate-100 border-0 rounded-lg font-mono text-sm p-4 focus:ring-2 focus:ring-indigo-500 shadow-inner" rows="12" placeholder="{{ $isDisabled ? 'Submissions are closed for this contest.' : 'Write your code here...' }}"></textarea>
                            @error('code') <span class="text-red-500 text-sm font-medium mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div class="flex justify-end">
                            @if($isContestEnded)
                                <button type="button" disabled class="bg-gray-400 cursor-not-allowed text-white px-8 py-3 rounded-lg shadow-md font-bold transition flex items-center gap-2">
                                    Contest Ended - Submissions Closed
                                </button>
                            @elseif($isContestUpcoming)
                                <button type="button" disabled class="bg-gray-400 cursor-not-allowed text-white px-8 py-3 rounded-lg shadow-md font-bold transition flex items-center gap-2">
                                    Contest Upcoming
                                </button>
                            @else
                                <button type="submit" wire:loading.attr="disabled" wire:target="submit, processJudging" class="bg-indigo-600 hover:bg-indigo-700 disabled:bg-indigo-400 disabled:cursor-not-allowed text-white px-8 py-3 rounded-lg shadow-md font-bold transition flex items-center gap-2">
                                    <svg wire:loading.remove wire:target="submit, processJudging" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    <svg wire:loading wire:target="submit, processJudging" class="animate-spin -ml-1 mr-2 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                    
                                    <span wire:loading.remove wire:target="submit, processJudging">Submit Solution</span>
                                    <span wire:loading wire:target="submit">Queueing...</span>
                                    <span wire:loading wire:target="processJudging">Judging...</span>
                                </button>
                            @endif
                        </div>
                    </form>
                </div>

                <!-- Submissions History Card -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 flex-1">
                    <div class="p-6 border-b border-gray-100">
                        <h3 class="text-lg font-bold text-gray-800">Recent Submissions</h3>
                    </div>
                    @if($submissions->isEmpty())
                        <div class="p-8 text-center text-gray-400 italic">You haven't submitted any solutions yet.</div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead class="bg-slate-50">
                                    <tr>
                                        <th class="py-3 px-6 text-xs uppercase tracking-wider font-bold text-gray-500">Time</th>
                                        <th class="py-3 px-6 text-xs uppercase tracking-wider font-bold text-gray-500">Language</th>
                                        <th class="py-3 px-6 text-xs uppercase tracking-wider font-bold text-gray-500">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @foreach($submissions as $sub)
                                    <tr class="hover:bg-slate-50 transition">
                                        <td class="py-4 px-6 text-sm text-gray-600 whitespace-nowrap">{{ $sub->created_at->diffForHumans() }}</td>
                                        <td class="py-4 px-6 text-sm font-semibold text-gray-700 uppercase">{{ $sub->language }}</td>
                                        <td class="py-4 px-6 text-sm font-bold whitespace-nowrap
                                            @if($sub->status == 'Accepted') text-emerald-600
                                            @elseif($sub->status == 'Pending') text-amber-500 animate-pulse
                                            @else text-rose-600 @endif">
                                            <div class="flex items-center gap-1.5">
                                                @if($sub->status == 'Accepted')
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                @elseif($sub->status == 'Pending')
                                                    <svg class="w-4 h-4 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                                                @else
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                                @endif
                                                {{ $sub->status }}
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>
