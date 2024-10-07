@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-10">
    <div class="max-w-md mx-auto bg-white p-8 border rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold mb-6 text-center">Register</h2>
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="mb-4">
                <label for="name" class="block mb-2">Name</label>
                <input type="text" name="name" id="name" class="w-full px-3 py-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label for="email" class="block mb-2">Email</label>
                <input type="email" name="email" id="email" class="w-full px-3 py-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label for="password" class="block mb-2">Password</label>
                <input type="password" name="password" id="password" class="w-full px-3 py-2 border rounded" required>
            </div>
            <div class="mb-6">
                <label for="password_confirmation" class="block mb-2">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="w-full px-3 py-2 border rounded" required>
            </div>
            <button type="submit" class="w-full bg-yellow-500 text-white py-2 rounded hover:bg-yellow-600">Register</button>
        </form>
        <div class="mt-4 text-center">
            <a href="{{ route('login') }}" class="text-blue-500 hover:text-blue-700">Already have an account? Login here!</a>
        </div>
    </div>
</div>
@endsection