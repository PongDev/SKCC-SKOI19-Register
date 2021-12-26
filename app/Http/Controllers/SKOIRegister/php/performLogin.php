<?php

define('DEFAULTALLOWINPUT','ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789_');

function checkInput($input,$allowinput=DEFAULTALLOWINPUT,$sizeAtleast=-1,$sizeLimit=-1)
{
  $inputSize=strlen($input);
  $allowinputSize=strlen($allowinput);
  if (($sizeAtleast!=-1&&$inputSize<$sizeAtleast)||($sizeLimit!=-1&&$inputSize>$sizeLimit))return false;
  for($i=0;$i<$inputSize;$i++)
  {
    $chk=false;
    for($i2=0;$i2<$allowinputSize;$i2++)
    {
      if ($input[$i]==$allowinput[$i2])
      {
        $chk=true;
        break;
      }
    }
    if ($chk==false)return false;
  }
  return true;
}

 ?>
