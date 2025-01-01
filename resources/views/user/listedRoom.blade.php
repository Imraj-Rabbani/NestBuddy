@extends('user.layouts.template')
@section('title')
    List Your Flat
@endsection

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Available Flats</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        
        @foreach ($rooms as $room)
        
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <img src="{{ asset('photos/test.jpg') }}" alt="Flat Image" class="w-full h-48 object-cover"> 
            <div class="p-4">
                <h2 class="text-lg font-semibold mb-2">Room Available for Rent</h2>
                <p class="text-gray-700">Rent: {{ $room->rent  }} BDT</p>
                <p class="text-gray-700">Description {{ $room->description }}</p>
                <form action="{{ route('placebid', [$room->flat_id,$room->room_number]) }}" method="POST">
                    @csrf
                    <div class="flex items-center mt-2">
                        <label for="bid_price" class="mr-2">Bid Price:</label>
                        <input type="number" id="bid_price" name="bid_price" class="border border-gray-300 rounded-md p-2" min="1" step="0.01" required>
                    </div>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-2">Place Bid</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection