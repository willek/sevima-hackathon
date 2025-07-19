<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        @vite('resources/css/app.css')
    </head>

    <body class="min-h-screen flex justify-center items-center">

        <div>
            {{-- <button>Clock In</button>
            <button>Clock Out</button> --}}

            <button id="btn-in" type="button" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                Clock In
            </button>
            <button id="btn-out" type="button" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                Clock Out
            </button>
        </div>

        <div id="in" style="display: none">
            {{ $qr_in }}
        </div>
        <div id="out" style="display: none">
            {{ $qr_out }}
        </div>

        <script>
            const qr_in = document.getElementById('in');
            const qr_out = document.getElementById('out');

            const btn_in = document.getElementById('btn-in');
            const btn_out = document.getElementById('btn-out');

            const button = document.querySelectorAll('button');

            btn_in.onclick = () => {
                qr_in.style.display = 'block';
                qr_out.style.display = 'none';
                hideButton()
            }
            btn_out.onclick = () => {
                qr_in.style.display = 'none';
                qr_out.style.display = 'block';
                hideButton()
            }

            function hideButton () {
                for (let i = 0; i < button.length; i++) {
                    button[i].style.display = "none";
                }
            }
        </script>
    </body>

</html>
