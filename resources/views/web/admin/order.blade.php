@extends('web.admin.template')
@section('main')
<div class="p-2">
    <div class="">
        <h4>List Order</h4>
    </div>
    <hr>
    <ul class="list-group p-2" style="border-radius: 12px;">
        @php
            $i = 1;
        @endphp
        @foreach($order as $ma)
        {{-- <li class="list-group-item d-flex justify-content-between align-items-center"> --}}
            @php
                $data = DB::table('carts')
                ->leftJoin('menus' , 'carts.id_menu' , '=' , 'menus.id')
                ->where('id_booked', $ma->id)
                ->get();
            @endphp
            Nama Pemesan : {{$ma->name}}<br>
            No Meja : {{$ma->no_meja}}
            <ol>
                @foreach($data as $d)
                <li>{{$d->nama}} x {{$d->qty.' Qty'}}</li>
                @endforeach
            </ol>
                <strong>
                    Total : Rp {{number_format($d->total,0)}}<br>
                </strong>
            <hr>
          {{-- {{$i++}}. {{ '#'.strtolower($ma->id_order)}} - No. Hp : {{ $ma->booked->no_telp }} --}}
          {{-- <div class="d-flex justify-content-end"> --}}
              {{-- <span class="badge bg-info rounded-pill mx-2">
                  <a href="{{ route('orders-detail',[$ma->id])}}" class="text-white">detail</a>
              </span> --}}
              {{-- <span class="badge bg-danger rounded-pill">
                  <a href="{{ route('delete-menus',[$ma->id])}}" class="text-white">delete</a>
              </span> --}}
            {{-- </div> --}}
        </li>
        @endforeach
      </ul>
    </div>
@endsection
