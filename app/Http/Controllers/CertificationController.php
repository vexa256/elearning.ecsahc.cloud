<?php

namespace App\Http\Controllers;

class CertificationController extends Controller
{
    public function GenerateCertificate()
    {
        $data = [

            "Page" => "cert.cert",

        ];

        return view('scrn', $data);

    }
}