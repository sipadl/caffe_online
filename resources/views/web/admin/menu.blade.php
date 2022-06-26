@extends('web.admin.template')
@section('main')
    <div class="menu p-3">
        {{-- <div class="d-flex justify-content-between">
            <a class="btn btn-sm btn-light" href="{{ route('reset-meja') }}">Reset Semua Meja</a>
            <a class="btn btn-sm btn-light" href="{{ route('plus-meja') }}">Tambah Meja</a>
        </div>
        <div class="p-1">
            <hr>
        </div> --}}
        <div class="d-flex justify-content-between">
            <div class="">
                <h4>List Menu</h4>
            </div>
            <div class="">
                <button type="button" class="btn btn-sm btn-info text-white" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Tambah Menu
                  </button>
            </div>
        </div>
        <div class="text-small" style="font-size: 10px">
            <span>*Ketuk Untuk Mengubah Status menu</span>
        </div>
        @php
            $i = 1;
        @endphp
        <div class="">
            <ul class="list-group p-2" style="border-radius: 12px;">
                @foreach($menu as $ma)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  {{$i++}}. {{ $ma->nama}}
                  <div class="d-flex justify-content-end">
                      <span class="badge bg-info rounded-pill mx-2">
                          <a href="{{ route('edit-menus',[$ma->id])}}" class="text-white">edit</a>
                      </span>
                      <span class="badge bg-danger rounded-pill">
                          <a href="{{ route('delete-menus',[$ma->id])}}" class="text-white">delete</a>
                      </span>
                    </div>
                </li>
                @endforeach
              </ul>
            </div>
        </div>
        <div class="text-center p-4">
            {{ $menu->links() }}
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Tambah Menu</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('post-menus') }}" method="post" enctype="multipart/form-data">
                @csrf
            <div class="modal-body">
                <div class="d-flex justify-content-between mb-2">
                    <div class="title w-25 p-2">nama</div>
                    <div class="w-75">
                        <input type="text" name="nama" class="form-control">
                    </div>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <div class="title w-25 p-2">stock</div>
                    <div class="w-75">
                        <input type="number" name="stock" class="form-control">
                    </div>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <div class="title w-25 p-2">harga</div>
                    <div class="w-75">
                        <input type="number" name="harga" class="form-control">
                    </div>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <div class="title w-25 p-2">Tipe</div>
                    <div class="w-75">
                        <select name="tipe" class="form-control" id="">
                            @foreach($tipe as $sp)
                            <option value="{{$sp->id}}">{{$sp->tipe}}</option>
                            @endforeach
                        </select>
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
                <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-sm btn-dark">Simpan</button>
            </form>
            </div>
          </div>
        </div>
      </div>
      @section('js')
      <script>
          var myDropzone = new Dropzone("div#myId", { url: "/file/post"});
      </script>
      @endsection
@endsection