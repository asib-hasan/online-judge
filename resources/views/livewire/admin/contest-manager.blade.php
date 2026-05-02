<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Contests') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Form Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 p-8">
                <h3 class="text-xl font-bold text-gray-800 mb-6">{{ $isEdit ? 'Edit Contest' : 'Create New Contest' }}</h3>
                <form wire:submit.prevent="save" class="space-y-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Contest Title</label>
                        <input type="text" wire:model="title" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        @error('title') <span class="text-rose-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Description</label>
                        <textarea wire:model="description" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="3"></textarea>
                        @error('description') <span class="text-rose-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Start Time</label>
                            <input type="datetime-local" wire:model="start_time" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            @error('start_time') <span class="text-rose-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">End Time</label>
                            <input type="datetime-local" wire:model="end_time" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            @error('end_time') <span class="text-rose-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Select Problems</label>
                        <p class="text-xs text-gray-500 mb-2">Hold CTRL or CMD to select multiple problems</p>
                        <select multiple wire:model="selectedProblems" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm h-48">
                            @foreach($allProblems as $prob)
                                <option value="{{ $prob->id }}" class="py-1 px-2 border-b">{{ $prob->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex gap-3 pt-2">
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg shadow-sm font-bold transition">
                            {{ $isEdit ? 'Update Contest' : 'Create Contest' }}
                        </button>
                        @if($isEdit)
                            <button type="button" wire:click="resetFields" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-2 rounded-lg font-bold transition">
                                Cancel
                            </button>
                        @endif
                    </div>
                </form>
            </div>

            <!-- List Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100">
                <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                    <h3 class="text-xl font-bold text-gray-800">All Contests</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="py-4 px-6 text-xs uppercase tracking-wider font-bold text-gray-500 border-b">Title</th>
                                <th class="py-4 px-6 text-xs uppercase tracking-wider font-bold text-gray-500 border-b">Duration</th>
                                <th class="py-4 px-6 text-xs uppercase tracking-wider font-bold text-gray-500 border-b">Problems</th>
                                <th class="py-4 px-6 text-xs uppercase tracking-wider font-bold text-gray-500 border-b text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($contests as $contest)
                                <tr class="hover:bg-slate-50 transition">
                                    <td class="py-4 px-6">
                                        <div class="font-bold text-gray-800">{{ $contest->title }}</div>
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="text-sm text-gray-600">
                                            <span class="font-semibold text-indigo-600">Start:</span> {{ $contest->start_time ? $contest->start_time->format('M d, Y h:i A') : 'TBA' }}<br>
                                            <span class="font-semibold text-rose-600">End:</span> {{ $contest->end_time ? $contest->end_time->format('M d, Y h:i A') : 'TBA' }}
                                        </div>
                                    </td>
                                    <td class="py-4 px-6 text-center">
                                        <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-xs font-bold">{{ $contest->problems->count() }}</span>
                                    </td>
                                    <td class="py-4 px-6 text-right">
                                        <a href="{{ route('admin.contests.summary', $contest) }}" wire:navigate class="text-emerald-600 hover:text-emerald-900 font-bold text-sm mr-4 transition">Summary</a>
                                        <button wire:click="edit({{ $contest->id }})" class="text-indigo-600 hover:text-indigo-900 font-bold text-sm mr-4 transition">Edit</button>
                                        <button wire:click="delete({{ $contest->id }})" class="text-rose-600 hover:text-rose-900 font-bold text-sm transition" onclick="confirm('Are you sure you want to delete this contest?') || event.stopImmediatePropagation()">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="p-6 border-t border-gray-100">
                    {{ $contests->links() }}
                </div>
            </div>

        </div>
    </div>
</div>
