@extends('layouts.app')

@section('content')
<div style="width:80%;margin:auto;" class="p-4 border">
    <div class="static flex flex-col">
        <form action="{{ route('check') }}" method="post" class="flex flex-col">
            @csrf
            <h3 style="background:rgba(3, 180, 198, 0.8);" class="w-full uppercase py-2 pl-4 rounded text-white text-md font-semibold" for="username">Se Connecter <span class="text-sm">(Admin)</span></h3>
            
            <br>

            <div class="flex flex-col  mb-2">
                <label for="username" class="p-2 text-base text-gray-500">Admin Username</label>
                <input type="text" name="username" id="username" placeholder="Username" class="p-2 mx-2 border rounded" value="{{ old('username') }}">
                <span class="text-red-500 text-base mt-1 px-2">@error('username'){{ $message }}@enderror</span>
            </div>
            
            
            <div class="flex flex-col">
                <label for="password" class="p-2 text-base text-gray-500">Admin Mot de passe</label>
                <input type="password" name="password" id="password" placeholder="Password" class="p-2 mx-2 border rounded">
                <span class="text-red-500 text-base mt-1 px-2">@error('password'){{ $message }}@enderror</span>
            </div>

            <br>
            <div class="relative">
                <button type="submit" 
                 class="submit float-right  font-semibold ">Connecter</button>
                
                <a href="{{route('register')}}" class="uppercase text-base font-semibold p-2" style="color:rgb(20 142 155 / 80%)" id="register">Créer un Compte</a>
            </div>

        </form>
    </div>
    <br>
    @if(Session::has('fail')) <div class="block text-base p-2 mx-2 rounded bg-red-500 text-white"> {{ Session::get('fail') }} </div>  @endif

</div>

@endsection