<?php
    //// env 
        if (file_exists('../env.php'))
        {
            include_once('../env.php');
        }
        else
        {
            include_once('env.php');
        }
    //// env 
    session_start();

    if(isset($_GET['data']))
    {
        $d_transaksi = json_decode($_GET['data'], true);
        // var_dump($d_data);
        $crud = new crud;
        $crud->push_tabungan($d_transaksi);
        $crud->push_nontunai($d_transaksi);

    }
    
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


    class crud
    {
        var $db;
        // koneksi
        function __construct()
        {
            $this->db=mysqli_connect( $GLOBALS['host'], $GLOBALS['username'], $GLOBALS['password']) or die ("koneksi salah");
            mysqli_select_db($this->db, $GLOBALS['databasename']) or die ("database salah");
        }
        // create id transaksi
        function id_transaksi($id_user)
        {
            $date = date("dm");
            $rand = substr(md5(microtime()),rand(0,26),6);
            $id = $date.$id_user.$rand;
            return $id;
        }

    /////////////////////////////// GET DATA  ///////////////////////////////

        // fetch_array 1 parameter
        function get($tabel,$where,$whereparameter)
        {
            $query = "SELECT * FROM $tabel WHERE $where='$whereparameter'";
            $results = mysqli_query($this->db, $query) or die (mysqli_error());
            $data=mysqli_fetch_array($results);
            return $data;
        }
        // kosongan 2 parameter
        function get_riwayat($tabel,$where,$whereparameter,$where2,$whereparameter2)
        {
            $query = "SELECT * FROM $tabel WHERE $where='$whereparameter' AND $where2='$whereparameter2'";
            $results = mysqli_query($this->db, $query) or die (mysqli_error());
            return $results;
        }
        // kosongan 1 parameter
        function get_riwayat_admin($tabel,$where,$whereparameter)
        {
            $query = "SELECT * FROM $tabel WHERE $where='$whereparameter'";
            $results = mysqli_query($this->db, $query) or die (mysqli_error());
            return $results;
        }
        // order_by
        function get_order_by($tabel,$where,$whereparameter, $byparm)
        {
            $query = "SELECT * FROM $tabel WHERE $where='$whereparameter' ORDER BY $byparm DESC";
            $results = mysqli_query($this->db, $query) or die (mysqli_error());
            return $results;
        }

    /////////////////////////////// PUSH DATA  ///////////////////////////////

        function push_tabungan($d_transaksi)
        {
                $id_transaksi       =$d_transaksi['id_transaksi'];
                $id_user            =$d_transaksi['id_user'];
                $tanggal_transaksi  =$d_transaksi['tanggal_transaksi'];
                $jumlah_beras       =$d_transaksi['jumlah_beras'];
                $jumlah_uang        =$d_transaksi['jumlah_uang'];
                $jenis_transaksi    =$d_transaksi['jenis_transaksi'];
                $jenis_pembayaran   =$d_transaksi['jenis_pembayaran'];
                $alamat             =$d_transaksi['alamat'];
                $lat                =$d_transaksi['lat'];
                $lng                =$d_transaksi['lng'];
                $status             =$d_transaksi['status'];
                if ($jenis_transaksi == 'uang')
                { $kategori=null;}
                else
                { $kategori=$d_transaksi['kategori'];}

            $sql="INSERT INTO log_tabungan(
                id_transaksi,
                id_user,
                tanggal_transaksi,
                jumlah_transaksi_beras,
                jumlah_transaksi_uang,
                kategori,
                jenis_transaksi,
                jenis_pembayaran,
                alamat,
                lat,
                lng,
                status) 
            VALUES (
                '$id_transaksi',
                '$id_user',
                '$tanggal_transaksi',
                '$jumlah_beras',
                '$jumlah_uang',
                '$kategori',
                '$jenis_transaksi',
                '$jenis_pembayaran',
                '$alamat',
                '$lat',
                '$lng',
                '$status')";
            $query=mysqli_query($this->db,$sql);
            if($query)
            {
                $sql2="UPDATE log_status SET
                s_tabungan='notclear',
                id_transaksi_tabungan='$id_transaksi'
                WHERE id_user='$id_user'";
                $query2=mysqli_query($this->db,$sql2);
                if ($query2) 
                {
                    $_SESSION['tabungan'] = 1;
                    // push_nontunai($d_transaksi);
                    header('Location:../profile/index.php');
                    
                }
            }
        }

        function push_nontunai($d_transaksi)
        {
            $id_transaksi       =$d_transaksi['id_transaksi'];
            $id_user            =$d_transaksi['id_user'];
            $tanggal_transaksi  =$d_transaksi['transaction_time'];
            $tipe_pembayaran    =$d_transaksi['payment_type'];
            $status             =$d_transaksi['transaction_status'];
            $detail_pembayaran  =$d_transaksi['pdf_url'];

            $sql="INSERT INTO log_transaksi_nontunai(
                id_transaksi,
                id_user,
                tanggal_transaksi,
                tipe_pembayaran,
                status,
                detail_pembayaran) 
            VALUES (
                '$id_transaksi',       
                '$id_user',            
                '$tanggal_transaksi',  
                '$tipe_pembayaran',    
                '$status',                
                '$detail_pembayaran')";
            $query=mysqli_query($this->db,$sql);
            if($query)
            {
            }
        }

    }


