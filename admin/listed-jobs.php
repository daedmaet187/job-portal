<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['jpaid']==0)) {
  header('location:logout.php');
  } else{


    if(isset($_GET['delid']))
    {
    $rid=intval($_GET['delid']);
    $sql="delete from tbljobs where jobId=:rid";
    $query=$dbh->prepare($sql);
    $query->bindParam(':rid',$rid,PDO::PARAM_STR);
    $query->execute();
        echo "<script>alert('Job deleted');</script>"; 
        echo "<script>window.location.href = 'listed-jobs.php'</script>";     


    }

    if(isset($_GET['id']) && isset($_GET['action']))
    {
        $rid=intval($_GET['id']);
        $active=intval($_GET['action']);
        $sql="UPDATE tbljobs SET isActive=:active where jobId=:rid";
        $query=$dbh->prepare($sql);
        $query->bindParam(':rid',$rid,PDO::PARAM_STR);
        $query->bindParam(':active',$active,PDO::PARAM_STR);
        $query->execute();
        if($active == 1) {
            echo "<script>alert('Job Activated');</script>"; 
        }else{
            echo "<script>alert('Job Deactivated');</script>"; 
        }
        echo "<script>window.location.href = 'listed-jobs.php'</script>";
    }
  ?>
<!doctype html>
<html lang="en" class="no-focus"> <!--<![endif]-->
    <head>
        <title>Job Portal - Listed Jobs</title>

        <link rel="stylesheet" href="assets/js/plugins/datatables/dataTables.bootstrap4.min.css">

        <link rel="stylesheet" id="css-main" href="assets/css/codebase.min.css">

    </head>
    <body>
        
        <div id="page-container" class="sidebar-o sidebar-inverse side-scroll page-header-fixed main-content-narrow">
           
           <?php include_once('includes/sidebar.php');?>

          <?php include_once('includes/header.php');?>


            <!-- Main Container -->
            <main id="main-container">
                <!-- Page Content -->
                <div class="content">
                    <h2 class="content-heading">Listed Jobs</h2>

                   

                    <!-- Dynamic Table Full Pagination -->
                    <div class="block">
                        <div class="block-header bg-gd-emerald">
                                    <h3 class="block-title">Listed Jobs</h3>
                                  
                                </div>
                        <div class="block-content block-content-full">
                            <!-- DataTables init on table by adding .js-dataTable-full-pagination class, functionality initialized in js/pages/be_tables_datatables.js -->
                            <table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
                                <thead>
                                    <tr>
                                        <th class="text-center"></th>
                                        <th>Job Title</th>
                                        <th>Job Category</th>
                                       <th>Type</th>
                                       <th>Pacakge</th>
                                        <th>Skill Required</th>
                                         <th class="d-none d-sm-table-cell" style="width: 15%;">Job Location</th>
                                        <th class="d-none d-sm-table-cell">Posting Date</th>
                                        <th>ACTION</th>
                                       
                                       </tr>
                                </thead>
                                <tbody>
                                    <?php
$sql="SELECT * from tbljobs ORDER BY tbljobs.isActive, tbljobs.jobId DESC";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
                                    <tr>
                                        <td class="text-center"><?php echo htmlentities($cnt);?></td>
                                        <td class="font-w600"><?php  echo htmlentities($row->jobTitle);?></td>
                                        <td class="font-w600"><?php  echo htmlentities($row->jobCategory);?></td>
                                        <td class="font-w600"><?php  echo htmlentities($row->jobType);?></td>
                                        <td class="font-w600"><?php  echo htmlentities($row->salaryPackage);?></td>
                                        <td class="font-w600"><?php  echo htmlentities($row->skillsRequired);?></td>

                                        <?php $locsArray = array('', 'Baghdad', 'al-Anbar', 'Babil', 'Basrah', 'Duhuk', 'Dhi Qar', 'Diyala', 'Erbil',  'Karbala', 'Kirkuk', 'Maisan', 'al-Muthanna', 'Najaf', 'Ninawa', 'al-Qadisiya', 'Salah ad-Din', 'as-Sulaimaniya', 'Wasit') ?>
                                        <td class="font-w600"><?php  echo $locsArray[$row->jobLocation];?></td>
                                        <td class="font-w600"><?php  echo htmlentities($row->postinDate);?></td>
                                        <td class="d-none d-sm-table-cell"><a href="listed-jobs.php?action=<?php echo $row->isActive == 1? '0': '1' ?>&id=<?php echo $row->jobId ?>"><?php echo $row->isActive == 1? 'Deactivate': 'Activate' ?></a> | <a href="listed-jobs.php?delid=<?php echo ($row->jobId);?>" onclick="return confirm('Do you really want to Delete ?');"><i class="fa fa-trash fa-delete" aria-hidden="true"></i></a></td>
                              
                                      
                                    </tr>
                                    <?php $cnt=$cnt+1;}} ?> 
                                
                                
                                  
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END Dynamic Table Full Pagination -->

                    <!-- END Dynamic Table Simple -->
                </div>
                <!-- END Page Content -->
            </main>
            <!-- END Main Container -->

           <?php include_once('includes/footer.php');?>
        </div>
        <!-- END Page Container -->

        <!-- Codebase Core JS -->
        <script src="assets/js/core/jquery.min.js"></script>
        <script src="assets/js/core/popper.min.js"></script>
        <script src="assets/js/core/bootstrap.min.js"></script>
        <script src="assets/js/core/jquery.slimscroll.min.js"></script>
        <script src="assets/js/core/jquery.scrollLock.min.js"></script>
        <script src="assets/js/core/jquery.appear.min.js"></script>
        <script src="assets/js/core/jquery.countTo.min.js"></script>
        <script src="assets/js/core/js.cookie.min.js"></script>
        <script src="assets/js/codebase.js"></script>

        <!-- Page JS Plugins -->
        <script src="assets/js/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="assets/js/plugins/datatables/dataTables.bootstrap4.min.js"></script>

        <!-- Page JS Code -->
        <script src="assets/js/pages/be_tables_datatables.js"></script>
    </body>
</html>
<?php }  ?>