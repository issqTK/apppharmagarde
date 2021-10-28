@extends('layouts.app')

@section('content')

<h3 class="h3">Scraper les Pharmacies en Garde</h3>

@if(Session::has('pharmacyCount') && Session::has('gardCount'))

<div class="affiche flex justify-around my-2 py-2  text-blue-900 font-semibold bg-blue-100">
  <span class="text-sm">{{ Session::get('pharmacyCount') }} Pharmacies Ajouter</span>
  <span class="text-sm">{{ Session::get('pharmacyUpdated') }} Pharmacies Modifier</span>
  <span class="text-sm">{{ Session::get('gardCount') }} Gardes Ajouter</span>
  <?php Session()->pull('pharmacyCount'); Session()->pull('gardCount'); ?>
</div>

@endif

<div class="scrapper-div">
  <a href="{{ route('scrapeALL') }}"
  class="mb-2 py-1 px-4 text-blue-900 text-sm bg-blue-100 border-white border">
  Scraper Tout les Ville</a>

  <a href="{{ route('scrapemarrakech') }}" 
  class="mb-2 py-1 px-4 bg-white text-blue-900 text-sm hover:bg-blue-100 hover:border-white border" >
  Scraper Marrakech</a>

  <a href="{{ route('scrapecasa') }}" 
  class="mb-2 py-1 px-4 bg-white text-blue-900 text-sm hover:bg-blue-100 hover:border-white border" >
  Scraper Casablanca</a>

  <a href="{{ route('scraperabat') }}" 
  class="mb-2 py-1 px-4 bg-white text-blue-900 text-sm hover:bg-blue-100 hover:border-white border" >
  Scraper Rabat</a>

  <a href="{{ route('scrapeeljadida') }}" 
  class="mb-2 py-1 px-4 bg-white text-blue-900 text-sm hover:bg-blue-100 hover:border-white border" >
  Scraper El Jadida</a>

  <a href="{{ route('scrapeoujda') }}" 
  class="mb-2 py-1 px-4 bg-white text-blue-900 text-sm hover:bg-blue-100 hover:border-white border" >
  Scraper Oujda</a>
  
  <a href="{{ route('scrapemeknes') }}" 
  class="mb-2 py-1 px-4 bg-white text-blue-900 text-sm hover:bg-blue-100 hover:border-white border" >
  Scraper Mekness</a>

  <a href="{{ route('scrapeagadir') }}" 
  class="mb-2 py-1 px-4 bg-white text-blue-900 text-sm hover:bg-blue-100 hover:border-white border" >
  Scraper Agadir</a>

  <a href="{{ route('scrapesale') }}" 
  class="mb-2 py-1 px-4 bg-white text-blue-900 text-sm hover:bg-blue-100 hover:border-white border" >
  Scraper Sale</a>

  <a href="{{ route('scrapesafi') }}" 
  class="mb-2 py-1 px-4 bg-white text-blue-900 text-sm hover:bg-blue-100 hover:border-white border" >
  Scraper Safi</a>

  <a href="{{ route('scrapefes') }}" 
  class="mb-2 py-1 px-4 bg-white text-blue-900 text-sm hover:bg-blue-100 hover:border-white border" >
  Scraper Fes</a>

  <a href="{{ route('scrapekenitra') }}" 
  class="mb-2 py-1 px-4 bg-white text-blue-900 text-sm hover:bg-blue-100 hover:border-white border" >
  Scraper Kenitra</a>

  <a href="{{ route('scrapemohammedia') }}" 
  class="mb-2 py-1 px-4 bg-white text-blue-900 text-sm hover:bg-blue-100 hover:border-white border">
  Scraper Mohammedia</a>

  <a href="{{ route('scrapetanger') }}" 
  class="mb-2 py-1 px-4 bg-white text-blue-900 text-sm hover:bg-blue-100 hover:border-white border" >
  Scraper Tanger</a>

  <a href="{{ route('scrapetemara') }}" 
  class="mb-2 py-1 px-4 bg-white text-blue-900 text-sm hover:bg-blue-100 hover:border-white border" >
  Scraper Temara</a>

  <a href="{{ route('scrapekhouribga') }}" 
  class="mb-2 py-1 px-4 bg-white text-blue-900 text-sm hover:bg-blue-100 hover:border-white border" >
  Scraper Khouribga</a>
  
  <a href="{{ route('scrapesettat') }}" 
  class="mb-2 py-1 px-4 bg-white text-blue-900 text-sm hover:bg-blue-100 hover:border-white border" >
  Scraper Settat</a>

  <a href="{{ route('scrapetetouan') }}" 
  class="mb-2 py-1 px-4 bg-white text-blue-900 text-sm hover:bg-blue-100 hover:border-white border" >
  Scraper Tetouan</a>

  <a href="{{ route('scrapenador') }}" 
  class="mb-2 py-1 px-4 bg-white text-blue-900 text-sm hover:bg-blue-100 hover:border-white border" >
  Scraper Nador</a>

  <a href="{{ route('scrapeberrechid') }}" 
  class="mb-2 py-1 px-4 bg-white text-blue-900 text-sm hover:bg-blue-100 hover:border-white border" >
  Scraper Berrchid</a>

  <a href="{{ route('scrapelarache') }}" 
  class="mb-2 py-1 px-4 bg-white text-blue-900 text-sm hover:bg-blue-100 hover:border-white border" >
  Scraper Larache</a>

  <a href="{{ route('scrapeaitmelloul') }}" 
  class="mb-2 py-1 px-4 bg-white text-blue-900 text-sm hover:bg-blue-100 hover:border-white border" >
  Scraper Ait Melloul</a>

  <a href="{{ route('scrapeberkane') }}" 
  class="mb-2 py-1 px-4 bg-white text-blue-900 text-sm hover:bg-blue-100 hover:border-white border" >
  Scraper Berkane</a>

  <a href="{{ route('scrapeessaouira') }}" 
  class="mb-2 py-1 px-4 bg-white text-blue-900 text-sm hover:bg-blue-100 hover:border-white border" >
  Scraper Essaouira</a>

  <a href="{{ route('scrapekhemisset') }}" 
  class="mb-2 py-1 px-4 bg-white text-blue-900 text-sm hover:bg-blue-100 hover:border-white border" >
  Scraper Khemisset</a>

  <a href="{{ route('scrapetaza') }}" 
  class="mb-2 py-1 px-4 bg-white text-blue-900 text-sm hover:bg-blue-100 hover:border-white border" >
  Scraper Taza</a>

  <a href="{{ route('scrapeouarzazate') }}" 
  class="mb-2 py-1 px-4 bg-white text-blue-900 text-sm hover:bg-blue-100 hover:border-white border" >
  Scraper Ouarzazate</a>

  <a href="{{ route('scrapeinezgane') }}" 
  class="mb-2 py-1 px-4 bg-white text-blue-900 text-sm hover:bg-blue-100 hover:border-white border" >
  Scraper Inezgane</a>

  <a href="{{ route('scrapebouznika') }}" 
  class="mb-2 py-1 px-4 bg-white text-blue-900 text-sm hover:bg-blue-100 hover:border-white border" >
  Scraper Bouznika</a>

  <a href="{{ route('scrapebenguerir') }}" 
  class="mb-2 py-1 px-4 bg-white text-blue-900 text-sm hover:bg-blue-100 hover:border-white border" >
  Scraper Benguerir</a>

  <a href="{{ route('scrapesidikacem') }}" 
  class="mb-2 py-1 px-4 bg-white text-blue-900 text-sm hover:bg-blue-100 hover:border-white border" >
  Scraper Sidi Kacem</a>

  <a href="{{ route('scrapeguelmim') }}" 
  class="mb-2 py-1 px-4 bg-white text-blue-900 text-sm hover:bg-blue-100 hover:border-white border" >
  Scraper Guelmim</a>

  <a href="{{ route('scrapelaayoune') }}" 
  class="mb-2 py-1 px-4 bg-white text-blue-900 text-sm hover:bg-blue-100 hover:border-white border" >
  Scraper Laayoune</a>

  <a href="{{ route('scrapechefchaouen') }}" 
  class="mb-2 py-1 px-4 bg-white text-blue-900 text-sm hover:bg-blue-100 hover:border-white border" >
  Scraper Chefchaouen</a>

  <a href="{{ route('scrapebenimellal') }}" 
  class="mb-2 py-1 px-4 bg-white text-blue-900 text-sm hover:bg-blue-100 hover:border-white border" >
  Scraper Beni Mellal</a>

  <a href="{{ route('scrapesefrou') }}" 
  class="mb-2 py-1 px-4 bg-white text-blue-900 text-sm hover:bg-blue-100 hover:border-white border" >
  Scraper Sefrou</a>

  <a href="{{ route('scrapetikiouine') }}" 
  class="mb-2 py-1 px-4 bg-white text-blue-900 text-sm hover:bg-blue-100 hover:border-white border" >
  Scraper Tikiouine</a>

  <a href="{{ route('scrapetiflet') }}" 
  class="mb-2 py-1 px-4 bg-white text-blue-900 text-sm hover:bg-blue-100 hover:border-white border" >
  Scraper Tiflet</a>

  <a href="{{ route('scrapeazrou') }}" 
  class="mb-2 py-1 px-4 bg-white text-blue-900 text-sm hover:bg-blue-100 hover:border-white border" >
  Scraper Azrou</a>

  <a href="{{ route('scrapefkihbensalah') }}" 
  class="mb-2 py-1 px-4 bg-white text-blue-900 text-sm hover:bg-blue-100 hover:border-white border" >
  Scraper Fkih Ben Salah</a>

  <a href="{{ route('scrapealhoceima') }}" 
  class="mb-2 py-1 px-4 bg-white text-blue-900 text-sm hover:bg-blue-100 hover:border-white border" >
  Scraper Al Hoceima</a>

  <a href="{{ route('scrapeksarelkebir') }}" 
  class="mb-2 py-1 px-4 bg-white text-blue-900 text-sm hover:bg-blue-100 hover:border-white border" >
  Scraper Ksar El Kebir</a>

  <a href="{{ route('scrapesidislimane') }}" 
  class="mb-2 py-1 px-4 bg-white text-blue-900 text-sm hover:bg-blue-100 hover:border-white border" >
  Scraper Sidi Slimane</a>

  <a href="{{ route('scrapedarbouazza') }}" 
  class="mb-2 py-1 px-4 bg-white text-blue-900 text-sm hover:bg-blue-100 hover:border-white border" >
  Dar Bouazza</a>

  <a href="{{ route('scrapetaourirt') }}" 
  class="mb-2 py-1 px-4 bg-white text-blue-900 text-sm hover:bg-blue-100 hover:border-white border" >
  Scraper Taourirt</a>

</div>

@endsection
