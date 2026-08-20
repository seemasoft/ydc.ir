<?php
$softname = "order";
$divinc = 1;

include_once("../header.php");
include_once("../connection.php");
include_once("../info.php");
include_once("../mail.php");
include_once("../orders/function.php");
include_once("../orders/gateways/index.php");

function payerror($payam) {
    global $divinc;
    ?>
    <div style="direction: rtl; text-align: center; max-width: 650px; margin: 40px auto; padding: 20px;">
        <div class="alert alert-danger" style="font-size: 16px; padding: 20px; border-radius: 8px; text-align: right;">
            <?= $payam ?>
            <br><br>
            <div style="text-align: center;">
                <button class="btn btn-danger" onclick="window.history.back()">بازگشت</button>
            </div>
        </div>
    </div>
    <?php
    include_once("../footer.php");
    exit();
}

getpayinfo();

if (!rss("select * from payments where orderid='$orderid'")) {
    payerror('شماره سفارش معتبر نیست.');
}

$mablagh = $rs["mablagh"];
$name = $rs["name"];
$mobile = $rs["mobile"];
$tarikh = $rs["tarikh"];
$ip = $rs["ip"];
$existing_au = $rs["au"];

if (!empty($existing_au)) {
    ?>
    <div style="direction: rtl; text-align: center; max-width: 650px; margin: 40px auto; padding: 30px; background: #fff; border: 1px solid #e2e8f0; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
        <i class="fa fa-info-circle fa-4x" style="color: #3182ce; margin-bottom: 15px;"></i>
        <h3 style="color: #2d3748; margin-bottom: 15px;">تراکنش قبلاً پردازش شده است</h3>
        <p style="font-size: 16px; color: #4a5568;">این تراکنش قبلاً با موفقیت انجام گردیده است. شماره سفارش: <strong><?= htmlspecialchars($orderid) ?></strong></p>
        <p style="font-size: 15px; color: #4a5568;">شماره پیگیری / مرجع: <strong><?= htmlspecialchars($existing_au) ?></strong></p>
        <br>
        <a href="/" class="btn btn-primary" style="padding: 10px 25px; font-size: 15px; border-radius: 6px;">بازگشت به صفحه اصلی</a>
    </div>
    <?php
    $divinc = 0;
    ?>
    </div></div></div></div>
    <?php
    require("../services.php");
    include_once("../footer.php");
    exit();
}

$out = confirmpay($mablagh);

if ($out == "ok") {
    $ref_id = isset($_POST['SaleReferenceId']) ? trim($_POST['SaleReferenceId']) : $au;
    if (empty($ref_id)) {
        $ref_id = $au;
    }

    rssetupdate("payments", "where orderid='" . sql($orderid) . "'");
    rschange("au", $ref_id);
    rschange("v", 10);
    rsendupdate();

    // Send email notification to admin
    $admin_email = "seemasoftgroup@gmail.com";
    $subject = "پرداخت آنلاین جدید - شماره سفارش " . $orderid;
    $email_body = "با سلام،\n\n";
    $email_body .= "یک پرداخت آنلاین جدید با موفقیت در سیستم ثبت گردید:\n\n";
    $email_body .= "شماره سفارش: " . $orderid . "\n";
    $email_body .= "شماره پیگیری / مرجع: " . $ref_id . "\n";
    $mablagh_toman = floor($mablagh / 10);
    $email_body .= "نام و نام خانوادگی: " . $name . "\n";
    $email_body .= "تلفن تماس: " . ($mobile ? $mobile : 'ثبت نشده') . "\n";
    $email_body .= "مبلغ پرداخت: " . number_format($mablagh_toman) . " تومان (" . number_format($mablagh) . " ریال)\n";
    $email_body .= "تاریخ پرداخت: " . $tarikh . "\n";
    $email_body .= "آدرس IP: " . $ip . "\n\n";
    $email_body .= "سیستم پرداخت آنلاین با مبلغ دلخواه";

    sendmail("noreply@" . $_SERVER['HTTP_HOST'], $admin_email, $subject, $email_body);

    ?>
    <div style="direction: rtl; text-align: center; max-width: 650px; margin: 40px auto; padding: 35px 25px; background: #ffffff; border: 1px solid #c6f6d5; border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.05);">
        <i class="fa fa-check-circle fa-5x" style="color: #38a169; margin-bottom: 20px;"></i>
        <h2 style="color: #276749; font-weight: bold; margin-bottom: 15px;">پرداخت شما با موفقیت انجام شد</h2>
        <div style="background-color: #f0fff4; border: 1px solid #9ae6b4; padding: 15px; border-radius: 8px; margin: 20px 0; font-size: 18px; color: #22543d;">
            شماره پیگیری: <strong style="color: #276749; font-size: 20px;"><?= htmlspecialchars($ref_id) ?></strong>
        </div>
        <p style="color: #4a5568; font-size: 15px;">شماره سفارش شما <strong><?= htmlspecialchars($orderid) ?></strong> می‌باشد.</p>
        <br>
        <a href="/" class="btn btn-success btn-large" style="padding: 10px 30px; font-size: 16px; border-radius: 6px;">بازگشت به صفحه اصلی</a>
    </div>
    <?php
    $divinc = 0;
    ?>
    </div></div></div></div>
    <?php
    require("../services.php");
    include_once("../footer.php");
} else {
    ?>
    <div style="direction: rtl; text-align: center; max-width: 650px; margin: 40px auto; padding: 30px; background: #ffffff; border: 1px solid #fed7d7; border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.05);">
        <i class="fa fa-times-circle fa-5x" style="color: #e53e3e; margin-bottom: 20px;"></i>
        <h3 style="color: #9b2c2c; margin-bottom: 15px;">تراکنش ناموفق بود</h3>
        <p style="font-size: 16px; color: #4a5568;">متأسفانه پرداخت انجام نشد یا توسط کاربر لغو گردید.</p>
        <p style="font-size: 15px; color: #4a5568;">شماره سفارش: <strong><?= htmlspecialchars($orderid) ?></strong></p>
        <br>
        <a href="/pay/" class="btn btn-primary" style="padding: 10px 25px; font-size: 15px; border-radius: 6px;">تلاش مجدد</a>
        <a href="/" class="btn btn-default" style="padding: 10px 25px; font-size: 15px; border-radius: 6px; margin-right: 10px;">بازگشت به صفحه اصلی</a>
    </div>
    <?php
    $divinc = 0;
    ?>
    </div></div></div></div>
    <?php
    require("../services.php");
    include_once("../footer.php");
    exit();
}
?>
