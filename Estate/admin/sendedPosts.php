<?php
    session_start();
    if (!isset($_SESSION['loginAdmin'])) {
        header("location: http://localhost/estate/admin");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پنل ادمین</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <p class="title">پست های جدید</p>
    <div class="container">

        <?php
            // نام سرور، نام کاربری، رمز عبور و نام پایگاه داده دریافت میکند
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "Estate_DB";

            // ساخت یک شئ PDO
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

            // تنظیم حالت خطاهای PDO روی استثناها
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // آماده کردن دستور SQL
            $stmt = $conn->prepare("SELECT * FROM `sendedHome`;");

            // اجرای دستور SQL
            try {
            $stmt->execute();

            // بررسی اینکه آیا پستی در پایگاه داده وجود دارد یا خیر
            if ($stmt->rowCount() > 0) {
                // مرور پست ها و نمایش آنها
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo '<form action="http://localhost/estate/process/functionsAddHome.php" method="post">';
                    echo '<table id="customers" border="3">';
                    echo '<tr><th><img src="http://localhost/estate/pics/' . $row['H_image'] . '" style="width:375px; height:325px;" /></th></tr>';
                    echo '<tr><th>' . $row['H_title'] . '</th></tr>';
                    echo '<tr><th>' . $row['H_city'] .' : '. $row['H_address'] . '</th></tr>';
                    echo '<tr><th>نوع معامله : ' . $row['H_transaction'] . '</th></tr>';
                    echo '<tr><th>نوع ملک : ' . $row['H_type'] . '</th></tr>';
                    echo '<tr><th>متراژ : ' . $row['H_metric'] . 'متر مربع</th></tr>';
                    echo '<tr><th>تعداد اتاق : ' . $row['H_rooms'] . '</th></tr>';
                    echo '<tr><th>سال ساخت : ' . $row['H_year'] . '</th></tr>';
                    echo '<tr><th>تعداد طبقات : ' . $row['H_numberOfFloors'] . '</th></tr>';
                    echo '<tr><th>طبقه : ' . $row['H_floorNumbers'] . '</th></tr>';
                    echo '<tr><th>آسانسور : ' . $row['H_theLift'] .'<br> پارکینگ : ' . $row['H_parking'] .'<br> انباری : ' . $row['H_warehouse'] . '</th></tr>';
                    echo '<tr><th>رهن(ریال) : ' . $row['H_rahn'] . '<br> اجاره(ریال) : ' . $row['H_ejare'] . '</th></tr>';
                    echo '<tr><th>نام و نام خانوادگی : ' . $row['ownerName'] .'<br> تلفن تماس : ' . $row['ownerTel'] .'<br> کد ملی : ' . $row['ownerNCode'] . '</th></tr>';
                    echo '<tr><th>توضیحات تکمیلی : ' . $row['H_description'] . '</th></tr>';
                    echo '<tr><th>آیدی آگهی : <input type="text" name="idHome" id="idHome" value="' . $row['id'] . '" readonly></th></tr>';
                    echo '</table>';
                    echo '<button type="submit" name="delete">حذف آگهی</button>';
                    echo '<button type="submit" name="send" id="sendbtn">ثبت آگهی و نمایش در سایت</button>';
                    echo '</form>';
                }
            } else {
                // اگر پستی وجود نداشت خطای زیر را نمایش بده
                echo "آگهی جدیدی ارسال نشده است";
            }
            } catch (PDOException $e) {
            // هر گونه خطا را مدیریت میکند
            echo $e->getMessage();
            } finally {
            // خروج از اتصال PDO
            $conn = null;
            }
        ?>
    </div>
</body>
</html>