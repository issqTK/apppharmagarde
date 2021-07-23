@extends('layouts.app')

@section('content')

<div class="md:w-4/6 lg:3/6 w-full mx-auto mt-6 px-2 lg:px-14 md:px-10 sm:px-6">
  <h1 class="w-full py-2 px-4 font-semibold text-base text-white font-semibold bg-gradient-to-r from-blue-500 to-blue-200">
    Update Pharmacies & Gards</h1>

  @if(Session::has('pharmacyCount') && Session::has('gardCount'))
    <div class="flex justify-around my-2 py-2  text-blue-900 font-semibold bg-blue-100">
      <span class="text-sm">{{ Session::get('pharmacyCount') }} Pharmacies Ajouter</span>
      <span class="text-sm">{{ Session::get('gardCount') }} Gards Ajouter</span>
      <?php Session()->pull('pharmacyCount'); Session()->pull('gardCount'); ?>
    </div>
  @endif

  <div class="flex flex-col my-2">
    <a href="{{ route('scrapeALL') }}"
    class="mb-2 py-1 px-4 text-blue-900 text-sm bg-blue-100 border-white border">
    Load All Cities</a>

    <a href="{{ route('scrapemarrakech') }}" 
    class="mb-2 py-1 px-4 bg-white text-blue-900 text-sm hover:bg-blue-100 hover:border-white border" >
    Load Marrakech</a>

    <a href="{{ route('scrapecasa') }}" 
    class="mb-2 py-1 px-4 bg-white text-blue-900 text-sm hover:bg-blue-100 hover:border-white border" >
    Load Casablanca</a>

    <a href="{{ route('scraperabat') }}" 
    class="mb-2 py-1 px-4 bg-white text-blue-900 text-sm hover:bg-blue-100 hover:border-white border" >
    Load Rabat</a>

    <a href="{{ route('scrapeeljadida') }}" 
    class="mb-2 py-1 px-4 bg-white text-blue-900 text-sm hover:bg-blue-100 hover:border-white border" >
    Load El Jadida</a>

    <a href="{{ route('scrapeoujda') }}" 
    class="mb-2 py-1 px-4 bg-white text-blue-900 text-sm hover:bg-blue-100 hover:border-white border" >
    Load Oujda</a>
    
    <a href="{{ route('scrapemeknes') }}" 
    class="mb-2 py-1 px-4 bg-white text-blue-900 text-sm hover:bg-blue-100 hover:border-white border" >
    Load Mekness</a>

    <a href="{{ route('scrapeagadir') }}" 
    class="mb-2 py-1 px-4 bg-white text-blue-900 text-sm hover:bg-blue-100 hover:border-white border" >
    Load Agadir</a>

    <a href="{{ route('scrapesale') }}" 
    class="mb-2 py-1 px-4 bg-white text-blue-900 text-sm hover:bg-blue-100 hover:border-white border" >
    Load Sale</a>

    <a href="{{ route('scrapesafi') }}" 
    class="mb-2 py-1 px-4 bg-white text-blue-900 text-sm hover:bg-blue-100 hover:border-white border" >
    Load Safi</a>

    <a href="{{ route('scrapefes') }}" 
    class="mb-2 py-1 px-4 bg-white text-blue-900 text-sm hover:bg-blue-100 hover:border-white border" >
    Load Fes</a>

    <a href="{{ route('scrapekenitra') }}" 
    class="mb-2 py-1 px-4 bg-white text-blue-900 text-sm hover:bg-blue-100 hover:border-white border" >
    Load Kenitra</a>

    <a href="{{ route('scrapemohammedia') }}" 
    class="mb-2 py-1 px-4 bg-white text-blue-900 text-sm hover:bg-blue-100 hover:border-white border">
    Load Mohammedia</a>

    <a href="{{ route('scrapetanger') }}" 
    class="mb-2 py-1 px-4 bg-white text-blue-900 text-sm hover:bg-blue-100 hover:border-white border" >
    Load Tanger</a>

    <a href="{{ route('scrapetemara') }}" 
    class="mb-2 py-1 px-4 bg-white text-blue-900 text-sm hover:bg-blue-100 hover:border-white border" >
    Load Temara</a>

  </div>
</div>
@endsection
