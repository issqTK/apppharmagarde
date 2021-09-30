@extends('layouts.app')

@section('content')

@if(Session::has('loggedAdmin'))
<h3 class="h3">Welcome {{ Session::get('loggedAdmin')->username }}</h3>
@else
<h3 class="h3">Welcome</h3>
@endif

@if(!Session::has('loggedAdmin'))

<div class="bref">
   
    <h4>A propos de l’application</h4>
    
    <p> Cette application permet de scraper des données, et de transférer ces dernières en mysql database;<br>
        Après on affiche les pharmacies de garde du Maroc basées sur les données qu'on a scrappées.<br>
        Notre équipe qui a l'accès à l'application peut également explorer d'autres options comme :<br>

        <span><strong>+</strong> Ajouter une garde ou une pharmacie;</span>
        <span><strong>+</strong> Filtrer, modifier et supprimer une pharmacie;</span>
        <span><strong>+</strong> Scrapper une ou bien toutes les villes manuellement;</span>
    </p>
    
</div>

@endif

<div class="index-contains">
     
    <h3>Gestion des gardes</h3>
    <ul class="font-semibold">
        <li><a href="{{ route('listergarde') }}">Lister les gardes par ville</a></li>
        <li><a href="{{ route('viewAddGarde') }}">Ajouter une garde</a></li>

    </ul>

</div>

<div class="index-contains">
     
   <h3>Gestion des pharmacies</h3>
    <ul class="font-semibold">
        <li><a href="{{ route('getGesPharma') }}">Gérer les pharmacies</a></li>
        <li><a href="{{ route('viewAddPharma') }}">Ajouter une pharmacie</a></li>
        <li><a href="{{ route('viewdeleteGarde') }}">Supprimer une pharmacie</a></li>

    </ul>

</div>

<div class="index-contains">
     
    <h3>Gestion de scraping</h3>
    <ul class="font-semibold">
        <li><a href="{{ route('updateInfos') }}">Activité</a></li>
        <li><a href="{{ route('scrapping') }}">Administrer le scraping</a></li>
    </ul>

</div>

@endsection
