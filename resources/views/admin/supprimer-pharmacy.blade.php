@extends('layouts.app')

@section('content')

<h3 class="h3">Supprimer Pharmacie </h3>

<div class="deletePharma">
    
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

    <form action="{{ route('bringpharmacy2') }}" method="post">
        @csrf
        <label class="" for="phone">Numéro de Téléphone</label>
        
        <input type="text" name="phone" id="phone" placeholder="Phone">
       
        @error('phone')
        <span class="text-red-400 text-sm">{{ $message }}</span>
        @enderror

        <input type="submit" class="submit font-semibold text-base" value="Lister" />
    </form>

    @if(Session::has('exist'))
        <div class="listed">
            <div class="inside-listed">
                <div>
                    <span>Numéro de Téléphone</span>
                    <p>{{ Session::get('exist')->phone }}</p>
                </div>

                <div>
                    <span>Nom de Pharmacie</span>
                    <p>{{ Session::get('exist')->name }}</p>
                </div>

                <div>
                    <span>Adresse de Pharmacie</span>
                    <p>{{ Session::get('exist')->address }}</p>
                </div>

                <div>
                    <span>Ville ID</span>
                    <p>{{ Session::get('exist')->city_id }}</p>
                </div>

                <div>
                    <span>Gmaps Localisation</span>
                    <p style="overflow-x: scroll;">{{ Session::get('exist')->gmaps_url }}</p>
                </div>

                <div>
                    <span>Latitude</span>
                    <p>{{ Session::get('exist')->lat }}</p>
                </div>

                <div>
                    <span>Long</span>
                    <p>{{ Session::get('exist')->long }}</p>
                </div>
            </div>

            <a href="javascript:void(0)" id="show-listed">Afficher toutes les données Pharmacie</a>
        </div>


        <div class="deleteNow">
            <h3 class="h3" style="max-width:100%!important">Etes-vous sûr de vouloir supprimer 'Current Pharmacy' et ces gardes</h3>
            
            <form action="{{ route('deletenow') }}" method="post">
                @csrf

                <input type="hidden" name="pharmacyId" value="{{ Session::get('exist')->id }}">

                <input type="submit" value="Supprimer" class="submit">
            </form>
        </div>
    @endif
</div>

@endsection