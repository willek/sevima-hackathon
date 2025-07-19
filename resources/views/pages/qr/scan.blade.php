@extends('components.layout.main')

@section('content')
    <div id="alert-error" class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 max-w-md mx-auto hidden" role="alert">
        <span class="font-medium">Error!</span>
        <p class="message"></p>
    </div>
    <div id="alert-success" class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 max-w-md mx-auto hidden" role="alert">
        <span class="font-medium">Success!</span>
        <p class="message"></p>
    </div>
    <div id="scan-block" class="block p-6 bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
        <h1>Scan QR</h1>

        <div class="w-64 h-64 mx-auto">
            <div id="reader"></div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/html5-qrcode.min.js') }}"></script>
    <script>
        let html5QRCodeScanner = new Html5QrcodeScanner(
            "reader", {
                fps: 10,
                qrbox: {
                    width: 100,
                    height: 100,
                },
            }
        );

        const alertError = document.getElementById('alert-error')
        const alertSuccess = document.getElementById('alert-success')
        const scanBlock = document.getElementById('scan-block')

        var latitude = 0
        var longitude = 0

        getLocation()

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(success, error);
            } else {
                console.log('error get location')
            }
        }

        function success(position) {
            latitude = position.coords.latitude,
                longitude = position.coords.longitude
        }

        function error() {
            console.log('error get location')
        }

        function onScanSuccess(decodedText, decodedResult) {
            // html5QRCodeScanner.clear();
            // console.log(decodedText, decodedResult)

            // let location = getLocation()
            // console.log(location)
            post(decodedText, latitude, longitude)
        }

        function post(string, latitude, longitude) {
            const url = "{{ route('qr.scan') }}";
            const token = "{{ csrf_token() }}";

            fetch(url, {
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-TOKEN": token
                    },
                    method: 'POST',
                    credentials: "same-origin",
                    body: JSON.stringify({
                        data: string,
                        latitude: latitude,
                        longitude: longitude,
                    })
                })
                .then(function(res) {
                    return res.json()
                })
                .then(function(json) {
                    const status = json.status
                    const message = json.message

                    if (status == 'success') {
                        alertSuccess.classList.remove('hidden')
                        alertSuccess.querySelector('.message').innerHTML = message
                    } else {
                        alertError.classList.remove('hidden')
                        alertError.querySelector('.message').innerHTML = message
                    }

                    html5QRCodeScanner.clear();
                    scanBlock.classList.add('hidden')

                    setTimeout(() => {
                        window.location.href = "{{ route('dashboard') }}"
                    }, 3000);
                })
        }

        // render qr code scannernya
        html5QRCodeScanner.render(onScanSuccess);
    </script>
@endsection
