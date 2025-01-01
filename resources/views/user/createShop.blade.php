@extends('user.layouts.template')
@section('title')
    Create Your Shop
@endsection

@section('content')

<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Create Your Shop</h1>

    <form action="{{route('saveshopinfo')}}" method="POST">
        @csrf
        <div class="mb-8">
            <label for="shop_name" class="block text-sm font-medium text-gray-700">Shop Name</label>
            <input type="text" id="shop_name" name="shop_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
            
        </div>

        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700">Shop Description</label>
            <textarea id="description" name="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>
        </div>

        <h2 class="text-xl font-bold mb-2 border">Menu Items</h2>

        <table class="table-auto border border-gray-500 min-w-full divide-y divide-gray-500">
            <thead>
                <tr>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Item Name</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                    <th class="px-6 py-3 bg-gray-50"></th>
                </tr>
            </thead>
            <tbody id="menu-rows">
                <tr class="menu-row">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <input type="text" name="item_name[]" class="border border-gray-300 rounded-md p-2 w-full focus:outline-none focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <input type="number" step="0.01" name="item_price[]" class="border border-gray-300 rounded-md p-2 w-full focus:outline-none focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right">
                        <button type="button" onclick="removeRow2(this)">
                            <img src="{{asset('assets/remove.png')}}" class="w-[25px]">
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>

        <button type="button" class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" onclick="addRow2()">Add Item</button>

        {{-- <h2 class="text-xl font-bold mb-2 mt-4">Subscription Menu</h2>

        <div class="flex space-x-6 mb-4">
            <div>
                <label for="subscription_duration" class="block text-sm font-medium text-gray-700">Subscription Duration (in days)</label>
                <input type="number" id="subscription_duration" name="subscription_duration" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
            </div>
            <div>
                <label for="sub_price" class="block text-sm font-medium text-gray-700">Price</label>
                <input type="number" id="sub_price" name="sub_price" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
            </div>
            <div>
                <label for="plan_number" class="block text-sm font-medium text-gray-700">Plan Number</label>
                <input type="number" id="plan_number" name="plan_number" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
            </div>
        </div> --}}

        {{-- <table id="subscription-table" class="table-auto border border-gray-500 min-w-full divide-y divide-gray-500 hidden">
            <thead>
                <tr>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Day</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Items</th>
                </tr>
            </thead>
            <tbody id="subscription-rows">
            
            </tbody>
        </table> --}}

        <button type="submit" class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create Shop</button>
    </form>
</div>

@endsection