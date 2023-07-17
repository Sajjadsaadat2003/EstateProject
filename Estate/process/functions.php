<?php
session_start();
include 'install.php';

///بررسی ارسال فرم///
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    ///بررسی وجود یوزرنیم و پسورد///
    if (isset($_POST['username']) and isset($_POST['U_password'])) {
        ///بررسی خالی نبودن یوزرنیم و پسورد///
        if (!empty($_POST['username']) and !empty($_POST['U_password'])) {
            ///اگر فرم رجیستر ارسال شد دستورات مربوط به ان را اجرا کن///
            if (isset($_POST['register'])) {
                if (register($_POST['username'], $_POST['U_email'], $_POST['U_tel'], $_POST['U_password'], $_POST['U_Rpassword'])) {
                    alert("خوش آمدید");
                    header("location: http://localhost/estate/registeration/login.php");
                    exit;
                } else {
                    alert("متاسفانه ثبت نام شما با خطا مواجه شد! لطفا دوباره امتحان نمایید");
                    header("location: http://localhost/estate/registeration/register.php?s=0");
                    exit;
                }
                ///اگر فرم لاگین ارسال شد دستورات مربوط به ان را اجرا کن///
            } elseif (isset($_POST['login'])) {
                if (login($_POST['username'], $_POST['U_password'])) {
                    header("location: http://localhost/estate");
                    exit;
                } else {
                    header("location: http://localhost/estate/registeration/login.php?id=0");
                    exit;
                }
                ///اگر فرم آپدیت کاربر ارسال شد دستورات مربوط به ان را اجرا کن///
            } elseif (isset($_POST['updateUser'])) {
                if (updateUser($_POST['username'], $_POST['U_email'], $_POST['U_tel'], $_POST['U_passwordOld'], $_POST['U_password'], $_POST['U_Rpassword'], $_POST['profilePic'])) {
                    alert("ویرایش اطلاعات با موفقیت انجام شد.");
                    header("location: http://localhost/estate/users/profile.php");
                    exit;
                } else {
                    alert("عملیات با خطا مواجه شد! لطفا دوباره امتحان نمایید");
                    header("location: http://localhost/estate/users/profile.php?s=Error");
                    exit;
                }
            }
        }
    }
}

//-----------------------------------------------------------------------//
//////بررسی صحت پسورد و تکرارش///////
function checkpassword($password, $Rpassword)
{
    if ($password == $Rpassword) {
        if (empty($password)) 
		{
            alert("پسورد نباید خالی باشد");
			return false;
			}else{
			if(preg_match("/^(?=.*[A-z])(?=.*[0-9])(?=.*[$@])\S{6,12}$/", $password))
			{
				return true;
			}else{
                alert("پسورد باید دارای علامت (@ یا # یا $ یا & یا ...) و عدد و حروف بزرگ و کوچک باشد");
				return false;
			} 
		}
    }else {
        alert("پسورد و تکرارش باید مشابه باشد");
        return false;
    }
}

//-----------------------------------------------------------------------//
//////بررسی وجود یوزرنیم///////
function isUserExists($username)
{
    global $pdo;
    $sql = "SELECT * FROM users WHERE U_username = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':username' => $username]);
    return $stmt->rowCount();
}
//-----------------------------------------------------------------------//
//////بررسی صحت پسورد///////
function isPassExists($password)
{
    global $pdo;
    $sql = "SELECT * FROM users WHERE U_password = :password";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':password' => md5($password)]);
    return $stmt->rowCount();
}
//-----------------------------------------------------------------------//
////نمایش آلرت ها////
function alert($message)
{
    echo "<script type='text/javascript'>alert('$message');</script>";
}
//-----------------------------------------------------------------------//
////ارسال اطلاعات به دیتابیس////
function register($username, $email, $tel, $password, $Rpassword)
{
    global $pdo;
    if (isUserExists($username)) {
        alert("نام کاربری وجود دارد");
        return false;
    }elseif (!checkpassword($password, $Rpassword)) {
        alert("خطا در تایید پسورد");
        return false;
    }
    $sql = "INSERT INTO users (U_username, U_email, U_tel, U_password, U_Rpassword) VALUES (:username, :email, :tel, :password, :Rpassword)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([ ':username' => $username, ':email' => $email, ':tel' => $tel, ':password' => md5($password), ':Rpassword' => md5($Rpassword)]);
    return $stmt->rowCount();
}
//-----------------------------------------------------------------------//
////بازخوانی اطلاعات از دیتابیس////
function login($username, $password)
{
    global $pdo;
    if (!isUserExists($username) or !isPassExists($password)) {
        return false;
    }else {
        $sql = "SELECT * FROM users WHERE U_username = :username AND U_password = :password";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':username' => $username, ':password' => md5($password)]);
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        $_SESSION['login'] = $result->id;
        return true;
    }
}
//-----------------------------------------------------------------------//
////بررسی پسورد برای اپدیت کردن اطلاعات////
function checkPasswordOld($passwordOld)
{
    global $pdo;
    $sql = "SELECT * FROM users WHERE U_password = :password";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':password' => md5($passwordOld)]);
    return $stmt->rowCount();
}
//-----------------------------------------------------------------------//
////ویرایش اطلاعات کاربر////
function updateUser($username, $email, $tel, $passwordOld, $password, $Rpassword, $profilePic)
{
    global $pdo;
    if (!checkPasswordOld($passwordOld)) {
        alert("لطفا پسوردی قبلی را صحیح وارد کنید");
        return false;
    }elseif (!checkpassword($password, $Rpassword)) {
        alert("خطا در تایید پسورد");
        return false;
    }else{
        $id = $_SESSION['login'];
        $sql = "UPDATE users SET U_username = :username, U_email = :email, U_tel = :tel, U_password = :password, U_Rpassword = :Rpassword, U_image = :profilePic  WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([ ':username' => $username, ':email' => $email, ':tel' => $tel, ':password' => md5($password), ':Rpassword' => md5($Rpassword), ':profilePic' => $profilePic, ':id' => $id]);
        return $stmt->rowCount();
    }
}
?>