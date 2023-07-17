<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>ثبت آگهی منزل</title>
</head>
<body>
<body>
<?php if (!isset($_SESSION['login'])) : ?>
    <?php header("location: http://localhost/estate/registeration/login.php"); ?>
        <?php else : ?>
            <h1>آگهی جدید</h1><hr id="firstLine">
            <div class='main'>
                    <?php
                        if (isset($_GET['idNumeric'])) {
                            echo "<div id='errorAddPost'><p> !شماره همراه یا کدملی مالک صحیح نمی باشد</p><p> ( .شماره همراه و کد ملی حتما باید از ارقام استفاده شود و شماره همراه 11 رقم و با 09 شروع شود و همچنین کدملی 10 رقم و با 0 شروع شود ) </p></div>";
                        } else {
                            echo " ";
                        }
                    ?>
                <form action="http://localhost/estate/process/functionsAddHome.php" method="post">
                    <div id="image">
                        <p>آپلود عکس</p>
                        <input type="file" name="H_image" id="homeIMG" accept="image/*">
                    </div>
                    <p>شهر</p>
                    <input type="text" name="H_city" id="inputText" required>
                    <br>
                    <p>نوع معامله</p>
                    <select name="H_transaction" id="list">
                        <option value="فروش">فروش</option>
                        <option value="رهن و اجاره">رهن و اجاره</option>
                        <option value="رهن کامل">رهن کامل</option>
                        <option value="پیش فروش">پیش فروش</option>
                    </select>
                    <p>نوع ملک</p>
                    <select name="H_type" id="list">
                        <option value="آپارتمان">آپارتمان</option>
                        <option value="خانه ویلایی">خانه ویلایی</option>
                        <option value="واحد تجاری">واحد تجاری</option>
                        <option value="واحد اداری">واحد اداری</option>
                    </select>
                    <p>آدرس ملک</p>
                    <input type="text" name="H_address" id="H_address">
                    <hr>
                    <h3>مشخصات ملک</h3>
                    <p>متراژ (متر)</p>
                    <input type="text" name="H_metric" id="inputText" required>
                    <p>تعداد اتاق</p>
                    <select name="H_rooms" id="list">
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="بیشتر از 5">بیشتر از 5</option>
                    </select>
                    <p>سال ساخت</p>
                    <select name="H_year" id="list">
                        <option value="قبل از سال 1390">قبل از سال 1390</option>
                        <option value="1391">1391</option>
                        <option value="1392">1392</option>
                        <option value="1393">1393</option>
                        <option value="1394">1394</option>
                        <option value="1395">1395</option>
                        <option value="1396">1396</option>
                        <option value="1397">1397</option>
                        <option value="1398">1398</option>
                        <option value="1399">1399</option>
                        <option value="1400">1400</option>
                        <option value="1401">1401</option>
                        <option value="1402">1402</option>
                    </select>
                    <p>تعداد طبقات</p>
                    <select name="H_numberOfFloors" id="list">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="بیشتر از 3">بیشتر از 3</option>
                    </select>
                    <p>طبقه</p>
                    <select name="H_floorNumbers" id="list">
                        <option value="همکف">همکف</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="بیشتر از 10">بیشتر از 10</option>
                    </select>
                    <p>آسانسور</p>
                    <select name="H_theLift" id="list">
                        <option value="دارد">دارد</option>
                        <option value="ندارد">ندارد</option>
                    </select>
                    <p>پارکینگ</p>
                    <select name="H_parking" id="list">
                        <option value="دارد">دارد</option>
                        <option value="ندارد">ندارد</option>
                    </select>
                    <p>انباری</p>
                    <select name="H_warehouse" id="list">
                        <option value="دارد">دارد</option>
                        <option value="ندارد">ندارد</option>
                    </select>
                    <hr>
                    <h3>قیمت</h3>
                    <p>رهن(تومان)</p>
                    <input type="text" name="H_rahn" id="inputText" required>
                    <p>اجاره(تومان)</p>
                    <input type="text" name="H_ejare" id="inputText" required>
                    <hr>
                    <h3>اطلاعات مالک</h3>
                    <p>نام و نام خانوادگی</p>
                    <input type="text" name="ownerName" id="inputText" required>
                    <p>تلفن تماس</p>
                    <input type="text" name="ownerTel" id="inputText" minlentgh="11" maxlentgh="11" required>
                    <p>کد ملی</p>
                    <input type="text" name="ownerNCode" id="inputText" minlentgh="10" maxlentgh="10" required>
                    <hr>
                    <h3>اطلاعات آگهی</h3>
                    <p>عنوان آگهی</p>
                    <input type="text" name="H_title" id="inputText" required>
                    <p>توضیحات تکمیلی</p>
                    <input type="text" name="H_description" id="H_description" required><br>
                    <p id="warning"><b>توجه :</b> لطفا برای ثبت آگهی خود تمامی فیلدها را پر کرده و از صحت آنها مطمعن شوید</p>
                    <button type="submit" name="add">ثبت آگهی</button>
                    <button type="reset" onclick="window.open('http://localhost/estate');" name="cancel" id="cancelbtn">انصراف</button>
                </form>
            </div>
        <?php endif; ?>
</body>
</body>
</html>