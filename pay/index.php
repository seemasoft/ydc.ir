<?php
$softname = "order";
$divinc = 1;
$sitepro = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 'https://' : 'http://';
$ret = $sitepro . $_SERVER['HTTP_HOST'] . "/orders/confirmpay.php";

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

    if (empty($onvan)) {
        $errors[] = "لطفا شرح پرداخت را وارد نمایید.";
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
        <center>
            <br><br><br>
            <i class="fa fa-spinner fa-spin fa-4x fa-fw"></i>
            <br><br>
            <h1>در حال اتصال به درگاه پرداخت...</h1>
            <h3>شماره سفارش: <span style="color:red;"><?= $orderid ?></span></h3>
            <br><br><br><br><br>
        </center>
        <?php
        function payerror($payam) {
            global $divinc;
            ?>
            <div class="alert alert-danger" style="direction:rtl; text-align:right;">
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

<div style="direction: rtl; text-align: right; max-width: 650px; margin: 0 auto; padding: 20px 10px;">
    <h2 style="text-align: center; margin-bottom: 25px; color: #333;">پرداخت وجه با مبلغ دلخواه</h2>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger" style="text-align: right; direction: rtl;">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST" action="" class="form-horizontal">
        <div class="control-group" style="margin-bottom: 15px;">
            <label class="control-label" for="name" style="font-weight: bold;">نام و نام خانوادگی <span style="color:red;">*</span>:</label>
            <div class="controls">
                <input type="text" id="name" name="name" class="form-control span12" required value="<?= isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '' ?>" placeholder="مثلا: علی محمدی">
            </div>
        </div>

        <div class="control-group" style="margin-bottom: 15px;">
            <label class="control-label" for="mablagh" style="font-weight: bold;">مبلغ پرداخت (ریال) <span style="color:red;">*</span>:</label>
            <div class="controls">
                <input type="number" id="mablagh" name="mablagh" class="form-control span12" min="1000" step="1000" required value="<?= isset($_POST['mablagh']) ? htmlspecialchars($_POST['mablagh']) : '' ?>" placeholder="مثلا: ۵۰۰۰۰۰">
            </div>
        </div>

        <div class="control-group" style="margin-bottom: 15px;">
            <label class="control-label" for="onvan" style="font-weight: bold;">توضیحات / شرح پرداخت <span style="color:red;">*</span>:</label>
            <div class="controls">
                <textarea id="onvan" name="onvan" class="form-control span12" rows="3" required placeholder="علت یا شرح پرداخت خود را وارد نمایید..."><?= isset($_POST['onvan']) ? htmlspecialchars($_POST['onvan']) : '' ?></textarea>
            </div>
        </div>

        <div class="control-group" style="margin-bottom: 15px;">
            <label class="control-label" for="mobile" style="font-weight: bold;">تلفن تماس (اختیاری):</label>
            <div class="controls">
                <input type="text" id="mobile" name="mobile" class="form-control span12" value="<?= isset($_POST['mobile']) ? htmlspecialchars($_POST['mobile']) : '' ?>" placeholder="مثلا: ۰۹۱۲۳۴۵۶۷۸۹">
            </div>
        </div>

        <div class="control-group" style="text-align: center; margin-top: 25px;">
            <button type="submit" name="submit_pay" value="1" class="btn btn-primary btn-large" style="padding: 10px 40px; font-size: 18px;">
                ورود به درگاه پرداخت و پرداخت آنلاین
            </button>
        </div>
    </form>
</div>

<?php
include_once("../footer.php");
?>
