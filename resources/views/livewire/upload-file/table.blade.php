

<div class="relative overflow-x-auto shadow-md sm:rounded-lg w-full">
    <table wire:poll="refreshUploadedFile" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
    {{-- <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"> --}}
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    #
                </th>
                <th scope="col" class="px-6 py-3">
                    {{ __('Time') }}
                </th>
                <th scope="col" class="px-6 py-3">
                    {{ __('File Name') }}
                </th>
                <th scope="col" class="px-6 py-3">
                    {{ __('Status') }}
                </th>
                <th scope="col" class="px-6 py-3">
                    {{ __('Action') }}
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse ($uploadedFile ?? [] as $file)
                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $loop->iteration }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $file['time'] }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $file['file_name'] }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $file['status'] }}
                    </td>
                    <td class="px-6 py-4">
                        @if ($file['status'] == \App\Enums\FileStatus::COMPLETED->value)
                            <button
                                wire:confirm="Are you sure you want to delete this file?"
                                wire:click="deleteUploadedFile({{ $file['id'] }})" type="button" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                Delete
                            </button>
                        @endif
                    </td>
                </tr>
            @empty
                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                    <th colspan="6" scope="row" class="px-6 py-4 text-center font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ __('No Record') }}
                    </th>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
