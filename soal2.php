<?php
function urutkanDanHitung($kartuStok, $saldoAwalStok, $saldoAwalStokRp) {
    usort($kartuStok, function($a, $b) {
        return strtotime($a->tanggal) - strtotime($b->tanggal);
    });

    $saldoQty = $saldoAwalStok;
    $saldoRp = $saldoAwalStokRp;

    foreach ($kartuStok as $index => $data) {
        if ($index > 0) {
            $kartuStok[$index]->saldoQty = $saldoQty;
            $kartuStok[$index]->saldoRp = $saldoRp;
            $kartuStok[$index]->keluarRp = $kartuStok[$index - 1]->saldoRp / $kartuStok[$index - 1]->saldoQty * $data->keluar;
        }

        $saldoQty += $data->masuk - $data->keluar;
        $saldoRp += $data->masukRp - $kartuStok[$index]->keluarRp;

        $kartuStok[$index]->saldoQty = $saldoQty;
        $kartuStok[$index]->saldoRp = $saldoRp;
    }

    return $kartuStok;
}

$saldoAwalStok = 0;
$saldoAwalStokRp = 0;

$kartuStok = array(
    (object)array("tanggal" => "2021-10-01", "masuk" => 10, "keluar" => 0, "saldoQty" => 0, "masukRp" => 10000, "keluarRp" => 0, "saldoRp" => 0),
    (object)array("tanggal" => "2021-10-03", "masuk" => 45, "keluar" => 0, "saldoQty" => 0, "masukRp" => 36000, "keluarRp" => 0, "saldoRp" => 0),
    (object)array("tanggal" => "2021-10-05", "masuk" => 40, "keluar" => 0, "saldoQty" => 0, "masukRp" => 35000, "keluarRp" => 0, "saldoRp" => 0),
    (object)array("tanggal" => "2021-10-02", "masuk" => 0, "keluar" => 5, "saldoQty" => 0, "masukRp" => 0, "keluarRp" => 0, "saldoRp" => 0),
    (object)array("tanggal" => "2021-10-04", "masuk" => 0, "keluar" => 40, "saldoQty" => 0, "masukRp" => 0, "keluarRp" => 0, "saldoRp" => 0),
    (object)array("tanggal" => "2021-10-06", "masuk" => 0, "keluar" => 35, "saldoQty" => 0, "masukRp" => 0, "keluarRp" => 0, "saldoRp" => 0)
);

$hasil = urutkanDanHitung($kartuStok, $saldoAwalStok, $saldoAwalStokRp);
?>


<title>Data Kartu</title>
<style>
table {
    width: 100%;
    border-collapse: collapse;
}

table,
th,
td {
    border: 1px solid black;
    padding: 8px;
    text-align: left;
}

th {
    background-color: #f2f2f2;
}
</style>

<h2>Data Stok Kartu</h2>
<table>
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Masuk</th>
            <th>Keluar</th>
            <th>Saldo Qty</th>
            <th>Masuk Rp</th>
            <th>Keluar Rp</th>
            <th>Saldo Rp</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($hasil as $data): ?>
        <tr>
            <td><?php echo $data->tanggal; ?></td>
            <td><?php echo $data->masuk; ?></td>
            <td><?php echo $data->keluar; ?></td>
            <td><?php echo $data->saldoQty; ?></td>
            <td><?php echo $data->masukRp; ?></td>
            <td><?php echo $data->keluarRp; ?></td>
            <td><?php echo $data->saldoRp; ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>