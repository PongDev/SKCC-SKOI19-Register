<?php

namespace App\Http\Controllers\SKOIRegister;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

/**
 *
 */

require 'conf/conf.php';
require 'php/session.php';
require 'php/database.php';
require 'php/validate.php';
require 'php/performLogin.php';

class routingManagement extends Controller
{

  /*function __construct(argument)
  {
    // code...
  }*/

  public function redirecthome()
  {
    db_traffic_log(array(
      'request_ip'=>$_SERVER['REMOTE_ADDR'],
      'request_user_agent'=>$_SERVER['HTTP_USER_AGENT'],
      'request_page'=>'redirect',
      'request_method'=>$_SERVER['REQUEST_METHOD'],
      'request_time'=>date('Y-m-d H:i:s',$_SERVER['REQUEST_TIME'])
    ));
    return redirect('/');
  }

  public function index()
  {
    db_traffic_log(array(
      'request_ip'=>$_SERVER['REMOTE_ADDR'],
      'request_user_agent'=>$_SERVER['HTTP_USER_AGENT'],
      'request_page'=>'index',
      'request_method'=>$_SERVER['REQUEST_METHOD'],
      'request_time'=>date('Y-m-d H:i:s',$_SERVER['REQUEST_TIME'])
    ));
    if ($_SERVER['REQUEST_METHOD']==='GET')
    {
      return view('SKOIRegister/index')->with([
        'mode'=>'HOME'
      ]);
    }
    else if ($_SERVER['REQUEST_METHOD']==='POST')
    {

    }
  }

  public function register()
  {
    db_traffic_log(array(
      'request_ip'=>$_SERVER['REMOTE_ADDR'],
      'request_user_agent'=>$_SERVER['HTTP_USER_AGENT'],
      'request_page'=>'register',
      'request_method'=>$_SERVER['REQUEST_METHOD'],
      'request_time'=>date('Y-m-d H:i:s',$_SERVER['REQUEST_TIME'])
    ));
    if ($_SERVER['REQUEST_METHOD']==='GET')
    {
      return view('SKOIRegister/index')->with([
        'mode'=>'REGISTER',
        'allowClass'=>allowClass
      ]);
    }
    else if ($_SERVER['REQUEST_METHOD']==='POST')
    {
      if (validate_register($_POST))
      {
        db_register($_POST);
        $_SESSION['regisLog']="สมัครเข้าแข่งขันสำเร็จ ในชื่อ Team ".$_POST['teamname'];
        $jsoncontent='
        {
          "schoolName": "'.$_POST['teamschool'].'",
          "teacher": {
            "name": "'.$_POST['teamteachername'].' '.$_POST['teamteachersurname'].'",
            "tel": "'.$_POST['teamteacherphone'].'"
          },
          "teams": [
            {
              "teamName": "'.$_POST['teamname'].'",
              "teamMembers": [
                {
                  "prefix": "",
                  "name": "'.$_POST['member1name'].'",
                  "lastName": "'.$_POST['member1surname'].'",
                  "classLevel": "'.$_POST['member1class'].'",
                  "tel": "'.$_POST['member1phone'].'",
                  "email": "'.$_POST['member1email'].'",
                  "facebook": ""
                },
                {
                  "prefix": "",
                  "name": "'.$_POST['member2name'].'",
                  "lastName": "'.$_POST['member2surname'].'",
                  "classLevel": "'.$_POST['member2class'].'",
                  "tel": "'.$_POST['member2phone'].'",
                  "email": "'.$_POST['member2email'].'",
                  "facebook": ""
                }
              ]
            }
          ]
        }
';
        $url="http://localhost:1030";
        $data=array('data'=>$jsoncontent);
        $opt=array('http'=>array(
          'header'=>'Content-type: application/x-www-form-urlencoded',
          'method'=>'POST',
          'content'=>http_build_query($data)
        ));
        $context=stream_context_create($opt);
        $result=file_get_contents($url,false,$context);
        return response($result)->header('Content-Type','application/pdf');
      }
      return redirect('/register');
    }
  }

  public function rule()
  {
    db_traffic_log(array(
      'request_ip'=>$_SERVER['REMOTE_ADDR'],
      'request_user_agent'=>$_SERVER['HTTP_USER_AGENT'],
      'request_page'=>'rule',
      'request_method'=>$_SERVER['REQUEST_METHOD'],
      'request_time'=>date('Y-m-d H:i:s',$_SERVER['REQUEST_TIME'])
    ));
    if ($_SERVER['REQUEST_METHOD']==='GET')
    {
      return view('SKOIRegister/index')->with([
        'mode'=>'RULE'
      ]);
    }
    else if ($_SERVER['REQUEST_METHOD']==='POST')
    {

    }
  }

  public function contact()
  {
    db_traffic_log(array(
      'request_ip'=>$_SERVER['REMOTE_ADDR'],
      'request_user_agent'=>$_SERVER['HTTP_USER_AGENT'],
      'request_page'=>'contact',
      'request_method'=>$_SERVER['REQUEST_METHOD'],
      'request_time'=>date('Y-m-d H:i:s',$_SERVER['REQUEST_TIME'])
    ));
    if ($_SERVER['REQUEST_METHOD']==='GET')
    {
      return view('SKOIRegister/index')->with([
        'mode'=>'CONTACT'
      ]);
    }
    else if ($_SERVER['REQUEST_METHOD']==='POST')
    {

    }
  }

  public function viewregisterlist()
  {
    db_traffic_log(array(
      'request_ip'=>$_SERVER['REMOTE_ADDR'],
      'request_user_agent'=>$_SERVER['HTTP_USER_AGENT'],
      'request_page'=>'viewregisterlist',
      'request_method'=>$_SERVER['REQUEST_METHOD'],
      'request_time'=>date('Y-m-d H:i:s',$_SERVER['REQUEST_TIME'])
    ));
    if ($_SERVER['REQUEST_METHOD']==='GET')
    {
      if (isset($_SESSION['login'])&&$_SESSION['login']==true)
      {
        return view('SKOIRegister/viewregisterlist')->with(['register_data'=>db_selectallregisterteam()]);
      }
      return view('SKOIRegister/viewregisterlist');
    }
    else if ($_SERVER['REQUEST_METHOD']==='POST')
    {
      if (isset($_SESSION['login'])&&$_SESSION['login']==true)
      {
        if (isset($_POST['logout']))
        {
          logout();
          return redirect('/viewregisterlist');
        }
        if (isset($_POST['downloadpdf']))
        {
          $register_data=db_selectregisterteam($_POST['teamname'])[0];$jsoncontent='
          {
            "schoolName": "'.$register_data->teamschool.'",
            "teacher": {
              "name": "'.$register_data->teamteachername.' '.$register_data->teamteachersurname.'",
              "tel": "'.$register_data->teamteacherphone.'"
            },
            "teams": [
              {
                "teamName": "'.$register_data->teamname.'",
                "teamMembers": [
                  {
                    "prefix": "",
                    "name": "'.$register_data->member1name.'",
                    "lastName": "'.$register_data->member1surname.'",
                    "classLevel": "'.$register_data->member1class.'",
                    "tel": "'.$register_data->member1phone.'",
                    "email": "'.$register_data->member1email.'",
                    "facebook": ""
                  },
                  {
                    "prefix": "",
                    "name": "'.$register_data->member2name.'",
                    "lastName": "'.$register_data->member2surname.'",
                    "classLevel": "'.$register_data->member2class.'",
                    "tel": "'.$register_data->member2phone.'",
                    "email": "'.$register_data->member2email.'",
                    "facebook": ""
                  }
                ]
              }
            ]
          }
  ';
          $url="http://localhost:1030";
          $data=array('data'=>$jsoncontent);
          $opt=array('http'=>array(
            'header'=>'Content-type: application/x-www-form-urlencoded',
            'method'=>'POST',
            'content'=>http_build_query($data)
          ));
          $context=stream_context_create($opt);
          $result=file_get_contents($url,false,$context);
          return response($result)->header('Content-Type','application/pdf');
        }
      }
      else
      {
        if (checkInput($_POST['usrname'],DEFAULTALLOWINPUT,1,20)&&checkInput($_POST['passwd'],DEFAULTALLOWINPUT,1,20))
        {
          login($_POST['usrname'],$_POST['passwd']);
        }
      }
      return redirect('/viewregisterlist');
    }
  }
}

 ?>
