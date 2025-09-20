<?php
$host = "localhost";
$user = "root";   // اسم مستخدم MySQL
$pass = "";       // كلمة المرور
$dbname = "cogemor";

$conn = new mysqli($host, $user, $pass, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("Échec de connexion : " . $conn->connect_error);
}

// UTF-8 لترميز عربي/فرنسي
$conn->set_charset("utf8");
?>