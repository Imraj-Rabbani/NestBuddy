@extends('user.layouts.template')
@section('title')
 Listed Rooms
@endsection

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Available Flats</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        
        @foreach ($rooms as $room)
        
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <img src="{{$room->photo}}" alt="Flat Image" class="w-full h-48 object-cover"> 
            <div class="p-4">
                <h2 class="text-lg font-semibold mb-2">Room Available for Rent</h2>
                <p class="text-gray-700">Rent: {{ $room->rent  }} BDT</p>
                <p class="text-gray-700 mb-4">Description {{ $room->description }}</p>
                
                <a href="{{ route('roomdetails', ['flat_id' => $room->flat_id, 'room_number' => $room->room_number]) }}" 
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                     Show Details
                 </a>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection