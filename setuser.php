<?php
  session_start();
  switch ($_GET['q']) {
    case 'admin':
      $_SESSION['login'] = 'admin';
      break;
    case 'manager':
      $_SESSION['login'] = 'manager_1';
      break;
    case 'company':
      $_SESSION['login'] = 'bad_company';
      break;
    default:
      # code...
      break;
  }
?>
