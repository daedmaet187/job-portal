<?php
session_start();
error_reporting(0);

include('includes/config.php');


if(isset($_GET['ajid']))
{
 
  $loggedIn = false;

  // Getting username/ email and password
  $uname=$_SESSION['jsid'];
  // Fetch data from database on the basis of username/email and password
  $sql ="SELECT id,IsActive FROM tbljobseekers WHERE (id=:usname )";
  $query= $dbh -> prepare($sql);
  $query-> bindParam(':usname', $uname, PDO::PARAM_STR);
  $query-> execute();
  $results=$query->fetchAll(PDO::FETCH_OBJ);
  if($query->rowCount() > 0)
  {
    foreach ($results as $row) {
      $loggedIn = $row->IsActive == 1? true: false;
    }
  }
  //if username or email not found in database
  else{
    echo "<script>alert('User not registered with us');</script>";
  }

  if($loggedIn == true) {

    $jobid=$_GET['ajid'];
    $userid= $_SESSION['jsid'];
    $query = "select ID from tblapplyjob where UserId=:uid && JobId=:jobid";
    $query = $dbh -> prepare($query);
    $query-> bindParam(':uid', $userid, PDO::PARAM_STR);
    $query-> bindParam(':jobid', $jobid, PDO::PARAM_STR);
    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    if($query->rowCount() > 0)
    {
    echo "<script>alert('Already Applied for this job');</script>"; 
    echo "<script>window.location.href ='index.php'</script>";
    }
    else
    {
    $query1="INSERT INTO tblapplyjob(UserId,JobId) VALUES(:uid,:jobid)";
    $query1 = $dbh -> prepare($query1);
      $query1-> bindParam(':uid', $userid, PDO::PARAM_STR);
      $query1-> bindParam(':jobid', $jobid, PDO::PARAM_STR);
      $query1->execute();
      $LastInsertId=$dbh->lastInsertId();
      if ($LastInsertId>0) {
        echo '<script>alert("Jobs has been applied.")</script>';
    echo "<script>window.location.href ='index.php'</script>";
      }
      else
        {
            echo '<script>alert("Something Went Wrong. Please try again")</script>';
        }
  
      
    }
  }else{
    echo '<script>alert("Your account is not active yet")</script>';
    echo "<script>window.location.href ='jobs-details.php?jid=$_GET[ajid]'</script>";
  }
}
?>
<!doctype html>

<html lang="ar" dir="rtl">

<head>

<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>بوابة الوظائف - تفاصيل الوظيفة</title>

<!--CUSTOM CSS-->

<link href="css/custom.css" rel="stylesheet" type="text/css">

<!--BOOTSTRAP CSS-->

<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap-rtl.css" rel="stylesheet" type="text/css">

<!--COLOR CSS-->

<link href="css/color.css" rel="stylesheet" type="text/css">

<!--RESPONSIVE CSS-->

<link href="css/responsive.css" rel="stylesheet" type="text/css">

<!--OWL CAROUSEL CSS-->

<link href="css/owl.carousel.css" rel="stylesheet" type="text/css">

<!--FONTAWESOME CSS-->

<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">

<!--SCROLL FOR SIDEBAR NAVIGATION-->

<link href="css/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css">


<!--GOOGLE FONTS-->

<link href='https://fonts.googleapis.com/css?family=Roboto:400,300,300italic,500,700,900' rel='stylesheet' type='text/css'>

<!--[if lt IE 9]>

      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>

      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <![endif]-->

</head>



<body class="theme-style-1">

<!--WRAPPER START-->

<div id="wrapper"> 

  <!--HEADER START-->

  <?php include_once('includes/header.php');?>

  <!--HEADER END--> 

  

  <!--INNER BANNER START-->

  <section id="inner-banner">

    <div class="container">

      <h1>تفاصيل الوظيفة</h1>

    </div>

  </section>

  <!--INNER BANNER END--> 

  

  <!--MAIN START-->

  <div id="main"> 

    <!--RECENT JOB SECTION START-->

    <section class="recent-row padd-tb job-detail">

      <div class="container">

        <div class="row">

          <div class="col-md-9 col-sm-8">

            <div id="content-area">

              <div class="box">
<?php  
$jid=$_GET['jid']; 
$sql="SELECT tbljobs.*,tblemployers.* from tbljobs join tblemployers on tblemployers.id=tbljobs.employerId where tbljobs.jobId=:jid";
$query = $dbh -> prepare($sql);
$query->bindParam(':jid',$jid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
                <div class="thumb"><img src="../files/employers/employerslogo/<?php echo $row->CompnayLogo;?>" width="100" height="100" alt="img"></div>

                <div class="text-col">

                  <h2><a href="#"><?php  echo htmlentities($row->jobTitle);?></a></h2>

                  <p><?php  echo htmlentities($row->CompnayName);?> <em><a href="index.php">(اعرض جميع الوظائف)</a></em></p>

                  <?php $locsArray = array('', 'بغداد', 'الأنبار', 'بابل', 'البصرة', 'دهوك', 'ذي قار', 'ديالى', 'أربيل',  'كربلاء', 'كركوك', 'ميسان', 'المثنى', 'النجف', 'نينوى', 'القادسية', 'صلاح الدين', 'السليمانية', 'واسط') ?>
                  <a href="#" class="text"><i class="fa fa-map-marker"></i><?php  echo $locsArray[$row->jobLocation];?></a> <a href="#" class="text"><i class="fa fa-calendar"></i><?php  echo htmlentities($row->postinDate);?> </a> <strong class="price"><i class="fa fa-money"></i>$<?php  echo htmlentities($row->salaryPackage);?></strong>

                  <div class="clearfix"> <?php if($row->jobType=="Full Time"){ ?><a href="#" class="btn-freelance">دوام كامل</a>
<?php } if($row->jobType=="Contract") { ?>
<a href="#" class="btn-freelance">عقد</a>
<?php } if($row->jobType=="Freelance") { ?>
<a href="#" class="btn-freelance">عمل حر</a>
<?php } if($row->jobType=="Part Time") { ?>
<a href="#" class="btn-freelance">دوام جزئي</a>
<?php } if($row->jobType=="Half Time") { ?>
<a href="#" class="btn-freelance">دوام نصفي</a>
<?php } if($row->jobType=="Internship") { ?>
<a href="#" class="btn-freelance">تدريب</a>
<?php } ?> 
                    <?php if($_SESSION['jsid']==""){?>
                    <a href="sign-up.php" class="btn-style-1">قدم على هذه الوظيفة</a>
 <?php } else { ?>
     <a href="jobs-details.php?ajid=<?php echo ($row->jobId);?>" class="btn-style-1">قدم على هذه الوظيفة</a>
     
      <?php } ?>   
                  
    </div>


                </div>

                <div class="clearfix">

                  <h4>نظرة عامة</h4>

                  <p><?php  echo ($row->CompnayDescription);?>.</p>

                  <h4>الخبرة المطلوبة</h4>

                  <p><?php  echo ($row->experience);?> yrs</p>
                  <h4>المهارات المطلوبة</h4>
                  <p><?php  echo ($row->skillsRequired);?></p>
                  <h4>موقع الوظيفة</h4>

                  <p> <?php  echo ($row->jobLocation);?></p>
                  <h4>الراتب</h4>

                  <p>$ <?php  echo ($row->salaryPackage);?></p>
                  <h4>تاريخ نشر الوظيفة</h4>

                  <p> <?php  echo ($row->postinDate);?></p>
<?php if($_SESSION['jsid']==""){?>
                  <a href="sign-up.php" class="btn-style-1 style-big">قدم على هذه الوظيفة الآن</a> 
<?php } else { ?>
  <a href="jobs-details.php?ajid=<?php echo ($row->jobId);?>" class="btn-style-1 style-big">قدم على هذا الوظيفة الآن</a> 
  <?php } ?>
                </div>

              </div>
<?php $cnt=$cnt+1;}} ?> 
            </div>

          </div>

          <div class="col-md-3 col-sm-4">

            <aside>

              <div class="sidebar">

              <h2>تفاصيل الشركة</h2>

              <div class="box">
<?php  
$jid=$_GET['jid']; 
$sql="SELECT tbljobs.*,tblemployers.* from tbljobs join tblemployers on tblemployers.id=tbljobs.employerId where tbljobs.jobId=:jid";
$query = $dbh -> prepare($sql);
$query->bindParam(':jid',$jid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
                  <div class="thumb"> <img src="../files/employers/employerslogo/<?php echo $row->CompnayLogo;?>" width="100" height="100">

                  </div>

                  <div class="text-box">

                    <h4 style="color: blue;"><?php  echo htmlentities($row->CompnayName);?></h4>

                    <p><?php  echo substr($row->CompnayDescription,40);?>
                     

</p>

<strong>صناعة</strong>

<p><?php  echo htmlentities($row->industry);?></p>



<strong>نوع العمل التجاري</strong>

<p><?php  echo htmlentities($row->typeBusinessEntity);?></p>



<strong>تأسست في</strong>

<p><?php  echo htmlentities($row->establishedIn);?></p>



<strong>عدد الموظفين</strong>

<p><?php  echo htmlentities($row->noOfEmployee);?></p>



<strong>الموقع</strong>

<p><?php  echo htmlentities($row->lcation);?> </p></div>

                </div>
                <?php $cnt=$cnt+1;}} ?> 
              </div>

            </aside>

          </div>

        </div>

      </div>

    </section>

    <!--RECENT JOB SECTION END--> 



  <!--MAIN END--> 

  

  <!--FOOTER START-->

 <?php include_once('includes/footer.php');?>

</div>

<!--WRAPPER END--> 



<!--jQuery START--> 

<!--JQUERY MIN JS--> 

<script src="js/jquery-1.11.3.min.js"></script> 

<!--BOOTSTRAP JS--> 

<script src="js/bootstrap.min.js"></script> 

<!--OWL CAROUSEL JS--> 

<script src="js/owl.carousel.min.js"></script> 

<!--BANNER ZOOM OUT IN--> 

<script src="js/jquery.velocity.min.js"></script> 

<script src="js/jquery.kenburnsy.js"></script> 

<!--SCROLL FOR SIDEBAR NAVIGATION--> 

<script src="js/jquery.mCustomScrollbar.concat.min.js"></script> 

<!--FOR CHECKBOX--> 

<script src="js/form.js"></script> 

<!--CUSTOM JS--> 

<script src="js/custom.js"></script>

</body>

</html>

