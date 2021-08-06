@extends('layouts.app')

@section('content')

<div class="flex flex-col md:w-5/6 lg:3/6 w-full mx-auto mt-4 px-2 lg:px-14 md:px-10 sm:px-6" >
    <h1 class="w-full text-md font-semibold uppercase text-center text-white tracking-wider py-2 bg-gradient-to-r from-blue-400  to-blue-100 rounded">
        Filter Pharmacies</h1>
    <div class="w-2/4 mx-auto mt-4">
        <form action="{{ route( 'filter' ) }}" method="post">
        @csrf
            <label for="phone" class="text-md">Phone Number</label> <br>
            <input type="text" name="phone" id="phone" placeholder="Ex:0555555555" class="w-full px-2 py-1 border">
            <hr class="my-2">
            <label for="city" class="text-md">City</label> <br>
            <select name="city" id="city"  class="w-full px-2 py-1 mb-2 border">
                <option value="" selected disabled hidden>Choose here</option>
                @foreach($cities AS $city)
                <option value="{{ $city->id }}" >{{ $city->name }}</option>
                @endforeach
            </select>
            <label for="gmaps" class="text-md">Gmaps_URL IS NULL</label> &nbsp;&nbsp;
            <input type="checkbox" name="gmaps" disabled id="gmaps"> 
            <br><br>
            <input type="submit" value="Search" id="submit" disabled class="py-2 px-4 uppercase text-sm font-semibold rounded text-white bg-blue-200 ">
        </form>
    </div>

    <div class="flex flex-col w-full mt-4 p-2">
            @if(Session::has('fail'))
            <span class="block w-full text-md font-semibold text-center text-red-400">{{ Session::get('fail') }}</span>
            @endif
            @if(Session::has('success'))
            <span class="block w-full text-md font-semibold text-center text-green-400">{{ Session::get('success') }}</span>
            @endif

            @if(Session::has('datas') )
            <table class="w-full border">
                <tr class="bg-blue-400 font-semibold uppercase text-xs ">
                    <th class="text-center">Phone</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Address</th>
                    <th class="text-center">gmapsUrl</th>
                    <th class="text-center">Lat</th>
                    <th class="text-center">Long</th>
                    <th class="text-center">cityID</th>
                    <th class="text-center">+</th>
                </tr>
                <tbody class="text-gray-600 text-sm font-light">
                @foreach(Session::get('datas') AS $data)
                    <tr>
                        <td>{{$data->phone}}</td>
                        <td>{{$data->name}}</td>
                        <td>{{$data->address}}</td>
                        <td class="max-w-md overflow-x-hidden">{{$data->gmaps_url}}</td>
                        <td>{{$data->lat}}</td>
                        <td>{{$data->long}}</td>
                        <td>{{$data->city_id}}</td>
                        <td><a href='{{ route("getPharmacy", ["id" => $data->id]) }}' class="uppercase text-blue-500">Edit</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            @endif
    </div>
</div>
<script>
    jQuery(function () {
        $( "#phone" ).keyup(function () {
            if($( this ).val().length > 0) {
                $('#city').prop('disabled', true);
                $('#gmaps').prop('disabled', true);
                var regex = new RegExp('^[0-9]+$');
                var phone = $( this ).val();
                if(phone.length == 10 && regex.test(phone)){
                    $('#submit').prop('disabled', false);
                    $('#submit').removeClass('bg-blue-200').addClass('bg-blue-400');
                } else {
                    $('#submit').prop('disabled', true);
                    $('#submit').removeClass('bg-blue-400').addClass('bg-blue-200');
                }
            } else {
                $('#city').prop('disabled', false);
                $('#gmaps').prop('disabled', false);
            }
        });

        $( "#city" ).change(function () {
            $('#city option:selected').each(function() {
                if( $(this).val() !== '') {
                    $('#phone').prop( "disabled", true );
                    $( '#gmaps' ).prop('disabled', false);
                    $( '#submit' ).prop('disabled', false);
                    $('#submit').removeClass('bg-blue-200').addClass('bg-blue-400');
                }
            });               
        })
    });
   
    
</script>
@endsection