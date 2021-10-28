@extends('layouts.app')

@section('content')

<h1 class="h3">Filtrer les Pharmacies</h1>

<div class="getion-pharma">
    <form action="{{ route( 'filter' ) }}" method="post">
    @csrf
        <div>
            <label for="phone" class="label">Filtré par Numéro de Téléphone</label>
            <input type="text" name="phone" id="phone" placeholder="Exemple 0555555555">
        </div>
                
        <div>
            <label for="city" class="label">Filtré par Ville</label>
            <select name="city" id="city" >
                <option value="" selected disabled hidden>Choisir une Ville</option>
                @foreach($cities AS $city)
                <option value="{{ $city->id }}" >{{ $city->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="label">Données Qualifiées</label>
            <select name="qualifier" id="qualifier" >
                <option value="" selected disabled hidden>Choisir</option>
                <option value="1" >Données Qualifiées</option>
                <option value="0" >Données Non Qualifiées (à corriger)</option>
            </select>
        </div>

        <div>
            <input type="submit" value="Chercher" class="submit font-semibold" id="submit" disabled >
        </div>
    </form>
</div>

<div class="flex flex-col w-full mx-auto mt-4">
        @if(Session::has('fail'))
        <span class="block w-full text-md font-semibold text-center text-red-400">{{ Session::get('fail') }}</span>
        @endif
        @if(Session::has('success'))
        <span class="block w-full text-md font-semibold text-center text-green-400">{{ Session::get('success') }}</span>
        @endif

        @if(Session::has('datas') )
        <table class="w-full border">
            <tr style="background:rgba(3, 180, 198, 0.8)" class="font-semibold uppercase text-xs ">
                <th class="text-center">Phone</th>
                <th class="text-center">Name</th>
                <th class="text-center">Address</th>
                <th class="text-center">gmapsUrl</th>
                <th class="text-center">Lat</th>
                <th class="text-center">Long</th>
                <th class="text-center">cityID</th>
                <th class="text-center">+</th>
            </tr>
            <tbody class="text-gray-600 text-sm font-light">
            @foreach(Session::get('datas') AS $data)
                <tr>
                    <td>{{$data->phone}}</td>
                    <td>{{$data->name}}</td>
                    <td>{{$data->address}}</td>
                    <td class="max-w-md overflow-x-hidden">{{$data->gmaps_url}}</td>
                    <td>{{$data->lat}}</td>
                    <td>{{$data->long}}</td>
                    <td>{{$data->city_id}}</td>
                    <td><a href='{{ route("getPharmacy", ["id" => $data->id]) }}' class="uppercase text-blue-500">Edit</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @endif
</div>

@endsection