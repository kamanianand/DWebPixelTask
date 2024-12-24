<div>
    <div class="container mx-auto py-4">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold">Create new job posting</h1>
        </div>
        <div>
            <div class="container mx-auto py-4">
                <form wire:submit.prevent="createJob" class="space-y-4 mb-6">
                    <div>
                        <label for="title" class="block font-medium">Job Title</label>
                        <input type="text" id="title" wire:model="title" class="border rounded px-4 py-2 w-full"/>
                        @error('title') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="description" class="block font-medium">Job Description</label>
                        <textarea id="description" wire:model="description" class="border rounded px-4 py-2 w-full"></textarea>
                        @error('description') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="experience" class="block font-medium">Experience</label>
                        <input type="text" id="experience" wire:model="experience" class="border rounded px-4 py-2 w-full">
                        @error('experience') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="salary" class="block font-medium">Salary</label>
                        <input type="text" id="salary" wire:model="salary" class="border rounded px-4 py-2 w-full">
                        @error('salary') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="location" class="block font-medium">Location</label>
                        <input type="text" id="location" wire:model="location" class="border rounded px-4 py-2 w-full">
                        @error('location') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="extra_info" class="block font-medium">Extra Info</label>
                        <input type="text" id="extra_info" wire:model="extra_info" class="border rounded px-4 py-2 w-full">
                        @error('extra_info') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <h3 class="font-semibold mb-2">Company details</h3>
                        <label for="company_name" class="block font-medium">Name</label>
                        <input type="text" id="company_name" wire:model="company_name" class="border rounded px-4 py-2 w-full">
                        @error('company_name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror

                        <label for="company_logo" class="block font-medium mt-4">Logo</label>
                        <input type="file" id="company_logo" wire:model="company_logo" class="border rounded px-4 py-2 w-full">
                        @error('company_logo') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <h3 class="font-semibold mb-2">Skills</h3>
                        <label for="skills" class="block font-medium">Name</label>
                        <select id="skills" wire:model="skills" multiple class="border rounded px-4 py-2 w-full">
                            @foreach($activeskills as $skill)
                                <option value="{{ $skill->id }}">{{ $skill->name }}</option>
                            @endforeach
                        </select>
                        @error('skills') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                        Create Job
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
