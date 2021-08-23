<?php
setcookie('lang', 'ar', time() + (86400 * 365), "/");
?>
  <header id="header"> 

    <!--BURGER NAVIGATION SECTION START-->

    <!--BURGER NAVIGATION SECTION END-->

    <div class="container"> 

      <!--NAVIGATION START-->

      <div class="navigation-col">

        <nav class="navbar navbar-inverse">

          <div class="navbar-header">

            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>

            <h2><strong class="logo" style="color: blue; padding-top:8%; font-family:almarai">بوابة الوظائف</strong></h2> </div>

          <div id="navbar" class="collapse navbar-collapse">

            <ul class="nav navbar-nav" id="nav">

              <li><a href="index.php">الرئيسية</a>

              <?php if(isset($_SESSION['jsid'])) { ?>
              </li>
              <li><a href="job-search.php?jobtitle=&company=&joblocation=&search=">وظائف</a>
              </li>
              <?php } ?>

               

              </li>
<?php if (strlen($_SESSION['jsid']==0)) {?>
              <li><a href="sign-up.php">الباحثين عن عمل</a>
              </li>

              <li><a href="employers/emp-login.php">الشركات</a></li>
              
<!-- <li><a href="../admin/index.php">المسؤول</a></li>--><?php } ?>
              
                  
<?php if (strlen($_SESSION['jsid']!=0)) {?>
                  <li><a href="applied-jobs.php">الوظائف المقدم عليها مسبقاً</a></li>
<?php } ?>
              </li>
              <li><a href="blogs.php">المدونة</a></li>

              <li><a href="about.php">معلومات عنا</a></li>

              <li><a href="contact.php">اتصل بنا</a></li>

            </ul>

          </div>

        </nav>

      </div>

      <!--NAVIGATION END--> 

    </div>

    

    <!--USER OPTION COLUMN START-->

    <div class="user-option-col">
     
     <div>
       <a href="../en">English</a>
       <a href="../ar">عربي</a>
     </div>

      <div class="thumb">

        <div class="dropdown">
          <?php if (strlen($_SESSION['jsid']==0)) {?>
          <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <img src="../files/images/account.png" width="40" height="40" ></button>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">

            <li><a href="sign-in.php">الباحثين عن العمل</a></li>

            <li><a href="employers/emp-login.php">الشركات</a></li>

            <li><a href="../admin/index.php">المسؤول</a></li>

            

          </ul><?php } ?>
<?php if (strlen($_SESSION['jsid']!=0)) {?>

   <?php
         $uid= $_SESSION['jsid'];
$sql="SELECT * from tbljobseekers where id='$uid'";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
          <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <img src="../files/images/<?php echo $row->ProfilePic;?>" width="40" height="40" ></button>
<?php $cnt=$cnt+1;}} ?>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">

            <li><a href="my-profile.php">صفحتي</a></li>

            <li><a href="change-password.php">تغيير كلمة السر</a></li>

            <li><a href="profile.php">تعديل الصفحة</a></li>

            <li><a href="logout.php">الخروج</a></li>

          </ul>
<?php } ?>
        </div>

      </div>

     

    </div>

    <!--USER OPTION COLUMN END--> 
  </header>
