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
      background-color: #60A5FA;
      color: white;
    }
    .colors{ color:white; }
    .colors:hover{background:rgb(20 142 155 / 80%)!important;}
  </style>
</head>
<body>
<nav class="block w-full fixed top-0 bg-white border-b-2 border-blue-400 ">
    <div class="max-w-7xl mx-auto px-2 lg:px-14 md:px-10 sm:px-6">
      <div class="relative flex items-center justify-between h-16 md:w-5/6 lg:3/6 w-full mx-auto">
       
        <!--Left Side-->
        <div class="flex">
          <!--Logo-->
          <div class="flex-shrink-0 flex items-center">
            <a href="{{ route('index') }}"><img class="block h-12 w-auto" src="{{ url('/parmagardeLogo.png') }}" alt="Pharmagarde"></a>
          </div>

          <!--left Nav-->
          <div class="sm:ml-4 md:ml-6 lg:ml-10 ml-2 flex items-center">
            <div class="flex relative space-x-4">

              @if(!Session::has('loggedAdmin'))

              <a href="{{ route('index') }}" 
              class="active text-blue-400 py-2 md:px-3 sm:px-2 px-1 md:text-sm text-xs font-semibold rounded-md" 
              aria-current="page" id="index">Accueil</a>

              <a href="javascript:void(0)" 
              class="text-blue-400 py-2 md:px-3 sm:px-2 px-1 md:text-sm text-xs  rounded-md font-medium" 
              id="cities-menu-button" aria-expanded="false" aria-haspopup="true"> Tout les villes 
              <ion-icon name="caret-down-outline" class="align-middle" id="fleshdown"></ion-icon> </a>

              <ul id="cities" role="menu" aria-orientation="vertical" aria-labelledby="cities-menu-button" tabindex="-1"
              class="hidden absolute z-1 right-0 top-11 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" >
                
                @foreach($cities as $citie)
                  
                <li class="">
                  <a href="{{ route('display', ['name' => $citie->slug]) }}" 
                    class="block text-black hover:text-white hover:bg-blue-200 px-6 py-2 text-sm font-medium">
                    {{ $citie->name }}</a>
                </li>
                  
                @endforeach
              
              </ul>

              @else

              <a href="{{ route('dashboard') }}" 
              class="active text-blue-400 py-2 md:px-3 sm:px-2 px-1 md:text-sm text-xs rounded-md font-medium" aria-current="page">
              Dashboard</a>

              @endif

            </div>
          </div>

        </div>
        <!--end left side-->

        <!--Right Side -->
        <div class="flex">
            @if(!Session::has('loggedAdmin'))

            <div class="flex items-center">

              <a href="{{ route('login') }}" style="letter-spacing:1px;"
              class="uppercase py-2 md:px-3 sm:px-2 px-1 text-xs font-semibold bg-blue-100 text-center text-blue-900 rounded" >
              <ion-icon name="log-in-outline" class="md:text-lg text-sm" style="vertical-align:bottom"></ion-icon>
              &nbsp;
              Admin Login</a>
              
            </div>

            @else

            <div class="flex items-center relative">
              <a href="javascript:void(0)" class="text-sm font-semibold text-blue-400" id="admin-button">
                <span>{{ Session::get('loggedAdmin')->username }}</span>
                <ion-icon name="caret-down-outline" class="align-middle" id="fleshdown"></ion-icon>
              </a>
              
              <div class="hidden z-10 absolute right-0 text-sm top-8 bg-white" id="admin-popup">
                <ul class="border-1 border-blue-100">
                  <li class="border-b-1 border-blue-100"><a href="{{ route('updateInfos') }}" style="width:150px"  class="block p-2 hover:bg-blue-400 hover:text-white">Last Updates Infos</a></li>
                  <li class=""><form action="{{ route('logout') }}" method="post" class="w-full">
                      @csrf 
                      <button type="submit" class="w-full p-2 text-left hover:bg-blue-400 hover:text-white">Logout</button> 
                      </form>
                  </li>
                </ul>
              </div>
              
            </div>

            @endif

        </div> 
        <!--end right side-->

      </div>
    </div>
</nav>
<div class="block h-16 border"></div>
@yield('content')


<script>
$( function(){
    var pathname = $(location).attr('pathname');
    var regex = new RegExp('^/pharmacie-de-garde-[a-z]*[a-z]*$');

    if (!regex.test(pathname)) {
      $('#cities-menu-button').click(function(){
        $('#cities').stop().fadeToggle();
        if(!$(this).hasClass('active')) { $(this).addClass('active'); $('#index').removeClass('active'); }
        else { $(this).removeClass('active'); $('#index').addClass('active'); }
      });
      $('body').click(function(event){
        var target = $(event.target);
        if(!target.parents().is("#cities-menu-button") && !target.is("#cities-menu-button") && !target.is('#cities') && !target.parents().is('#cities')){
            $('#cities').stop().fadeOut();
            $("#cities-menu-button").removeClass('active');
            $('#index').addClass('active');
        }
      });

    } else {
      $("#cities-menu-button").addClass('active');
      $('#index').removeClass('active');
      $('#cities-menu-button').click(function(){ $('#cities').stop().fadeToggle(); });
      $('body').click(function(event){
        var target = $(event.target);
        if(!target.parents().is("#cities-menu-button") && !target.is("#cities-menu-button") && !target.is('#cities') && !target.parents().is('#cities')){
            $('#cities').stop().fadeOut();
        }
      });
    }

    $('#admin-button').click(function(){ $('#admin-popup').stop().fadeToggle(); });

    $('body').click(function(event){
      var target = $(event.target);
      if(!target.parents().is("#admin-button") && !target.parents().is("#admin-popup") ){
          $('#admin-popup').stop().fadeOut();
      }
    });

    $('#register').click(function(){ $('#loginPopup').hide(); $('#registerPopup').show(); });
    $('#login').click(function(){ $('#loginPopup').show(); $('#registerPopup').hide(); });

    $('.show').click(function(){  $(this).hide(); $(this).siblings().show();  });

});
</script>
</body>

</html>
