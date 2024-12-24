<div class="p-6 bg-white shadow rounded-lg">
    <h2 class="text-xl font-bold mb-4">Skills Management</h2>

    <!-- Add Skill Form -->
    <form wire:submit.prevent="addSkill" class="flex items-center space-x-4 mb-6">
        <input
            type="text"
            wire:model="newSkill"
            placeholder="Enter skill name"
            class="border rounded px-4 py-2 w-full"
        />
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
            Save
        </button>
    </form>

    @error('newSkill') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror

    <!-- Skills Table -->
    <table class="table-auto w-full border-collapse border border-gray-200">
        <thead>
            <tr class="bg-gray-100">
                <th class="border border-gray-300 px-4 py-2 text-left">ID</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Skill Name</th>
                <th class="border border-gray-300 px-4 py-2 text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($skills as $skill)
            <tr>
                <td class="border border-gray-300 px-4 py-2">{{ $skill->id }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $skill->name }}</td>
                <td class="border border-gray-300 px-4 py-2 text-center">

                    <button 
                            wire:click="editSkill({{ $skill->id }})" 
                            class="bg-blue-500 text-white px-2 py-1 rounded">Edit</button>
                    <button
                        wire:click="deleteSkill({{ $skill->id }})"
                        class="bg-red-500 text-white px-3 py-1 rounded"
                    >
                        Delete
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="p-6 bg-white shadow rounded-lg">
        @if($skillId)
            <form wire:submit.prevent="updateSkill" class="flex items-center space-x-4 mb-6">
                <input
                    type="text"
                    wire:model="name"
                    placeholder="Enter skill name"
                    class="border rounded px-4 py-2 w-full"
                />
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                    Update
                </button>
            </form>
        @endif
    </div>

    @error('name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror

</div>

</div>
