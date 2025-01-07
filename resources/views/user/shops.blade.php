@extends('user.layouts.template')
@section('title')
    All the shops
@endsection

@section('content')
@if (session('success'))
    <div class="bg-green-100 border text-center border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
@endif
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Shops and Menus</h1>

        @foreach ($shops as $shop)
            <div class="bg-white rounded-lg shadow-md p-4 mb-4 w-[60%]">
                <h2 class="text-xl font-semibold mb-2">{{ $shop->shop_name }}</h2>
                <ul class="mt-2">
                    @foreach ($menus as $menu)
                        @if ($shop->id === $menu->shop_id)
                            <li
                                class="flex justify-between items-center py-2 ml-4 border-b border-gray-200 last:border-b-0 hover:bg-gray-100 transition-colors duration-150 ease-in-out">
                                <div class="text-gray-900">{{ $menu->item_name }}</div>
                                <div class="flex items-center">
                                    <div class="text-gray-600 font-semibold">{{ $menu->price }}</div>
                                    <form action="{{route('addtocart')}}" method="POST">
                                        @csrf
                                    <div class="flex items-center ml-8">
                                        <button type="button" class="text-sm bg-gray-200 rounded-sm px-2 py-1"
                                            onclick="decrementQuantity('{{ $shop->id }}', '{{ $menu->item_name }}')">-</button>
                                        <input type="text" class="w-[40px] border-none"
                                            id="quantity_{{ $shop->id }}_{{ $menu->item_name }}"
                                            name="quantity" value="1"
                                            min="0" class="w-10 text-center mx-2 border border-gray-300 rounded-sm">
                                        <button type="button" class="text-sm bg-gray-200 rounded-sm px-2 py-1"
                                            onclick="incrementQuantity('{{ $shop->id }}', '{{ $menu->item_name }}')">+</button>
                                            
                                                <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                                                <input type="hidden" name="item_name" value="{{ $menu->item_name }}">
                                                <input type="hidden" name="price" value="{{ $menu->price }}">
                                                <button type="submit" class="text-sm bg-blue-500 hover:bg-blue-600 rounded-sm px-2 py-1 ml-4 text-white font-semibold">
                                                    Add to Cart
                                                </button>
                                            </form>
                                    </div>
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        @endforeach

        <div class="my-4">
            <a href="{{route('showcart')}}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">View
                Cart</a>
        </div>
        <div class="my-4">
            <a href="{{route('myorders')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold mt-4 py-2 px-4 rounded">
                Your orders
            </a>
        </div>
    </div>
@endsection
