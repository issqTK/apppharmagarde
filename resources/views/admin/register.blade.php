@extends('layouts.app')

@section('content')

<div class="md:w-4/6 lg:3/6 w-full mx-auto mt-6 px-2 lg:px-14 md:px-10 sm:px-6">
    <div class="flex flex-col" id="loginPopup">
        <form action="{{ route('save') }}" method="post" class="flex flex-col">
            @csrf
            <label class="w-full py-2 pl-4 rounded bg-indigo-400 text-white text-medium font-semibold" for="username">Administrator Register</label>

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

            <div class="flex flex-col">
                <label for="password-confirm" class="p-2 text-sm text-gray-500">Reenter Password</label>
                <input type="password" name="password_confirmation" id="password-confirm" placeholder="Password Confirm" class="p-2 mx-2 border rounded">
                <span class="text-red-500 text-xs mt-1 px-2">@error('password_confirmation'){{ $message }}@enderror</span>
            </div>

            <br>

            <div class="relative">
                <button type="submit" class="absolute right-2 bottom-0 px-10 py-1 bg-gradient-to-r from-indigo-700 to-indigo-400 text-white rounded hover:from-indigo-400 hover:to-indigo-700 border border-black">Register</button>
                <a href="{{route('login')}}" class="uppercase text-xs p-2  text-indigo-700" id="register">Go To Login</a>
            </div>

            
        </form>
    </div>
    
    <br>

    @if(Session::has('success')) <div class="block p-2 mx-2 rounded bg-green-500 text-white"> {{ Session::get('success') }}  </div> @endif
</div>

@endsection