<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function calculateDiscount(Request $request)
    {
        // Validasi input
        $request->validate([
            'discounts' => 'required|array',
            'discounts.*.diskon' => 'required|numeric',
            'total_sebelum_diskon' => 'required|numeric',
        ]);

        // Ambil nilai diskon dari request
        $discounts = $request->input('discounts');
        $totalSebelumDiskon = $request->input('total_sebelum_diskon');

        // Hitung total rupiah diskon
        $totalDiskon = 0;
        foreach ($discounts as $discount) {
            $totalDiskon += $totalSebelumDiskon * $discount['diskon'] / 100;
        }

        // Hitung total harga setelah diskon
        $totalHargaSetelahDiskon = $totalSebelumDiskon - $totalDiskon;

        // Format output JSON
        $output = [
            'total_diskon' => $totalDiskon,
            'total_harga_setelah_diskon' => $totalHargaSetelahDiskon,
        ];

        // Kembalikan output dalam bentuk JSON
        return response()->json($output);
    }
}