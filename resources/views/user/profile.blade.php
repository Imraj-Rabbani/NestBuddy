@extends('user.layouts.template')
@section('title')
    Create Your Shop
@endsection

@section('content')
    {{-- Personal Information --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="p-6 ">
                            <h3 class="text-lg font-medium mb-4">Personal Information</h3>
                            <form action="{{ route('updateuserprofile') }}" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                                    <input type="text" id="name" name="name"
                                        value="{{ old('name', $user->name) }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200" />
                                </div>
                                <div class="mb-4">
                                    <label for="email" class="block text-sm font-medium text-gray-700">Email
                                        Address</label>
                                    <input type="email" id="email" name="email"
                                        value="{{ old('email', $user->email) }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200" />
                                </div>
                                <div class="mb-4">
                                    <label for="age" class="block text-sm font-medium text-gray-700">Age</label>
                                    <input type="number" id="age" name="age" value="{{ old('age', $user->age) }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200" />
                                </div>
                                <div class="mb-4">
                                    <label for="occupation"
                                        class="block text-sm font-medium text-gray-700">Occupation</label>
                                    <input type="text" id="occupation" name="occupation"
                                        value="{{ old('occupation', $user->occupation) }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200" />
                                </div>
                                <div class="mb-4">
                                    <label for="user_type" class="block text-sm font-medium text-gray-700">User Type</label>
                                    <div>
                                        <input type="checkbox" name="B_flag" id="bachelor"
                                            {{ $user->B_flag == 1 ? 'checked' : '' }}>
                                        <label for="bachelor" class="ml-2">Bachelor</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="H_flag" id="home_owner"
                                            {{ $user->H_flag == 1 ? 'checked' : '' }}>
                                        <label for="home_owner" class="ml-2">Home Owner</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="S_flag" id="shop_owner"
                                            {{ $user->S_flag == 1 ? 'checked' : '' }}>
                                        <label for="shop_owner" class="ml-2">Shop Owner</label>
                                    </div>
                                </div>
                                <button type="submit"
                                    class="inline-flex items-center px-4 py-2 bg-blue-500 border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Save Changes
                                </button>
                            </form>
                        </div>
                    </div>


                    @if (count($properties) != 0)
                        <div class="border"></div>
                        <h3 class="text-lg font-medium m-4">My Properties</h3>
                        <table class="w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th
                                        class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Flats</th>
                                    <th
                                        class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Room Number</th>
                                    <th
                                        class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Rent Price</th>
                                    <th
                                        class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Rent Status</th>
                                    <th class="px-6 py-3 bg-gray-50"></th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($properties as $property)
                                    <tr>
                                        {{-- @dd($property); --}}
                                        <form
                                            action="{{ route('updaterent', ['flat_id' => $property->flat_id, 'room_number' => $property->room_number]) }}"
                                            method="POST">
                                            @csrf
                                            <td class="px-6 py-4">{{ $property->flat_number }}</td>
                                            <td class="px-6 py-4">{{ $property->room_number }}</td>
                                            <td class="px-6 py-4">
                                                <input type="number" name="rent" value="{{ $property->rent }}"
                                                    class="border-none ">

                                            </td>
                                            <td class="px-6 py-4">{{ $property->status }}</td>
                                            <td class="px-6 py-4 text-right text-sm font-medium">
                                                <a href="{{ route('deleteroom', ['flat_id' => $property->flat_id, 'room_number' => $property->room_number]) }}"
                                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</a>
                                                <button type="submit"
                                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update</button>
                                            </td>
                                        </form>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                    @if (count($items) != 0)
                        <div class="border"></div>
                        <h3 class="text-lg font-medium m-4">My Shop</h3>
                        <table class="w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th
                                        class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Item</th>
                                    <th
                                        class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Amount Sold</th>
                                    <th
                                        class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Price</th>
                                    <th class="px-6 py-3 bg-gray-50">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($items as $item)
                                    <tr>
                                        <td class="px-6 py-4 text-center">{{ $item->item_name }}</td>
                                        <td class="px-6 py-4 text-center">{{ $item->amount_sold }}</td>
                                        <td class="px-6 py-4 text-center">
                                            <form
                                                action="{{ route('updateprice', ['shop_id' => $item->shop_id, 'item_name' => $item->item_name]) }}"
                                                method="POST">
                                                @csrf
                                                <input type="number" name="price" value="{{ $item->price }}"
                                                    class="border-none p-2 pl-24">

                                        </td>
                                        <td class="px-6 py-4 text-left text-sm font-medium flex justify-center">
                                            <button type="submit"
                                                class="bg-blue-500 hover:bg-blue-700 text-white mx-4 font-bold py-2 px-4 rounded">Update</button>
                                            </form>
                                            <form
                                                action="{{ route('deleteitem', ['shop_id' => $item->shop_id, 'item_name' => $item->item_name]) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>


    {{-- My Properties --}}
@endsection
