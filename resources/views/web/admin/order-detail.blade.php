@extends('web.admin.template')
@section('main')
    <div class="p-2">
        <div class="d-flex justify-content-between">
            <div class="">
                <h5>Order Detail {{ $order->id_order }}</h5>
            </div>
            <div class="">
                <a href="{{ route('orders') }}" class="btn btn-sm btn-info text-white">kembali</a>
            </div>
        </div>
        <div class="p-2">
            <h5>Pesanan Meja {{$booking->no_meja}}</h5>
            <div class="d-flex">
                @php
                    $p = $keranjang;
                @endphp
                @foreach($p as $as)
                <div class="card mx-2 w-25">
                    <img src="{{ $as->item->img }}" alt="">
                    <div class="text-center">
                        <p style="font-size: 10px;">
                            {{$as->item->nama}}
                        </p>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="p-3">
                <table>
                    <tbody>
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td>{{$user->name}}</td>
                        </tr>
                        <tr>
                            <td>Total</td>
                            <td>:</td>
                            <td>Rp {{number_format($keranjang->sum('total'),0)}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection