<?php
session_start();// âñÿ ïðîöåäóðà ðàáîòàåò íà ñåññèÿõ. Èìåííî â íåé õðàíÿòñÿ äàííûå ïîëüçîâàòåëÿ, ïîêà îí íàõîäèòñÿ íà ñàéòå. Î÷åíü âàæíî çàïóñòèòü èõ â ñàìîì íà÷àëå ñòðàíè÷êè!!!

if (isset($_POST['email'])) { $login = $_POST['email']; if ($login == '') { unset($login);} } //çàíîñèì ââåäåííûé ïîëüçîâàòåëåì ëîãèí â ïåðåìåííóþ $login, åñëè îí ïóñòîé, òî óíè÷òîæàåì ïåðåìåííóþ
if (isset($_POST['password'])) { $password=$_POST['password']; if ($password =='') { unset($password);} }
//çàíîñèì ââåäåííûé ïîëüçîâàòåëåì ïàðîëü â ïåðåìåííóþ $password, åñëè îí ïóñòîé, òî óíè÷òîæàåì ïåðåìåííóþ

if (empty($login) or empty($password)) //åñëè ïîëüçîâàòåëü íå ââåë ëîãèí èëè ïàðîëü, òî âûäàåì îøèáêó è îñòàíàâëèâàåì ñêðèïò
{
exit ("Âû ââåëè íå âñþ èíôîðìàöèþ, âåíèòåñü íàçàä è çàïîëíèòå âñå ïîëÿ!");
}
//åñëè ëîãèí è ïàðîëü ââåäåíû,òî îáðàáàòûâàåì èõ, ÷òîáû òåãè è ñêðèïòû íå ðàáîòàëè, ìàëî ëè ÷òî ëþäè ìîãóò ââåñòè
$login = stripslashes($login);
$login = htmlspecialchars($login);

$password = stripslashes($password);
$password = htmlspecialchars($password);

//óäàëÿåì ëèøíèå ïðîáåëû
$login = trim($login);
$password = trim($password);


// ïîäêëþ÷àåìñÿ ê áàçå
include ("bd.php");// ôàéë bd.php äîëæåí áûòü â òîé æå ïàïêå, ÷òî è âñå îñòàëüíûå, åñëè ýòî íå òàê, òî ïðîñòî èçìåíèòå ïóòü 



$result = $mysqli->query("SELECT * FROM people WHERE mail='$login'"); //извлекаем из базы все данные о пользователе с введенным логином
$myrow = mysqli_fetch_array($result);
if (empty($myrow['password']))
{
header('Location: ../login.php?req=empty_password');
//åñëè ïîëüçîâàòåëÿ ñ ââåäåííûì ëîãèíîì íå ñóùåñòâóåò
exit ("bad password");
}
else {
//åñëè ñóùåñòâóåò, òî ñâåðÿåì ïàðîëè
          if ($myrow['password']==$password) {
          //åñëè ïàðîëè ñîâïàäàþò, òî çàïóñêàåì ïîëüçîâàòåëþ ñåññèþ! Ìîæåòå åãî ïîçäðàâèòü, îí âîøåë!
          $_SESSION['login']=$myrow['mail']; 
          $_SESSION['id']=$myrow['id'];//ýòè äàííûå î÷åíü ÷àñòî èñïîëüçóþòñÿ, âîò èõ è áóäåò "íîñèòü ñ ñîáîé" âîøåäøèé ïîëüçîâàòåëü
          header('Location: ../dashboard.php');
          exit;
          }

       else {
        header('Location: ../login.php?req=bad_password');
       //åñëè ïàðîëè íå ñîøëèñü
       exit ("All bad.");
	   }
}
?>