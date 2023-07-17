<?php
include 'database.php';

// نام سرور، نام کاربری، رمز عبور و نام پایگاه داده دریافت میکند
$dsn = 'mysql:host=localhost;dbname=Estate_DB';
$username = 'root';
$password = '';

// ساخت یک شئ PDO
$pdo = new PDO($dsn, $username, $password);

// تنظیم حالت خطاهای PDO روی استثناها
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

///ایجاد جدول کاربران///
try {
    $sql = 'CREATE TABLE users (
        id INT NOT NULL AUTO_INCREMENT,
        U_username VARCHAR(100) NOT NULL,
        U_email VARCHAR(255) NOT NULL,
        U_tel VARCHAR(11) NOT NULL,
        U_password VARCHAR(255) NOT NULL,
        U_Rpassword VARCHAR(255) NOT NULL,
        U_image BLOB,
        PRIMARY KEY (id)
        );';
    $pdo->exec($sql);
} catch (PDOException $e) {
    echo '- خطا در ساخت جدول کاربران -';
}

///ایجاد جدول خانه ها///
try {
    $sql = 'CREATE TABLE sendedHome (
        id INT NOT NULL AUTO_INCREMENT,
        H_image BLOB,
        H_city VARCHAR(50) NOT NULL,
        H_transaction VARCHAR(50) NOT NULL,
        H_type VARCHAR(10) NOT NULL,
        H_address VARCHAR(255) NOT NULL,
        H_metric INT NOT NULL,
        H_rooms INT NOT NULL,
        H_year VARCHAR(20) NOT NULL,
        H_numberOfFloors VARCHAR(15),
        H_floorNumbers VARCHAR(15),
        H_theLift VARCHAR(5),
        H_parking VARCHAR(5),
        H_warehouse VARCHAR(5),
        H_rahn INT NOT NULL,
        H_ejare INT NOT NULL,
        ownerName VARCHAR(100) NOT NULL,
        ownerTel VARCHAR(11) NOT NULL,
        ownerNCode INT NOT NULL,
        H_title VARCHAR(50) NOT NULL,
        H_description TEXT,
        PRIMARY KEY (id)
        );';
    $pdo->exec($sql);
} catch (PDOException $e) {
    echo '<h2>- خطا در ساخت جدول خانه ها -</h2>';
}

///ایجاد جدول خانه های تایید شده توسط ادمین///
try {
    $sql = 'CREATE TABLE acceptedHome (
        id INT NOT NULL AUTO_INCREMENT,
        H_image BLOB,
        H_city VARCHAR(50) NOT NULL,
        H_transaction VARCHAR(50) NOT NULL,
        H_type VARCHAR(10) NOT NULL,
        H_address VARCHAR(255) NOT NULL,
        H_metric INT NOT NULL,
        H_rooms INT NOT NULL,
        H_year VARCHAR(20) NOT NULL,
        H_numberOfFloors VARCHAR(15),
        H_floorNumbers VARCHAR(15),
        H_theLift VARCHAR(5),
        H_parking VARCHAR(5),
        H_warehouse VARCHAR(5),
        H_rahn INT NOT NULL,
        H_ejare INT NOT NULL,
        ownerName VARCHAR(100) NOT NULL,
        ownerTel VARCHAR(11) NOT NULL,
        ownerNCode INT NOT NULL,
        H_title VARCHAR(50) NOT NULL,
        H_description TEXT,
        PRIMARY KEY (id)
        );';
    $pdo->exec($sql);
} catch (PDOException $e) {
    echo '<h2>- خطا در ساخت جدول خانه های تایید شده -</h2>';
}