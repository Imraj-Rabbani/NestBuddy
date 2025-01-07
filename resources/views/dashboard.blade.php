@extends('user.layouts.template')
@section('title')
    Homepage
@endsection

@section('content')
@if (session('success'))
    <div class="bg-green-100 border text-center border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
@endif
<div class="container mx-auto px-4 py-16">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="border-4 border-blue-500 rounded-lg p-6 hover:bg-blue-500 hover:text-white transition duration-300 ease-in-out transform hover:-translate-y-1">
            <h3 class="text-xl font-bold mb-4">Find Your Perfect Flat</h3>
            <p>Browse through thousands of flats for rent, filter by location, budget, and amenities.</p>
            <a href="{{route('listedroom')}}" class="inline-block bg-blue-500 text-white hover:bg-white hover:text-blue-500 rounded-full px-4 py-2 mt-4">Find Flats</a>
        </div>

        <div class="border-4 border-blue-500 rounded-lg p-6 hover:bg-blue-500 hover:text-white transition duration-300 ease-in-out transform hover:-translate-y-1">
            <h3 class="text-xl font-bold mb-4">Order Delicious Food Online</h3>
            <p>Discover a wide variety of restaurants and cuisines, and have your favorite dishes delivered to your doorstep.</p>
            <a href="{{route('shops')}}" class="inline-block bg-blue-500 text-white hover:bg-white hover:text-blue-500 rounded-full px-4 py-2 mt-4">Order Food</a>
        </div>

        <div class="border-4 border-green-500 rounded-lg p-6 hover:bg-green-500 hover:text-white transition duration-300 ease-in-out transform hover:-translate-y-1">
            <h3 class="text-xl font-bold mb-4">List Your Flat</h3>
            <p>Reach thousands of potential tenants and find reliable renters for your property.</p>
            <a href="{{route('listflat')}}" class="inline-block bg-green-500 text-white hover:bg-white hover:text-green-500 rounded-full px-4 py-2 mt-4">List Now</a>
        </div>

        <div class="border-4 border-green-500 rounded-lg p-6 hover:bg-green-500 hover:text-white transition duration-300 ease-in-out transform hover:-translate-y-1">
            <h3 class="text-xl font-bold mb-4">Sell Food Online</h3>
            <p>Expand your reach and connect with hungry customers looking for delicious food.</p>
            <a href="{{route('createshop')}}" class="inline-block bg-green-500 text-white hover:bg-white hover:text-green-500 rounded-full px-4 py-2 mt-4">Sell Food</a>
        </div>
    </div>
</div>
@endsection()