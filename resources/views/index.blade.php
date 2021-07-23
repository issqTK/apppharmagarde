@extends('layouts.app')

@section('content')

<div class="md:w-4/6 lg:3/6 w-full mx-auto mt-6 px-2 lg:px-14 md:px-10 sm:px-6">
  <div class="" style="padding-left:1%">
     
    @foreach($cities as $city)
    <div style="display:inline-block;width:47%!important; margin:0 1% 23px 1%;">
      <a href="{{ route('displayframe', ['name' => $city->slug]) }}" 
        class="block w-full text-sm text-center py-2 font-semibold text-blue-600 hover:bg-gray-100 hover:text-blue-900 bg-gray-50 rounded border">
        Show Iframe <span class="font-bold uppercase text-xs">{{ $city->name }}</span></a>
    </div>
    @endforeach

  </div>
</div>

@endsection
