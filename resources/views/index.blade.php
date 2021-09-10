@extends('layouts.app')

@section('content')

@if(Session::has('loggedAdmin'))
    <h3 class="h3">Welcome {{ Session::get('loggedAdmin')->username }}</h3>
@else
    <h3 class="h3">Welcome</h3>
@endif

@if(!Session::has('loggedAdmin'))

<div class="bref">
   
    <h4>Bref a Propos de L'application</h4>
    
    <p>Cette Appli permet de scraper des données, et transfert ces dernier en mysql database,<br>
    Après on affiche les pharmacies de garde de maroc baser sur les donner qu'on as scrapper.<br>
    Notre équipe qui on l'accès a L'appli peuvent également explorer d'autres options comme : <br>
        <strong>+ Ajouter une garde ou une pharmacie.</strong><br>
        <strong>+ Filter, modifier et supprimer une pharmacie.</strong><br>
        <strong>+ Scrapper une ou bien Tout les ville manuellement. </strong><br>
    </p>
    
</div>

@endif

<div class="index-contains">
     
    <h3>Gérer Gardes</h3>
    <ul class="font-semibold">
        <li><a href="{{ route('listergarde') }}">Lister Gardes par Ville</a></li>
        <li><a href="{{ route('viewAddGarde') }}">Ajouter une Garde</a></li>

    </ul>

</div>

<div class="index-contains">
     
   <h3>Gestion des Pharmacies</h3>
    <ul class="font-semibold">
        <li><a href="{{ route('getGesPharma') }}">Gérer Pharmacies</a></li>
        <li><a href="{{ route('viewAddPharma') }}">Ajouter une Pharmacies</a></li>
        <li><a href="{{ route('viewdeleteGarde') }}">Supprimer une Pharmacies</a></li>

    </ul>

</div>

<div class="index-contains">
     
    <h3>Gestion de Scraping</h3>
    <ul class="font-semibold">
        <li><a href="{{ route('updateInfos') }}">Activité</a></li>
        <li><a href="{{ route('scrapping') }}">Administer Scraping</a></li>
    </ul>

</div>

@endsection
