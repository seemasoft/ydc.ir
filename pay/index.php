<?php
$softname = "order";
$divinc = 1;
$sitepro = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 'https://' : 'http://';
$ret = $sitepro . $_SERVER['HTTP_HOST'] . "/pay/confirmpay.php";

include_once("../info.php");
include_once("../connection.php");
include_once("../orders/function.php");

$errors = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_pay'])) {
    $name = trim(r('name'));
    $mobile = trim(r('mobile'));
    $mablagh = intval(latinnumber(trim(r('mablagh'))));
    $onvan = trim(r('onvan'));

    if (empty($name)) {
        $errors[] = "لطفا نام و نام خانوادگی را وارد نمایید.";
    } elseif (strpos($name, "ا") === false && strpos($name, "ب") === false && strpos($name, "ی") === false && strpos($name, "ه") === false && strpos($name, "ر") === false && strpos($name, "م") === false && strpos($name, "د") === false && strpos($name, "ح") === false && strpos($name, "ز") === false && strpos($name, "ل") === false) {
        $errors[] = "لطفا برای وارد کردن نام و نام خانوادگی از حروف فارسی استفاده نمایید.";
    }

    if ($mablagh < 1000) {
        $errors[] = "لطفا مبلغ معتبری (حداقل ۱,۰۰۰ ریال) وارد نمایید.";
    }

    if (empty($errors)) {
        function getorderid() {
            global $db;
            $orderid = rand(100000000, 999999999);
            if (mysqli_num_rows(mysqli_query($db, "select * from payments where orderid='$orderid'"))) {
                return getorderid();
            } else {
                return $orderid;
            }
        }

        $orderid = getorderid();

        rsaddnew("payments");
        rsadd("orderid", $orderid);
        rsadd("mablagh", $mablagh);
        rsadd("name", sql($name));
        rsadd("mobile", sql($mobile));
        rsadd("onvan", sql($onvan));
        rsadd("timestamp", time());
        rsadd("tarikh", dateshamsi());
        rsadd("ip", $_SERVER['REMOTE_ADDR']);
        rsadd("paymode", 1);
        if (isset($_COOKIE['ref'])) rsadd("ref", $_COOKIE['ref']);
        if (isset($_COOKIE['source'])) rsadd("source", $_COOKIE['source']);

        rsupdate();

        include_once("../header.php");
        ?>
        <div style="direction: rtl; text-align: center; padding: 50px 20px;">
            <i class="fa fa-spinner fa-spin fa-4x fa-fw" style="color: #2b6cb0;"></i>
            <h2 style="margin-top: 20px; color: #2d3748;">در حال اتصال به درگاه پرداخت...</h2>
            <h4 style="color: #4a5568; margin-top: 15px;">شماره سفارش: <span style="color: #e53e3e; font-weight: bold;"><?= $orderid ?></span></h4>
        </div>
        <?php
        function payerror($payam) {
            global $divinc;
            ?>
            <div class="alert alert-danger" style="direction:rtl; text-align:right; font-size: 16px; padding: 15px; border-radius: 8px;">
                <?= $payam ?>
                <br><br>
                <button class="btn btn-danger" onclick="window.history.back()">بازگشت</button>
            </div>
            <?php
            include_once("../footer.php");
            exit();
        }

        include_once("../orders/gateways/index.php");
        payreq($mablagh, $orderid, $ret, 0);

        include_once("../footer.php");
        exit();
    }
}

include_once("../header.php");
?>

<style>
.pay-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
    padding: 35px 30px;
    max-width: 720px;
    margin: 20px auto 40px auto;
    direction: rtl;
    text-align: right;
    font-family: inherit;
}
.pay-card-header {
    border-bottom: 2px solid #edf2f7;
    padding-bottom: 20px;
    margin-bottom: 25px;
    text-align: center;
}
.pay-card-header h2 {
    font-size: 24px;
    font-weight: 700;
    color: #2d3748;
    margin: 0 0 10px 0;
}
.pay-card-header p {
    color: #718096;
    font-size: 14px;
    margin: 0;
}
.pay-form-group {
    margin-bottom: 20px;
}
.pay-form-group label {
    display: block;
    font-size: 15px;
    font-weight: 600;
    color: #374151;
    margin-bottom: 8px;
}
.pay-form-control {
    width: 100%;
    box-sizing: border-box;
    padding: 12px 15px;
    font-size: 15px;
    border: 1px solid #cbd5e0;
    border-radius: 8px;
    background-color: #f8fafc;
    transition: all 0.2s ease-in-out;
    height: auto;
}
.pay-form-control:focus {
    border-color: #3182ce;
    background-color: #ffffff;
    box-shadow: 0 0 0 3px rgba(49, 130, 206, 0.15);
    outline: none;
}
.pay-btn-submit {
    background: linear-gradient(135deg, #2b6cb0 0%, #2b4c7e 100%);
    color: #ffffff;
    font-size: 18px;
    font-weight: 700;
    padding: 14px 28px;
    border: none;
    border-radius: 8px;
    width: 100%;
    cursor: pointer;
    transition: background 0.3s ease, transform 0.1s ease;
    box-shadow: 0 4px 12px rgba(43, 108, 176, 0.3);
}
.pay-btn-submit:hover {
    background: linear-gradient(135deg, #2c5282 0%, #1a365d 100%);
    color: #ffffff;
}
.pay-btn-submit:active {
    transform: translateY(1px);
}
.pay-required-star {
    color: #e53e3e;
    font-weight: bold;
}
.pay-optional-text {
    color: #a0aec0;
    font-size: 13px;
    font-weight: normal;
}
.pay-alert {
    background-color: #fff5f5;
    border: 1px solid #feb2b2;
    color: #c53030;
    padding: 15px 20px;
    border-radius: 8px;
    margin-bottom: 25px;
}
.pay-alert ul {
    margin: 0;
    padding-right: 20px;
}
.pay-alert li {
    margin-bottom: 5px;
}
.pay-alert li:last-child {
    margin-bottom: 0;
}
</style>

<div class="pay-card">
    <div class="pay-card-header">
        <h2>پرداخت آنلاین با مبلغ دلخواه</h2>
        <p>لطفاً اطلاعات زیر را جهت پرداخت وجه فرمایید</p>
    </div>

    <?php if (!empty($errors)): ?>
        <div class="pay-alert">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="row-fluid">
            <div class="span6 pay-form-group">
                <label for="name">نام و نام خانوادگی <span class="pay-required-star">*</span></label>
                <input type="text" id="name" name="name" class="pay-form-control" required value="<?= isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '' ?>" placeholder="مثلاً: علی محمدی">
            </div>

            <div class="span6 pay-form-group">
                <label for="mablagh">مبلغ پرداخت (ریال) <span class="pay-required-star">*</span></label>
                <input type="number" id="mablagh" name="mablagh" class="pay-form-control" min="1000" step="1000" required value="<?= isset($_POST['mablagh']) ? htmlspecialchars($_POST['mablagh']) : '' ?>" placeholder="مثلاً: ۵۰۰۰۰۰">
            </div>
        </div>

        <div class="row-fluid">
            <div class="span12 pay-form-group">
                <label for="mobile">تلفن همراه <span class="pay-optional-text">(اختیاری)</span></label>
                <input type="text" id="mobile" name="mobile" class="pay-form-control" value="<?= isset($_POST['mobile']) ? htmlspecialchars($_POST['mobile']) : '' ?>" placeholder="مثلاً: ۰۹۱۲۳۴۵۶۷۸۹">
            </div>
        </div>

        <div class="row-fluid">
            <div class="span12 pay-form-group">
                <label for="onvan">توضیحات / شرح پرداخت <span class="pay-optional-text">(اختیاری)</span></label>
                <textarea id="onvan" name="onvan" class="pay-form-control" rows="3" placeholder="توضیحات یا علت پرداخت خود را وارد نمایید..."><?= isset($_POST['onvan']) ? htmlspecialchars($_POST['onvan']) : '' ?></textarea>
            </div>
        </div>

        <div style="margin-top: 25px; text-align: center;">
            <button type="submit" name="submit_pay" value="1" class="pay-btn-submit">
                <i class="fa fa-credit-card" style="margin-left: 8px;"></i> ورود به درگاه پرداخت و پرداخت آنلاین
            </button>
        </div>
    </form>
</div>

<?php
require("../services.php");
include_once("../footer.php");
?>
