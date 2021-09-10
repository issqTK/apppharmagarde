@extends('layouts.app')

@section('content')

<h3 class="h3">Update Pharmacie </h3>

<ul class="edit">

    <form action="{{ route('updatePharmacy', ['id' => $pharmacy->id]) }}" method="post" class="w-full">
        @csrf
        <div class="contains">
            <li><label class="label">Numéro de Téléphone</label></li>
            <li><input type="text" name="phone" disabled value="{{ $pharmacy->phone }}" ></li>
        </div>

        <div class="contains">
            <li><label class="label">Nom de Pharmacie</label></li>
            <li><input type="text" name="name" value="{{ $pharmacy->name }}"></li>
            @error('name')
             <span class="text-red-400 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div class="contains">
            <li><label class="label">Adresse de Pharmacie</label></li>
            <li class=""><input type="text" name="address" value="{{ $pharmacy->address }}" ></li>
            @error('address')
             <span class="text-red-400 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="contains">
            <li><label class="label">Gmaps Localisation</label></li>
            <li><input type="text" name="gmaps" value="{{ $pharmacy->gmaps_url }}"></li>
            @error('gmaps')
             <span class="text-red-400 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="contains">
            <li><label class="label">Latitude</label></li>
            <li><input type="text" name="lat" value="{{ $pharmacy->lat }}" ></li>
            @error('lat')
             <span class="text-red-400 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="contains">
            <li><label class="label">Longitude</label></li>
            <li><input type="text" name="long" value="{{ $pharmacy->long }}"></li>
            @error('long')
             <span class="text-red-400 text-sm">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="contains">
            <li><span class="label">Is Qualifiées</span></li>
            @if($pharmacy->qualifier == 1)
            <li><input type="checkbox" name="qualifiedTrue" id="qualified" checked> <label for="qualified">True</label></li>
            @else
            <li><input type="checkbox" name="qualifiedTrue" id="qualified" > <label for="qualified">True</label></li>
            @endif
        </div>

        <div class="contains">
            <li>
                <input type="submit" value="Enregister" class="submit font-semibold" >
            </li>
            
        </div>

    </form>
</ul>

@endsection