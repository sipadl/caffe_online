@extends('template.main')
@section('content')
@php
    $p = $order->booked->cart;
    // dd($p[0]['items'][0]['nama'])
@endphp
<div class="d-flex justify-content-center">
    <div class="">
        <h3 class="text-center">Pesanan Anda Sedang Di Proses</h3>
        <hr class="mx-2">
        <div class="card w-100 p-2 my-2">
            <h5>Informasi Pemesan</h5>
            <table>
                <tbody>
                    <tr>
                        <td width="25%">Nama</td>
                        <td>:</td>
                        <td>{{$user->name}}</td>
                    </tr>
                    <tr>
                        <td width="25%">No. Meja</td>
                        <td>:</td>
                        <td>{{ $order->booked->no_meja }}</td>
                    </tr>
                    <tr>
                        <td width="25%">No. Pesanan</td>
                        <td>:</td>
                        <td>{{ '#'.$order->id_order }}</td>
                    </tr>
                    <tr>
                        <td width="25%">Total</td>
                        <td>:</td>
                        <td>{{ 'Rp '.number_format($order->total,0) }}</td>
                    </tr>
                    <tr>
                        <td width="25%">Jumlah Pesanan</td>
                        <td>:</td>
                        <td>{{ count($p) .' Hidangan'}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="card p-2">
            <h4>Pesanan Kamu</h4>
                <div class="row">
                @foreach($p as $p)
                @foreach($p['items'] as $items)
                <div class="col-6 my-2">
                    <div class="card" style="border-radius:12px;">
                        <a href="">
                            <img src="{{$items['img'] }}" class="w-100" alt="">
                        </a>
                        <div class="card-body align-self-center">
                            <div class="text-center">
                                <p class="card-title mb-2">
                                    {{ $items['nama'] }}
                                </p>
                                <small>{{ 'Rp '. number_format($items->harga,0) }}</small><br>
                            </div>
                            <a href="" class="btn btn-info text-light text-center">Lihat Detail</a>
                        </div>
                    </div>
                </div>
                @endforeach
                @endforeach
            </div>
        </div>
    </div>
</div>
<div class="mb-5"></div>
@endsection