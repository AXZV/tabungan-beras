                            //  <?php echo push_to_db($data_transaksi);?>

                            <?php echo $GLOBALS['BASE_URL'] ?>

                            <script src="https://api.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-2Y2-CwObIvUba1Vx"></script>

// document.location.replace('../tabungan/uang.php');

document.location.replace('../function/fungsi.php?red=<?php $data_transaksi ?>');



info = JSON.stringify(<?php $data_transaksi ?>);
                                $.ajax({
                                        url: "../function/fungsi.php?red="+info,
                                        data: info,
                                        success: function(msg){
                                            console.log("sukses");
                                        }
                                    });