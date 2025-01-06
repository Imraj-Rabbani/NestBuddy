@extends('user.layouts.template')
@section('title')
    Your Cart
@endsection

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Shopping Cart</h1>

    @if (count($cart_items) != 0)
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Item
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Price
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Quantity
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Total
                    </th>
                    <th class="px-6 py-3 bg-gray-50"></th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($cart_items as $item)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="text-sm font-medium text-gray-900">{{ $item->item_name }}</div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium text-gray-900">
                            {{ $item->price }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium text-gray-900">
                            {{ $item->quantity }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium text-gray-900">
                            {{ $item->price * $item->quantity }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <form action="{{ route('deletecart', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE') 
                                <button type="submit" class="text-red-500 hover:text-red-700">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            <p class="text-right text-lg font-semibold">Total: {{ $total }}</p>
        </div>

        {{-- <form action="{{ route('order') }}" method="POST">
            @csrf
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Proceed to Checkout
            </button>
        </form> --}}

    @else
        <p>Your cart is empty.</p>
    @endif
</div>
@endsection