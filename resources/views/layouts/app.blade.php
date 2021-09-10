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

  <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>
<body>

<nav id="mainNav">
    <span id="hideNav">
        <ion-icon name="close-circle-outline"></ion-icon>
    </span>
    
    <!--Logo-->
    <div class="logo">
        <a href="{{ route('index') }}"> <img src="{{ url('/logo.jpg') }}" alt="Pharmagarde" draggable="false"> </a>
    </div>
    
@if(!Session::has('loggedAdmin'))
    
    <a href="{{ route('login') }}" class="login">
        <ion-icon name="log-in-outline" class="md:text-xl text-sm" style="vertical-align:bottom"></ion-icon>
        &nbsp;
        Se Connecter
    </a>
    
@else    
    
    <div class="user-nav" id="admin-button">
        <img src="{{url('/user.jpg')}}" alt="user_picture" />
        <span class="font-semibold" id="admin-button">
            {{ Session::get('loggedAdmin')->username }}
            <ion-icon name="caret-down-outline" class="align-middle" id="fleshdown"></ion-icon>
        </span>
        <div class="logout">
            <a href="{{ route('logout') }}" id="admin-popup">Se déconnecter</a>
        </div>
    </div>
    
@endif
    
    <ul class="nav">
        
        <li class="subnav"><a href="{{ route('index') }}" class="click-subnav">Dashboard</a></li>
        
        <li class="subnav">
            <a href="javascript:void(0)" class="click-subnav">Garde</a>
            <div class="block">
                <ul>
                    <li><a href="{{ route('listergarde') }}">Lister</a></li>
                    <li><a href="{{ route('listergardeframe') }}">Lister Iframe</a></li>
                    <li><a href="{{ route('viewAddGarde') }}">Ajouter</a></li>
                </ul>
            </div>
        </li>
        
        <li class="subnav">
            <a href="javascript:void(0)" class="click-subnav">Pharmacie</a>
            <div  class="block">
                <ul>
                    <li><a href="{{ route('getGesPharma') }}">Gérer Pharmacies</a></li>
                    <li><a href="{{ route('viewAddPharma') }}">Ajouter une Pharmacie</a></li>
                    <li><a href="{{ route('viewdeleteGarde') }}">Supprimer une Pharmacie</a></li>
                </ul>
            </div>
        </li>
        
        <li class="subnav">
            <a href="javascript:void(0)" class="click-subnav">Scraping</a>
            <div class="block">
                <ul>
                    <li><a href="{{ route('updateInfos') }}">Activité</a></li>
                    <li><a href="{{ route('scrapping') }}">Administrer Scraping</a></li>
                </ul>
            </div>
        </li>
        
        <li><a href="#">Contact</a></li>
    </ul>
    
</nav>
  
<div class="fake"></div>
    
<div  class="mainpage">
    <span id="showNav">
        <ion-icon name="apps-outline"></ion-icon>
    </span>
    
    <div class="hideMain"></div>
    
@yield('content')
    
</div>
    
<script src="{{ url('./js/custom.js') }}"></script>

</body>

</html>
