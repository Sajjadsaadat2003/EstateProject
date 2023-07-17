<?php
session_start();
///بررسی ارسال فرم///
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    ///بررسی وجود یوزرنیم و پسورد///
    if (isset($_POST['username']) and isset($_POST['A_password'])) {
        ///بررسی خالی نبودن یوزرنیم و پسورد///
        if (!empty($_POST['username']) and !empty($_POST['A_password'])) {
            ///اگر فرم ورود ادمین ارسال شد دستورات مربوط به ان را اجرا کن///
            if (isset($_POST['loginَAdmin'])) {
                $pass = md5($_POST['A_password']);
                if ($_POST['username'] == "sajjadsaadat" and $pass == "c51f356cac760ecaceae918b8e7ef06e") {
                    $_SESSION['loginAdmin'] = $_POST['username'];
                    header("location: http://localhost/estate/admin/adminPanel.php");
                    exit;
                }else {
                    header("location: http://localhost/estate/admin?idAdmin=0");
                    exit;
                }
            }
        }
    }
}