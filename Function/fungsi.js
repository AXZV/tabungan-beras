
//////////////////// rubah ke angka normal ////////////////////

function rubahangka(totalharga) // 5.000,25
{
        if (totalharga.includes("."))
        {
            var takenondecimal=totalharga.substr(0, totalharga.indexOf('.'));// ambil angka sebelum koma
            var takedecimal    = totalharga.split('.').pop();// ambil angka setelah koma
        }
        else
        {
            takenondecimal = totalharga;
            takedecimal = null;
        }
        var hasilnumber = String(takenondecimal).replace(/(.)(?=(\d{3})+$)/g,'$1.') // format ke angka
        if (totalharga.includes("."))
        {
            var finalangka = hasilnumber+","+takedecimal;
        }
        else
        {
            finalangka=hasilnumber;
        }

        return finalangka;
}

//////////////////// rubah ke angka ke rupiah ////////////////////

function formatRupiah(angka, prefix) // 5.000,2
{
    var number_string = angka.replace(/[^,\d]/g, "").toString(),
        split = number_string.split(","),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if (ribuan) {
        separator = sisa ? "." : "";
        rupiah += separator + ribuan.join(".");
    }

    rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
    return prefix == undefined ? rupiah : rupiah ? rupiah : "";
}

//////////////////// Minimal cod tabungan ////////////////////

function mincod(xx, parameter)
{
    var vals = xx.replace(/\./g,'');
    var valss = Number(vals);
    if( valss < parameter ) {
       return $('#kirim').attr('disabled', true);
    }
    else if ( valss >= parameter) {
       return $('#kirim').attr('disabled', false);
    }
}

//////////////////// rubah angka ke format number ////////////////////

function angkatonumxy(angkaxy) // 5000.2
{
    var vals = angkaxy.replace(/\./g,''); /// hapus .
    var vals2 = vals.replace(/\,/g,'.'); /// ganti , menjadi .
    return vals2;
}