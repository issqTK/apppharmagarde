@extends('layouts.app')

@section('content')
<div class="md:w-4/6 lg:3/6 w-full mx-auto mt-6 px-2 lg:px-14 md:px-10 sm:px-6">
    <div class="static flex flex-col" id="loginPopup">
        <form action="{{ route('check') }}" method="post" class="flex flex-col">
            @csrf
            <label class="w-full py-2 pl-4 rounded bg-indigo-400 text-white text-medium font-semibold" for="username">Admin Login</label>
            
            <br>

            <div class="flex flex-col  mb-2">
                <label for="username" class="p-2 text-sm text-gray-500">Enter Admin Username</label>
                <input type="text" name="username" id="username" placeholder="Username" class="p-2 mx-2 border rounded" value="{{ old('username') }}">
                <span class="text-red-500 text-xs mt-1 px-2">@error('username'){{ $message }}@enderror</span>
            </div>

            <div class="flex flex-col">
                <label for="password" class="p-2 text-sm text-gray-500">Enter Admin Password</label>
                <input type="password" name="password" id="password" placeholder="Password" class="p-2 mx-2 border rounded">
                <span class="text-red-500 text-xs mt-1 px-2">@error('password'){{ $message }}@enderror</span>
            </div>

            <br>

            <div class="relative">
                <button type="submit" class="float-right px-10 py-1 bg-gradient-to-r from-indigo-700 to-indigo-400 text-white rounded hover:from-indigo-400 hover:to-indigo-700 border border-black">Login</button>
                <a href="{{route('register')}}" class="uppercase text-xs p-2  text-indigo-700" id="register">Go To Register</a>
            </div>

        </form>
    </div>
    <br>
    @if(Session::has('fail')) <div class="block p-2 mx-2 rounded bg-red-500 text-white"> {{ Session::get('fail') }} </div>  @endif

</div>

@endsection