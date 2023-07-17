<?php
// نام سرور، نام کاربری، رمز عبور و نام پایگاه داده دریافت میکند
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Estate_DB";

// ساخت یک شئ PDO
$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

// تنظیم حالت خطاهای PDO روی استثناها
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

///بررسی ارسال فرم///
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    ///در صورتی دکمه مرتب سازی بر اساس رهن زده شد دستورات مربوطه اجرا شود///
    if (isset($_POST['rahnbtn'])) {
        if ($_POST['H_rahn'] == "ASC") {
            $stmt = $pdo->prepare("SELECT * FROM `acceptedhome` ORDER BY H_rahn ASC;");
        }elseif ($_POST['H_rahn'] == "DESC") {
            $stmt = $pdo->prepare("SELECT * FROM `acceptedhome` ORDER BY H_rahn DESC;");
        }
        ///در صورتی دکمه مرتب سازی بر اساس اجاره زده شد دستورات مربوطه اجرا شود///
    }elseif (isset($_POST['ejarebtn'])) {
        if ($_POST['H_ejare'] == "ASC") {
            $stmt = $pdo->prepare("SELECT * FROM `acceptedhome` ORDER BY H_ejare ASC;");
        }elseif ($_POST['H_ejare'] == "DESC") {
            $stmt = $pdo->prepare("SELECT * FROM `acceptedhome` ORDER BY H_ejare DESC;");
        }
        ///در صورتی دکمه خرید در هدر زده شد دستورات مربوطه اجرا شود///
    }elseif (isset($_POST['kharid'])) {
        $stmt = $pdo->prepare("SELECT * FROM `acceptedhome` WHERE H_transaction = 'فروش' ;");
        ///در صورتی دکمه رهن و اجاره در هدر زده شد دستورات مربوطه اجرا شود///
    }elseif (isset($_POST['rahn_Ejare'])) {
        $stmt = $pdo->prepare("SELECT * FROM `acceptedhome` WHERE H_transaction = 'رهن و اجاره' ;");
    }
}else {
    ///اگر هیچ فرمی ارسال نشد تمامی آگهی هارا نشان بده///
    $stmt = $pdo->prepare("SELECT * FROM `acceptedHome`;");
}

// اجرای دستور SQL
try {
    $stmt->execute();

    $i = 1;
    // بررسی اینکه آیا پستی در پایگاه داده وجود دارد یا خیر
    if ($stmt->rowCount() > 0) {
        // مرور پست ها و نمایش آنها
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<center><p id="number">' . $i . '</p></center>';
            echo '<table id="customers">';
            echo '<tr><th><img src="http://localhost/estate/pics/' . $row['H_image'] . '"alt="تصویر منزل" style="width:375px; height:325px;" /></th></tr>';
            echo '<tr><th id="th_title">' . $row['H_title'] . '</th></tr>';
            echo '<tr><th><hr style="background-color:blue;">' . $row['H_city'] .' ، '. $row['H_address'] . '</th></tr>';
            if ($row['H_transaction'] == "فروش") {
                echo '<tr><th>قیمت : ' . $row['H_rahn'] . ' تومان </th></tr>';
            } else {
                echo '<tr><th>رهن : ' . $row['H_rahn'] . ' تومان <br> اجاره : ' . $row['H_ejare'] . ' تومان </th></tr>';
            }
            echo '<tr><th>نوع معامله : ' . $row['H_transaction'] . '</th></tr>';
            echo '<tr><th>نوع ملک : ' . $row['H_type'] . '</th></tr>';
            echo '<tr><th>متراژ : ' . $row['H_metric'] . 'متر مربع</th></tr>';
            echo '<tr><th>تعداد اتاق : ' . $row['H_rooms'] . '</th></tr>';
            echo '<tr><th>سال ساخت : ' . $row['H_year'] . '</th></tr>';
            echo '<tr><th>طبقه : ' . $row['H_floorNumbers'] . '</th></tr>';
            echo '<tr><th>آسانسور : ' . $row['H_theLift'] .'<br> پارکینگ : ' . $row['H_parking'] .'<br> انباری : ' . $row['H_warehouse'] . '</th></tr>';
            echo '<tr><th>تلفن تماس مالک : <br>' . $row['ownerTel'] . '</th></tr>';
            echo '<tr><th>توضیحات تکمیلی : <br>' . $row['H_description'] . '</th></tr>';
            echo '</table><hr>';
            $i++;
        }
    } else {
        // اگر پستی وجود نداشت خطای زیر را نمایش بده
        echo "آگهی برای نمایش موجود نمی باشد";
    }
    } catch (PDOException $e) {
    // هر گونه خطا را مدیریت میکند
    echo $e->getMessage();
    } finally {
    // خروج از اتصال PDO
    $pdo = null;
    }