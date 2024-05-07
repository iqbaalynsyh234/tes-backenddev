<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RevenueShareController extends Controller
{
    public function calculateRevenueShare(Request $request)
    {
        $request->validate([
            'harga_sebelum_markup' => 'required|numeric',
            'markup_persen' => 'required|numeric',
            'share_persen' => 'required|numeric',
        ]);

        $hargaSebelumMarkup = $request->input('harga_sebelum_markup');
        $markupPersen = $request->input('markup_persen');
        $sharePersen = $request->input('share_persen');

        $hargaSetelahMarkup = $hargaSebelumMarkup * (1 + $markupPersen / 100);

        $netUntukResto = $hargaSetelahMarkup * (1 - $sharePersen / 100);

        $shareUntukOjol = $hargaSetelahMarkup * ($sharePersen / 100);

        $output = [
            'net_untuk_resto' => $netUntukResto,
            'share_untuk_ojol' => $shareUntukOjol,
        ];

        return response()->json($output);
    }
}