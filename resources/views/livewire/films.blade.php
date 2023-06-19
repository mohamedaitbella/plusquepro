<div>
    
<div class="relative overflow-x-auto">
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
                    
                </th>
                <th scope="col" class="px-6 py-3">
                    Release date
                </th>
            </tr>
        </thead>
        <tbody>
           @foreach ($films as $film)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ Str::limit($film->title, 15) }}

                </th>
                <td class="px-6 py-4">
                    @foreach ( $film->genres as $genre)
                        <p>{{$genre->name}}</p>
                    @endforeach
                </td>
                <td class="px-6 py-4">
                    {{$film->release_date}}
                </td>
               
            </tr>
           @endforeach
        </tbody>
    </table>
</div>

</div>
