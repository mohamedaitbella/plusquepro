<div>
    
<div class="relative overflow-x-auto">
    
    <div class="m-6 flex justify-between">
        <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            <input type="search" wire:model="q" id="default-search" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search" required>
        
        </div>
    </div>

    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Title
                </th>
                <th scope="col" class="px-6 py-3">
                    Genre
                </th>
                <th scope="col" class="px-6 py-3">
                    Release date
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
           @foreach ($films as $film)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ Str::limit($film->title, 25) }}

                </th>
                <td class="px-6 py-4">
                    @foreach ( $film->genres as $genre)
                        <p>{{$genre->name}}</p>
                    @endforeach
                </td>
                <td class="px-6 py-4">
                    {{$film->release_date}}
                </td>
                <td class="px-6 py-4">
                    <x-danger-button wire:click="confirmFilmDeletion({{$film->id}})" wire:loading.attr="disabled">
                        {{ __('Delete') }}
                    </x-danger-button>
                </td>
            </tr>
           @endforeach
        </tbody>
    </table>
    <div class=" mt-6 mb-6   mx-6">
        {{ $films->links() }}
    </div>
</div>
<x-dialog-modal wire:model="confirmingFilmDeletion">
    <x-slot name="title">
        {{ __('Delete') }}
    </x-slot>

    <x-slot name="content"> 
        {{ __('Are you sure you want to delete.') }}
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="$set('confirmingFilmDeletion',false)" wire:loading.attr="disabled">
            {{ __('Cancel') }} 
        </x-secondary-button>

        <x-danger-button wire:click="deleteFilm({{$confirmingFilmDeletion}})" wire:loading.attr="disabled">
             {{ __('Delete') }}
        </x-danger-button>
    </x-slot>
</x-dialog-modal>

</div>
