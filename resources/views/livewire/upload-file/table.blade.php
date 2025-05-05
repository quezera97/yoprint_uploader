

<div class="relative overflow-x-auto shadow-md sm:rounded-lg w-full">
    <table wire:poll.5s="refreshUploadedFile" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
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
                        {{ $file->created_at }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $file->file_name }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $file->status }}
                    </td>
                    <td class="px-6 py-4">
                        MEOW
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
