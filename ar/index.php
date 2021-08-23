<?php
session_start();
error_reporting(0);

include('includes/config.php');
?>
<!doctype html>

<html lang="ar" dir="rtl">

<head>

<meta charset="utf-8">
<title>بوابة الوظائف || الصفحة الرئيسية</title>

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

  

  <!--BANNER START-->

  <div class="banner-outer">

    <div id="banner" class="element">  </div>

    <div class="caption">

      <div class="holder">

        <h1>ابحث عن الوظائف المتوفرة</h1>

        <form action="job-search.php" method="get">

          <div class="container">

            <div class="row">

              <div class="col-md-3 col-sm-3">

                <input type="text" placeholder="ادخل عنوان الوظيفة" name="jobtitle">

              </div>
              <div class="col-md-3 col-sm-3">

                <input type="text" placeholder="اسم الشركة" name="company">

              </div>
              <div class="col-md-3 col-sm-3">

  <select class="full-width" name="joblocation" style="width: 100%">
    <option value="">الكل</option>
    <option value="1">بغداد</option>
    <option value="2">الانبار</option>
    <option value="3">بابل</option>
    <option value="4">بصرة</option>
    <option value="5">دهوك</option>
    <option value="6">ذي قار</option>
    <option value="7">ديالى</option>
    <option value="8">اربيل</option>
    <option value="9">كربلاء</option>
    <option value="10">كركوك</option>
    <option value="11">ميسان</option>
    <option value="12">المثنى</option>
    <option value="13">نجف</option>
    <option value="14">نينوى</option>
    <option value="15">القادسية</option>
    <option value="16">صلاح الدين</option>
    <option value="17">السليمانية</option>
    <option value="18">واسط</option>
  </select>

              </div>

              <div class="col-md-2 col-sm-2">

                <button type="submit" name="search"><i class="fa fa-search"></i></button>

              </div>

            </div>

          </div>

        </form>


<?php if (strlen($_SESSION['jsid']==0)) {?>
        <div class="btn-row"> <a href="sign-up.php"><i class="fa fa-user"></i>انا ابحث عن وظيفة</a> <a href="../ar/employers/employers-signup.php"><i class="fa fa-building-o"></i>انا شركة</a> </div>
<?php } ?>
      </div>

    </div>

    <div class="browse-job-section">

 
    </div>

  </div>

  <!--BANNER END--> 

  

  <!--MAIN START-->

  <div id="main"> 

    <!--POPULAR JOB CATEGORIES START-->

    <section class="popular-categories">

      <div class="container">

        <div class="clearfix">

          <h2>أكثر الفئات الشائعة</h2>

          <a href="job-search.php" class="btn-style-1">اكتشف جميع الوظائف</a> </div>

        <div class="row">
<?php
$sql="SELECT jobCategory,count(jobId) as totaljobs from tbljobs group by jobCategory";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

foreach($results as $row)
{               ?>
          <div class="col-md-3 col-sm-6">

            <div class="box"> <img src="../ar/images/jobs.jpg" alt="img" width="68" height="68">

              <h4><a href="job-search.php?jobCategory=<?php echo htmlentities ($row->jobCategory);?>"><?php  echo htmlentities($row->jobCategory);?></a></h4>

              <strong><?php  echo htmlentities($row->totaljobs);?></strong>

          

            </div>

          </div>
 <?php } ?> 
         


        </div>

      </div>

    </section>

    <!--POPULAR JOB CATEGORIES END--> 

    

    <!--RECENT JOB SECTION START-->

    <section class="recent-row padd-tb">

      <div class="container">

        <div class="row">

          <div class="col-md-12 col-sm-8">

            <div id="content-area">

              <h2>اخر الوظائف الشعبية</h2>

              <ul id="myList">

                <li>
<?php
         if (isset($_GET['page_no']) && $_GET['page_no']!="") {
  $page_no = $_GET['page_no'];
  } else {
    $page_no = 1;
        }
        // Formula for pagination
        $no_of_records_per_page = 5;
        $offset = ($page_no-1) * $no_of_records_per_page;
        $previous_page = $page_no - 1;
  $next_page = $page_no + 1;
  $adjacents = "2"; 
  $ret = "SELECT jobId FROM tbljobs WHERE tbljobs.isActive=1";
  $query1 = $dbh -> prepare($ret);
  $query1->execute();
  $results1=$query1->fetchAll(PDO::FETCH_OBJ);
  $total_rows=$query1->rowCount();
  $total_no_of_pages = ceil($total_rows / $no_of_records_per_page);
    $second_last = $total_no_of_pages - 1; // total page minus 1
  $sql="SELECT tbljobs.*,tblemployers.CompnayLogo,tblemployers.CompnayName from tbljobs join tblemployers on tblemployers.id=tbljobs.employerId WHERE tbljobs.isActive=1 LIMIT $offset, $no_of_records_per_page";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
                  <div class="box">

                    <div class="thumb"><a href="jobs-details.php?jid=<?php echo ($row->jobId);?>"><img src="../files/employers/employerslogo/<?php echo $row->CompnayLogo;?>" width="100" height="100"></a></div>

                    <div class="text-col">

                      <h4><a href="jobs-details.php?jid=<?php echo ($row->jobId);?>"><?php  echo htmlentities($row->jobTitle);?></a></h4>

                      <p><?php  echo htmlentities($row->CompnayName);?></p>

                      <?php $locsArray = array('', 'بغداد', 'الأنبار', 'بابل', 'البصرة', 'دهوك', 'ذي قار', 'ديالى', 'أربيل',  'كربلاء', 'كركوك', 'ميسان', 'المثنى', 'النجف', 'نينوى', 'القادسية', 'صلاح الدين', 'السليمانية', 'واسط') ?>
                      <a href="jobs-details.php?jid=<?php echo ($row->jobId);?>" class="text"><i class="fa fa-map-marker"></i><?php  echo $locsArray[$row->jobLocation];?></a> <a href="#" class="text"><i class="fa fa-calendar"></i><?php  echo htmlentities($row->postinDate);?> </a> </div>

                    <strong class="price"><i class="fa fa-money"></i>$<?php  echo htmlentities($row->salaryPackage);?></strong> 
                    <?php if($row->jobType=="Full Time"){ ?><a href="jobs-details.php?jid=<?php echo ($row->jobId);?>" class="btn-1 btn-color-2 ripple">دوام كامل</a>
<?php } if($row->jobType=="Contract") { ?>
<a href="jobs-details.php?jid=<?php echo ($row->jobId);?>" class="btn-1 btn-color-4 ripple">عقد</a>
<?php } if($row->jobType=="Freelance") { ?>
<a href="jobs-details.php?jid=<?php echo ($row->jobId);?>" class="btn-1 btn-color-3 ripple">عمل حر</a>
<?php } if($row->jobType=="Part Time") { ?>
<a href="jobs-details.php?jid=<?php echo ($row->jobId);?>" class="btn-1 btn-color-1 ripple">دوام جزئي</a>
<?php } if($row->jobType=="Half Time") { ?>
<a href="jobs-details.php?jid=<?php echo ($row->jobId);?>" class="btn-1 btn-color-1 ripple">دوام نصفي</a>
<?php } if($row->jobType=="Internship") { ?>
<a href="jobs-details.php?jid=<?php echo ($row->jobId);?>" class="btn-1 btn-color-2 ripple">تدريب</a>

<?php } ?> 
                     </div>

                </li>

<?php $cnt=$cnt+1;}} ?> 

            
              </ul>

              <div align="left">
    <ul class="pagination">

<li <?php if($page_no <= 1){ echo "class='disabled'"; } ?>>
<a <?php if($page_no > 1){ echo "href='?page_no=$previous_page'"; } ?>>السابق</a>
</li>

<?php
if ($total_no_of_pages <= 10){
for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
if ($counter == $page_no) {
echo "<li class='active'><a>$counter</a></li>";
}else{
echo "<li><a href='?page_no=$counter'>$counter</a></li>";
}
}
}
elseif($total_no_of_pages > 10){

if($page_no <= 4) {
for ($counter = 1; $counter < 8; $counter++){
if ($counter == $page_no) {
echo "<li class='active'><a>$counter</a></li>";
}else{
echo "<li><a href='?page_no=$counter'>$counter</a></li>";
}
}
echo "<li><a>...</a></li>";
echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
}

elseif($page_no > 4 && $page_no < $total_no_of_pages - 4) {
echo "<li><a href='?page_no=1'>1</a></li>";
echo "<li><a href='?page_no=2'>2</a></li>";
echo "<li><a>...</a></li>";
for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {
if ($counter == $page_no) {
echo "<li class='active'><a>$counter</a></li>";
}else{
echo "<li><a href='?page_no=$counter'>$counter</a></li>";
}
}
echo "<li><a>...</a></li>";
echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
}

else {
echo "<li><a href='?page_no=1'>1</a></li>";
echo "<li><a href='?page_no=2'>2</a></li>";
echo "<li><a>...</a></li>";

for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
if ($counter == $page_no) {
echo "<li class='active'><a>$counter</a></li>";
}else{
echo "<li><a href='?page_no=$counter'>$counter</a></li>";
}
}
}
}
?>

<li <?php if($page_no >= $total_no_of_pages){ echo "class='disabled'"; } ?>>
<a <?php if($page_no < $total_no_of_pages) { echo "href='?page_no=$next_page'"; } ?>>التالي</a>
</li>
<?php if($page_no < $total_no_of_pages){
echo "<li><a href='?page_no=$total_no_of_pages'>الاقدم &rsaquo;&rsaquo;</a></li>";
} ?>
</ul>
</div>

            </div>

          </div>

 

        </div>

      </div>

    </section>

    <!--RECENT JOB SECTION END--> 

    

    <!--CALL TO ACTION SECTION START-->

    <section class="call-action-section">

      <div class="container">

        <div class="text-box">

        <h2 class="container">اول موقع توظيف في العراق</h2>
          <p>تقدم لك بوابة الوظائف الالكترونية اسهل واسرع لطريقة للحصول على وظيفة</p>

        </div>

        <a href="sign-up.php" class="btn-get">سجل و جرب الان</a> </div>

    </section>

    <!--CALL TO ACTION SECTION END--> 

    



    



  </div>

  <!--MAIN END--> 

  

  <!--FOOTER START-->
<?php include_once('includes/footer.php');?>
  <!--FOOTER END--> 

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

<!--CUSTOM JS--> 

<script src="js/custom.js"></script>

</body>

</html>

