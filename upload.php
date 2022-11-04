<?php // Основной файл загрузки
session_start();
require("connect.php");
$username=$_SESSION['username'];
$position=mysqli_query($connection,"select position from employees where login='$username'")->fetch_assoc()['position'];
$date=date('y-m-d');
$time=date("h:i:s");
$_SESSION['date']=$date;
$FileDir="./upload_files/$username/$date/";
$countfiles1= count($_FILES['files1']['name']);
$_SESSION['countfiles1']=$countfiles1;
$countfiles2= count($_FILES['files2']['name']);
$_SESSION['countfiles2']=$countfiles2;
$countfiles3= count($_FILES['files3']['name']);
$_SESSION['countfiles3']=$countfiles3;


if (!is_dir($FileDir)){
    mkdir($FileDir,0700);}

/*file_put_contents("./upload_files/$username/$date/counts.txt", "$countfiles1, $countfiles2, $countfiles3, $date, $time, $position");*/

if(isset($_POST['uploadBtn'])) {
    require_once("upload1.php"); // Загрузка файлов УЧЕБНО-МЕТОДИЧЕСКАЯ РАБОТА
    require_once("upload2.php"); // Загрузка файлов УЧЕБНО - ВОСПИТАТЕЛЬНАЯ РАБОТА
    require_once ("upload3.php"); // Загрузка файлов НАУЧНО-ИССЛЕДОВАТЕЛЬСКАЯ РАБОТА
}

switch ($position) { // Переход на страницу
    case Null:
        echo "Error: Null in position";
        break;
    case "Prepodavatel": // Переход на страницу для преподавателей
        echo '<script type="text/javascript">
            alert("Файлы успешно загружены");
            window.location.href ="prepod.php";
        </script>';
        break;
    case "ZavKafedri": // Переход на страницу для завкафедры
        echo '<script type="text/javascript">
            alert("Файлы успешно загружены");
            window.location.href ="zavkaf.php";
        </script>';
        break;
    case "Dekan" or "Direktor": // Переход на страницу для декана или директора
        echo '<script type="text/javascript">
            alert("Файлы успешно загружены");
            window.location.href ="deka-dir.php";
        </script>';
        break;
}

