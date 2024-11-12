<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registration;

class RegistrationController extends Controller
{
    public function showForm()
    {
        return view('registration.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'confirm_email' => 'required|same:email',
            'program_studi' => 'required|string|max:255',
'nim' => 'required|string|in:
200201010200,
200201072086,
200201072025,
200201072106,
200201010193,
200201072064,
200201072281,
200201072229,
200201072269,
200201010179,
200201072218,
220201020022,
200201072150,
200201072213,
200201072050,
200201072298,
200201072157,
230201020038,
200201010077,
220201020031,
200201010071,
200201072104,
200201072130,
200201072274,
200201072197,
200201010082,
200201072225,
200201072123,
230201020015,
200201072005,
200201010172,
200201010096,
200201072033,
220201020040,
200201010174,
200201010128,
200201072051,
220201020039,
200201072199,
200201072011,
200201072190,
200201072047,
200201072297,
200201072231,
200201010080,
200201072173,
200201072023,
200201010114,
200201072167,
200201072019,
200201072223,
200201072095,
230201020026,
200201072260,
200201072162,
200201072134,
200201072252,
230201020017,
200201010215,
200201072284,
200201010118,
200201072055,
200201072044,
200201010074,
230201020032,
200201072105,
200201010178,
200201070072,
200201010206,
200201072112,
200201072114,
200201010217,
200201010151,
200201072137,
200201072074,
200201072002,
230201020033,
200201010123,
200201072276,
200201072107,
230201020019,
230301020003,
200301072073,
200301072114,
200301072062,
200301072051,
200301072089,
200301010034,
200301010021,
230301020004,
200301072066,
200301072063,
200301010060,
200301072064,
230301020007,
200301072043,
220301020007,
200301072093,
220301020015,
200301072061,
200501010022,
200501010051,
200501072010,
200501010028,
200501010033,
200501010009,
200501010048,
200501010039,
200501010105,
200501072003,
200502072045,
220501020011,
200501072060,
200501010048,
200501072057,
220101020005,
220101020044,
230101020071,
230101020017,
220101020007,
200101010088,
200101072060,
230101020015,
200101010109,
220101020001,
200101010124,
220101020028,
200101010052,
200101010065,
200101010048,
220101020034,
200101072075,
230101020047,
200101010018,
200101010025,
200101010095,
200101010002,
200101010104,
230101020070,
200401072035,
220401020006,
200401010156,
220401020003,
200401010179,
200401010120,
200401072041,
200401072174,
200401072091,
200401010048,
220401020008,
230401020046,
220401020013,
200401072073,
200401010076,
200401010150,
200401010115,
220401020011,
230401020034,
200401072178,
200401072031,
230401020044,
230401020045,
200401010072,
230401020038,
200401010168,
200401072094,
200401010109,
220401020002,
220401020022,
200401010186,
11111,
22222,
33333,
44444,
55555
|unique:registrations,nim',
            'graduation_type' => 'required|string|in:online,onsite',
            'toga_size' => 'required|string|in:S,M,L,XL,XXL',
            'delivery' => 'required|string|in:Dikirim,Ambil Dikampus Universitas Siber Asia',
            'graduation_payment_file' => 'required|file|mimes:jpg,png,pdf|max:10240',
            'family_payment_file' => 'nullable|file|mimes:jpg,png,pdf|max:10240',
        ]);

        if ($request->delivery === 'Dikirim') {
            $request->validate([
                'address' => 'required|string|max:255',
                'city' => 'required|string|max:255',
                'province' => 'required|string|max:255',
                'postal_code' => 'required|string|max:10',
            ]);
        }

        $registration = new Registration($validated);

        if ($request->hasFile('graduation_payment_file')) {
            $graduationPaymentPath = $request->file('graduation_payment_file')->store('bukti_pembayaran/wisuda');
            $registration->graduation_payment_file = $graduationPaymentPath;
        }
        $validated = $request->validate([
            'graduation_type' => 'required|string|in:online,onsite',
        ]);
        
        if ($request->hasFile('family_payment_file')) {
            $familyPaymentPath = $request->file('family_payment_file')->store('bukti_pembayaran/keluarga');
            $registration->family_payment_file = $familyPaymentPath;
        }

        $registration->save();

        return back()->with('success', 'Pendaftaran berhasil!');
    }
}
