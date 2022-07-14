<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Banks;
use App\Models\Booked;
use App\Models\Meja;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use App\Models\carts;
use Auth;
use DB;
use Illuminate\Support\Str;
use App\Models\MenuCategori as menulist;
use Faker\Factory as Faker;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        if($user->email == 'admin@gmail.com'){
            return view('home');
        }else{
            return redirect()->route('admin');
        }
    }


    public function post_login(Request $request)
    {
        $user = Auth::attempt(['email' => $request->email, 'password' => $request->password ]);
        if($user){
            return redirect()->route('admin');
        }else{
            return redirect()->route('logins');
        }
    }

    public function resetMeja()
    {
        $meja = Meja::where('status','booked')->update([
            'status' => 'active'
        ]);
        return redirect()->back();
        // return response()->json(['status' => 'Berhasil', 'total meja' => $meja ]);
    }

    public function resetMejaById($id, Request $request)
    {
        $meja = Meja::where(['status' => 'booked', 'id' => $id ])->update([
            'status' => 'active'
        ]);
        return response()->json(['status' => 'Berhasil', 'total meja' => $meja->count() ]);
    }

    public function admins()
    {
        $user = Auth::user();
        return view('web.admin.index');
    }

    public function mejas()
    {
        $meja = Meja::paginate(10);
        return view('web.admin.meja',compact('meja'));
    }

    public function plusmeja()
    {
        $meja = Meja::get();
        $no_terakhir = $meja->last();
        $create = Meja::create([
            'no_meja'   => $no_terakhir->no_meja+1,
            'status'    => 'active'
        ]);
        return redirect()->back();
    }

    public function menus()
    {
        $menu = Menu::paginate(10);
        $tipe = menulist::get();
        return view('web.admin.menu', compact('menu','tipe'));
    }

    public function addMenus(Request $request)
    {
        // dd($request->all());
        $file = $request->file('img');
        $img = $file->getClientOriginalName();
        $rename = 'https://padl.my.id/warss/assets/img/'.$img;
        $file->move('assets/img', $img);

        $data = [
            'nama'  => $request->nama,
            'stock' => $request->stock??1,
            'harga' => $request->harga??1000,
            'img'   => $rename,
            'tipe'  => $request->tipe
        ];

        $menu = Menu::create($data);
        return redirect()->back();
    }

    public function editMenus(Request $request)
    {
        $menu = Menu::find($request->id);
        if($menu == true )
        {
        if($request->file('img')){
            $file = $request->file('img');
            $img = $file->getClientOriginalName();
            $rename = 'https://padl.my.id/warss/assets/img/'.$img;
            $file->move('assets/img', $img);
        }else{
            $rename = $menu->img;
        }
        $data = [
            'nama'  => $request->nama??$menu->nama,
            'stock' => $request->stock??$menu->stock,
            'harga' => $request->harga??$menu->harga,
            'img'   => $rename
        ];

        // dd($data);
        Menu::where('id',$request->id)->update($data);

        return redirect()->route('menus');

        }

        return redirect()->route('menus');
    }

    public function edit($id, Request $request)
    {
        $menu = Menu::find($id);
        return view('web.admin.menu-single',compact('menu'));
    }

    public function deleteMenus($id, Request $request)
    {
        $menu = Menu::where('id', $id)->first()->delete();
    }

    public function orders()
    {
        // $order = DB::table('bookeds b')
        // ->select('b.*, name')
        // ->rightJoin('users' ,'bookeds.user_id','=','users.id')
        // ->where('user_id', '!=' ,null)->get();
        $order = DB::select("SELECT b.*, u.name from bookeds b left join users u on b.user_id = u.id where b.user_id != ''");
        return view('web.admin.order',compact('order'));
    }

    public function ordersDetail($id, Request $request)
    {
        $p = Order::where('id', $id)->first();
        $order = OrderDetail::where('id_order', $p->id_order)->first();
        $booking = Booked::where('id', $order->id_booked)->first();
        $keranjang = carts::where('id_booked',$booking->id)->with('item')->get();
        $user = User::where('email', $booking->no_telp.'@mail.com')->first();
        // dd($booking->no_telp);
        return view('web.admin.order-detail',compact('user','order','booking','keranjang'));
    }

    public function abisLogin()
    {
        $user = Auth::user();
        if($user->email == 'admin@gmail.com'){
        return redirect()->route('admin');
        }else{
        return view('web.front.verifikasi',compact('user'));

        }
    }


    public function menu()
    {
        $user = Auth::user();
        $menus = menulist::with('menu')->get();
        return view('web.front.menu', compact('menus'));

    }

    function createMeja(Request $request)
    {
        // dd($request->all());
        $user = Auth::user();
        $ceking = Booked::where(['id_user' => $user->id, 'tipe'=>$request->tipe, 'tanggal' => date('d/m/y')])->first();
        if(!$ceking){
            $meja = Meja::query();
            $noMeja = $meja->where('status','active')->get();
            $booked = Booked::create([
                'id_meja' => ($request->tipe == 'dine-in')?$noMeja[0]->id:0,
                'id_user' => $user->id,
                'no_telp'   => $user->no_hp,
                'tanggal' => $request->tanggal??date('d/m/y'),
                'waktu' => $request->jam??date('H:i'),
                'pengunjung' => $request->pengunjung??0,
                'tipe' => $request->tipe
            ]);
            if($request->tipe == 'dine-in'){
                $meja->where('id', $noMeja[0]->id)->update(['status' => 'booked']);
            }
        }
        return redirect()->route('menu');
    }

    public function addCart(Request $request)
    {
        $user = Auth::user();
        $booked = Booked::where(['id_user' => $user->id])->get();
        $he = $booked->last();
        $menu = Menu::where('id',$request->menu)->first();
        $cart = Carts::where(['id_menu' => $request->menu, 'user_id' => $user->id, 'id_booked' => $he->id])->first();
        if($cart){
           $p = $cart->update([
                'qty' => ($cart->qty+1),
                'total' => $menu->harga*($cart->qty +1 )
            ]);
        }else{
            $data = [
                'id_booked' => $he->id,
                'id_menu'   => $request->menu,
                'qty' => 1,
                'total' => $menu->harga,
                'user_id' => $user->id,
            ];
            $p = Carts::create($data);
        }
        // dd($p);
        return response()->json([
            'status' => ($p == true )?'Berhasil Menambahkan Menu':false,
        ]);
    }

    public function Cart(Request $request)
    {
        $user = Auth::user();
        $booked = Booked::where(['id_user' => $user->id])->get();
        $he = $booked->last();
        $data = Carts::where('id_booked', $he->id)->with('items')->get();
        $total = Carts::where('id_booked', $he->id)->sum('total');

        return response()->json(['data' => $data, 'total' => $total ]);
    }

    public function orderx(Request $request)
    {
        $user = Auth::user();
        $booked = Booked::where(['id_user' => $user->id, 'tanggal' => date('d/m/y')])->first();
        $menu = Carts::where('id_booked', $booked->id)->with('items')->get();
        $total = Carts::where('id_booked', $booked->id)->sum('total');
        $order = Order::query();
        $he = $order->create([
            'id_order' => Str::random(7),
            'id_booked' => $booked->id,
            'total' => $total
        ]);
        return redirect()->route('waiting-list', [$he['id_order']]);
    }
    public function wait(Request $request)
    {
        $order = Order::where('id_order',$id)->with(['booked' => function($x){
            $x->with(['cart' => function($y){
                $y->with('items')->get();
            }])->first();
        }])->first();
        $user = Auth::user();

        return view('web.front.wait',compact('order','user'));
    }

    public function SeeCart(Request $request)
    {
        return view('web.front.keranjang');
    }

    public function deleteItems(Request $request)
    {
        $user = Auth::user();
        $booked = Booked::where(['id_user' => $user->id, 'tanggal' => date('d/m/y')])->first();
        $cart = Carts::where(['id' => $request->id, 'user_id' => $user->id])->with('items')->first();
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

    public function bayar(Request $request)
    {
        dd($request->all());
        $user = Auth::user();
        $booked = Booked::where(['id_user' => $user->id])->get();
        $ps = $booked->last();
        $menu = Carts::where('id_booked', $ps->id)->with('item')->get();
        $total = Carts::where('id_booked', $ps->id)->sum('total');
        $bank = Banks::where('status', 'active' )->get();

        if(isset($booked->id_meja))
        {
            $this->undoMeja($booked->id_meja);
        }
        return view('web.front.bayar',compact('user','menu','bank','total'));
    }
    public function createOrder(Request $request)
    {
        $method = $request->method;
        $user = Auth::user();
        $booked = Booked::where(['id_user' => $user->id])->get();
        $ps = $booked->last();
        $menu = Carts::where('id_booked', $ps->id)->with('items')->get();
        $total = Carts::where('id_booked', $ps->id)->sum('total');
        $order = Order::query();
        $he = $order->create([
            'id_order'  => Str::random(7),
            'user_id'   => $user->id,
            'id_booked' => $ps->id,
            'total'     => $total
        ]);
        foreach($menu as $ma){
            $px[] =[
                'menu' => $ma->item->nama,
                'qty'  => $ma->qty,
                'total'=> $ma->total
            ];
        }

        $this->createOrderDetail($ps->id, $he->id_order, $method, $px, $ps->tipe);
        return redirect()->route('detail_order',[$he->id_order]);
    }

    function createOrderDetail($id, $code, $method, $cart, $tipe)
    {
        OrderDetail::create([
            'id_booked' => $id,
            'id_order'  => $code,
            'payment_type' => $method,
            'status' => 0,
            'ext'   => json_encode($cart),
            'tipe' => $tipe
        ]);
        Carts::where('id_booked', $id)->delete();
    }

    public function undoMeja($id)
    {
        Meja::where('id', $id)->update('status','active');
    }

    public function detail_order($id)
    {
        $detail = OrderDetail::where('id_order',$id)->with('hehe')->first();
        $bank = Banks::where('id', $detail->payment_type??0)->first();
        OrderDetail::where('id_order', $id)->update(['status' => 2]);
        $meja = Booked::where('id',$detail->id_booked)->with('meja')->first();

        // dd($meja);

        return view('web.front.detailorder',compact('detail','bank','meja'));
    }

    public function riwayat()
    {
        $user = Auth::user();
        $order = Order::where('user_id',$user->id)->with('detail')->get();

        return view('web.front.riwayat',compact('order'));
    }

    public function reservasi()
    {
        return view('web.front.reservasi');
    }

    public function about()
    {
        return view('web.front.about');
    }

    public function contact()
    {
        return view('web.front.contact');
    }

    public function setting()
    {
        $user = Auth::user();
        return view('web.front.setting', compact('user'));
    }

    public function logouts()
    {
        Auth::logout();
        return redirect('/');
    }

    public function editdatauser(Request $request)
    {
        $auth = Auth::user();
        $user = User::where('id', $auth->id)->update($request->except('_token'));
        return redirect()->back();
    }
}
