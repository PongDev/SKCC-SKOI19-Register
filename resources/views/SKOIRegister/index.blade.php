<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>SKOI Register</title>
    <link rel="stylesheet" href="/css/bootstrap.css">
    @php
    $browser=get_browser();
    if (strtolower($browser->browser)=='safari')
    echo '<link rel="stylesheet" href="/css/safari_css.css">';
    else
    echo '<link rel="stylesheet" href="/css/css.css">';
@endphp
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bai+Jamjuree">
  </head>
  <body>
    <img class="navbar-bg" src="/resource/navbar.png">
    <div class="navbar-container">
      <a href="/"><img class="navbar-icon" src="/resource/home.png"></a>
      <a href="/register"><img class="navbar-icon" src="/resource/register.png"></a>
      <span class="nav-padding"></span>
      <a href="/rule"><img class="navbar-icon" src="/resource/rule.png"></a>
      <a href="/contact"><img class="navbar-icon" src="/resource/contact.png"></a>
    </div>
    <div class="sponsor">
      <center>
          Sponsored By<br>
        </span>
        <img class="sponsor-icon" src="/resource/sponsor.png">
      </center>
    </div>
@if ($mode=='HOME')
    <center>
      <div class="container maincontent">
        <img src="/resource/poster.png" width="100%">
      </div>
    </center>
@endif
@if ($mode=='REGISTER')
    <center>
      <div class="container maincontent" style="color:#000000;font-family:Kanit">
        <span style="font-size:30px">สมัครเข้าร่วมการแข่งขัน SKOI'19</span>
        @php
        if (isset($_SESSION['regisLog']))
        {
          echo '<br><span style="font-size:25px;color:red">'.$_SESSION['regisLog'].'</span>';
          unset($_SESSION['regisLog']);
        }
        @endphp
        <form class="form-group" action="/register" method="post" style="margin-top:30px">
          @csrf

          <table cellpadding="5" style="width:70%">
            <tr style="font-size:25px">
              <td colspan="2" style="text-align:center">ข้อมูลทีม</td>
            </tr>
            <tr style="font-size:20px">
              <td>โรงเรียน<br>(ผู้เข้าแข่งขันต้องมาจากโรงเรียนเดียวกันทั้งทีม)</td>
              <td><input class="form-control" type="text" name="teamschool" required></td>
            </tr>
            <tr style="font-size:20px">
              <td>ชื่อทีม</td>
              <td><input class="form-control" type="text" name="teamname" required></td>
            </tr>
            <tr style="font-size:20px">
              <td>ชื่ออาจารย์ผู้ดูแลทีม<br>(ถ้ามี)</td>
              <td><input class="form-control" type="text" name="teamteachername"></td>
            </tr>
            <tr style="font-size:20px">
              <td>นามสกุลอาจารย์ผู้ดูแลทีม<br>(ถ้ามี)</td>
              <td><input class="form-control" type="text" name="teamteachersurname"></td>
            </tr>
            <tr style="font-size:20px">
              <td>เบอร์โทรศัพท์อาจารย์ผู้ดูแลทีม<br>(ถ้ามี)</td>
              <td><input class="form-control" type="tel" minlength="9" maxlength="10" pattern="\d*" name="teamteacherphone"></td>
            </tr>
            <tr style="font-size:25px">
              <td colspan="2" style="text-align:center">ผู้เข้าแข่งขันคนที่ 1</td>
            </tr>
            <tr style="font-size:20px">
              <td style="width:35%">ชื่อ</td>
              <td><input class="form-control" type="text" name="member1name" maxlength="255" required></td>
            </tr>
            <tr style="font-size:20px">
              <td>นามสกุล</td>
              <td><input class="form-control" type="text" name="member1surname" maxlength="255" required></td>
            </tr>
            <tr style="font-size:20px">
              <td>ระดับชั้น</td>
              <td>
                <select class="form-control" name="member1class" style="width:100px">@php
                  foreach($allowClass as $i=>$i_value)
                  {
                    if ($i_value)
                    {
                      echo '
                    <option value="'.$i.'">'.$i.'</option>';
                    }
                  }
@endphp

                </select>
              </td>
            </tr>
            <tr style="font-size:20px">
              <td>Email</td>
              <td><input class="form-control" type="email" name="member1email" maxlength="255" required></td>
            </tr>
            <tr style="font-size:20px">
              <td>เบอร์โทรศัพท์<br>(เช่น 0810000000<br>ไม่ต้องมี "-" คั่น)</td>
              <td><input class="form-control" type="tel" minlength="9" maxlength="10" pattern="\d*" name="member1phone" required></td>
            </tr>
            <tr style="font-size:20px">
              <td>ชื่อผู้ปกครอง<br>(ไว้ติดต่อกรณีฉุกเฉิน)</td>
              <td><input class="form-control" type="text" name="member1parentname" maxlength="255" required></td>
            </tr>
            <tr style="font-size:20px">
              <td>เบอร์โทรศัพท์ผู้ปกครอง<br>(ไว้ติดต่อกรณีฉุกเฉิน)</td>
              <td><input class="form-control" type="tel" minlength="9" maxlength="10" pattern="\d*" name="member1parentphone" required></td>
            </tr>
            <tr style="height:20px">
            </tr>
            <tr style="font-size:25px">
              <td colspan="2" style="text-align:center">ผู้เข้าแข่งขันคนที่ 2<br>(หากในทีมมีผู้เข้าแข่งขันเพียง 1 คน ไม่ต้องกรอกข้อมูลส่วนนี้)</td>
            </tr>
            <tr style="font-size:20px">
              <td style="width:25%">ชื่อ</td>
              <td><input class="form-control" type="text" name="member2name" maxlength="255"></td>
            </tr>
            <tr style="font-size:20px">
              <td>นามสกุล</td>
              <td><input class="form-control" type="text" name="member2surname" maxlength="255"></td>
            </tr>
            <tr style="font-size:20px">
              <td>ระดับชั้น</td>
              <td>
                <select class="form-control" name="member2class" style="width:100px">@php
                  foreach($allowClass as $i=>$i_value)
                  {
                    if ($i_value)
                    {
                      echo '
                    <option value="'.$i.'">'.$i.'</option>';
                    }
                  }
@endphp

                </select>
              </td>
            </tr>
            <tr style="font-size:20px">
              <td>Email</td>
              <td><input class="form-control" type="email" name="member2email" maxlength="255"></td>
            </tr>
            <tr style="font-size:20px">
              <td>เบอร์โทรศัพท์<br>(เช่น 0810000000<br>ไม่ต้องมี "-" คั่น)</td>
              <td><input class="form-control" type="tel" minlength="9" maxlength="10" pattern="\d*" name="member2phone"></td>
            </tr>
            <tr style="font-size:20px">
              <td>ชื่อผู้ปกครอง<br>(ไว้ติดต่อกรณีฉุกเฉิน)</td>
              <td><input class="form-control" type="text" name="member2parentname" maxlength="255"></td>
            </tr>
            <tr style="font-size:20px">
              <td>เบอร์โทรศัพท์ผู้ปกครอง<br>(ไว้ติดต่อกรณีฉุกเฉิน)</td>
              <td><input class="form-control" type="tel" minlength="9" maxlength="10" pattern="\d*" name="member2parentphone"></td>
            </tr>
            <tr style="height:20px">
            </tr>
            <tr style="height:20px">
            </tr>
            <tr>
              <td colspan="2"><span style="font-size:25px;color:red">หลังจากสมัครสำเร็จแล้วจะไม่สามารถแก้ไขข้อมูลได้ และจะมีไฟล์PDFให้พิมพ์ กรอกข้อมูลแล้วส่งมาทาง Email:computerclub@sk.ac.th<br><center><u>*ไฟล์นี้จะให้เพียงครั้งเดียวเท่านั้น*</u><br>กรณีพบปัญหาสามารถติดต่อได้ทาง<a href="https://web.facebook.com/skoi2019/">เพจเฟสบุ๊ก SKOI 2019</a></center><span></td>
            </tr>
            <tr>
              <td colspan="2"><input class="btn btn-primary float-right" type="submit" name="register" value="Register" style="margin-top:10px"></td>
            </tr>
          </table>
        </form>
      </div>
    </center>
@endif
@if ($mode=='RULE')
  <center>
    <div class="container maincontent" style="font-family:Kanit;padding-left:5%;padding-right:5%">
      <h2><span style="font-family:Kanit"><p>กติกา และข้อกำหนดการแข่งขัน SKOI 2019</p></span></h2><br><br>
      <div class="container">
        <div class="col-md-10-offset-1">
          <div class="row">
            <div class="col-md-12 col-lg-12">
              <h4>ประเภทการแข่งขัน</h4><br>
              <ul style="text-align:left">
                <li>เป็นการแข่งขันประเภททีม สำหรับนักเรียนระดับมัธยมศึกษา จำนวนสมาชิกไม่เกิน 2 คนต่อ 1 ทีม</li>
              </ul>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-md-12 col-lg-12">
              <h4>คุณสมบัติและเงื่อนไขของทีม</h4><br>
              <ul style="text-align:left">
                <li>ผู้สมัครต้องกำลังศึกษาอยู่ในระดับมัธยมศึกษา</li>
                <li>สมาชิกทั้ง 2 คนภายในทีมต้องมาจากโรงเรียนเดียวกัน</li>
                <li>แต่ละโรงเรียนมีสิทธิ์ส่งทีมเข้าร่วมแข่งขันได้ไม่จำกัดจำนวน</li>
                <li>แต่ละทีมต้องมีอาจารย์ที่ปรึกษาประจำทีม 1 คน
                  <ul style="list-style-type:square">
                    <li>อาจารย์ที่ปรึกษาต้องเป็นอาจารย์ประจำโรงเรียนเดียวกันกับนักเรียน</li>
                    <li>ในกรณีโรงเรียนที่ส่งทีมเข้าร่วมแข่งขันหลายทีมสามารถใช้อาจารย์ที่ปรึกษาคนเดียวกันได้</li>
                    <li>ในกรณีโรงเรียนที่ส่งทีมเข้าร่วมแข่งขันหลายทีม ทางคณะกรรมการผู้จัดงานจะคัดเลือกทีมตาม<b>ลำดับการส่งใบสมัคร</b></li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-md-12 col-lg-12">
              <h4>กฎ กติกา และวิธีการแข่งขัน</h4><br>
              <ul style="text-align:left">
                <li>การแข่งขันจะแบ่งออกเป็น 2 ช่วง</li>
                <ul style="list-style-type:square">
                  <li>การแข่งในช่วงเช้า ผู้เข้าแข่งขันจะได้อุ่นเครื่องกับโจทย์การเขียนโปรแกรมคอมพิวเตอร์ในแบบปกติ ที่จะทำให้สมองของผู้เข้าแข่งขันได้เริ่มทำงาน</li>
                  <li>การแข่งในช่วงบ่าย ผู้เข้าแข่งขันจะได้สัมผัสกับโจทย์ของ SKOI พร้อมกับกฏพิเศษ ที่นอกจากจะต้องทำโจทย์ให้ได้แล้ว ยังต้องคิดเพื่อวางแผนในการเก็บแต้มให้ได้มากที่สุดอีกด้วย</li>
                </ul>
              </ul>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-md-12 col-lg-12">
              <h4>การตัดสิน</h4><br>
              <ul style="text-align:left">
                <li>ตัดสินจากโปรแกรมตรวจ ที่จะสุ่มข้อมูลเข้าและตรวจหาข้อมูลออกที่ต้องการ รวมทั้งจากกฏพิเศษที่จะประกาศ ณ การแข่งขัน </li>
              </ul>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-md-12 col-lg-12">
              <h4>รางวัล</h4><br>
              <ul style="text-align:left">
                <li>รางวัลอันดับที่ 1 : เงินรางวัล 3000 บาท</li>
                <li>รางวัลอันดับที่ 2 : เงินรางวัล 2000 บาท</li>
                <li>รางวัลอันดับที่ 3 : เงินรางวัล 1000 บาท</li>
              </ul>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-md-12 col-lg-12">
              <h4>วัน เวลา และสถานที่แข่งขัน</h4><br>
              <ul style="text-align:left">
                <li>วันที่ 3 กุมภาพันธ์ พ.ศ.2562 เวลา 8:30 - 17:00 น.</li>
                <li>อาคาร 6 ชั้น 3 โรงเรียนสวนกุหลาบวิทยาลัย</li>
              </ul>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-md-12 col-lg-12">
              <h4>การสมัคร</h4><br>
              <ul style="text-align:left">
                <li>สามารถสมัครได้ที่เว็ปไซด์ : <a href="/register">link</a> หรือแทป "สมัครเข้าแข่งขัน" ในเว็ปไซด์นี้ โดยกรอกข้อมูลให้ครบถ้วน จากนั้นส่งใบสมัครที่ <a href="mailto:computerclub@sk.ac.th">computerclub@sk.ac.th</a></li>
                <li>ทีมงานจะประกาศรายชื่อทีมที่มีสิทธิ์เข้าร่วมทางเพจของชุมนุมคอมพิวเตอร์ สวนกุหลาบวิทยาลัย ในวันที่ 29 มกราคม 2562</li>
                <li>สามารถสมัครได้ตั้งแต่วันนี้ ถึงวันที่ 27 มกราคม 2562</li>
              </ul>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-md-12 col-lg-12">
              <h4>กำหนดการแข่งขัน</h4>
              <p style="text-align:left">
                <table style="width:100%;margin-left:0px" align="left">
                  <tr style="text-align:left">
                    <td class="timetable-time" style="text-align:left">8:30 น.</td>
                    <td class="timetable-data" style="text-align:left">ผู้เข้าแข่งขันรวมกัน ณ ห้อง 6304</td>
                  </tr>
                  <tr style="text-align:left">
                    <td class="timetable-time" style="text-align:left">8:30 - 9:00 น.</td>
                    <td class="timetable-data" style="text-align:left">พิธีเปิด และอธิบายกฏการแข่งขัน</td>
                  </tr>
                  <tr style="text-align:left">
                    <td class="timetable-time" style="text-align:left">9:00 - 11:30 น.</td>
                    <td class="timetable-data" style="text-align:left">การแข่งขันช่วงเช้า</td>
                  </tr>
                  <tr style="text-align:left">
                    <td class="timetable-time" style="text-align:left">11:30 - 12:30 น.</td>
                    <td class="timetable-data" style="text-align:left">พักรับประทานอาหารกลางวัน</td>
                  </tr>
                  <tr style="text-align:left">
                    <td class="timetable-time" style="text-align:left">12:30 - 13:00 น.</td>
                    <td class="timetable-data" style="text-align:left">อธิบายกฏกติกาสำหรับการแข่งขันในช่วงบ่าย</td>
                  </tr>
                  <tr style="text-align:left">
                    <td class="timetable-time" style="text-align:left">13:00 - 16:30 น.</td>
                    <td class="timetable-data" style="text-align:left">การแข่งขันช่วงบ่าย</td>
                  </tr>
                  <tr style="text-align:left">
                    <td class="timetable-time" style="text-align:left">16:30 - 17:00 น.</td>
                    <td class="timetable-data" style="text-align:left">พิธีปิด มอบรางวัล</td>
                  </tr>
                </table>
              </p>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-md-12 col-lg-12">
              <h4>กำหนดการดำเนินงาน</h4><br>
              <ul style="text-align:left">
                <li>สามารถสมัครได้ตั้งแต่วันนี้ จนถึงวันที่ 27 มกราคม 2562</li>
                <li>ทีมงานจะประกาศรายชื่อผู้ที่มีสิทธ์เข้าร่วมการแข่งขันในวันที่ 29 มกราคม 2562</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </center>
@endif
@if ($mode=='CONTACT')
    <center>
      <div class="container maincontent">
        <p class="contact-header">Contact us</p>
        <div class="container justify-content-center">
        <div class="content-block">
            <svg class="contact-icon" viewBox="0 0 512 512">
              <path d="M256 480c-88.366 0-160-71.634-160-160 0-160 160-352 160-352s160 192 160 352c0 88.366-71.635 160-160 160zm0-258c-54.124 0-98 43.876-98 98s43.876 98 98 98 98-43.876 98-98-43.876-98-98-98zm-62 98a62 62 1260 1 0 124 0 62 62 1260 1 0-124 0z" transform="scale(1 -1) translate(0 -480)"></path>
            </svg>
            <p><h3 class="content-block-header">Address</h3></p>
            <p class="content-block-sub-header">Suankularb Wittayalai School</p>
            <p style="font-family:Kanit">
              88 ถนนตรีเพชร แขวงวังบูรพาภิรมย์<br>
              เขตพระนคร กรุงเทพมหานคร 10200<br>
            </p>
            <br>
            <p class="content-block-sub-header">Suankularb Computer Club</p>
            <p style="font-family:Kanit">
              ตึกสวนกุหลาบรำลึก ชั้น 3<br>
              โรงเรียนสวนกุหลาบวิทยาลัย<br>
            </p>
          </div>
          <div class="content-block">
            <svg class="contact-icon" viewBox="0 0 512 512">
              <path d="M321.788 371.146c-11.188 6.236-20.175 2.064-32.764-4.572-11.46-8.748-45.402-35.438-81.226-71.188-26.156-33.084-46.162-64.288-55.375-79.293-.625-1.66-.944-2.632-.944-2.632-5.397-13.476-8.771-22.92-1.324-33.521 6.854-9.727 9.5-12.383 18.24-20.108l-87.79-130.124c-10.604 7.728-27.018 25.106-40.509 44.378-12.538 18.317-23.154 38.587-26.049 53.055 15.295 55.117 52.258 157.896 120.583 231.325l-.021.308c65.73 81.028 170.165 131.43 225.571 153.226 14.679-1.385 35.938-9.844 55.456-20.404 20.598-11.415 39.567-25.945 48.329-35.685l-120.288-100.829c-8.597 7.91-11.498 10.254-21.889 16.064zm-116.178-242.488c7.241-5.302 5.313-14.944 1.926-20.245l-66.579-101.913c-4.344-5.291-13.396-8.064-21.252-5.579l-27.433 18.381 88.034 129.879 25.304-20.523zm287.339 269.188l-94.473-76.788c-4.93-3.918-14.313-6.838-20.325-.188l-23.046 23.05 120.047 101.015 21.136-25.357c3.285-7.564 1.467-16.857-3.339-21.732z"></path>
            </svg>
            <p><h3 class="content-block-header">Phone</h3></p>
            <p class="content-block-sub-header">Suankularb Wittayalai School</p>
            <p style="font-family:Kanit">
              022255605-8 โทรศัพท์<br>
              022248554 โทรสาร<br>
            </p>
            <br>
            <p class="content-block-sub-header">Suankularb Computer Club</p>
            <p style="font-family:Kanit">
              คุณปฏิพล 0649914515<br>
              คุณอัครพนธ์ 0830796080<br>
            </p>
          </div>
          <div class="content-block">
            <svg class="contact-icon" viewBox="0 0 512 512">
              <path d="M418 32h-324c-51.7 0-94 42.3-94 94v354l96-96h322c51.7 0 94-42.3 94-94v-164c0-51.7-42.3-94-94-94zm-258 224c-17.673 0-32-14.327-32-32s14.327-32 32-32 32 14.327 32 32-14.327 32-32 32zm96 0c-17.673 0-32-14.327-32-32s14.327-32 32-32 32 14.327 32 32-14.327 32-32 32zm96 0c-17.673 0-32-14.327-32-32s14.327-32 32-32 32 14.327 32 32-14.327 32-32 32z"></path>
            </svg>
            <p><h3 class="content-block-header">Message us</h3></p>
            <p class="content-block-sub-header">Facebook</p>
            <p style="font-family:Kanit">
              <a href="https://web.facebook.com/skcomclub/">Suankularb Computer Club</a><br>
              <a href="https://web.facebook.com/skoi2019/">SKOI 2019</a><br>
            </p>
            <br>
            <p class="content-block-sub-header">Email</p>
            <p style="font-family:Kanit">
              <a class="link" href="mailto:computerclub@sk.ac.th">computerclub@sk.ac.th</a><br>
              <br>
            </p>
          </div>
        </div>
        <div class="container">
          <iframe width="80%" height="500" src="https://maps.google.com/maps?q=suankularb%20wittayalai%20school&t=&z=17&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" style="margin-top:100px;margin-bottom:100px"></iframe>
        </div>
      </div>
    </center>
@endif
  </body>
</html>
