<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function homepage(){
        return view("dashboard");
    }

    public function listFlat(){
        return view("user.listFlat");
    }

    public function createShop(){
        return view("user.createShop");
    }

    public function saveFlat(Request $request){

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
   
            // Handle photo uploads (optional)
            if ($request->hasFile('photos.'.$index)) {
                $photo = $request->file('photos.'.$index);
                $photoName = time() . '_' . $photo->getClientOriginalName();
                $photoPath = $photo->storeAs('public/photos', $photoName);
                $photoPath = 'public/photos' . $photoName;
                $roomData['photo'] = $photoPath;
            }

            DB::table('rooms')->insert($roomData);
        }

        return redirect()->route('dashboard')->with('success', 'Rooms added successfully!');
    }



    public function saveShop(Request $request)
{
    $user_id = Auth::id();
    // Insert into shops table
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

    // Insert into menus table

    foreach ($request->item_name as $index => $itemName) {

        DB::table('menus')->insert([
            'shop_id' => $shopId,
            'item_name' => $itemName,
            'price' => $request->item_price[$index],
        ]);
    }

    // Insert into meal_subscriptions table (if applicable)
    // if ($request->subscription_duration > 0) {
    //     for ($day = 1; $day <= $request->subscription_duration; $day++) {
    //         // dd($request->input('sub_item_name'));
    //         foreach ($request->input('sub_item_name') as $item) {
    //             DB::table('meal_subscriptions')->insert([
    //                 'shop_id' => $shopId,
    //                 'day_number' => $day,
    //                 'plan_number' => $request->plan_number,
    //                 'items' => $item, 
    //                 'price' => $request->sub_price,
    //                 'duration' => $request->subscription_duration
    //             ]);
    //         }
    //     }
    // }

    return redirect()->route('homepage')->with('success', 'Shop created successfully!');
    }
    
    public function listedRoom()
{
    $rooms = DB::table('rooms')
        ->select('room_number', 'rent', 'description', 'flat_id')
        ->where('status', 'available')
        ->get();

    return view('user.listedRoom', compact('rooms')); 
}
    public function placeBid(Request $request){
        $bidId = DB::table('bids')->insertGetId([
            'bid_amount' => $request->bid_price,
        ]);
}

    public function shops(){
        $shops = DB::table('shops')->get();
        $menus = DB::table('menus')->get();
        // dd($shops,$menus);
        return view('user.shops', compact(['shops','menus']));
    }


    public function userProfile(){
        $user_id = Auth::id(); 


        $user = DB::table('users')
        ->select('*')
        ->where('id', $user_id)
        ->get();
        $user = $user[0];


        $properties = DB::table('flats')
        ->join('rooms', 'flats.flat_id', '=', 'rooms.flat_id')
        ->select('flats.flat_id','flats.flat_number', 'rooms.room_number', 'rooms.rent', 'rooms.status')
        ->where('flats.owner_id', $user->id) // Assuming flats table has a user_id column
        ->get();

        // dd($properties);

        $items = DB::table('shops')
            ->join('menus', 'shops.id',"=",'menus.shop_id')
            ->select('shops.shop_name','menus.*')
            ->where('S_user_id', $user->id) 
            ->get();

        // dd($items);

        return view('user.profile', compact(['user','properties','items']));
    }

    public function updateUserProfile(Request $request){
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

    public function updateRent(Request $request, $flat_id, $room_number){
        DB::table('rooms')
        ->where('flat_id', $flat_id)
        ->where('room_number', $room_number)
        ->update([
            'rent' => $request->rent,
        ]);
    }


    public function deleteRoom(Request $request, $flat_id, $room_number){
        DB::table('rooms')
        ->where('flat_id', $flat_id)
        ->where('room_number', $room_number)
        ->delete();
    }


    public function updatePrice(Request $request, $shop_id, $item_name){
        DB::table('menus')
            ->where('shop_id', $shop_id)
            ->where('item_name',$item_name) 
            ->update([
                'price' => $request->price,
            ]);
    }

    public function deleteItem(Request $request, $shop_id, $item_name){
        DB::table('menus')
            ->where('shop_id', $shop_id)
            ->where('item_name',$item_name) 
            ->delete();
    }
}