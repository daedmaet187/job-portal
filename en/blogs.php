<?php
session_start();
error_reporting(0);

include('includes/config.php');

if(isset($_POST['submit'])) {

  if(!isset($_POST['title']) || strlen($_POST['title']) == 0) {
    $error = 'Invalid title';
  }elseif(!isset($_POST['content']) || strlen($_POST['content']) == 0) {
    $error = 'Invalid content';
  }elseif(!isset($_SESSION['emplogin']) && !isset($_SESSION['jsid'])) {
    $error = 'Access Denied';
  }

  if(!$error) {
    $query1="INSERT INTO blogs(user_type, user_id, title, content) VALUES(:utype, :uid, :title, :content)";
    $query1 = $dbh -> prepare($query1);
    if(isset($_SESSION['emplogin'])) {
      $userid = $_SESSION['emplogin'];
      $utype = 'emp';
    }
    if(isset($_SESSION['jsid'])) {
      $userid = $_SESSION['jsid'];
      $utype = 'js';
    }
    $query1-> bindParam(':utype', $utype, PDO::PARAM_STR);
    $query1-> bindParam(':uid', $userid, PDO::PARAM_STR);
    $query1-> bindParam(':title', $_POST['title'], PDO::PARAM_STR);
    $query1-> bindParam(':content', $_POST['content'], PDO::PARAM_STR);
    $query1-> bindParam(':content', $_POST['content'], PDO::PARAM_STR);
    $query1->execute();
    $LastInsertId=$dbh->lastInsertId();
    if ($LastInsertId>0) {
      echo '<script>alert("Blog has been posted.")</script>';
      echo "<script>window.location.href ='blogs.php'</script>";
    }else{
      echo '<script>alert("Something Went Wrong. Please try again")</script>';
    }
  }
}
?>
<!doctype html>

<html>

<head>

<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Job Portal || Home Page</title>

<!--CUSTOM CSS-->

<link href="css/custom.css" rel="stylesheet" type="text/css">

<!--BOOTSTRAP CSS-->

<link href="css/bootstrap.css" rel="stylesheet" type="text/css">

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

<!--FAVICON ICON-->

<link rel="icon" href="../files/images/favicon.ico" type="image/x-icon">

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

  <!--MAIN START-->

  <div id="main"> 

    <!--POPULAR JOB CATEGORIES START-->
   

    <!--POPULAR JOB CATEGORIES END--> 

    

    <!--RECENT JOB SECTION START-->

    <section class="recent-row padd-tb">

      <div class="container">

        <div class="row">

          <div class="col-md-12 col-sm-8">

            <div id="content-area">
             
              <?php if(isset($_SESSION['emplogin']) || isset($_SESSION['jsid'])) { ?>
              <div style="margin-bottom: 30px;">
                <form method="post">
                  <?php if(@$error){ ?><div class="errorWrap">
                      <strong>ERROR</strong> : <?php echo htmlentities($error);?></div><?php } ?>
                  <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Title</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" name="title" value="<?php echo isset($_POST['title'])? $_POST['title']: '' ?>">
                  </div>
                  <div class="mb-3" style="margin-top: 10px;">
                    <label for="exampleFormControlTextarea1" class="form-label">Content</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="content"><?php echo isset($_POST['content'])? $_POST['content']: '' ?></textarea>
                  </div>
                  <div style="margin-top: 10px;">
                    <input type="submit" value="Add Blog Post" name="submit" class="btn btn-primary" />
                  </div>
                </form>
              </div>
              <?php } ?>

              <h2 style="color: red">Blogs</h2> 

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
$ret = "SELECT blogs.*,tblemployers.CompnayLogo AS img, tblemployers.CompnayName AS CompnayName, tbljobseekers.FullName AS FullName, tbljobseekers.ProfilePic AS img from blogs left join tblemployers on tblemployers.id=blogs.user_id left join tbljobseekers on tbljobseekers.id=blogs.user_id WHERE blogs.is_active=1 ORDER BY blogs.blog_id DESC";
$query1 = $dbh -> prepare($ret);
$query1->execute();
$results1=$query1->fetchAll(PDO::FETCH_OBJ);
$total_rows=$query1->rowCount();
$total_no_of_pages = ceil($total_rows / $no_of_records_per_page);
  $second_last = $total_no_of_pages - 1; // total page minus 1
  $vid=$_GET['viewid'];
$sql="SELECT blogs.*,tblemployers.CompnayLogo AS img, tblemployers.CompnayName AS CompnayName, tbljobseekers.FullName AS FullName, tbljobseekers.ProfilePic AS img from blogs left join tblemployers on tblemployers.id=blogs.user_id left join tbljobseekers on tbljobseekers.id=blogs.user_id WHERE blogs.is_active=1 ORDER BY blogs.blog_id DESC LIMIT $offset, $no_of_records_per_page";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
  
  <div class="box">

    <?php if($row->img != null){ ?>
    <div class="thumb"><a href="blogpost.php?id=<?php echo ($row->blog_id);?>"><img src="<?php echo $row->user_type == 'emp'? '../files/employers/employerslogo/'.$row->img: '../files/images/'.$row->img; ?>" width="100" height="100"></a></div>
    <?php } ?>

    <div class="text-col">

      <h4><a href="blogpost.php?id=<?php echo ($row->blog_id);?>"><?php  echo htmlentities($row->title);?></a></h4>

      <?php
      $string = strip_tags(htmlentities($row->content));
      if (strlen($string) > 500) {

        // truncate string
        $stringCut = substr($string, 0, 500);
        $endPoint = strrpos($stringCut, ' ');

        //if the string doesn't contain any space then it will cut without word basis.
        $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
        $string .= '... <a href="blogpost.php?id='.$row->blog_id.'">Read More</a>';
      }
      ?>
      <p><?php  echo $string;?></p>

      <p>By <?php  echo $row->user_type == 'emp'? htmlentities($row->CompnayName): htmlentities($row->FullName);?></p>

       <a href="#" class="text"><i class="fa fa-calendar"></i><?php  echo htmlentities($row->date_created);?> </a> </div>


     </div>

</li>

<?php 
$cnt=$cnt+1;
} } else { ?>

<h4> No blog posts yet</h4>


<?php } ?>

              </ul>


            </div>

          </div>

 

        </div>

      </div>

    </section>

    <!--RECENT JOB SECTION END--> 

    

    <!--CALL TO ACTION SECTION START-->

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

