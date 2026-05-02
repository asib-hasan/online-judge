<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <h2 class="text-2xl font-bold mb-4 text-gray-800">Problems</h2>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr>
                        <th class="border-b py-4 px-6 bg-gray-50 font-bold uppercase text-sm text-gray-700">ID</th>
                        <th class="border-b py-4 px-6 bg-gray-50 font-bold uppercase text-sm text-gray-700">Title</th>
                        <th class="border-b py-4 px-6 bg-gray-50 font-bold uppercase text-sm text-gray-700">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($problems as $problem)
                    <tr class="hover:bg-gray-100">
                        <td class="py-4 px-6 border-b text-gray-700">{{ $problem->id }}</td>
                        <td class="py-4 px-6 border-b text-gray-700">
                            <div class="flex items-center gap-3">
                                <span>{{ $problem->title }}</span>
                                @if(auth()->check() && isset($userStatuses[$problem->id]))
                                    @if($userStatuses[$problem->id] === 'solved')
                                        <span class="bg-emerald-100 text-emerald-800 text-xs font-bold px-2 py-1 rounded border border-emerald-200">Solved</span>
                                    @elseif($userStatuses[$problem->id] === 'tried')
                                        <span class="bg-amber-100 text-amber-800 text-xs font-bold px-2 py-1 rounded border border-amber-200">Tried</span>
                                    @endif
                                @endif
                            </div>
                        </td>
                        <td class="py-4 px-6 border-b text-gray-700">
                            <a href="{{ route('problems.show', $problem) }}" class="text-blue-500 hover:underline">View & Submit</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                {{ $problems->links() }}
            </div>
        </div>
    </div>
</div>
