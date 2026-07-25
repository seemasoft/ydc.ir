<? 
include ("check.php");

if ( $admintype < 10 ) { echo 'دسترسی غیر مجاز ' ; exit();  }

if (isset($_REQUEST['id']) && $_REQUEST['id'] !== '') {
    $orderid = sql($_REQUEST['id']) ;
    rss("select * from payments where orderid='$orderid'" );
    include ("../info.php");
    $plg = explode(",",$rs["pluglist"]);


    $trmahsool = "<tr><td>".$itemname[$rs["item"]]."</td><td>". mablagh($price[$rs["item"]]) . "</td></tr>";
    for($i=1;$i<sizeof($plg);$i++){
    $trmahsool = $trmahsool . "<tr><td>".$pname[$plg[$i]]."</td><td>". mablagh($pprice[$plg[$i]])."</td></tr>";
     }

    if (($postprice[$rs["post"]] + $invoice * $rs["invoice"]) ) { $trmahsool = $trmahsool . "<tr><td>".$postt[$rs["post"]]."</td><td>".mablagh($postprice[$rs["post"]] + $invoice * $rs["invoice"])."</td></tr>"; }


    $tmphtml = file_get_contents("../orders/mailtemp/invoice.htm");
    $tmphtml = str_replace("<customer>",$rs["name"] ,$tmphtml);
    $tmphtml = str_replace("<customerphone>",$rs["mobile"] ,$tmphtml);
    $tmphtml = str_replace("<customeraddress>",$rs["address"] ,$tmphtml);


    $tmphtml = str_replace("<tarikh>",farsidigit($rs["tarikh"]) ,$tmphtml);
    $tmphtml = str_replace("<orderid>",farsidigit($orderid),$tmphtml);
    $tmphtml = str_replace("<trmahsool>",$trmahsool,$tmphtml);
    $tmphtml = str_replace("<company>",$company,$tmphtml);
    $tmphtml = str_replace("<address>",farsidigit($companyaddress),$tmphtml);
    $tmphtml = str_replace("<majmoo>",mablagh($rs["mablagh"]) ,$tmphtml);

    if ($_REQUEST["sigmohr"]) { $tmphtml = str_replace("<mohr>",'<img src="smohr.jpg" />' ,$tmphtml); } else { $tmphtml = str_replace("<mohr>","" ,$tmphtml);  }



    include('../orders/pdf/mpdf.php');
    $mpdf=new mPDF('utf-8');
    //$html=iconv("utf-8","UTF-8//IGNORE",$tmphtml);
    $mpdf=new mPDF('ar','A4','','',5,5,5,5,16,13);
    $mpdf->SetDirectionality('rtl');
    $mpdf->WriteHTML($tmphtml);

    if ($_REQUEST["sigmohr"]) { $mpdf->Output('faktor'.  $orderid  .'.pdf', 'D'); } else {  $mpdf->Output(); }

} else {
    // --- Manual Invoice Logic ---
    include ("../info.php");
    include_once ("function.php"); // For dateshamsi()

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $custom_orderid = sql($_POST['orderid']);
        $custom_tarikh = sql($_POST['tarikh']);
        $custom_customer = sql($_POST['customer']);
        $custom_phone = sql($_POST['customerphone']);
        $custom_address = sql($_POST['customeraddress']);
        $custom_company = sql($_POST['company']);
        $custom_companyaddress = sql($_POST['companyaddress']);

        $item_titles = $_POST['item_title'];
        $item_prices = $_POST['item_price'];

        $trmahsool = "";
        $total_price = 0;
        if (is_array($item_titles) && is_array($item_prices)) {
            for ($i = 0; $i < count($item_titles); $i++) {
                $title = sql($item_titles[$i]);
                $price_val = floatval($item_prices[$i]);
                $total_price += $price_val;

                $trmahsool .= "<tr><td>" . $title . "</td><td>" . mablagh($price_val) . "</td></tr>";
            }
        }

        $tmphtml = file_get_contents("../orders/mailtemp/invoice.htm");
        $tmphtml = str_replace("<customer>", $custom_customer, $tmphtml);
        $tmphtml = str_replace("<customerphone>", $custom_phone, $tmphtml);
        $tmphtml = str_replace("<customeraddress>", $custom_address, $tmphtml);

        $tmphtml = str_replace("<tarikh>", farsidigit($custom_tarikh), $tmphtml);
        $tmphtml = str_replace("<orderid>", farsidigit($custom_orderid), $tmphtml);
        $tmphtml = str_replace("<trmahsool>", $trmahsool, $tmphtml);
        $tmphtml = str_replace("<company>", $custom_company, $tmphtml);
        $tmphtml = str_replace("<address>", farsidigit($custom_companyaddress), $tmphtml);
        $tmphtml = str_replace("<majmoo>", mablagh($total_price), $tmphtml);

        if ($_POST["sigmohr"]) {
            $tmphtml = str_replace("<mohr>", '<img src="smohr.jpg" />', $tmphtml);
        } else {
            $tmphtml = str_replace("<mohr>", "", $tmphtml);
        }

        include('../orders/pdf/mpdf.php');
        $mpdf = new mPDF('utf-8');
        $mpdf = new mPDF('ar', 'A4', '', '', 5, 5, 5, 5, 16, 13);
        $mpdf->SetDirectionality('rtl');
        $mpdf->WriteHTML($tmphtml);

        if ($_POST["sigmohr"]) {
            $mpdf->Output('faktor' . $custom_orderid . '.pdf', 'D');
        } else {
            $mpdf->Output();
        }
        exit();
    } else {
        include ("header.php");
        $default_date = dateshamsi();
        $default_invoice_num = time(); // Unique sequential/timestamp number as default
        ?>
        <div class="container" style="direction: rtl; margin-top: 80px; padding-bottom: 50px;">
            <h1 class="pgheader">صدور فاکتور دستی</h1>
            <p class="alert alert-info">
                از طریق این فرم می‌توانید فاکتور دستی با آیتم‌های دلخواه ایجاد نموده و فایل PDF آن را به همراه مهر و امضا دریافت کنید.
            </p>

            <form method="POST" action="invoice.php" class="form-horizontal">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">مشخصات فاکتور و خریدار</h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label" style="text-align: right;">شماره فاکتور:</label>
                            <div class="col-sm-4">
                                <input type="text" name="orderid" class="form-control" value="<?= $default_invoice_num ?>" required>
                            </div>
                            <label class="col-sm-2 control-label" style="text-align: right;">تاریخ:</label>
                            <div class="col-sm-4">
                                <input type="text" name="tarikh" class="form-control" value="<?= $default_date ?>" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label" style="text-align: right;">نام خریدار:</label>
                            <div class="col-sm-4">
                                <input type="text" name="customer" class="form-control" placeholder="نام خریدار را وارد کنید" required>
                            </div>
                            <label class="col-sm-2 control-label" style="text-align: right;">تلفن خریدار:</label>
                            <div class="col-sm-4">
                                <input type="text" name="customerphone" class="form-control" placeholder="تلفن خریدار">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label" style="text-align: right;">آدرس خریدار:</label>
                            <div class="col-sm-10">
                                <input type="text" name="customeraddress" class="form-control" placeholder="آدرس خریدار">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">مشخصات فروشنده</h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label" style="text-align: right;">نام شرکت:</label>
                            <div class="col-sm-4">
                                <input type="text" name="company" class="form-control" value="<?= $company ?>" required>
                            </div>
                            <label class="col-sm-2 control-label" style="text-align: right;">آدرس شرکت:</label>
                            <div class="col-sm-6">
                                <input type="text" name="companyaddress" class="form-control" value="<?= $companyaddress ?>" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="sigmohr" value="1" checked> درج مهر و امضا روی فاکتور
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">آیتم‌های فاکتور</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered table-striped" id="items-table">
                            <thead>
                                <tr style="background-color: #f5f5f5;">
                                    <th style="width: 5%; text-align: center;">ردیف</th>
                                    <th style="width: 55%;">عنوان آیتم</th>
                                    <th style="width: 30%;">مبلغ (ریال)</th>
                                    <th style="width: 10%; text-align: center;">عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="item-row">
                                    <td class="row-num" style="text-align: center; vertical-align: middle;">1</td>
                                    <td>
                                        <input type="text" name="item_title[]" class="form-control" placeholder="مثلا: نرم افزار حسابداری مهر - نسخه پیشرفته" required>
                                    </td>
                                    <td>
                                        <input type="number" name="item_price[]" class="form-control item-price" placeholder="مثلا: 9400000" min="0" required>
                                    </td>
                                    <td style="text-align: center;">
                                        <button type="button" class="btn btn-danger btn-sm remove-item-btn" disabled>حذف</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="row">
                            <div class="col-sm-6" style="text-align: right;">
                                <button type="button" id="add-item-btn" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> افزودن آیتم جدید</button>
                            </div>
                            <div class="col-sm-6 text-left" style="font-size: 16px; font-weight: bold; padding-top: 10px; text-align: left;">
                                مجموع کل: <span id="grand-total-display">0</span> ریال
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group text-center" style="margin-top: 30px;">
                    <button type="submit" class="btn btn-success btn-lg" style="min-width: 200px;">
                        <span class="glyphicon glyphicon-file"></span> تولید و دانلود فاکتور (PDF)
                    </button>
                </div>
            </form>
        </div>

        <script>
        $(document).ready(function() {
            function renumberRows() {
                $('#items-table tbody tr').each(function(index) {
                    $(this).find('.row-num').text(index + 1);
                });

                // Disable delete button if only one row remains
                var rowCount = $('#items-table tbody tr').length;
                if (rowCount <= 1) {
                    $('.remove-item-btn').attr('disabled', true);
                } else {
                    $('.remove-item-btn').attr('disabled', false);
                }
            }

            function calculateTotal() {
                var total = 0;
                $('.item-price').each(function() {
                    var val = parseFloat($(this).val());
                    if (!isNaN(val)) {
                        total += val;
                    }
                });
                // Format with commas for display
                $('#grand-total-display').text(total.toLocaleString('fa-IR'));
            }

            $('#add-item-btn').click(function() {
                var newRow = `
                    <tr class="item-row">
                        <td class="row-num" style="text-align: center; vertical-align: middle;"></td>
                        <td>
                            <input type="text" name="item_title[]" class="form-control" placeholder="عنوان آیتم جدید" required>
                        </td>
                        <td>
                            <input type="number" name="item_price[]" class="form-control item-price" placeholder="مبلغ" min="0" required>
                        </td>
                        <td style="text-align: center;">
                            <button type="button" class="btn btn-danger btn-sm remove-item-btn">حذف</button>
                        </td>
                    </tr>
                `;
                $('#items-table tbody').append(newRow);
                renumberRows();
                calculateTotal();
            });

            $(document).on('click', '.remove-item-btn', function() {
                $(this).closest('tr').remove();
                renumberRows();
                calculateTotal();
            });

            $(document).on('input', '.item-price', function() {
                calculateTotal();
            });

            // Initial call
            calculateTotal();
        });
        </script>
        <?
        include ("bottom.php");
    }
}
?>
