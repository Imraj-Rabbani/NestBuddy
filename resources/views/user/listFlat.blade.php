@extends('user.layouts.template')
@section('title')
    List Your Flat
@endsection

@section('content')
<div class="container border-black border-2 rounded-2xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-8 text-center ">Add Your Flat Information</h1>

    <form action="{{route('saveFlat')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="flex justify-evenly">
            <div>
                <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                <input type="text" id="city" name="city" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                @error('city')
                    <p class="text-red-500 mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="area" class="block text-sm font-medium text-gray-700">Area</label>
                <input type="text" id="area" name="area" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                @error('area')
                    <p class="text-red-500 mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="road_number" class="block text-sm font-medium text-gray-700">Road Number</label>
                <input type="text" id="road_number" name="road_number" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                @error('road_number')
                    <p class="text-red-500 mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="building_number" class="block text-sm font-medium text-gray-700">Building Number</label>
                <input type="text" id="building_number" name="building_number" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                @error('building_number')
                    <p class="text-red-500 mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="flat_number" class="block text-sm font-medium text-gray-700">Flat Number</label>
                <input type="text" id="flat_number" name="flat_number" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                @error('flat_number')
                    <p class="text-red-500 mt-2">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="mt-6">
            <table class="table-auto border border-gray-500 min-w-full divide-y divide-gray-500">
                <thead>
                    <tr>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Room Number</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rent</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Photos</th>
                        <th class="px-6 py-3 bg-gray-50"></th>
                    </tr>
                </thead>
                <tbody id="room-rows">
                    <tr class="room-row">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <input type="text" name="room_number[]" class="border border-gray-300 rounded-md p-2 w-full focus:outline-none focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <input type="number" name="rent[]" class="border border-gray-300 rounded-md p-2 w-full focus:outline-none focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <textarea name="description[]" rows="2" class="border border-gray-300 rounded-md p-2 w-full focus:outline-none focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <input type="file" name="photos[]" class="border border-gray-300 rounded-md p-2 w-full focus:outline-none focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right">
                            <button type="button" onclick="removeRow(this)">
                                <img src="{{asset('assets/remove.png')}}" class="w-[25px]">
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <button type="button" class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" onclick="addRow()">Add Row</button>
        <div class="text-center">
            <button type="submit" class="mt-4 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Submit</button>
            </div>
    </form>
</div>




@endsection