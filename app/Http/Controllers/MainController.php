<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Banks;
use App\Models\Booked;
use App\Models\Meja;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use App\Models\Carts;
use Auth;
use DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Session;

class MainController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }
    public function index()
    {
        return view('web.front.login');
    }

    public function Menu()
    {
        $menus = Menu::get();
        return view('web.front.menu', compact('menus'));
    }

    public function setMeja(Request $request)
    {

        $checking = User::where('no_hp', $request->no_hp)->first();
        if($checking){

            $user = $checking;
        }else{
            $user = DB::table('users')->insertGetId([
                'email' => $request->name.'@mail.com',
                'name'  => $request->name,
                'password' =>   Hash::make($request->no_hp),
                'no_hp' => $request->no_hp
            ]);
        }
        // dd($user['email']);
        $auth = Auth::attempt(['email' => $user['email'], 'password' => $request->no_hp ]);
        $users = Auth::user();
        $meja = Meja::query();
        $noMeja = $meja->where('status','active')->get();
        $booked = Booked::create([
            'id_meja' => $noMeja[0]->id,
            'no_telp'  => $request->no_hp,
            'no_meja' => $noMeja[0]->no_meja,
            'tanggal' => date('d/m/y'),
            'waktu' => date('H:i'),
            'user_id' => $users->id
        ]);
        $meja = Meja::where('id', $noMeja[0]->id)->update(['status' => 'booked']);
        $uri = base64_encode($booked->id);
        // dd($auth);
        return response()->json([
            'status' => ($booked == true)?true:false,
            'auth' => ($auth == true)?true:false,
            'uri' => $uri
        ]);
    }

    public function addMenu(Request $request)
    {
        dd($request->all());
    }

    public function faker()
    {
        $faker = Faker::create('id_ID');
        for($i = 1; $i < 10; $i++){
            DB::table('menus')->insert([
                'nama'  => $faker->userName,
                'stock' => $faker->numberBetween(10,50),
                'harga' => $faker->numberBetween(10000,100000),
                'img'   =>  'https://pondokindahmall.co.id/assets/img/default.png',
            ]);
        }

        $faker = Faker::create('id_ID');
        for($i = 1; $i < 10; $i++){
            DB::table('mejas')->insert([
                'no_meja'   => $i,
                'status'    => 'active'
            ]);
        }

        return response()->json(['status' => true ]);
    }

    public function addCart(Request $request)
    {
        // dd($request->all());
        $id = base64_decode($request->kode);
        $Booked = Booked::where('id', $id )->first();
        $auth = User::where('email', $Booked->no_telp.'@mail.com' )->first();
        $menu = Menu::where('id',$request->menu)->first();
        $cart = Carts::where(['id_menu' => $request->menu, 'user_id' => $auth->id, 'id_booked' => $id])->first();
        if($cart){
           $p = $cart->update([
                'qty' => ($cart->qty+1),
                'total' => $menu->harga*($cart->qty +1 )
            ]);
        }else{
            $data = [
                'id_booked' => $Booked->id,
                'id_menu'   => $request->menu,
                'qty' => 1,
                'total' => $menu->harga,
                'user_id' => $auth->id,
            ];
            $p = Carts::create($data);
        }
        return response()->json([
            'status' => ($p == true )?'Berhasil Menambahkan Menu':false,
        ]);
    }

    public function cart(Request $request)
    {

        $id = base64_decode($request->kode);
        $data = Carts::where('id_booked', $id)->with('items')->get();
        $total = Carts::where('id_booked', $id)->sum('total');


        return response()->json(['data' => $data, 'total' => $total ]);
    }

    public function SeeCart(Request $request)
    {
        return view('web.front.keranjang');
    }

    public function deleteItems(Request $request)
    {
        $id = base64_decode($request->kode);
        $Booked = Booked::where('id', $id )->first();
        $auth = User::where('email', $Booked->no_telp.'@mail.com' )->first();
        $cart = Carts::where(['id' => $request->id, 'user_id' => $auth->id])->with('items')->first();
        if($cart->qty > 1 ){
           $p = $cart->update([
                'qty' => ($cart->qty-1),
                'total' => $cart->total - $cart['items'][0]['harga']
            ]);
        }else{
            $p = $cart->delete();
        }
        return response()->json([
            'status' => ($p == true )?'Berhasil Menghapus Menu':false,
        ]);
    }

    public function orders($id, Request $request)
    {
        $id = base64_decode($id);
        $booked = Booked::where('id', $id )->first();
        $menu = Carts::where('id_booked', $id)->with('items')->get();
        $total = Carts::where('id_booked', $id)->sum('total');
        $order = Order::query();
        $he = $order->create([
            'id_order' => Str::random(7),
            'id_booked' => $booked->id,
            'total' => $total
        ]);
        return redirect()->route('waiting-list', [$he['id_order']]);
    }

    public function wait($id, Request $request)
    {
        $order = Order::where('id_order',$id)->with(['booked' => function($x){
            $x->with(['cart' => function($y){
                $y->with('items')->get();
            }])->first();
        }])->first();
        $user = User::where('email', $order->booked->no_telp.'@mail.com' )->first();

        return view('web.front.wait',compact('order','user'));
    }

    public function bayar($id, Request $request)
    {
        $id = base64_decode($id);
        $booked = Booked::where('id', $id )->first();
        $carts = Carts::where('id_booked', $booked->id)->get();
        $user = User::where('id', $booked->user_id)->latest()->first();

        return view('web.front.pay',compact('user','booked','carts'));
    }


    public function nota($id, Request $request)
    {
        $id = base64_decode($id);
        $booked = Booked::where('id', $id )->first();
        $carts = Carts::where('id_booked', $booked->id)->get();
        $user = User::where('id', $booked->user_id)->latest()->first();

        return view('web.front.nota',compact('user','booked','carts'));
    }

    public function post_detail(Request $request)
    {
        dd($request->all());
        $order = Order::where('id_order', $request->kode)->first();
        $data = [
            'id_order'  => $request->kode,
            'id_booked' => $order->id_booked,
            'payment_type' => $request->bank,
            'status' => 0,
        ];
        // dd($data);
        $orderDetail = OrderDetail::create($data);
        return response()->json([
            'status' => ($orderDetail==true)?true:false,
            'data' => $orderDetail,
            'kode'  => base64_encode($order->id_booked)
        ]);
    }

    public function barcode($id, Request $request)
    {
        $idx = base64_decode($id);
        $orderDetail = OrderDetail::where('id_booked', $idx)->first();
        $banks = Banks::where('id', $orderDetail->payment_type)->first();

        // dd($banks);
        return view('web.front.qr',compact('banks'));
    }

    public function last(Request $request)
    {
        $id = base64_decode($request->kode);
        $booked = Booked::where('id', $id)->first();
        $meja = Meja::where('id', $booked->id_meja)->update(['status' => 'active']);
        $order = OrderDetail::where('id_booked', $id)->update(['status' => 1 ]);

        return response()->json(['data' => ($id == true)?true:false ]);
    }
}
