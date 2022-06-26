@extends('template.main')
@section('content')
@section('style')
<style>
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
    /* display: none; <- Crashes Chrome on hover */
    -webkit-appearance: none;
    margin: 0; /* <-- Apparently some margin are still there even though it's hidden */
}

input[type=number] {
    -moz-appearance:textfield; /* Firefox */
}
</style>
@endsection
<div class="" style="
    min-height: 30rem;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
">
<div class="d-flex">
    <div class="card w-100" style="
    min-width: 24rem;
    min-height: 16rem;
    border-radius: 12px;
    box-shadow: 5px 5px 5px 0px rgba(0,0,0,0.27);
-webkit-box-shadow: 5px 5px 5px 0px rgba(0,0,0,0.27);
-moz-box-shadow: 5px 5px 5px 0px rgba(0,0,0,0.27);">
            <img class="my-4" src="https://pondokindahmall.co.id/assets/img/default.png" width="64px" height="64px" style="margin:0 auto" alt="">
            <form id="meja" onsubmit="return false" method="post">
                <div class="d-flex p-2 justify-content-center">
                    <label for="" class="w-25 mt-1">Nama</label>
                    <input type="text" name="name" id="name" class="form-control w-50">
                </div>
                <div class="d-flex p-2 justify-content-center">
                    <label for="" class="w-25 mt-1">No. Hp</label>
                    <input type="number" name="no_hp" id="no_hp" class="form-control w-50">
                </div>
                <div class="d-flex justify-content-center p-4">
                    <button type="submit" class="btn btn-info text-light" style="margin: 0 auto;">Tambahkan Informasi</button>
                </div>
            </form>
        </div>
    </div>
</div>
@section('script')
    <script>
        $('#meja').on('submit', () => {
            let nama = $('#name').val();
            $.post("{{route('mejas')}}", {
                name:$('#name').val(),
                no_hp:$('#no_hp').val(),
            },
                function (data) {
                    if(data.auth == true)
                    {
                        var uri = window.location.origin;
                        window.location.replace(`${uri}/menu/${data.uri}`)
                    }
                },
            );
        });
    </script>
@endsection
@endsection