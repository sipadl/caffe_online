@extends('web.admin.template')
@section('main')
    <div class="menu p-3">
        <div class="d-flex justify-content-between">
            <a class="btn btn-sm btn-light" href="{{ route('reset-meja') }}">Reset Semua Meja</a>
            <a class="btn btn-sm btn-light" href="{{ route('plus-meja') }}">Tambah Meja</a>
        </div>
        <div class="p-1">
            <hr>
        </div>
        <div class="text-small" style="font-size: 10px">
            <span>*Ketuk Untuk Mengubah Menu</span>
        </div>
        <div class="">
            <div class="list-group p-2" style="border-radius: 12px;">
                @foreach($meja as $ma)
                <a href="#" class="list-group-item list-group-item-action">No. {{$ma->no_meja}} - [ {{ ($ma->status == 'active')?'Tersedia':'Booked' }} ] </a>
                @endforeach
            </div>
        </div>
        <div class="text-center p-4">
            {{ $meja->links() }}
        </div>
    </div>

@endsection