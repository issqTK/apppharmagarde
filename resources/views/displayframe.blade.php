@extends('layouts.app')

@section('content')

<div class="w-4/6  w-full mx-auto mt-2 px-2 ">
     
    <h3 class="h3">Lister Iframe Pharmacies des garde par ville</h3>
    
    <div class="iframeitem">
        @foreach($cities as $city)
        <a href="{{ route('displayframe', ['name' => $city->slug]) }}">
            Affiche Iframe 
            <span class="font-bold uppercase text-sm" >{{ $city->name }}</span>
        </a>
        @endforeach
     </div>
</div>

@endsection
