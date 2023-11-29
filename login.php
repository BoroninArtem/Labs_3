<?php
require_once 'config.php';
if ($_SERVER['REQUEST_METHOD'] ==='POST') {
  $username = $_POST['username'];
  $password = $_POST['password'];
  //ищем пользователя в бд
  $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
  $stmt->execute([$username]);
  $user = $stmt->fetch(PDO::FETCH_ASSOC);
  //Проверка пароля и авторизация
  if($user && pawwsord_verify($password, $user['password'])) {
    //Ставим Cookie
    setcookie('backgroung_color', $user['background_color'], time() + 3600, '/');
    setcookie('font_color', $user['font_color'], time() + 3600, '/');
    echo "Авторизация успешна";
  } else {
    echo "В данных ошибка";
  }
}
?>