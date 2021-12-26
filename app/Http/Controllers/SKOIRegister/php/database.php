<?php
function db_selectallregisterteam()
{
  return DB::select('select * from SKOI_Register_Team order by registertime');
}

function db_selectregisterteam($team)
{
  return DB::select('select * from SKOI_Register_Team where teamname=?',[$team]);
}

function db_register($input)
{
  DB::insert('insert into SKOI_Register_Team
  (member1name,member1surname,member1class,member1email,member1phone,member1parentname,member1parentphone,
	member2name,member2surname,member2class,member2email,member2phone,member2parentname,member2parentphone,
	teamschool,teamname,teamteachername,teamteachersurname,teamteacherphone) values
  (?,?,?,?,?,?,?,
  ?,?,?,?,?,?,?,
  ?,?,?,?,?)',[$input['member1name'],$input['member1surname'],$input['member1class'],$input['member1email'],$input['member1phone'],$input['member1parentname'],$input['member1parentphone'],
  $input['member2name'],$input['member2surname'],$input['member2class'],$input['member2email'],$input['member2phone'],$input['member2parentname'],$input['member2parentphone'],
  $input['teamschool'],$input['teamname'],$input['teamteachername'],$input['teamteachersurname'],$input['teamteacherphone']]);
  return true;
}

function db_traffic_log($input)
{
  if (enable_traffic_log)
  {
    DB::insert('insert into Traffic_Log (request_ip,request_user_agent,request_page,request_method,request_time) values (?,?,?,?,?)',[$input['request_ip'],$input['request_user_agent'],$input['request_page'],$input['request_method'],$input['request_time']]);
  }
}

function login($usrname,$passwd)
{
  $user=DB::select('select * from SKOI_Staff where User=?',[$usrname]);
  if (count($user)==1)
  {
    if ($user[0]->Password==$passwd)
    {
      DB::update('update SKOI_Staff set lastLogin=? where User=?',[date('Y-m-d H:i:s',time()),$usrname]);
      $_SESSION['login']=true;
      return true;
    }
    return false;
  }
  return false;
}
function logout()
{
  unset($_SESSION['login']);
}
 ?>
