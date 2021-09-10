@extends('layouts.app')

@section('content')

<h3 class="h3">Scraper les Pharmacies de Garde</h3>

@if(Session::has('pharmacyCount') && Session::has('gardCount'))

<div class="affiche flex justify-around my-2 py-2  text-blue-900 font-semibold bg-blue-100">
  <span class="text-sm">{{ Session::get('pharmacyCount') }} Pharmacies Ajouter</span>
  <span class="text-sm">{{ Session::get('pharmacyUpdated') }} Pharmacies Updated</span>
  <span class="text-sm">{{ Session::get('gardCount') }} Gards Ajouter</span>
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

</div>

@endsection
