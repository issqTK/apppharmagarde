@extends('layouts.app')

@section('content')

<div class="flex md:w-5/6 lg:3/6 w-full mx-auto mt-6 px-2 lg:px-14 md:px-10 sm:px-6">
    <table class="w-full max-w-auto">
            <tr class="bg-gray-200 text-gray-800 font-semibold uppercase text-xs ">
                <th class="text-center text-gray-500">Exec_By</th>
                <th class="text-center text-gray-500">City</th>
                <th class="text-center text-gray-500">Guards_Added</th>
                <th class="text-center text-gray-500">Pharmacies_Added</th>
                <th class="text-center text-gray-500">Pharmacies_Updated</th>
                <th class="text-center text-gray-500">Fails_Scraper</th>
                <th class="text-center text-gray-500">Time</th>
            </tr>
        <tbody class="text-gray-600 text-sm font-light">
            @foreach($datas AS $data)
            <tr class="border-b border-gray-200 hover:bg-gray-100">
                <td class="py-3 px-6 text-left whitespace-nowrap">{{$data->executedBy}}
                </td>

                <td class="py-3 px-6 text-left">{{$data->city}}
                </td>
                
                <td class="py-3 px-6 text-center">{{$data->guards_added}}
                </td>

                <td class="py-3 px-6 text-center">{{$data->pharmacies_added}}
                </td>

                <td class="py-3 px-6 text-center">{{$data->pharmacies_Updated}}
                </td>
                
                <td class="py-3 px-6 text-center">{{$data->pharmacies_fails_count}}
                </td>
                
                <td class="py-3 px-6 text-center">{{ $data->updated_at }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection