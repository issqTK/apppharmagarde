@extends('layouts.app')

@section('content')

<h3 class="h3">Ajouter pharmacie en garde</h3>

<div class="addgarde">
    
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

    <form action="{{ route('bringpharmacy') }}" method="post">
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

            <a href="javascript:void(0)" id="show-listed">Affiche Tout</a>
        </div>


        <div class="ajoutegarde">
            <h3 class="h3" style="max-width:100%!important">Ajouter une garde pour cette pharmacie</h3>
            
            @if(Session::has('error_date'))
            
            <div class="submessage">
                <div class="fails">
                    <h4>Message</h4>
                    <p>{{ Session::get('error_date') }}</p>
                </div>
            </div>

            @endif

            <form action="{{ route('addguard') }}" method="post">
                @csrf

                <label for="startdate">La Date de Début </label>
                <input type="datetime-local" name="startDate" id="startDate"  value="2021-09-09T00:00:00" style="margin-bottom:10px">
                @error('startDate')
                    <span class="text-red-400 text-sm">{{ $message }}</span>
                @enderror


                <label for="endDate">La Date de Fin </label>
                <input type="datetime-local" name="endDate" id="endDate"  value="2021-10-09T00:00:00" style="margin-bottom:10px">
                @error('endDate')
                    <span class="text-red-400 text-sm">{{ $message }}</span>
                @enderror

                <label for="guard-type">Le type de Garde </label>
                <select name="guardType" id="guard-type">
                    <option value="" disabled selected>Choisir le type de garde</option>
                    <option value="24h">24h</option>
                    <option value="jour">Jour</option>
                    <option value="nuit">Nuit</option>
                </select>
                @error('guardType')
                    <span class="text-red-400 text-sm">{{ $message }}</span>
                @enderror


                <input type="hidden" name="pharmaId" value="{{ Session::get('exist')->id }}">
                
                <input type="submit" value="Enregister" class="submit">
            </form>
        </div>
    @endif
</div>

@endsection