<?php
session_start();
?>

<?php

include('connection.php');

$mysql_hostname = "localhost";
$mysql_user = "root";
$mysql_password = "root";
$mysql_database = "Database";
$prefix = "";

$conn = new mysqli($mysql_hostname, $mysql_user, $mysql_password, $mysql_database);
$id=$_SESSION['SESS_MEMBER_ID'];
$sql = "SELECT * FROM profiles where mem_id='$id'";
//$statement = $conn -> prepare($sql);
//$statement->execute();
//$r = $statement->fetch();

$result = mysqli_query($bd, $sql);

if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
        $fname = $row['fname'];
        $lname = $row['lname'];
        $email = $row['email'];
        $type = $row['typeof'];
        $image = $row['profile_img'];
    };
};

//$fname = $_SESSION['fname'];
//$lname = $_SESSION['lname'];
//$email = $_SESSION['email'];
//$type = $_SESSION['typeof'];
//$image = $_SESSION['profile_img'];



//$result = $conn->query("SELECT profile_img FROM profiles WHERE id = $id");
//
//if($result->num_rows > 0) {
//    $imgData = $result->fetch_assoc();
//
//    //Render image
//    header("Content-type: image/jpg");
//    $image = $imgData['image'];
//}
include "header.php";

if (isset($_SESSION['SESS_MEMBER_ID'])) {
?>


<html lang="en">

    <div class="page-header header">
      <h1>My Profile</h1>
    </div>

    <br>
    <div class="row">
      <div class="profile-left white">
        <img class="rounded-circle profile-picture" src="getimage.php?id=<?php echo $id; ?>" alt="Tavish Profile Image" width="140" height="140">
        <h2><?php echo $fname; ?> <?php echo $lname; ?></h2>
        <p><?php echo $email; ?></p>
        <p><a class="btn btn-secondary" href="edit_profile.php?id=<?php echo $id; ?>" role="button">Edit Profile &raquo;</a></p>
      </div>

      <div class="profile-right">
        <div class="nav-scroller py-1 mb-2">
        <nav class="nav d-flex">
          <a class="p-2 text-muted" style="margin-left:8px;"" href="#">Bio</a>
          <a class="p-2 text-muted" href="#">Projects</a>
          <a class="p-2 text-muted" href="#">Recent Activity</a>
        </nav>
      </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery.min.js"><\/script>')</script>
    <script src="js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>

    <?php

} else {
    ?>
    <html>
    <style>
        .example1 {
            height: 80%;
            overflow: hidden;
            position: relative;
            top: 100px;
        }
        .example1 h3 {
            font-size: 8em;
            font-family: Impact;
            color: white;
            position: absolute;
            width: 100%;
            height: 100%;
            margin: 0;
            line-height: 100px;
            text-align: center;
            /* Starting position */
            -moz-transform:translateX(100%);
            -webkit-transform:translateX(100%);
            transform:translateX(100%);
            /* Apply animation to this element */
            -moz-animation: example1 5s linear infinite;
            -webkit-animation: example1 5s linear infinite;
            animation: example1 5s linear infinite;
        }
        /* Move it (define the animation) */
        @-moz-keyframes example1 {
            0%   { -moz-transform: translateX(100%); }
            100% { -moz-transform: translateX(-100%); }
        }
        @-webkit-keyframes example1 {
            0%   { -webkit-transform: translateX(100%); }
            100% { -webkit-transform: translateX(-100%); }
        }
        @keyframes example1 {
            0%   {
                -moz-transform: translateX(100%); /* Firefox bug fix */
                -webkit-transform: translateX(100%); /* Firefox bug fix */
                transform: translateX(100%);
            }
            100% {
                -moz-transform: translateX(-100%); /* Firefox bug fix */
                -webkit-transform: translateX(-100%); /* Firefox bug fix */
                transform: translateX(-100%);
            }
        }
    </style>
    <body>
    <div class = 'example1'>
    <h3>YOU ARE NOT LOGGED IN                      YOU ARE NOT LOGGED IN YOU ARE NOT LOGGED IN YOU ARE NOT LOGGED IN</h3>
    </div>
    </body>
    </html>
    <?php
}



