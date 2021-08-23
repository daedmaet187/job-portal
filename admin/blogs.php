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
    $sql="delete from blogs where blog_id=:rid";
    $query=$dbh->prepare($sql);
    $query->bindParam(':rid',$rid,PDO::PARAM_STR);
    $query->execute();
        echo "<script>alert('Blog post deleted');</script>"; 
        echo "<script>window.location.href = 'blogs.php'</script>";     


    }

    if(isset($_GET['id']) && isset($_GET['action']))
    {
        $rid=intval($_GET['id']);
        $active=intval($_GET['action']);
        $sql="UPDATE blogs SET is_active=:active where blog_id=:rid";
        $query=$dbh->prepare($sql);
        $query->bindParam(':rid',$rid,PDO::PARAM_STR);
        $query->bindParam(':active',$active,PDO::PARAM_STR);
        $query->execute();
        if($active == 1) {
            echo "<script>alert('Blog post Activated');</script>"; 
        }else{
            echo "<script>alert('Blog post Deactivated');</script>"; 
        }
        echo "<script>window.location.href = 'blogs.php'</script>";
    }
  ?>
<!doctype html>
<html lang="en" class="no-focus"> <!--<![endif]-->
    <head>
        <title>Job Portal - Blogs</title>

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
                    <h2 class="content-heading">Blogs</h2>

                   

                    <!-- Dynamic Table Full Pagination -->
                    <div class="block">
                        <div class="block-header bg-gd-emerald">
                                    <h3 class="block-title">Blogs</h3>
                                  
                                </div>
                        <div class="block-content block-content-full">
                            <!-- DataTables init on table by adding .js-dataTable-full-pagination class, functionality initialized in js/pages/be_tables_datatables.js -->
                            <table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
                                <thead>
                                    <tr>
                                        <th class="text-center"></th>
                                        <th>Blog Title</th>
                                        <th>Blog Content</th>
                                        <th>Posted by</th>
                                        <th class="d-none d-sm-table-cell">Posting Date</th>
                                        <th>ACTION</th>
                                       
                                       </tr>
                                </thead>
                                <tbody>
                                    <?php
$sql="SELECT blogs.*,tblemployers.CompnayLogo AS img, tblemployers.CompnayName AS CompnayName, tbljobseekers.FullName AS FullName, tbljobseekers.ProfilePic AS img from blogs left join tblemployers on tblemployers.id=blogs.user_id left join tbljobseekers on tbljobseekers.id=blogs.user_id ORDER BY blogs.is_active, blogs.blog_id DESC";
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
                                        <td class="font-w600"><?php  echo htmlentities($row->title);?></td>
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
                                        <td class="font-w600" style="max-width: 300px"><?php  echo $string;?></td>
                                        <td class="font-w600"><?php  echo $row->user_type == 'emp'? htmlentities($row->CompnayName): htmlentities($row->FullName);?></td>
                                        <td class="font-w600"><?php  echo htmlentities($row->date_created);?></td>
                                        <td class="d-none d-sm-table-cell"><a href="blogs.php?action=<?php echo $row->is_active == 1? '0': '1' ?>&id=<?php echo $row->blog_id ?>"><?php echo $row->is_active == 1? 'Deactivate': 'Activate' ?></a> | <a href="blogs.php?delid=<?php echo ($row->blog_id);?>" onclick="return confirm('Do you really want to Delete ?');"><i class="fa fa-trash fa-delete" aria-hidden="true"></i></a></td>
                              
                                      
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