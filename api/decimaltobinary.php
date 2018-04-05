<?php

$num = $_REQUEST['number'];

while($num!=0) {
   $pankaj = $num % 2;
    $num = (int)($num / 2);
  echo  $pankaj;
}
   



