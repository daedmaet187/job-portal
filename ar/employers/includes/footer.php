 <footer id="footer">
<?php
//Getting Employer Id
$empid=$_SESSION['emplogin'];
// Fetching jobs
$sql = "SELECT * from  tblemployers  where id=:eid";
$query = $dbh -> prepare($sql);
$query-> bindParam(':eid', $empid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
{


 ?>
    <div class="text-box box">&nbsp;</div>
    <div class="text-box box">

      <h4><?php echo htmlentities($result->CompnayName)?></h4>

      <p><?php echo htmlentities($result->CompanyTagline)?>.</p>
      <p>موقع إلكتروني: <?php echo htmlentities($result->CompanyUrl)?></p>
<p>العنوان: <?php echo htmlentities($result->lcation)?></p>
    </div>

    <div class="box">

      <h4>شعار الشركة</h4>

      <img src="../../files/employers/employerslogo/<?php echo htmlentities($result->CompnayLogo)?>" width="100" height="100">

    </div>

     <div class="box">
     <!--<img src="employerslogo/uoitc.png" width="150" height="150">-->
     
    </div>
<?php 
}}
?>
    <div class="container">

      <div class="bottom-row"> <strong class="copyrights">بوابة الوظائف; 2021</strong>

        <div class="footer-social">

          <ul>

            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>

            <li><a href="#"><i class="fa fa-twitter"></i></a></li>

            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>

            <li><a href="#"><i class="fa fa-facebook-f"></i></a></li>

          </ul>

        </div>

      </div>

    </div>

  </footer>
