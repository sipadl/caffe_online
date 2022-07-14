@extends('template.main')
@section('content')
@section('title', 'Pilih Menu')
@section('style')
<style>
    .list-group .list-group-item{
        border-radius: 12px;
    }
</style>
@endsection
    <ul class="list-group">
        @foreach($menus as $enum)
        <li class="list-group-item mb-1">
            <div class="d-flex justify-content-between">
                <div class="right-side w-100">
                    <div class="d-flex">
                        <img src="{{ $enum->img }}" width="64px" class="img-thumbnail" style="object-fit:cover" height="64px" alt="">
                        <div class="detail px-2 p-1">
                            <h6 class="m-0 p-0">{{$enum->nama}}</h6>
                            <p>
                            {{'Rp '. number_format($enum->harga,0)}}<br>
                        </p>
                        </div>
                    </div>
                </div>
                <div class="left-side w-25 align-self-end">
                    <div class="d-flex pb-2 justify-content-end">
                            <span>
                                <a class="btn btn-info plus" href="javascript:;" data-id="{{ $enum->id }}">+</a>
                            </span>
                        </form>
                    </div>
                </div>
            </div>
        </li>
        @endforeach
    </ul>
    <div class="mb-5"></div>
@endsection
@section('script')
<script>

    var j = window.location.pathname.split('/');
    k = j[2];

    $(document).ready( () => {
        $.post("{{ route('cart') }}", {kode: k},
              function (data) {
                  $('#qtyx').html(data.data.length + '   items');
              },
          );
    });

    $('body .plus').on('click', function() {
        var t = $(this);
        $.post("{{ route('add-cart') }}", { menu:t.data('id'), kode: k },
        function (data) {
        //   console.log(data);
          $.post("{{ route('cart') }}", {kode: k},
              function (data) {
                  $('#qtyx').html(data.data.length + '   items');
              },
          );
        },
        );
    });
    </script>

@endsection
