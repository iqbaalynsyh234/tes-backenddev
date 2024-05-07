<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function calculateTax(Request $request)
    {
        $request->validate([
            'total' => 'required|numeric',
            'persen_pajak' => 'required|numeric',
        ]);

        $total = $request->input('total');
        $persenPajak = $request->input('persen_pajak');

        $netSales = $total / (1 + $persenPajak / 100);

        // Hitung jumlah pajak dalam Rupiah
        $pajakRp = $total - $netSales;

        $output = [
            'net_sales' => $netSales,
            'pajak_rp' => $pajakRp,
        ];

        return response()->json($output);
    }
}