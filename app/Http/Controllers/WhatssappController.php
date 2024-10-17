<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class WhatssappController extends Controller
{
    public function wagw(){
        return view('whatsapp/index');
    }

    public function send(Request $request) : RedirectResponse
{
    $pesan = $request->pesan;
    $nowa = $request->nowa;
    $token = '8rfAZaEm4SGUyg@MTjia';

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.fonnte.com/send',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array('target' => $nowa, 'message' => $pesan),
        CURLOPT_HTTPHEADER => array("Authorization: $token"),
        CURLOPT_SSL_VERIFYPEER => false,
    ));

    $response = curl_exec($curl);

    if (curl_errno($curl)) {
        \Log::error('Curl error: ' . curl_error($curl));
    } else {
        \Log::info('Response from Fonnte: ' . $response);
    }

    curl_close($curl);

    return Redirect::back()->with('success', 'Pesan Terkirim');
}

}
