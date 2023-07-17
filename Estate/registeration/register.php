<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ثبت نام</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php if (isset($_SESSION['login'])) : ?>
    <?php header("location: http://localhost/estate/users/profile.php"); ?>
        <?php else : ?>
            <div class='main'>
                <h1>ثبت نام</h1>
                <hr>
                <form action="http://localhost/estate/process/functions.php" method="post">
                    <p>: نام کاربری</p>
                    <input type="text" name="username" minlength="3" placeholder="نام کاربری خود را وارد کنید" required>
                    <p>: ایمیل</p>
                    <input type="email" name="U_email" placeholder="ایمیل خود را وارد کنید" required>
                    <p>: شماره همراه</p>
                    <input type="text" name="U_tel" minlength="11" maxlength="11" placeholder="شماره همراه خود را وارد کنید" required>
                    <p>: رمز عبور</p>
                    <input type="password" name="U_password" minlength="8" placeholder="رمز عبور خود را وارد کنید" required>
                    <p>: تکرار رمز عبور</p>
                    <input type="password" name="U_Rpassword" placeholder="تکرار رمز عبور خود را وارد کنید" required>
                    <button type="submit" name="register">ثبت</button>
                    <a href="login.php" class="link-signin">حساب کاربری دارید؟ وارد شوید</a>
                </form>
            </div>
        <?php endif; ?>
</body>
</html>