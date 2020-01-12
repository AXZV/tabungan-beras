<?php

    class konversi
    {
        function normal($jumlah) /// 1.500,25 Kg
        {

            $totaltabungan = $jumlah;
            if (strpos($totaltabungan, '.') !== false) { // cek apakah ada titik. Ya
                $b=strstr($totaltabungan, '.', true); //ambil angka sebelum koma
                $removecoma = str_replace('.', '', $b ); // hapus titik
                $takedecimal =  substr($totaltabungan, strpos($totaltabungan, ".") + 1); // ambil char setelah titik
            }
            else
            {
                $removecoma = $totaltabungan;
                $takedecimal = null;
            }
            $hasil_rupiah = number_format($removecoma,0,'','.'); // merubah menjadi format nomor c: 1.000.000
            if (strpos($totaltabungan, '.') !== false) {
                $finaltotalsaldo=$hasil_rupiah.",".$takedecimal;
            }
            else
            {
                $finaltotalsaldo=$hasil_rupiah;
            }
    
            return $finaltotalsaldo;
            
        }

        function nonnormal($jumlah) /// 1500.25
        {
            $removedot = str_replace('.', '', $jumlah );
            $replacecomatodot = str_replace(',', '.', $removedot );
            return $replacecomatodot;
        }
    }

?>