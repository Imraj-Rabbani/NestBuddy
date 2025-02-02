<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function homepage()
    {
        return view("dashboard");
    }

    public function listFlat()
    {
        return view("user.listFlat");
    }

    public function createShop()
    {
        return view("user.createShop");
    }

    public function saveFlat(Request $request)
    {
        $user_id = Auth::id();
        // dd($user_id);
        $flatId = DB::table('flats')->insertGetId([
            'flat_number' => $request->flat_number,
            'building_number' => $request->building_number,
            'road_number' => $request->road_number,
            'city' => $request->city,
            'area' => $request->area,
            'owner_id' => $user_id,
        ]);

        DB::table('users')
            ->where('id', $user_id)
            ->update(['H_flag' => 1]);

        foreach ($request->room_number as $index => $roomNumber) {
            $roomData = [
                'room_number' => $roomNumber,
                'flat_id' => $flatId,
                'rent' => $request->rent[$index],
                'description' => $request->description[$index],
            ];

            if ($request->hasFile('photos.' . $index)) {
                $file = $request->file('photos.' . $index);
                $extension = $file->getClientOriginalName();
                $fileName = time() . "." . $extension;
                $path = 'uploads/';
                $file->move($path, $fileName);
                $roomData['photo'] = $path . $fileName;
            }

            DB::table('rooms')->insert($roomData);
        }

        return redirect()->route('dashboard')->with('success', 'Rooms added successfully!');
    }



    public function saveShop(Request $request)
    {
        $user_id = Auth::id();

        $shopId = DB::table('shops')->insertGetId([
            'shop_name' => $request->shop_name,
            'S_user_id' => $user_id,
        ]);

        DB::table('users')
            ->where('id', $user_id)
            ->update([
                'S_flag' => 1,
                'shop_name' => $request->shop_name,
            ]);



        foreach ($request->item_name as $index => $itemName) {

            DB::table('menus')->insert([
                'shop_id' => $shopId,
                'item_name' => $itemName,
                'price' => $request->item_price[$index],
            ]);
        }

        return redirect()->route('homepage')->with('success', 'Shop created successfully!');
    }

    public function listedRoom()
    {
        $rooms = DB::table('rooms')
            ->select("*")
            ->where('status', 'available')
            ->get();

        return view('user.listedRoom', compact('rooms'));
    }
    public function placeBid(Request $request, $flat_id, $room_number)
    {
        $user_id = Auth::id();

        $bidId = DB::table('bids')->insertGetId([
            'bid_amount' => $request->bid_price,
        ]);

        $owner_id = DB::table('flats')
            ->select('owner_id')
            ->where('flat_id', $flat_id)
            ->first()->owner_id;


        // dd($owner_id);
        DB::table('bid_infos')->insert([
            'bid_id' => $bidId,
            'flat_id' => $flat_id,
            'H_user_id' => $owner_id,
            'B_user_id' => $user_id,
        ]);
    }

    public function shops()
    {
        $shops = DB::table('shops')->get();
        $menus = DB::table('menus')->get();
        // dd($shops,$menus);
        return view('user.shops', compact(['shops', 'menus']));
    }


    public function userProfile()
    {
        $user_id = Auth::id();


        $user = DB::table('users')
            ->select('*')
            ->where('id', $user_id)
            ->get();
        $user = $user[0];


        $properties = DB::table('flats')
            ->join('rooms', 'flats.flat_id', '=', 'rooms.flat_id')
            ->select('flats.flat_id', 'flats.flat_number', 'rooms.room_number', 'rooms.rent', 'rooms.status')
            ->where('flats.owner_id', $user->id) // Assuming flats table has a user_id column
            ->get();

        // dd($properties);

        $items = DB::table('shops')
            ->join('menus', 'shops.id', "=", 'menus.shop_id')
            ->select('shops.shop_name', 'menus.*')
            ->where('S_user_id', $user->id)
            ->get();

        // dd($items);

        return view('user.profile', compact(['user', 'properties', 'items']));
    }

    public function updateUserProfile(Request $request)
    {
        $user_id = Auth::id();

        DB::table('users')
            ->where('id', $user_id)
            ->update([
                'name' => $request->name,
                'email' => $request->email,
                'age' => $request->age,
                'occupation' => $request->occupation,
                'B_flag' => isset($request->B_flag) ? 1 : 0,
                'H_flag' => isset($request->H_flag) ? 1 : 0,
                'S_flag' => isset($request->S_flag) ? 1 : 0,
            ]);
    }

    public function updateRent(Request $request, $flat_id, $room_number)
    {
        DB::table('rooms')
            ->where('flat_id', $flat_id)
            ->where('room_number', $room_number)
            ->update([
                'rent' => $request->rent,
            ]);
    }


    public function deleteRoom(Request $request, $flat_id, $room_number)
    {
        DB::table('rooms')
            ->where('flat_id', $flat_id)
            ->where('room_number', $room_number)
            ->delete();
    }


    public function updatePrice(Request $request, $shop_id, $item_name)
    {
        DB::table('menus')
            ->where('shop_id', $shop_id)
            ->where('item_name', $item_name)
            ->update([
                'price' => $request->price,
            ]);
    }

    public function deleteItem(Request $request, $shop_id, $item_name)
    {
        DB::table('menus')
            ->where('shop_id', $shop_id)
            ->where('item_name', $item_name)
            ->delete();
    }

    public function roomDetails(Request $request, $room_number, $flat_id)
    {

        $room = DB::table('rooms')
            ->join('flats', 'flats.flat_id', '=', 'rooms.flat_id')
            ->select('flats.*', 'rooms.*')
            ->where('rooms.room_number', $room_number)
            ->where('rooms.flat_id', $flat_id)
            ->get();

        $room = $room[0];
        // dd($room);
        $bids = DB::table('bid_infos')
            ->join('bids', 'bids.id', "=", 'bid_infos.bid_id')
            ->join('users', 'users.id', '=', 'bid_infos.B_user_id')
            ->select("users.name", "bids.*", 'bid_infos.*')
            ->where('bid_infos.flat_id', $flat_id)
            ->get();
        // dd($bids);
        return view('user.roomDetails', compact(['room', 'bids']));
    }

    public function addToCart(Request $request)
    {
        $user_id = Auth::id();

        DB::table('carts')->insert([
            'user_id' => $user_id,
            'shop_id' => $request->shop_id,
            'item_name' => $request->item_name,
            'price' => $request->price,
            'quantity' => $request->quantity
        ]);

        return redirect()->route('shops')->with('success', 'Added to Cart successfully!');
    }

    public function showCart()
    {
        $user_id = Auth::id();

        $cart_items = DB::table('carts')
            ->select("*")
            ->where('user_id', $user_id)
            ->get();

        $total = $cart_items->sum(function ($item) {
            return $item->price * $item->quantity;
        });


        return view('user.cart', compact(['cart_items', 'total']));
    }

    public function deleteCart($id)
    {
        DB::table('carts')->where('id', $id)->delete();

        return redirect()->route('showcart')->with('success', 'Removed From Cart successfully!');
    }

    public function order(Request $request)
    {
        $user_id = Auth::id();

        $order_id = DB::table('food__orders')->insertGetId([
            'B_user_id' => $user_id,
            'status' => "Delivering"
        ]);

        DB::table('items_infos')->insert([
            'order_id' => $order_id,
            'items' => $request->item_name,
            'quantity' => $request->quantity,
            'price' => $request->price
        ]);

        DB::table('belongs_tos')->insert([
            'order_id' => $order_id,
            'item_name' => $request->item_name,
            'shop_id' => $request->shop_id
        ]);

        DB::table('carts')->where('id', $request->id)->delete();

        return redirect()->route('showcart')->with('success', 'Ordered successfully!');
    }

    public function myOrders()
    {
        $user_id = Auth::id();

        $orders = DB::table('food__orders')
            ->join('items_infos', 'food__orders.id', '=', 'items_infos.order_id')
            ->where('food__orders.B_user_id', $user_id)
            ->select('food__orders.*', 'items_infos.*')
            ->get();

        return view('user.myOrders', compact('orders'));
    }

    public function showOrders()
    {
        $user_id = Auth::id();

        $orders = DB::table('belongs_tos')
            ->join('food__orders', 'belongs_tos.order_id', '=', 'food__orders.id')
            ->join('shops', 'belongs_tos.shop_id', '=', 'shops.id')
            ->where('shops.S_user_id', $user_id)
            ->select('belongs_tos.*', 'food__orders.status')
            ->get();

        return view('user.showOrder', compact('orders'));
    }

    public function orderUpdate($id)
    {
        DB::table('food__orders')
            ->where('id', $id)
            ->update(['status' => 'Delivered']);

            return redirect()->route('showorders');
        
    }


}