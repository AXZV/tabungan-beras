<?php

    namespace Midtrans;
    
    require_once dirname(__FILE__) . '/../Midtrans.php';
    include '../env.php';



    function show_snap_pay($snapToken, $data_transaksi)
    {
        ?>
            <!DOCTYPE html>
            <html>
            <style>
                .bodyx{
                    background-color:grey;
                }
            </style>
                <body class="bodyx">
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
                    <script src="<?php echo $GLOBALS['APP_URL'] ?>/snap/snap.js" data-client-key="<?php echo $GLOBALS['client_key'] ?>"></script>
                    <script>
                        snap.pay('<?php echo $snapToken ?>', {
                            onPending: function(result)
                            {
                                var data_transaksi = <?php echo json_encode($data_transaksi); ?>;
                                delete result.finish_redirect_url;

                                var final_data = {...data_transaksi, ...result };
                                data = JSON.stringify(final_data);

                                document.location.replace('../function/fungsi.php?data='+data);

                            },
                            onClose: function()
                            {
                                document.location.replace('../tabungan/uang.php');
                            }
                        });
                    </script>   
                </body>
            </html>
        <?php
    }


    class midtransx
    {

        function snap_pay($data_transaksi)
        {
            $order_id = $data_transaksi['id_transaksi'];
            $gross_amount = $data_transaksi['jumlah_uang'];
            $nama = $data_transaksi['nama'];
            $tlp = $data_transaksi['tlp'];
            $email = $data_transaksi['email'];

            Config::$serverKey = $GLOBALS['server_key'];

            // Uncomment for production environment
            // Config::$isProduction = true;

            Config::$isSanitized = true;
            Config::$is3ds = true;

            $transaction_details = array(
                'order_id' => $order_id,
                'gross_amount' => $gross_amount, // no decimal allowed for creditcard
            );

            $customer_details = array(
                'first_name'    => $nama,
                'email'         => $email,
                'phone'         => $tlp,
            );

            $transaction = array(
                'transaction_details' => $transaction_details,
                'customer_details' => $customer_details,
            );

            $snapToken = Snap::getSnapToken($transaction);
            show_snap_pay($snapToken, $data_transaksi);

        }


        function get_status_transaction($data_transaksi)
        {
            $transaction_id = $data_transaksi;
            $url = $GLOBALS['BASE_URL'].'/v2/'.$transaction_id.'/status';
            $login = $GLOBALS['server_key'];
            $password ='';

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,$url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($ch, CURLOPT_USERPWD, "$login:$password");
            $result = curl_exec($ch);
            curl_close($ch);
            $data = json_decode($result, true);  
            return $data;
        }


       

    }
