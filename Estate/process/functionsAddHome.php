<?php
include 'install.php';

///بررسی ارسال فرم///
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    ///بررسی وجود شماره همراه مالک و عنوان پست///
    if (isset($_POST['ownerTel']) and isset($_POST['H_title'])) {
        ///بررسی خالی نبودن همراه مالک و عنوان پست///
        if (!empty($_POST['ownerTel']) and !empty($_POST['H_title'])) {
            ///اگر فرم ثبت آگهی ارسال شد دستورات مربوط به ان را اجرا کن///
            if (isset($_POST['add'])) {
                if (addHome($_POST['H_image'], $_POST['H_city'], $_POST['H_transaction'], $_POST['H_type'], $_POST['H_address'], $_POST['H_metric'], $_POST['H_rooms'], $_POST['H_year'], $_POST['H_numberOfFloors'], $_POST['H_floorNumbers'], $_POST['H_theLift'], $_POST['H_parking'], $_POST['H_warehouse'], $_POST['H_rahn'], $_POST['H_ejare'], $_POST['ownerName'], $_POST['ownerTel'], $_POST['ownerNCode'], $_POST['H_title'], $_POST['H_description'])) {
                    header("location: http://localhost/estate");
                    echo "آگهی شما با موفقیت ثبت شد";
                    exit;
                }else {
                    header("location: http://localhost/estate/addHome/addHome.php?idNumeric=0");
                    echo "ثبت آگهی با خطا مواجه شد!";
                    exit;
                }
            }
        }
    }
    ///اگر فرم حذف آگهی ارسال شد دستورات مربوط به ان را اجرا کن///
    if (isset($_POST['delete'])) {
        if (deletePost($_POST['idHome'])) {
            header("location: http://localhost/estate/admin?s=successful");
            echo 'آگهی با موفقیت حذف شد!';
            exit;
        }else {
            header("location: http://localhost/estate/admin?s=error");
            echo "حذف آگهی با خطا مواجه شد!";
            exit;
        }
    }
    ///اگر فرم تایید آگهی ارسال شد دستورات مربوط به ان را اجرا کن///
    if (isset($_POST['send'])) {
        if (sendPost($_POST['idHome'])) {
            deletePost($_POST['idHome']);
            header("location: http://localhost/estate/admin?s=successful");
            echo 'آگهی با موفقیت تایید شد!';
            exit;
        }else {
            header("location: http://localhost/estate/admin?s=error");
            echo "تایید آگهی با خطا مواجه شد!";
            exit;
        }
    }
    ///اگر فرم حذف آگهی‌ای که از قبل ثبت شده بود ارسال شد دستورات مربوط به ان را اجرا کن///
    if (isset($_POST['deletePost'])) {
        if (deletePost2($_POST['idHome'])) {
            alert("!آگهی با موفقیت حذف شد");
            header("location: http://localhost/estate/admin?s=successful");
            exit;
        }else {
            alert("!حذف آگهی با خطا مواجه شد");
            header("location: http://localhost/estate/admin?s=error");
            exit;
        }
    }
}
//-----------------------------------------------------------------------//
///بررسی صحت تلفن همراه و کدملی///
function checkPassAndTel($Otel,$ONCode)
{
    ///بررسی عدد بود دو مقدار///
    if (!is_numeric($Otel) or !is_numeric($ONCode)) {
        return false;
    }else {
        ///بررسی تعداد ارقام دو مقدار///
        $OtelNum = strlen($Otel);
        $ONCodeNum = strlen($ONCode);
        if ($OtelNum != 11 or $ONCodeNum != 10) {
            return false;
        }else {
            ///بررسی ابتدای دو مقدار///
            $Otel09 = substr($Otel, 0, 2);
            $ONCode0 = substr($ONCode, 0, 1);
            if ($Otel09 != "09" or $ONCode0 != "0") {
                return false;
            }else {
                return true;
            }
        }
    }
}
//-----------------------------------------------------------------------//
////ارسال اطلاعات ثبت منزل به دیتابیس////
function addHome($image,$city,$transaction,$type,$address,$metric,$rooms,$year,$nFloors,$flrNumbers,$lift,$parking,$warehouse,$rahn,$ejare,$OName,$Otel,$ONCode,$title,$description)
{
    global $pdo;
    if (!checkPassAndTel($Otel,$ONCode)) {
        return false;
    }else {
        $sql = "INSERT INTO sendedHome (H_image, H_city, H_transaction, H_type, H_address, H_metric, H_rooms, H_year, H_numberOfFloors, H_floorNumbers, H_theLift, H_parking, H_warehouse, H_rahn, H_ejare, ownerName, ownerTel, ownerNCode, H_title, H_description) VALUES (:image, :city, :transaction, :type, :address, :metric, :rooms, :year, :nFloors, :flrNumbers, :Lift, :parking, :warehouse, :rahn, :ejare, :OName, :OTel, :ONCode, :title, :description)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([ ':image' => $image, ':city' => $city, ':transaction' => $transaction, ':type' => $type, ':address' => $address, ':metric' => $metric, ':rooms' => $rooms, ':year' => $year, ':nFloors' => $nFloors, ':flrNumbers' => $flrNumbers, ':Lift' => $lift, ':parking' => $parking, ':warehouse' => $warehouse, ':rahn' => $rahn, ':ejare' => $ejare, ':OName' => $OName, ':OTel' => $Otel, ':ONCode' => $ONCode, ':title' => $title, ':description' => $description]);
        return $stmt->rowCount();
        return true;
    }
}
//-----------------------------------------------------------------------//
///حذف آگهی تازه ارسال شده توسط ادمین///
function deletePost($id)
{
    global $pdo;
    $sql = "DELETE FROM sendedHome WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);
    return $stmt->rowCount();
}
//-----------------------------------------------------------------------//
///تایید آگهی ارسال شده///
function sendPost($id)
{
    global $pdo;
    $sql = "INSERT INTO acceptedHome SELECT * FROM sendedHome WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);
    return $stmt->rowCount();
}
//-----------------------------------------------------------------------//
///حذف آگهی از قبل ثبت شده توسط ادمین///
function deletePost2($id)
{
    global $pdo;
    $sql = "DELETE FROM acceptedHome WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);
    return $stmt->rowCount();
}
//-----------------------------------------------------------------------//
////نمایش آلرت ها////
function alert($message)
{
    echo "<script type='text/javascript'>alert('$message');</script>";
}
?>