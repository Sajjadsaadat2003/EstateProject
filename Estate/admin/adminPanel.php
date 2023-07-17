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
    <p class="title">پنل مدیریت سایت</p>
    <input type="button" id="btnAdminPost" value="آگهی های جدید" onclick="window.open('sendedPosts.php');">
    <input type="button" id="btnAdminPost" value="آگهی های ثبت شده" onclick="window.open('acceptedPosts.php');">
    <input type="button" id="btnAdminPost" value="خروج از حساب کاربری" onclick="window.open('logoutAdmin.php');">
</body>
</html>