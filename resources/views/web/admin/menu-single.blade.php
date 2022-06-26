@extends('web.admin.template')
@section('main')
    <div class="menu p-2">
        <h5 class="p-2">Edit Menu [ {{$menu->nama}} ]</h5>
        <form action="{{ route('epost-menus',[$menu->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
        <div class="modal-body">
            <div class="d-flex justify-content-between mb-2">
                <div class="title w-25 p-2">nama</div>
                <div class="w-75">
                    <input type="text" name="nama" class="form-control" value="{{ $menu->nama }}">
                </div>
            </div>
            <div class="d-flex justify-content-between mb-2">
                <div class="title w-25 p-2">stock</div>
                <div class="w-75">
                    <input type="number" name="stock" class="form-control" value="{{ $menu->stock }}">
                </div>
            </div>
            <div class="d-flex justify-content-between mb-2">
                <div class="title w-25 p-2">harga</div>
                <div class="w-75">
                    <input type="number" name="harga" class="form-control" value="{{ $menu->harga }}">
                </div>
            </div>
            {{-- <form action="" method="post" enctype="multipart/form-data"> --}}
            <div class="d-flex justify-content-between mb-2">
                <div class="title w-25 p-2">thumbnail</div>
                <div class="w-75">
                    <input type="file" name="img" />
                </div>
            </div>
              {{-- </form> --}}
        </div>
        <div class="modal-footer">
            <a href="{{route('menus')}}" class="btn btn-sm btn-danger" data-bs-dismiss="modal">Batal</a>
            <button type="submit" class="btn btn-sm btn-dark">Simpan</button>
        </form>
    </div>
@endsection