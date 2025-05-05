<div class="w-full">
    <form wire:submit="uploadFile" class="w-full">
        <label for="file_input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
            Upload file
        </label>

        <input
            id="file_input"
            type="file"
            wire:model="uploadedFile"
            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
        >

        @error('uploadedFile')
            <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
        @enderror

        <div class="flex justify-end mt-4">
            <button
                type="submit"
                class="cursor-pointer text-white bg-gradient-to-r from-cyan-400 via-cyan-500 to-cyan-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
            >
                Upload
            </button>
        </div>
    </form>
</div>
