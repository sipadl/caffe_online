@extends('template.main')
@section('content')
@section('title', 'Pembayaran Berhasil')
@section('style')
<style>
/* input[type="radio"]{
  visibility: hidden;
  height: 0;
  width: 0;
} */
</style>
@endsection
@php
    $p = Request::segment(2);
    $d = Request::segment(3);
@endphp
<div id="accordion">
    <div class="card">
        <div class="card-body">
            <div class="">
                <div class="d-flex justify-content-between">
                    <h6>Nama Pemesan</h6>
                    {{$user->name}}
                </div>
            </div>
            <div class="">
                <div class="d-flex justify-content-between">
                    <h6>Meja</h6>
                    {{$booked->no_meja}}
                </div>
            </div>
            <hr>
            <div class="">
                    <h6>Pesanan</h6>
                    <ul>
                    @foreach($carts as $dd)
                    @php
                    $data = \App\Models\Menu::where('id' , $dd->id_menu)->first();
                    @endphp
                        <li>{{$data->nama .' x '.$dd->qty.' pcs'}}</li>
                        @endforeach
                    </ul>
            </div>
            <hr>
            <div class="">
                <div class="d-flex justify-content-between">
                    <h6>Total</h6>
                    <strong>
                        {{'Rp.'.number_format($carts->sum('total'),0)}}
                    </strong>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="card my-1">
      <div class="card-header" id="headingOne">
        <h5 class="mb-0">
          <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            Cash on Cashier
          </button>
        </h5>
      </div>
      <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
        <div class="card-body">
            <ol>
                <li>Mendatangi Kasir Terdekat</li>
                <li>Menyiapkan Uang Tunai</li>
                <li>Maka Kasir akan memberikan nota pembayaran sebagai bukti telah membayar</li>
                <li>Maka Kami akan memproses makanan yang sudah anda pesan</li>
            </ol>
        </div>
      </div>
    </div>
    <div class="card my-1">
      <div class="card-header" id="headingTwo">
        <h5 class="mb-0">
          <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            QRIS Payment
          </button>
        </h5>
      </div>
      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
        <div class="card-body">
            <div class="justify-content-center">
                <img src="{{ ('/assets/img/qris.jpg') }}" class="img-thumbnail">
                <h6 class="my-2">Tata Cara Pembayaran</h6>
                <ol>
                    <li>Silahkan Scan QR Tesebut</li>
                    <li>Screenshoot untuk melakukan konfirmasi pada halaman berikutnya</li>
                    <li>Pastikan saldo yang anda miliki sudah sesuai</li>
                </ol>
            </div>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header" id="headingThree">
        <h5 class="mb-0">
          <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
            Bank Transfer
          </button>
        </h5>
      </div>
      <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
        <div class="card-body">
            <blockquote class="justify-content-between">
                No. Rekening : 882193210 - BCA
            </blockquote>
            <h6 class="my-2">Tata Cara Pembayaran</h6>
            <ol>
                <li>Silahkan Melakukan pembayaran melakukan BANK yang sudah disediakan</li>
                <li>Perbedaan pada bank akan dikenakan biaya charge melalui bank masing-masing yang tidak ditanggung oleh kami</li>
                <li>Screenshoot untuk melakukan konfirmasi pada halaman berikutnya</li>
                <li>Pastikan saldo yang anda miliki sudah sesuai</li>
            </ol>
        </div>
      </div>
    </div> --}}
  </div>
  {{-- <form action="{{ route('detail-orders') }}" method="post" enctype="multipart/form">
    <div class="form-group row">
        <input type="hidden" name="kode" id="code" value="">
        <label for="" class="col-sm-4 control-label">Upload Bukti Pembayaran</label>
        <div class="col-sm-8">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">Upload</span>
                </div>
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="inputGroupFile01">
                  <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                </div>
              </div>
        </div>
    </div>
      <div class="fixed-botom" style="position: relative; text-align: -webkit-center">
        <button type="submit" class="btn btn-primary d-block w-100 p-2" style="border-radius:20px">Konfirmasi Pembayaran</button>
    </div>
</form> --}}
@section('script')
<script>
    $(document).ready(function() {
        $('#code').val(localStorage.getItem('code'));
    })

</script>
@endsection
@endsection
