<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Problems') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Form Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 p-8">
                <h3 class="text-xl font-bold text-gray-800 mb-6">{{ $isEdit ? 'Edit Problem' : 'Create New Problem' }}</h3>
                <form wire:submit.prevent="save" class="space-y-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Problem Title</label>
                        <input type="text" wire:model="title" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        @error('title') <span class="text-rose-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Description (Markdown Supported)</label>
                        <textarea wire:model="description" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm font-mono text-sm" rows="6"></textarea>
                        @error('description') <span class="text-rose-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Test Cases</label>
                        <p class="text-xs text-gray-500 mb-2">Provide test cases in valid JSON format: <code class="bg-gray-100 px-1 rounded">[{"input":"1 2", "output":"3"}]</code></p>
                        <textarea wire:model="test_cases" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm font-mono text-sm bg-slate-50" rows="5" placeholder='[
  {
    "input": "1 2",
    "output": "3"
  }
]'></textarea>
                    </div>

                    <div class="flex gap-3 pt-2">
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg shadow-sm font-bold transition">
                            {{ $isEdit ? 'Update Problem' : 'Create Problem' }}
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
                    <h3 class="text-xl font-bold text-gray-800">All Problems</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="py-4 px-6 text-xs uppercase tracking-wider font-bold text-gray-500 border-b">ID</th>
                                <th class="py-4 px-6 text-xs uppercase tracking-wider font-bold text-gray-500 border-b">Title</th>
                                <th class="py-4 px-6 text-xs uppercase tracking-wider font-bold text-gray-500 border-b text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($problems as $problem)
                                <tr class="hover:bg-slate-50 transition">
                                    <td class="py-4 px-6 text-gray-500 font-mono text-sm">
                                        #{{ $problem->id }}
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="font-bold text-gray-800">{{ $problem->title }}</div>
                                    </td>
                                    <td class="py-4 px-6 text-right">
                                        <!-- Note: raw db id for edit/delete functions instead of encrypted object -->
                                        <button wire:click="edit({{ $problem->id }})" class="text-indigo-600 hover:text-indigo-900 font-bold text-sm mr-4 transition">Edit</button>
                                        <button wire:click="delete({{ $problem->id }})" class="text-rose-600 hover:text-rose-900 font-bold text-sm transition" onclick="confirm('Are you sure you want to delete this problem?') || event.stopImmediatePropagation()">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="p-6 border-t border-gray-100">
                    {{ $problems->links() }}
                </div>
            </div>

        </div>
    </div>
</div>
