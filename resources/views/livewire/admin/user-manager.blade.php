<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Form Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 p-8">
                <h3 class="text-xl font-bold text-gray-800 mb-6">{{ $isEdit ? 'Edit User' : 'Create New User' }}</h3>
                <form wire:submit.prevent="save" class="space-y-6">
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Full Name</label>
                            <input type="text" wire:model="name" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            @error('name') <span class="text-rose-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Email Address</label>
                            <input type="email" wire:model="email" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            @error('email') <span class="text-rose-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">
                                Password 
                                @if($isEdit) <span class="text-xs font-normal text-gray-500">(Leave blank to keep current password)</span> @endif
                            </label>
                            <input type="password" wire:model="password" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            @error('password') <span class="text-rose-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Role / Type</label>
                            <select wire:model="type" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm bg-white">
                                <option value="user">Participant (User)</option>
                                <option value="admin">Administrator</option>
                            </select>
                            @error('type') <span class="text-rose-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="flex gap-3 pt-2">
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg shadow-sm font-bold transition">
                            {{ $isEdit ? 'Update User' : 'Create User' }}
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
                    <h3 class="text-xl font-bold text-gray-800">All Users</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="py-4 px-6 text-xs uppercase tracking-wider font-bold text-gray-500 border-b">User</th>
                                <th class="py-4 px-6 text-xs uppercase tracking-wider font-bold text-gray-500 border-b">Email</th>
                                <th class="py-4 px-6 text-xs uppercase tracking-wider font-bold text-gray-500 border-b">Role</th>
                                <th class="py-4 px-6 text-xs uppercase tracking-wider font-bold text-gray-500 border-b text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($users as $user)
                                <tr class="hover:bg-slate-50 transition">
                                    <td class="py-4 px-6">
                                        <div class="font-bold text-gray-800">{{ $user->name }}</div>
                                        <div class="text-xs text-gray-500 mt-0.5">Joined {{ $user->created_at->format('M d, Y') }}</div>
                                    </td>
                                    <td class="py-4 px-6 text-gray-600">
                                        {{ $user->email }}
                                    </td>
                                    <td class="py-4 px-6">
                                        @if($user->type === 'admin')
                                            <span class="bg-rose-100 text-rose-800 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide">Admin</span>
                                        @else
                                            <span class="bg-slate-100 text-slate-800 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide">User</span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-6 text-right">
                                        <button wire:click="edit({{ $user->id }})" class="text-indigo-600 hover:text-indigo-900 font-bold text-sm mr-4 transition">Edit</button>
                                        @if($user->id !== auth()->id())
                                            <button wire:click="delete({{ $user->id }})" class="text-rose-600 hover:text-rose-900 font-bold text-sm transition" onclick="confirm('Are you sure you want to delete this user? This action cannot be undone.') || event.stopImmediatePropagation()">Delete</button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="p-6 border-t border-gray-100">
                    {{ $users->links() }}
                </div>
            </div>

        </div>
    </div>
</div>
