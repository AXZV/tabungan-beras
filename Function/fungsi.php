<?php

    class konversi
    {
        function normal($jumlah)
        {

            $totaltabungan = $jumlah;
            if (strpos($totaltabungan, '.') !== false) {
                $b=strstr($totaltabungan, '.', true);
                $removecoma = str_replace('.', '', $b );
                $takedecimal =  substr($totaltabungan, strpos($totaltabungan, ".") + 1); 
            }
            else
            {
                $removecoma = $totaltabungan;
                $takedecimal = null;
            }
            $hasil_rupiah = number_format($removecoma,0,'','.');
            if (strpos($totaltabungan, '.') !== false) {
                $finaltotalsaldo=$hasil_rupiah.",".$takedecimal;
            }
            else
            {
                $finaltotalsaldo=$hasil_rupiah;
            }
    
            return $finaltotalsaldo;
            
        }
    }

?>