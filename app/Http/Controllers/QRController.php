<?php

namespace App\Http\Controllers;

use App\Models\Office;
use Illuminate\Support\Facades\Crypt;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QRController extends Controller
{
    public function generate($officeId) {
        $office = Office::findOrFail($officeId);

        $qr = [
            'office_id' => $office->id,
        ];


        $qr = Crypt::encryptString(json_encode($qr));

        $data['qr'] = QrCode::format('svg')->size(300)->generate($qr);

        return view('pages.qr.generate', $data);
    }

    public function scan() {
        return view('pages.qr.scan');
    }

}
