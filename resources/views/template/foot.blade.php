
@if(Request::segment(1) != '')
@php
$p = Request::segment(2);
$d = Request::segment(3);
@endphp
</div>
</section>
</div>
<div class="fixed-bottom d-none">
  <div class="d-flex justify-content-between bg-dark">
      <div class="nav-link left">
    @if(Request::segment(1) != 'waiting' AND Request::segment(1) != 'bayar' AND Request::segment(1) != 'barcode' )
          <h5 class="text-light my-2">Total : <span id="qtyx">0 Items</span></h5>
         @if($d)
          <h5 class="text-light my-2">Total Bayar : <span id="bayar">Rp 0</span></h5>
        @endif
    @endif
        </div>
      <div class="nav-link right p-3">
          @if($d)
          <a href="{{ route('web.menu',[$d])}}" class="btn btn-info text-light">
              Kembali
          </a>
          <a href="{{ route('make-order',[$d])}}" class="btn btn-info text-light">
              Proses
          </a>
          @else
            @if(Request::segment(1) == 'payment')
            <a href="{{ route('bayar',[$p])}}" class="btn btn-info text-light">
                Bayar
            </a>
            @elseif(Request::segment(1) == 'waiting')
            <a href="{{ route('bayar',[$p])}}" class="btn btn-info text-light">
                Pilih Metode Pembayaran
            </a>
            @else
                @if(Request::segment(1) == 'bayar')
                <button type="button" id="barcode" class="btn btn-info text-light">
                    Lihat QR Code / Virtual Account
                </button>
                @else
                    @if(Request::segment(1) == 'barcode')
                    {{-- <a href="{{ route('tq',[$p])}}" class="btn btn-info text-light">
                        Selesai
                    </a> --}}
                    @else
                    <a href="{{ route('li-cart',[$p])}}" class="btn btn-info text-light">
                        Proses
                    </a>
                    @endif
                @endif
            @endif
          @endif
      </div>
  </div>
</div>
@endif
</div>
</div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="{{ @asset('assets/js/stisla.js') }}"></script>
@yield('script')
</html>
