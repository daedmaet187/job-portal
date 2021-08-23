 <header id="header"> 

    <!--BURGER NAVIGATION SECTION START-->

    <!--BURGER NAVIGATION SECTION END-->

    <div class="container"> 

      <!--NAVIGATION START-->

      <div class="navigation-col">

        <nav class="navbar navbar-inverse">

          <div class="navbar-header">

            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>


            <h2><strong class="logo" style="color:blue;padding-top:8%;font-family:almarai">بوابة الوظائف</strong></h2> </div>

          

            <ul class="nav navbar-nav" id="nav">
              <li><a href="#">الوظائف</a>
                <ul>
                  <li><a href="post-job.php">انشر وظيفة</a></li>
                  <li><a href="job-listing.php">ادارة الوظائف</a></li>
                </ul>
              </li>
             
 <li><a href="candidates-listings.php">قائمة المقدمين</a></li>
 <li><a href="candidates-reports.php">التقارير</a></li>
 <li><a href="../blogs.php">المدونة</a></li>
            </ul>

          </div>

        </nav>

      </div>

      <!--NAVIGATION END--> 

    </div>

    

    <!--USER OPTION COLUMN START-->

    <div class="user-option-col">

      <div class="thumb">

        <div class="dropdown">
<!--Fetching Company Logo -->
<?php
//Geeting Employer Id
$empid=$_SESSION['emplogin'];
// Fetching jobs
$sql = "SELECT  CompnayLogo from tblemployers where id=:eid";
$query = $dbh -> prepare($sql);
$query-> bindParam(':eid', $empid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
{ ?>

          <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <img src="../../files/employers/employerslogo/<?php echo htmlentities($result->CompnayLogo)?>" alt="Company Logo" width="44" height="44" style="border: solid 1px #000000;"></button>
<?php }} ?>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">

            <li><a href="edit-profile.php">ادارة الحساب</a></li>

            <li><a href="change-password.php">تغيير كلمة السر</a></li>
            <li><a href="logout.php">الخروج</a></li>

          </ul>

        </div>

      </div>

      

    </div>

    <!--USER OPTION COLUMN END--> 

    

  </header>