@extends('layouts.app')

@section('content')

<div class="flex flex-col md:w-5/6 lg:3/6 w-full mx-auto mt-4 px-2 lg:px-14 md:px-10 sm:px-6" >
<h1 class="text-lg font-semibold tracking-wider text-blue-400 my-2">Update Current Pharmacy</h1>
    <ul class="text-gray-800">
        
        <form action="{{ route('updatePharmacy', ['id' => $pharmacy->id]) }}" method="post" class="w-full">
            @csrf
            <div class="contains">
                <li><label>Phone Number</label></li>
                <li><input type="text" name="phone" disabled value="{{ $pharmacy->phone }}" ></li>
            </div>
            <div class="contains">
                <li><label>Name</label></li>
                <li><input type="text" name="name" value="{{ $pharmacy->name }}"></li>
                @error('name')
                 <span class="text-red-400 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="contains">
                <li><label>Address</label></li>
                <li class=""><input type="text" name="address" value="{{ $pharmacy->address }}" ></li>
                @error('address')
                 <span class="text-red-400 text-sm">{{ $message }}</span>
                @enderror
            </div>
           
            <div class="contains">
                <li><label>Gmaps Url</label></li>
                <li><input type="text" name="gmaps" value="{{ $pharmacy->gmaps_url }}"></li>
                @error('gmaps')
                 <span class="text-red-400 text-sm">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="contains">
                <li><label>Latitude</label></li>
                <li><input type="text" name="lat" value="{{ $pharmacy->lat }}" ></li>
                @error('lat')
                 <span class="text-red-400 text-sm">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="contains">
                <li><label>Longitude</label></li>
                <li><input type="text" name="long" value="{{ $pharmacy->long }}"></li>
                @error('long')
                 <span class="text-red-400 text-sm">{{ $message }}</span>
                @enderror
            </div>
            
            <li><input type="submit" value="Update" class="py-2 px-4 mt-2 text-md font-semibold text-white bg-blue-400 rounded cursor-pointer" ></li>
            
        </form>
    </ul>
</div>

@endsection