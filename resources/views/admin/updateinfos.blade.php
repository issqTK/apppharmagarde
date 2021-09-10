@extends('layouts.app')

@section('content')

<h3 class="h3-updateinfos">Les Activités de Scraping </h3><br>

<table class="updateinfos">
    <tr>
        <th >Executer<br>par</th>
        <th >Ville</th>
        <th >Gardes<br>Ajouter</th>
        <th >Pharmacies<br>Ajouter</th>
        <th >Pharmacies<br>Modifier</th>
        <th >Scraping <br> échoue</th>
        <th >Date <br> d'exécution</th>
    </tr>

    <tbody class="tbody">
    @foreach($datas AS $data)
        <tr>
            <td >{{$data->executedBy}} </td>

            <td >{{$data->city}} </td>

            <td >{{$data->guards_added}} </td>

            <td >{{$data->pharmacies_added}} </td>

            <td >{{$data->pharmacies_Updated}} </td>

            <td >{{$data->pharmacies_fails_count}} </td>

            <td >{{ $data->updated_at }} </td>
        </tr>
    @endforeach
    </tbody>

</table>

@endsection