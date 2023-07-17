<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پنل ادمین</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php if (isset($_SESSION['loginAdmin'])) : ?>
    <?php header("location: http://localhost/estate/admin/adminPanel.php"); ?>
    <?php else : ?>
        <div class='main'>
            <h1>ورود ادمین</h1>
            <hr id="adminLine">
            <?php
            if (isset($_GET['idAdmin'])) {
                echo "<p id='errorLogin'> ! نام کاربری یا رمزعبور اشتباه است </p>";
            } else {
                echo " ";
            }
            ?>
            <form action="http://localhost/estate/process/functionsAdmin.php" method="post">
                <p>: نام کاربری</p>
                <input type="text" name="username" id="inpAdmin" placeholder="نام کاربری" required>
                <p>: رمز عبور</p>
                <input type="password" name="A_password" id="inpAdmin" placeholder="رمز عبور" required>
                <button type="submit" name="loginَAdmin" id="btnAdmin">ورود</button>
            </form>
        </div>
    <?php endif; ?>
</body>
</html>