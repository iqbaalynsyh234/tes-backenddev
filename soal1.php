<?php
function urutDanHitungSaldo($saldoawal, $mutasi) {
    // Fungsi untuk membandingkan tanggal dua objek
    function tanggalCompare($a, $b) {
        return strtotime($a->tanggal) - strtotime($b->tanggal);
    }

    // Urutkan array $mutasi berdasarkan tanggal
    usort($mutasi, "tanggalCompare");

    // Hitung saldo setiap indeks
    $saldo = $saldoawal;
    foreach ($mutasi as $transaksi) {
        $saldo += $transaksi->masuk - $transaksi->keluar;
        $transaksi->saldo = $saldo;
    }

    // Persiapkan array untuk menyimpan data
    $result = array();
    foreach ($mutasi as $transaksi) {
        $result[] = array(
            'tanggal' => $transaksi->tanggal,
            'masuk' => $transaksi->masuk,
            'keluar' => $transaksi->keluar,
            'saldo' => $transaksi->saldo
        );
    }

    // Kembalikan hasil sebagai JSON
    return json_encode($result);
}

// Input
$saldoawal = 100000;
$mutasi = array(
    (object)array("tanggal" => "2021-10-01", "masuk" => 200000, "keluar" => 0, "saldo" => 0),
    (object)array("tanggal" => "2021-10-03", "masuk" => 300000, "keluar" => 0, "saldo" => 0),
    (object)array("tanggal" => "2021-10-05", "masuk" => 150000, "keluar" => 0, "saldo" => 0),
    (object)array("tanggal" => "2021-10-02", "masuk" => 0, "keluar" => 100000, "saldo" => 0),
    (object)array("tanggal" => "2021-10-04", "masuk" => 0, "keluar" => 150000, "saldo" => 0),
    (object)array("tanggal" => "2021-10-06", "masuk" => 0, "keluar" => 50000, "saldo" => 0)
);

// Panggil fungsi dan cetak hasil sebagai JSON
echo urutDanHitungSaldo($saldoawal, $mutasi);
?>