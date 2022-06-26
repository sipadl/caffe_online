@extends('template.main')
@section('content')
@section('title', 'Keranjang')
@section('style')
{{-- Style --}}
@endsection
@php
    $p = Request::segment(2);
    // dd($p);
    $d = Request::segment(3);
    @endphp
<ul class="list-group" id="keranjang">
</ul>
<div class="fixed-botom p-4" style="position: relative; text-align: -webkit-center">
    <a href="{{ route('bayar',[$p])}}" class="btn btn-primary d-block w-100 p-2" style="border-radius:20px">Bayar Sekarang</a>
</div>
@section('script')
<script>
    localStorage.setItem('code', '{{ $p }}');
    var j = window.location.pathname.split('/');
    k = j[2];
    var Pondel = {
        aa:(isi) => {
            return `
            <li class="list-group-item my-1 border">
                <div class="d-flex justify-content-between">
                <div class="right-side w-100">
                    <div class="d-flex">
                        <img src="${isi.items[0].img}" width="64px" class="img-thumbnail" style="object-fit:contain" height="64px" alt="">
                        <div class="detail px-2 py-1">
                            <h5>${isi.items[0].nama}</h5>
                            <p>
                                Rp ${isi.items[0].harga}. x ${isi.qty} Pcs<br>
                        </p>
                            </div>
                            </div>
                            </div>
                <div class="left-side w-50 align-self-end">
                    <div class="d-flex pb-2 justify-content-end">
                            <span>
                                <a class="btn btn-info delete" id="delete" href="javascript:;" data-id="${isi.id}">Hapus</a>
                            </span>
                        </form>
                        </div>
                        </div>
                        </div>
                    </li>`
                },
            }

            $(document).ready(function() {
                $.post("{{ route('cart') }}", {kode: k},
                function (data) {
                    $('#qtyx').html(data.data.length +' items');
                    $('#bayar').html(`Rp ${data.total}`);
                        data.data.forEach(isi => {
                            $('#keranjang').append(Pondel.aa(isi));
                            });
                            $('body .delete').on('click', function() {
                                var p = $(this);
                                z = p.data('id');
                                $.post("{{ route('delete-cart')}}", {kode:k, id:z},
                                    function (data) {
                                        $.post("{{ route('cart') }}", {kode:k},
                                            function (data) {
                                                $('#keranjang').html('');
                                                $('#qtyx').html(data.data.length +' items');
                                                $('#bayar').html(`Rp ${data.total}`);
                                                    data.data.forEach(isi => {
                                                    $('#keranjang').append(Pondel.aa(isi));
                                                });
                                            },
                                        );
                                    },
                                );
                            });
                        },
                    );
                });


</script>
@endsection
@endsection
