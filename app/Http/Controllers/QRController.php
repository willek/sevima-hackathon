<?php

namespace App\Http\Controllers;

use App\Models\Office;
use Carbon\Carbon;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QRController extends Controller
{
    public function generate($officeId)
    {
        $office = Office::findOrFail($officeId);

        $qr_in = [
            'office_id' => $office->id,
            'is_in' => true,
        ];

        $qr_out = [
            'office_id' => $office->id,
            'is_out' => true,
        ];


        $qr_in = Crypt::encryptString(json_encode($qr_in));
        $qr_out = Crypt::encryptString(json_encode($qr_out));

        $data['qr_in'] = QrCode::format('svg')->size(300)->generate($qr_in);
        $data['qr_out'] = QrCode::format('svg')->size(300)->generate($qr_out);

        return view('pages.qr.generate', $data);
    }

    public function scan()
    {
        return view('pages.qr.scan');
    }

    public function debug()
    {
        // dd(now());
    }

    public function scan_post(Request $request)
    {
        try {
            $decrypt = crypt::decryptString($request->data);
        } catch (DecryptException $th) {
            return false;
        }

        $data = json_decode($decrypt, true);

        // this office lat lng is sevima coordinates
        $office = Office::findOrFail($data['office_id']);
        $user = auth()->user();
        $action = isset($data['is_in']) && $data['is_in'] === true ? 'in' : 'out';

        // dd($data);

        // $req = [
        //     'lat1' => floatval($request->latitude),
        //     'lng1' => floatval($request->longitude)
        // ];

        // mimick konka coffe, because hard to get current location on localhost
        $req = [
            'lat1' => floatval(-7.326823695993475),
            'lng1' => floatval(112.79191873744492),
        ];

        $target = [
            'lat2' => floatval($office->lat),
            'lng2' => floatval($office->lng)
        ];

        $validateLocation = $this->isCloseTo($req, $target, 500);

        if ($validateLocation) {
            $isCheckedIn = $user->attendances()
                ->where('office_id', $data['office_id'])
                ->whereDate('clock_in', Carbon::today())
                ->first();

            $isCheckedOut = $user->attendances()
                ->where('office_id', $data['office_id'])
                ->whereDate('clock_out', Carbon::today())
                ->first();

            $saveData = [
                'office_id' => $data['office_id'],
                'lat' => $req['lat1'],
                'lng' => $req['lng1'],
                'date' => now()->format('Y-m-d')
            ];

            if ($action === 'in' && !$isCheckedIn) {
                $saveData['clock_in'] = now()->format('H:i:s');

                $user->attendances()->create($saveData);

                return response()->json(['status' => 'success', 'message' => 'Successfully clocked in']);
            } else if ($action === 'out' && $isCheckedIn && !$isCheckedOut) {
                $saveData['clock_out'] = now()->format('H:i:s');

                $user->attendances()->where('office_id', $saveData['office_id'])->whereDate('clock_in', Carbon::today())->update($saveData);

                return response()->json(['status' => 'success', 'message' => 'Successfully clocked out']);
            }

            return response()->json(['status' => 'failed', 'message' => 'You have already clocked ' . $action]);
        }

        return response()->json(['status' => 'failed', 'message' => 'Failed to clock ' . $action]);
    }

    // haversine formula | AI generated to calculate if a coordinate is close to another
    function isCloseTo($req, $target, $thresholdInMeters = 1000)
    {
        $earthRadius = 6371000; // in meters

        $req['lat1'] = deg2rad($req['lat1']);
        $req['lng1'] = deg2rad($req['lng1']);
        $target['lat2'] = deg2rad($target['lat2']);
        $target['lng2'] = deg2rad($target['lng2']);

        $latDelta = $target['lat2'] - $req['lat1'];
        $lngDelta = $target['lng2'] - $req['lng1'];

        $a = sin($latDelta / 2) ** 2 + cos($req['lat1']) * cos($target['lat2']) * sin($lngDelta / 2) ** 2;
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        $distance = $earthRadius * $c;

        return $distance <= $thresholdInMeters;
    }
}
