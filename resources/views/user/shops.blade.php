@extends('user.layouts.template')
@section('title')
    All the shops
@endsection

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Shops and Menus</h1>

        @foreach ($shops as $shop)
            <div class="bg-white rounded-lg shadow-md p-4 mb-4">
                <h2 class="text-xl font-semibold mb-2">{{ $shop->shop_name }}</h2>

                <ul class="mt-2">
                    @foreach ($menus as $menu)
                    @if ($shop->id === $menu->shop_id )
                    <li class="flex justify-between items-center py-2 border-b border-gray-200 last:border-b-0 hover:bg-gray-100 transition-colors duration-150 ease-in-out cursor-pointer">
                        <span class="text-gray-900">{{ $menu->item_name }}</span>
                        <div class="flex items-center">
                            <span class="text-gray-600 font-semibold">{{ $menu->price }}</span>
                            <form action="" method="POST">
                                @csrf
                                <input type="hidden" name="menu_id" value="{{ $menu->shop_id }}">
                                <input type="hidden" name="item_name" value="{{ $menu->item_name }}">
                                <button type="submit" class="ml-6 text-xs text-white bg-blue-500 hover:bg-blue-600 rounded-sm px-2 py-1">
                                    Add to Cart
                                </button>
                            </form>
                        </div>
                    </li>
                @endif
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
@endsection
