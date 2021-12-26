<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
  @if (isset($_SESSION['login'])&&$_SESSION['login']==true)
  <title>SKOI Register List</title>
  @else
  <title>Login</title>
  @endif
  <link rel="stylesheet" href="/css/bootstrap.css">
  </head>
  <body>
@if (isset($_SESSION['login'])&&$_SESSION['login']==true)
<table class="table-bordered">
      <thead>
        <tr>
          <th>เวลา&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</th>
          <th>โรงเรียน</th>
          <th>ชื่อทีม</th>
          <th>ชื่ออาจารย์ผู้ดูแลทีม</th>
          <th>นามสกุลอาจารย์ผู้ดูแลทีม</th>
          <th>เบอร์โทรศัพท์อาจารย์ผู้ดูแลทีม</th>
          <th>คนที่1-ชื่อ</th>
          <th>คนที่1-นามสกุล</th>
          <th>คนที่1-ระดับชั้น</th>
          <th>คนที่1-Email</th>
          <th>คนที่1-เบอร์โทรศัพท์</th>
          <th>คนที่1-ชื่อผู้ปกครอง</th>
          <th>คนที่1-เบอร์โทรศัพท์ผู้ปกครอง</th>
          <th>คนที่2-ชื่อ</th>
          <th>คนที่2-นามสกุล</th>
          <th>คนที่2-ระดับชั้น</th>
          <th>คนที่2-Email</th>
          <th>คนที่2-เบอร์โทรศัพท์</th>
          <th>คนที่2-ชื่อผู้ปกครอง</th>
          <th>คนที่2-เบอร์โทรศัพท์ผู้ปกครอง</th>
          <th>PDF</th>
        </tr>
      </thead>
      <tbody>
@foreach ($register_data as $data)
        <tr>
          <td>{{$data->registertime}}</td>
          <td>{{$data->teamschool}}</td>
          <td>{{$data->teamname}}</td>
          <td>{{$data->teamteachername}}</td>
          <td>{{$data->teamteachersurname}}</td>
          <td>{{$data->teamteacherphone}}</td>
          <td>{{$data->member1name}}</td>
          <td>{{$data->member1surname}}</td>
          <td>{{$data->member1class}}</td>
          <td>{{$data->member1email}}</td>
          <td>{{$data->member1phone}}</td>
          <td>{{$data->member1parentname}}</td>
          <td>{{$data->member1parentphone}}</td>
          <td>{{$data->member2name}}</td>
          <td>{{$data->member2surname}}</td>
          <td>{{$data->member2class}}</td>
          <td>{{$data->member2email}}</td>
          <td>{{$data->member2phone}}</td>
          <td>{{$data->member2parentname}}</td>
          <td>{{$data->member2parentphone}}</td>
          <td>
            <form class="form-group" action="/viewregisterlist" method="post">
              @csrf

              <input class="btn btn-primary" type="submit" name="downloadpdf" value="Download">
              <input type="hidden" name="teamname" value="{{$data->teamname}}">
            </form>
          </td>
        </tr>
@endforeach
      </tbody>
    </table>
    <div class="container" style="text-align:right;padding-top:10px">
      <form class="form-group" action="/viewregisterlist" method="post">
        @csrf

        <input class="btn btn-primary" type="submit" name="logout" value="Logout">
      </form>
    </div>
@else
    <center>
      <div class="container" style="margin-top:30vh">
        <form class="form-group" action="/viewregisterlist" method="post">
          @csrf

          <span style="font-size:30px">Login</span>
          <div class="container" style="width:40%">
            <input class="form-control" type="text" name="usrname" placeholder="Username" required><br>
            <input class="form-control" type="password" name="passwd" placeholder="Password" required><br>
            <input class="btn btn-primary" type="submit" name="" value="Login">
          </div>
        </form>
      </div>
    </center>
@endif
  </body>
</html>
