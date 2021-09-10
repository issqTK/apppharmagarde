@extends('layouts.app')

@section('content')

<h3 class="h3">Ajouter Une Pharmacie </h3>

<ul class="add">

    <form action="{{ route('addpharmacy') }}" method="post" class="w-full">
        @csrf

        <div class="message">
            @if(Session::has('fails'))

            <div class="fails">
                <h4>Message</h4>
                <p>{{ Session::get('fails') }}</p>
            </div>

            @elseif(Session::has('success'))

            <div class="success">
                <h4>Message</h4>
                <p>{{ Session::get('success') }}</p>
            </div>

            @endif
        </div>

        <div class="contains">
            <li><label class="label">Numéro de Téléphone</label></li>
            <li><input type="text" name="phone" placeholder="Phone" value="{{ old('phone') }}" ></li>
            @error('phone')
             <span class="text-red-400 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="contains">
            <li><label class="label">Nom de Pharmacie</label></li>
            <li><input type="text" name="name" placeholder="Name" value="{{ old('name') }}"></li>
            @error('name')
             <span class="text-red-400 text-sm">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="contains">
            <li><label class="label">Adresse de Pharmacie</label></li>
            <li class=""><input type="text" name="address" placeholder="Address" value="{{ old('address') }}"></li>
            @error('address')
             <span class="text-red-400 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="contains">
            <li><label class="label">Ville</label></li>
            <li class="">
                <select name="city" id="city" >
                    <option value="" selected disabled hidden>Choisir une Ville</option>
                    @foreach($cities AS $city)
                    <option value="{{ $city->id }}" >{{ $city->name }}</option>
                    @endforeach
                </select>
            </li>
            @error('address')
             <span class="text-red-400 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="contains">
            <li><label class="label">Gmaps Localisation</label></li>
            <li><input type="text" name="gmaps" placeholder="Gmaps" value="{{ old('gmaps') }}"></li>
            @error('gmaps')
             <span class="text-red-400 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="contains">
            <li><label class="label">Latitude</label></li>
            <li><input type="text" name="lat" placeholder="Latitude" value="{{ old('lat') }}"></li>
            @error('lat')
             <span class="text-red-400 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="contains">
            <li><label class="label">Longitude</label></li>
            <li><input type="text" name="long" placeholder="Longitude" value="{{ old('long') }}"></li>
            @error('long')
             <span class="text-red-400 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="contains">
            <li>
                <input type="submit" value="Enregister" class="submit font-semibold" >
            </li>
            
        </div>

    </form>
</ul>

@endsection