<?php
session_start();
//Database Configuration File
include('includes/config.php');
error_reporting(0);
//verifying Session
if(strlen($_SESSION['emplogin'])==0)
  { 
header('location:emp-login.php');
}
else{

//Genrating CSRF Token
if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}

if(isset($_POST['submit']))
{

//Verifying CSRF Token
if (!empty($_POST['csrftoken'])) {
if (hash_equals($_SESSION['token'], $_POST['csrftoken'])) {
 
  $loggedIn = false;

  // Getting username/ email and password
  $uname=$_SESSION['emplogin'];
  // Fetch data from database on the basis of username/email and password
  $sql ="SELECT id,Is_Active FROM tblemployers WHERE (id=:usname )";
  $query= $dbh -> prepare($sql);
  $query-> bindParam(':usname', $uname, PDO::PARAM_STR);
  $query-> execute();
  $results=$query->fetchAll(PDO::FETCH_OBJ);
  if($query->rowCount() > 0)
  {
    foreach ($results as $row) {
      $loggedIn = $row->Is_Active == 1? true: false;
    }
  }
  //if username or email not found in database
  else{
    echo "<script>alert('لم يتم العثور على حساب مسجل'');</script>";
  }

  if($loggedIn == true) {
    $empid=$_SESSION['emplogin'];  
    //Getting Post Values
    $category=$_POST['category'];  
    $jontitle=$_POST['jobtitle']; 
    $jobtype=$_POST['jobtype']; 
    $salpackg=$_POST['salarypackage'];
    $skills=$_POST['skills'];
    $exprnce=$_POST['experience'];
    $joblocation=$_POST['joblocation'];
    $jobdesc=$_POST['description'];
    $jed=$_POST['jed'];
    $isactive=0;
    
    
    
    $sql="INSERT INTO tbljobs(employerId,jobCategory,jobTitle,jobType,salaryPackage,skillsRequired,experience,jobLocation,jobDescription,JobExpdate,isActive) VALUES(:empid,:category,:jontitle,:jobtype,:salpackg,:skills,:exprnce,:joblocation,:jobdesc,:jed,:isactive)";
    $query = $dbh->prepare($sql);
    // Binding Post Values
    $query->bindParam(':empid',$empid,PDO::PARAM_STR);
    $query->bindParam(':category',$category,PDO::PARAM_STR);
    $query->bindParam(':jontitle',$jontitle,PDO::PARAM_STR);
    $query->bindParam(':jobtype',$jobtype,PDO::PARAM_STR);
    $query->bindParam(':salpackg',$salpackg,PDO::PARAM_STR);
    $query->bindParam(':skills',$skills,PDO::PARAM_STR);
    $query->bindParam(':exprnce',$exprnce,PDO::PARAM_STR);
    $query->bindParam(':joblocation',$joblocation,PDO::PARAM_STR);
    $query->bindParam(':jobdesc',$jobdesc,PDO::PARAM_STR);
    $query->bindParam(':jed',$jed,PDO::PARAM_STR);
    $query->bindParam(':isactive',$isactive,PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    if($lastInsertId)
    {
    $msg="تم نشر الوظيفة بنجاح";
    unset( $_SESSION['token']);
    }
    else 
    {
    $error="حدث خطأ، يرجى اعادة المحاولة";
    }
  }else{
    $error="حسابك غير مفعل";
  }


}}}

?>

<!doctype html>
<html lang="ar" dir="rtl">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>الشركات | نشر وظيفة</title>
<link href="../css/custom.css" rel="stylesheet" type="text/css">
<link href="../css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="../css/bootstrap-rtl.css" rel="stylesheet" type="text/css">
<link href="../css/color.css" rel="stylesheet" type="text/css">
<link href="../css/responsive.css" rel="stylesheet" type="text/css">
<link href="../css/owl.carousel.css" rel="stylesheet" type="text/css">
<link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="../css/editor.css" type="text/css" rel="stylesheet"/>
<link href="../css/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css">
<link href='https://fonts.googleapis.com/css?family=Roboto:400,300,300italic,500,700,900' rel='stylesheet' type='text/css'>


<body class="theme-style-1">
<div id="wrapper"> 
<!--HEADER START-->
 <?php include('includes/header.php');?>
<!--HEADER END--> 

  
  <!--INNER BANNER START-->
  <section id="inner-banner">

    <div class="container">

      <h1>الشركات | نشر وظيفة</h1>

    </div>

  </section>

  <!--INNER BANNER END--> 

  

  <!--MAIN START-->

  <div id="main">
    <!--Signup FORM START-->
    <form name="empsignup" enctype="multipart/form-data" method="post">
<input type="hidden" name="csrftoken" value="<?php echo htmlentities($_SESSION['token']); ?>" /> 
 

    <section class="resum-form padd-tb">

      <div class="container">
    <!--Success and error message -->
     <?php if(@$error){ ?><div class="errorWrap">
        <strong>خطأ</strong> : <?php echo htmlentities($error);?></div><?php } ?>

        <?php if(@$msg){ ?><div class="succMsg">
        <strong>نجحت العملية</strong> : <?php echo htmlentities($msg);?></div><?php } ?>

<div class="row">
<div class="col-md-6 col-sm-6" >
<label>التصنيف*</label>
  <div class="selector">
       <select name='category' class="full-width">
  <?php 
$sqlt = "SELECT CategoryName FROM tblcategory order by CategoryName asc";
$queryt = $dbh -> prepare($sqlt);
$queryt -> execute();
$results = $queryt -> fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($queryt -> rowCount() > 0)
{
foreach($results as $result)
{?>
<option value="<?php echo htmlentities($result->CategoryName);?>"><?php echo htmlentities($result->CategoryName);?></option>
 <?php  }} ?>
              
</select>
</div>
</div>

<div class="col-md-6 col-sm-6">
<label>عنوان الوظيفة*</label>
<input type="text" name="jobtitle" required placeholder="e.g. Full Stack Developer" autocomplete="off">
</div>
</div>
      
<div class="row">
  <div class="col-md-6 col-sm-6">
 <label>نوع الوظيفة</label>

              <div class="selector">

                <select class="full-width" name="jobtype">
                  <option value="Full Time">دوام كامل</option>
                  <option value="Part Time">دوام جزئي</option>
                  <option value="Half Time">دوام نصفي</option>
                  <option value="Freelance">عمل حر</option>
                  <option value="Contract">عقد</option>
                  <option value="Internship">تدريب</option>
                  <option value="Temporary">مؤقت</option>
                </select>

              </div>

            </div>

          <div class="col-md-6 col-sm-6">

              <label>مقدار الراتب</label>
<input type="text" placeholder="500000 - 750000" name="salarypackage" required>

            </div>
            </div>


<div class="row">

<div class="col-md-6 col-sm-6">
<label>المهارة المطلوبة</label>
<input type="text" placeholder="e.g. PHP, MySQL, HTML, CSS" name="skills" required>
</div>

<div class="col-md-6 col-sm-6">
<label>الخبرة</label>
<input type="text" placeholder="e.g. 0-5" name="experience" required>
</div>

</div>


<div class="row">

<div class="col-md-6 col-sm-6">
<label>موقع الوظيفة</label>
<div class="selector">
  <select class="full-width" name="joblocation">
    <option value="1">بغداد</option>
    <option value="2">الأنبار</option>
    <option value="3">بابل</option>
    <option value="4">البصرة</option>
    <option value="5">دهوك</option>
    <option value="6">ذي قار</option>
    <option value="7">ديالى</option>
    <option value="8">أربيل</option>
    <option value="9">كربلاء</option>
    <option value="10">كركوك</option>
    <option value="11">ميسان</option>
    <option value="12">المثنى</option>
    <option value="13">النجف</option>
    <option value="14">نينوى</option>
    <option value="15">القادسية</option>
    <option value="16">صلاح الدين</option>
    <option value="17">السليمانية</option>
    <option value="18">واسط</option>
  </select>
</div>

</div>
<div class="col-md-6 col-sm-6">
<label>تاريخ انتهاء التقديم</label>
<input type="date" placeholder="e.g. 0-5" name="jed" required class="form-control">
</div>
</div>


<div class="row">
 <div class="col-md-12">
<h4>وصف الوظيفة</h4>
<div class="text-editor-box">
<textarea  name="description" required></textarea>
</div>
</div>
</div>

            <div class="col-md-12">

              <div class="btn-col">

                <input type="submit" name="submit" value="نشر">

              </div>

            </div>

          </div>

    

      </div>

    </section>
    </form>
    <!--RESUME FORM END--> 

  </div>

  <!--MAIN END--> 

  

  <!--FOOTER START-->

  <?php include('includes/footer.php');?>
  <!--FOOTER END--> 

</div>


<script src="../js/jquery-1.11.3.min.js"></script> 
<script src="../js/bootstrap.min.js"></script> 
<script src="../js/owl.carousel.min.js"></script> 
<script src="../js/jquery.velocity.min.js"></script> 
<script src="../js/jquery.kenburnsy.js"></script> 
<script src="../js/jquery.mCustomScrollbar.concat.min.js"></script> 
<script src="../js/editor.js"></script> 
<script src="../js/jquery.accordion.js"></script> 
<script src="../js/jquery.noconflict.js"></script> 
<script src="../js/theme-scripts.js"></script> 
<script src="../js/custom.js"></script>

</body>

</html>
<?php } ?>

