@extends('user.layouts.template')
@section('title')
    Room Details
@endsection

@section('content')
    <div class="container mx-auto p-4">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <img src="{{$room->photo}}" alt="Flat Image" class="w-full h-[600px]">
            <div class="p-6">
                <h2 class="text-2xl font-semibold mb-4">Room Details</h2>
                <p class="text-gray-700 mb-2">Flat Number: {{ $room->flat_number }}</p>
                <p class="text-gray-700 mb-2">Building Number: {{ $room->building_number }}</p>
                <p class="text-gray-700 mb-2">Road Number: {{ $room->road_number }}</p>
                <p class="text-gray-700 mb-2">City: {{ $room->city }}</p>
                <p class="text-gray-700 mb-2">Area: {{ $room->area }}</p>
                <p class="text-gray-700 mb-2">Rent: {{ $room->rent }} BDT</p>
                <p class="text-gray-700 mb-4">Description: {{ $room->description }}</p>


                <div class="border my-2"></div>
                <h3 class="text-xl font-semibold mb-4">Place Bid</h3>
                <form action="{{ route('placebid', [$room->flat_id, $room->room_number]) }}" method="POST"
                    class="flex items-center">
                    @csrf
                    <label for="bid_price" class="mr-2">Bid Price:</label>
                    <input type="number" id="bid_price" name="bid_price"
                        class="border border-gray-300 rounded-md p-2 w-[50%]" required>
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2">Place Bid</button>
                </form>

                <div class="border my-2"></div>
                <h3 class="text-xl font-semibold mb-4">Bids placed by Tenants</h3>
                <div class="space-y-4">
                    @foreach ($bids as $bid)
                        <div class="border p-4 rounded-md">
                            <p>Bid Price: {{ $bid->bid_amount }} BDT</p>
                            <p>Placed By: {{ $bid->name }}</p>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
@endsection
