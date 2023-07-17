<?php session_start() ?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <title>خرید و فروش - رهن و اجاره آنلاین خانه | املاک</title>
</head>
<body>
    <div id="header">
        <div class="navbar">
            <a href="" id="sitename">املاک سجاد</a>
            <hr class="line">
            <form action="index.php" method="post">
                <button href="#" id="menu" type="submit" name="kharid"><h3> خرید</h3></button>
                <button href="#" id="menu" type="submit" name="rahn_Ejare"><h3> رهن و اجاره</h3></button>
            </form>
            <h4 class="addhome" onclick="window.open('http://localhost/estate/addHome/addHome.php');window.close();"><p>ثبت آگهی +</p></h4>
			<?php /* اگر کاربر قبلا وارد شده بود دکمه پروفایل رو نشون میده درغیر این صورت دکمه ورود|ثبت نام رو نشون میده */?>
			<?php if (!isset($_SESSION['login'])) : ?>
            <h4 class="signin" onclick="window.open('http://localhost/estate/registeration/login.php');window.close();"><p>ورود | ثبت نام</p></h4>
			<?php else : ?>
			<h4 class="signin" onclick="window.open('http://localhost/estate/users/profile.php');window.close();"><p>پروفایل</p></h4>
			<?php endif; ?>
        </div>
    </div>
    <div id="box_Right">
        <p id="filterTitle">مرتب سازی</p>
        <form action="" method="post">
            <p>: بر اساس قیمت رهن</p>
            <select name="H_rahn" id="listFilter">
                <option value="ASC">از کم به زیاد</option>
                <option value="DESC">از زیاد به کم</option>
            </select>
            <button type="submit" id="listbtn" name="rahnbtn">فیلتر</button>
            <p>: بر اساس قیمت اجاره</p>
            <select name="H_ejare" id="listFilter">
                <option value="ASC">از کم به زیاد</option>
                <option value="DESC">از زیاد به کم</option>
            </select>
            <button type="submit" id="listbtn" name="ejarebtn">فیلتر</button>
        </form>
    </div>

    <div id="mainPage">
        <div class="container">
            <?php include 'process/showPosts.php'; ?>
        </div>
    </div>
    <div class="footer">
        <div class="main-footer">
            <div class="social">
                <div>
                    <a href="#"><img src="images/facebook-icon.png" alt=""></a>
                    <a href="#"><img src="images/google-plus.png" alt=""></a>
                    <a href="#"><img src="images/square-linkedin.png" alt=""></a>
                    <a href="#"><img src="images/square-twitter.png" alt=""></a>
                </div>
            </div>
        </div>
        <div class="footer-bot">
            <div class="footer-bot">
                <div class="copyright">
                    تمام حقوق مادی و معنوی متعلق به طراح سایت می باشد  <b id="copyicon">&copy;</b>
                </div>
                <div class="ui">
                    طراحی شده توسط سجاد سعادت
                </div>
            </div>
        </div>
    </div>
</body>
</html>