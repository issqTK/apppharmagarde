@extends('layouts.app')

@section('content')

<div class="top-nav h3">
    
    <a href="javascript:void(0)" class="uppercase p-2 rounded text-sm text-white font-semibold" id="cities-menu-button"> 
        Tout les villes 
        <ion-icon name="caret-down-outline" class="align-middle" id="fleshdown"></ion-icon> 
    </a>

    <ul id="cities" class="hidden absolute z-1 left-0 top-11 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" >

        @foreach($cities as $citie)

            <li>
              <a href="{{ route('display', ['name' => $citie->slug]) }}" 
                class="block text-black px-6 py-2 text-sm font-medium">
                {{ $citie->name }}</a>
            </li>

        @endforeach

    </ul>
</div>

@if(Session::has('pharmacies'))
<div style="width:80%" class="max-w-2xl mt-6 mx-auto ">
  <ul class="w-full grid grid-cols divide-y divide-gray-200">
    @foreach(Session('pharmacies') AS $pharma)
    <?php
    $startdate = explode('-', explode(' ', $pharma->startDate)[0]);
    $startdate = $startdate[2] . '-' . $startdate[1];
    $endDate = explode('-', explode(' ', $pharma->endDate)[0]);
    $endDate = $endDate[2] . '-' . $endDate[1] . '-' . $endDate[0];
    $typeGard = explode(':', $pharma->endHoure);
    $gmaps = $pharma->gmaps_url;
    if($typeGard[0] == '24'){
      $gard = 'Garde ' . $typeGard[0] . '/' . $typeGard[0];
    } else {
      $startHoure = explode(':', $pharma->startHoure);
      $startHoure = $startHoure[0] . ':' . $startHoure[1];
      $endHoure = $typeGard[0] . ':' . $typeGard[1];
      $gard = 'Ouvert de ' . $startHoure . ' à ' . $endHoure;
    }
    ?>
    <div style="font-family:Poppins, serif;" class="flex flex-row px-2 py-3  ">
      <div class="w-4/6  flex flex-col flex-shrink gap-1">
        <li style="color:#3B3B3B" class="text-base font-bold">Pharmacie <span style="font-size:0.9em; letter-spacing:1px;">{{ $pharma->name }}</span></li>
        <li style="color:rgb(53, 204, 128);" class="text-sm font-semibold">{{ $gard }}</li>
        <li  style="color:#3B3B3B" class="text-xs">{{ $pharma->address }}</li>
      </div>

      <div class="flex flex-col flex-grow gap-2 align-top w-2/6 ">

      <li><a href="tel:{{ $pharma->phone }}" target="_blank" style="background: rgba(3, 180, 198, 0.8);" class="colors block py-2 text-center font-bold capitalize tracking-wider text-xs sm:text-sm rounded ">📞&nbsp; Appeler</a></li>

      @if($gmaps != '')
      <li><a href="{{ $gmaps }}" target="_blank" style="background: rgb(68, 216, 158);" 
      class="colors block py-2 text-center font-bold capitalize tracking-wider text-xs sm:text-sm rounded ">
      📌&nbsp;Itinéraire</a></li>
      @else
      <li><a href="#" style="background: rgb(68, 216, 158);" disabled 
      class="text-white cursor-not-allowed block py-2 text-center font-bold capitalize tracking-wider text-xs sm:text-sm rounded ">
      📌&nbsp;Itinéraire</a></li>
      @endif

      </div>
    </div>
    @endforeach
  </ul>
</div>
@endif

@endsection
