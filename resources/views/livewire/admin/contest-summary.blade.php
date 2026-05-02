<div>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Contest Summary: {{ $contest->title }}
            </h2>
            <a href="{{ route('admin.contests') }}" wire:navigate class="text-sm text-indigo-600 hover:underline">
                &larr; Back to Contests
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 p-6 flex justify-between items-center">
                <div>
                    <h3 class="text-2xl font-bold text-gray-800">{{ $contest->title }}</h3>
                    <p class="text-gray-500 mt-1">
                        {{ $contest->start_time ? $contest->start_time->format('M d, Y h:i A') : 'TBA' }} 
                        &mdash; 
                        {{ $contest->end_time ? $contest->end_time->format('M d, Y h:i A') : 'TBA' }}
                    </p>
                </div>
                <div class="bg-indigo-50 border border-indigo-100 px-4 py-2 rounded-lg text-center">
                    <span class="block text-2xl font-black text-indigo-700">{{ $submissions->total() }}</span>
                    <span class="text-xs uppercase font-bold text-indigo-500">Total Submissions</span>
                </div>
            </div>

            <!-- Submissions Table -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100">
                <div class="p-6 border-b border-gray-100">
                    <h3 class="text-xl font-bold text-gray-800">Contest Submissions</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="py-4 px-6 text-xs uppercase tracking-wider font-bold text-gray-500 border-b">Time</th>
                                <th class="py-4 px-6 text-xs uppercase tracking-wider font-bold text-gray-500 border-b">User</th>
                                <th class="py-4 px-6 text-xs uppercase tracking-wider font-bold text-gray-500 border-b">Problem</th>
                                <th class="py-4 px-6 text-xs uppercase tracking-wider font-bold text-gray-500 border-b">Language</th>
                                <th class="py-4 px-6 text-xs uppercase tracking-wider font-bold text-gray-500 border-b">Status</th>
                                <th class="py-4 px-6 text-xs uppercase tracking-wider font-bold text-gray-500 border-b text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($submissions as $sub)
                                <tr class="hover:bg-slate-50 transition">
                                    <td class="py-4 px-6 text-sm text-gray-600">
                                        {{ $sub->created_at->format('M d, H:i:s') }}
                                    </td>
                                    <td class="py-4 px-6 font-bold text-gray-800">
                                        {{ $sub->user->name ?? 'Unknown' }}
                                    </td>
                                    <td class="py-4 px-6 text-indigo-600 font-semibold">
                                        {{ $sub->problem->title ?? 'Deleted Problem' }}
                                    </td>
                                    <td class="py-4 px-6 text-sm font-mono text-gray-500">
                                        {{ $sub->language }}
                                    </td>
                                    <td class="py-4 px-6">
                                        <span class="px-3 py-1 rounded-full text-xs font-bold
                                            @if($sub->status == 'Accepted') bg-emerald-100 text-emerald-800
                                            @elseif($sub->status == 'Pending') bg-slate-100 text-slate-800
                                            @elseif($sub->status == 'Wrong Answer') bg-rose-100 text-rose-800
                                            @else bg-amber-100 text-amber-800
                                            @endif
                                        ">
                                            {{ $sub->status }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-6 text-right">
                                        <button wire:click="viewCode({{ $sub->id }})" class="text-indigo-600 hover:text-indigo-900 font-bold text-sm transition">View Code</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-8 text-center text-gray-500 italic">No submissions yet during this contest.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($submissions->hasPages())
                    <div class="p-6 border-t border-gray-100">
                        {{ $submissions->links() }}
                    </div>
                @endif
            </div>
            
        </div>
    </div>

    <!-- Code Modal -->
    @if($viewingSubmission)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-gray-900 bg-opacity-75 backdrop-blur-sm">
            <div class="bg-white rounded-xl shadow-2xl w-full max-w-4xl overflow-hidden flex flex-col max-h-[90vh]">
                <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-slate-50">
                    <div>
                        <h3 class="text-xl font-bold text-gray-800">Submission by <span class="text-indigo-600">{{ $viewingSubmission->user->name ?? 'Unknown' }}</span></h3>
                        <p class="text-sm text-gray-500 mt-1">Problem: <strong>{{ $viewingSubmission->problem->title ?? 'Deleted' }}</strong> | Language: <span class="font-mono">{{ $viewingSubmission->language }}</span></p>
                    </div>
                    <button wire:click="closeCode" class="text-gray-400 hover:text-gray-600 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
                <div class="flex-grow p-6 overflow-y-auto bg-slate-900">
                    <pre class="text-slate-200 font-mono text-sm whitespace-pre-wrap"><code>{{ $viewingSubmission->code }}</code></pre>
                </div>
                @if($viewingSubmission->error_message)
                <div class="p-4 bg-rose-50 border-t border-rose-100">
                    <h4 class="font-bold text-rose-800 text-sm mb-1">Error/Output:</h4>
                    <pre class="text-rose-600 text-xs font-mono whitespace-pre-wrap">{{ $viewingSubmission->error_message }}</pre>
                </div>
                @endif
                <div class="p-4 bg-slate-50 border-t border-gray-100 text-right">
                    <button wire:click="closeCode" class="px-6 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold rounded-lg transition">Close</button>
                </div>
            </div>
        </div>
    @endif
</div>
