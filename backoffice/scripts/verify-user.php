<?php
session_start();
$hero = $_POST['hero'];
$nbr = $_POST['number'];
$person = $_POST['person'];
if (isset($hero) && isset($nbr) && isset($person) && isset($_POST['submit'])) {
  // Data
  $hero_hash = "$2y$10$/61EylcGCEKYqAQNjZYggOYOPRsHZDwNmJ2o7x8in8EH0BECDelUK";
  $number1 = "$2y$10\$NMtrbLADPmP8Ba8OReUUpOY7gnbcuEqEK.vqKXJntX7rgAMc3K/VG";
  $number5 = '$2y$10$rmaZB8nM2tv/3hMN2E5FwOAESmAUY8rTbRz1QszRsPGGWyzFEnM4K';
  $number0 = "$2y$10\$MK3euT1JYpihIE6xtuQyaeni22K4knaWLXLA6KCUshfO1KNnuA3ae";
  $person_hash = "$2y$10\$Ruw0eN66TRbtEUUKPBS.1.GHWSQNa4AgaQ0UwxJO73XP4yGUkGeNm";

  if (vrf($hero, $hero_hash) && vrf($person, $person_hash)) {
    if (vrf($nbr, $number0) || vrf($nbr, $number1) || vrf($nbr, $number5)) {
      $_SESSION['message'] = '';
      $_SESSION['count'] = 1;
      header('Location:./../index.php');
    } else {
      // header('Location:./../challenge.php');
    }
  } else {
    // header('Location:./../challenge.php');
  }
}

function vrf($a, $b)
{
  if (password_verify($a, $b)) {
    return true;
  } else {
    return false;
  }
}
