<?php
function validate_register($input)
{
    if (!isset($input['member1name'])
    ||!isset($input['member1surname'])
    ||!isset($input['member1class'])
    ||!isset($input['member1email'])
    ||!isset($input['member1phone'])
    ||!isset($input['member1parentname'])
    ||!isset($input['member1parentphone'])
    ||!isset($input['member2name'])
    ||!isset($input['member2surname'])
    ||!isset($input['member2class'])
    ||!isset($input['member2email'])
    ||!isset($input['member2phone'])
    ||!isset($input['member2parentname'])
    ||!isset($input['member2parentphone'])
    ||!isset($input['teamschool'])
    ||!isset($input['teamname'])
    ||!isset($input['teamteachername'])
    ||!isset($input['teamteachersurname'])
    ||!isset($input['teamteacherphone']))
    {
      $_SESSION['regisLog']="ข้อมูลนำเข้าไม่ถูกต้อง";
      return false;
    }
    if ((strlen($input['member1name'])>255)
    ||(strlen($input['member1surname'])>255)
    ||(strlen($input['member1class'])>16)
    ||(strlen($input['member1email'])>255)
    ||(strlen($input['member1phone'])>32)
    ||(strlen($input['member1parentname'])>255)
    ||(strlen($input['member1parentphone'])>32)
    ||(strlen($input['member2name'])>255)
    ||(strlen($input['member2surname'])>255)
    ||(strlen($input['member2class'])>16)
    ||(strlen($input['member2email'])>255)
    ||(strlen($input['member2phone'])>32)
    ||(strlen($input['member2parentname'])>255)
    ||(strlen($input['member2parentphone'])>32)
    ||(strlen($input['teamschool'])>255)
    ||(strlen($input['teamname'])>255)
    ||(strlen($input['teamteachername'])>255)
    ||(strlen($input['teamteachersurname'])>255)
    ||(strlen($input['teamteacherphone'])>32))
    {
      $_SESSION['regisLog']="ข้อมูลนำเข้ามีความยาวมากเกินไป";
      return false;
    }
    $ok=true;
    $havemember2=false;
    if ($input['member2name']!=null||$input['member2surname']!=null||$input['member2email']!=null||$input['member2phone']!=null||$input['member2parentname']!=null||$input['member2parentphone']!=null||!isset(allowClass[$input['member2class']]))
    {
      $havemember2=true;
    }
    if ($havemember2===false)$_POST['member2class']="";
    if ($havemember2===false)$input['member2class']="";
    //start check user input
    if ($input['teamschool']==null)
    {
      $ok=false;
      $_SESSION['regisLog']="โปรดกรอกชื่อโรงเรียนของท่าน";
    }
    else if ($input['teamname']==null)
    {
      $ok=false;
      $_SESSION['regisLog']="โปรดกรอกชื่อทีมที่ท่านจะใช้ในการแข่งขัน";
    }
    else if (count(db_selectregisterteam($input['teamname']))!=0)
    {
      $ok=false;
      $_SESSION['regisLog']="ชื่อTeamนี้ถูกใช้แล้ว";
    }
    else if (strlen($input['teamteacherphone'])!=0&&preg_match_all('/^([0-9]{9,10})$/',$input['teamteacherphone'])!=1)
    {
      $ok=false;
      $_SESSION['regisLog']="โปรดกรอกเบอร์โทรศัพท์อาจารย์ผู้ดูแลทีมให้ถูกต้อง";
    }
    else if ($input['member1name']==null||$input['member1surname']==null||$input['member1email']==null||$input['member1phone']==null||$input['member1parentname']==null||$input['member1parentphone']==null||!isset(allowClass[$input['member1class']]))
    {
      $ok=false;
      $_SESSION['regisLog']="โปรดกรอกข้อมูลของผู้เข้าแข่งขันคนที่ 1 ให้ครบ";
    }
    else if (filter_var($input['member1email'],FILTER_VALIDATE_EMAIL)===false)
    {
      $ok=false;
      $_SESSION['regisLog']="โปรดกรอกEmailของผู้เข้าแข่งขันคนที่ 1 ให้ถูกต้อง";
    }
    else if (preg_match_all('/^([0-9]{9,10})$/',$input['member1phone'])!=1)
    {
      $ok=false;
      $_SESSION['regisLog']="โปรดกรอกเบอร์โทรศัพท์ของผู้เข้าแข่งขันคนที่ 1 ให้ถูกต้อง";
    }
    else if (preg_match_all('/^([0-9]{9,10})$/',$input['member1parentphone'])!=1)
    {
      $ok=false;
      $_SESSION['regisLog']="โปรดกรอกเบอร์โทรศัพท์ผู้ปกครองของผู้เข้าแข่งขันคนที่ 1 ให้ถูกต้อง";
    }
    else if (!isset(allowClass[$input['member1class']])||$input['member1class']!=true)
    {
      $ok=false;
      $_SESSION['regisLog']="ระดับชั้นของผู้เข้าแข่งขันคนที่ 1 ไม่ถูกต้อง";
    }
    else if (($havemember2===true)&&($input['member2name']==null||$input['member2surname']==null||$input['member2email']==null||$input['member2phone']==null||$input['member2parentname']==null||$input['member2parentphone']==null||!isset(allowClass[$input['member2class']])))
    {
      $ok=false;
      $_SESSION['regisLog']="โปรดกรอกข้อมูลของผู้เข้าแข่งขันคนที่ 2 ให้ครบ";
    }
    else if (($havemember2===true)&&(filter_var($input['member2email'],FILTER_VALIDATE_EMAIL)===false))
    {
      $ok=false;
      $_SESSION['regisLog']="โปรดกรอกEmailของผู้เข้าแข่งขันคนที่ 2 ให้ถูกต้อง";
    }
    else if (($havemember2===true)&&(preg_match_all('/^([0-9]{9,10})$/',$input['member2phone'])!=1))
    {
      $ok=false;
      $_SESSION['regisLog']="โปรดกรอกเบอร์โทรศัพท์ของผู้เข้าแข่งขันคนที่ 2 ให้ถูกต้อง";
    }
    else if (($havemember2===true)&&(preg_match_all('/^([0-9]{9,10})$/',$input['member2parentphone'])!=1))
    {
      $ok=false;
      $_SESSION['regisLog']="โปรดกรอกเบอร์โทรศัพท์ผู้ปกครองของผู้เข้าแข่งขันคนที่ 2 ให้ถูกต้อง";
    }
    else if (($havemember2===true)&&(!isset(allowClass[$input['member2class']])||$input['member2class']!=true))
    {
      $ok=false;
      $_SESSION['regisLog']="ระดับชั้นของผู้เข้าแข่งขันคนที่ 2 ไม่ถูกต้อง";
    }
    //end check
    return $ok;
}
 ?>
