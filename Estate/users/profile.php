<?php session_start(); ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/style.css">
<title>نمایش اطلاعات</title>
</head>
<body>
<div class="container">
<p class="title_profile">پروفایل من</p>

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
$userID = $_SESSION['login'];
$stmt = $conn->prepare("SELECT * FROM `users` WHERE id = $userID;");

// اجرای دستور SQL
try {
  $stmt->execute();

  // بررسی اینکه آیا پستی در پایگاه داده وجود دارد یا خیر
  if ($stmt->rowCount() > 0) {
    // مرور پست ها و نمایش آنها
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      echo '<table id="customers" border="3">';
      if ($row['U_image'] == NULL) {
        echo '<tr><th colspan="2" style="width:100px"><center><input type="image" src="http://localhost/estate/pics/Sajjad.bmp" alt="تصویر کاربر" style="width:120px; height:100px;"></center></th></tr>';
      }else {
        echo '<tr><th colspan="2" style="width:100px"><center><input type="image" src="http://localhost/estate/pics/' . $row['U_image'] . '" alt="تصویر کاربر" style="width:120px; height:100px;"></center></th></tr>';
      }
      echo '<tr><th style="width:100px">نام کاربری :</th><th style="width:150px">' . $row['U_username'] . '</th></tr>';
      echo '<tr><th style="width:100px">ایمیل :</th><th style="width:150px">' . $row['U_email'] . '</th></tr>';
      echo '<tr><th style="width:100px">شماره همراه :</th><th style="width:150px">' . $row['U_tel'] . '</th></tr>';
      echo '</table>';
    }
  } else {
    // اگر پستی وجود نداشت خطای زیر را نمایش بده
    echo "اطلاعاتی برای نمایش موجود نیست";
  }
} catch (PDOException $e) {
  // هر گونه خطا را مدیریت میکند
  echo $e->getMessage();
} finally {
  // خروج از اتصال PDO
  $conn = null;
}
?>
<center>
  <div class='main'>
    <form action="http://localhost/estate/process/functions.php" method="post">
      <input type="file" name="profilePic" id="profilePic" accept="image/*" placeholder="تصویر پروفایل خود را وارد کنید">
      <input type="text" name="username" class="up_input" placeholder="نام کاربری جدید را وارد کنید">
      <input type="text" name="U_email" class="up_input" placeholder="ایمیل جدید را وارد کنید">
      <input type="text" name="U_tel" class="up_input" placeholder="شماره همراه جدید را وارد کنید">
      <input type="password" name="U_passwordOld" class="up_input" placeholder="رمزعبور قدیم را وارد کنید" required>
      <input type="password" name="U_password" class="up_input" placeholder="رمز عبور جدید را وارد کنید">
      <input type="password" name="U_Rpassword" class="up_input" placeholder="تکرار رمز عبور را وارد کنید">
      <button type="submit" name="updateUser">ویرایش اطلاعات</button>
    </form>
  </div>

  <button type="submit" class="backTosite" onclick="window.open('http://localhost/estate/'); window.close();">بازگشت به سایت</button><br>
  <a href="http://localhost/estate/process/logout.php" class="link-signin" style="text-align:center;">خروج از حساب کاربری</a>
</center>
</div>


</body>
</html>