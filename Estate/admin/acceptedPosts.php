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
    <p class="title">پست های ثبت شده</p>
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
            $stmt = $conn->prepare("SELECT * FROM `acceptedHome`;");

            // اجرای دستور SQL
            try {
            $stmt->execute();

            // بررسی اینکه آیا پستی در پایگاه داده وجود دارد یا خیر
            if ($stmt->rowCount() > 0) {
                // مرور پست ها و نمایش آنها
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo '<form action="http://localhost/estate/process/functionsAddHome.php" method="post">';
                    echo '<table id="customers" border="3">';
                    echo '<tr style="font-size:17px;">';
                    echo '<th><img src="http://localhost/estate/pics/' . $row['H_image'] . '" style="width:125px; height:100px;" /></th>';
                    echo '<th>' . $row['H_title'] . '</th>';
                    echo '<th>آیدی آگهی : <input type="text" name="idHome" id="idHome" value="' . $row['id'] . '" readonly></th>';
                    echo '<th><button type="submit" name="deletePost">حذف آگهی</button></th>';
                    echo '</tr>';
                    echo '</table>';
                    echo '<br>';
                    echo '</form>';
                }
            } else {
                // اگر پستی وجود نداشت خطای زیر را نمایش بده
                echo "آگهی ای موجود نیست";
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