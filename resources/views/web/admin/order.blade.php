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
        <li class="list-group-item d-flex justify-content-between align-items-center">
          {{$i++}}. {{ '#'.strtolower($ma->id_order)}} - No. Hp : {{ $ma->booked->no_telp }}
          <div class="d-flex justify-content-end">
              <span class="badge bg-info rounded-pill mx-2">
                  <a href="{{ route('orders-detail',[$ma->id])}}" class="text-white">detail</a>
              </span>
              {{-- <span class="badge bg-danger rounded-pill">
                  <a href="{{ route('delete-menus',[$ma->id])}}" class="text-white">delete</a>
              </span> --}}
            </div>
        </li>
        @endforeach
      </ul>
    </div>
@endsection