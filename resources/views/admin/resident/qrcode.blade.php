@extends('admin.layout.default')

@section('title', 'QR Code')

@section('body')

    <div class="container-xl">

        <div class="card">

            <div class="card-header">
                <i class="fa fa-qrcode"></i>QR Code for {{ $resident->name }}
            </div>

            <div class="card-body">

                <div>
                    <qrcode id="qr_code"
                            value="{{ $resident->id.'|'.str_replace(' ', '-', $resident->name) }}"
                            :options="{ width: 500 }">
                    </qrcode>
                </div>

                <button onclick="printQRCode('{{ $resident->name }}'); return false;">Print</button>

            </div>

        </div>

    </div>

@endsection

<script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
<script>
    function printQRCode(title) {
        printJS({
            printable: document.querySelector("#qr_code").toDataURL(),
            type: 'image',
            imageStyle: 'width:250px;height:250px',
            documentTitle: title
        });
    }
</script>