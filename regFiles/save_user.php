<?php
if (isset($_POST['email'])) { $login = $_POST['email']; if ($login == '') { unset($login);} } //заносим введенный пользователем логин в переменную $login, если он пустой, то уничтожаем переменную
if (isset($_POST['password'])) { $password=$_POST['password']; if ($password =='') { unset($password);} }
if (isset($_POST['mobile'])) { $mobile=$_POST['mobile']; if ($mobile =='') { unset($mobile);} }
//заносим введенный пользователем пароль в переменную $password, если он пустой, то уничтожаем переменную

if (empty($login) or empty($password) or empty($mobile)) //если пользователь не ввел логин или пароль, то выдаем ошибку и останавливаем скрипт
{
exit ("XYINYA!");
}
//если логин и пароль введены,то обрабатываем их, чтобы теги и скрипты не работали, мало ли что люди могут ввести
$login = stripslashes($login);
$login = htmlspecialchars($login);

$password = stripslashes($password);
$password = htmlspecialchars($password);

$mobile = stripslashes($mobile);
$mobile = htmlspecialchars($mobile);

//удал€ем лишние пробелы
$login = trim($login);
$password = trim($password);
$mobile = trim($mobile);

// подключаемс€ к базе
include ("bd.php");// файл bd.php должен быть в той же папке, что и все остальные, если это не так, то просто измените путь 

// проверка на существование пользовател€ с таким же логином
$result = $mysqli->query("SELECT id FROM people WHERE mail='$login'");
$myrow = mysqli_fetch_array($result);
if (!empty($myrow['id'])) {
header('Location: ../login.php?req=exist');
exit;
}

// если такого нет, то сохран€ем данные
$result2 = $mysqli->query("INSERT INTO people (mail,password,mobile) VALUES('$login','$password','$mobile')");
// ѕровер€ем, есть ли ошибки
if ($result2=='TRUE')
{
header('Location: ../login.php?req=complete');
echo "Good</a>";
}

else {
echo "Bad.";
     }
?>