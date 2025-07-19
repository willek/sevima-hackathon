@extends('components.layout.main')

@section('content')
    <div class="block p-6 bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
        <div>
            <h1>Scan QR</h1>

            <div class="w-64 h-64 mx-auto">
                <div id="reader"></div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script src="{{ asset('js/html5-qrcode.min.js') }}"></script>
<script>
    // inisiasi html5QRCodeScanner
    let html5QRCodeScanner = new Html5QrcodeScanner(
        // target id dengan nama reader, lalu sertakan juga
        // pengaturan untuk qrbox (tinggi, lebar, dll)
        "reader", {
            fps: 10,
            qrbox: {
                width: 100,
                height: 100,
            },
        }
    );

    // function yang dieksekusi ketika scanner berhasil
    // membaca suatu QR Code
    function onScanSuccess(decodedText, decodedResult) {
        // redirect ke link hasil scan
        // window.location.href = decodedResult.decodedText;

        // membersihkan scan area ketika sudah menjalankan
        // action diatas
        // html5QRCodeScanner.clear();
        console.log(decodedText, decodedResult)
    }

    // render qr code scannernya
    html5QRCodeScanner.render(onScanSuccess);
</script>
@endsection
