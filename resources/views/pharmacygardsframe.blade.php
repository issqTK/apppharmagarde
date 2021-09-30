<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'Laravel') }}</title>

  <link href="{{ asset('css/app.css') }}" rel="stylesheet">

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400&display=swap" rel="stylesheet">

  <!-- Scripts -->
  <script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
  <!--Ionicons-->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

  <style>
    .active{
      background-color: white;
      color: #3B82F6;
      border: 1px solid #3B82F6;
    }
    .colors{ color:white; }
    .colors:hover{background:rgb(20 142 155 / 80%)!important;}
  </style>
</head>
<body>

@if(Session::has('pharmacies'))
  <div style="max-width:422.989px" class="w-full mt-4 mx-auto">
    <ul class="w-full grid grid-cols divide-y divide-gray-200">
      @foreach(Session('pharmacies') AS $pharma)
      <?php
      $startdate = explode('-', explode(' ', $pharma['startDate'])[0]);

      $startdate = $startdate[2] . '-' . $startdate[1];
      $endDate = explode('-', explode(' ', $pharma['endDate'])[0]);
      $endDate = $endDate[2] . '-' . $endDate[1] . '-' . $endDate[0];
      $gmaps = $pharma['gmaps_url'];

      $typeGard = explode(':', $pharma['endHoure']);
      if($typeGard[0] == '24'){
        $gard = 'Garde ' . $typeGard[0] . '/' . $typeGard[0];
      } else {
        $startHoure = explode(':', $pharma['startHoure']);
        $startHoure = $startHoure[0] . ':' . $startHoure[1];
        $endHoure = $typeGard[0] . ':' . $typeGard[1];
        $gard = 'Ouvert de ' . $startHoure . ' à ' . $endHoure;
      }
      ?>
      <div style="font-family:Poppins, serif;" class="relative flex flex-row px-2 py-3  ">
        <div class="w-4/6  flex flex-col flex-shrink gap-1">
          <li style="color:#3B3B3B" class="text-base font-bold">Pharmacie <span style="font-size:0.9em; letter-spacing:1px;">{{ $pharma['name'] }}</span></li>
          <li style="color:rgb(53, 204, 128);" class="text-sm font-semibold">{{ $gard }}</li>
          <li  style="color:#3B3B3B" class="text-xs">{{ $pharma['address'] }}</li>
        </div>

        <div class="flex flex-col flex-grow gap-2 align-top w-2/6  ">

          <li><a href="tel:{{ $pharma['phone'] }}" target="_blank" style="background: rgba(3, 180, 198, 0.8);" class="colors block py-2 text-center font-bold capitalize tracking-wider text-xs sm:text-sm rounded ">📞&nbsp; Appeler</a></li>
          
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

</body>
</html>
