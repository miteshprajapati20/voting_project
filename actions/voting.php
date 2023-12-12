<?php
session_start();
include("connection.php");

$votes = $_POST['groupvotes'];
$totalvotes = $votes+1;
$gid = $_POST['groupid'];
$uid = $_SESSION['id'];

//update the votes 

$updatevotes = mysqli_query($con," update `userdata` set votes='$totalvotes' where id='$gid'");

$updatestatus = mysqli_query($con," update `userdata` set status=1 where id='$uid'");

if($updatevotes && $updatestatus){

    $getGroups = mysqli_query($con,"select username,photo,votes,id from `userdata` where standard = 'group'  ");

    $groups = mysqli_fetch_all($getGroups, MYSQLI_ASSOC);   

    $_SESSION['groups'] = $groups;
    $_SESSION['status'] = 1;

    echo '
    <script>
    alert("Voting successfull");
    window.location = "../partials/dashboard.php";
    </script>
    ';

}
else{
    echo '
    <script>
    alert("Technical Error ! Vote after sometime");
    window.location = "../partials/dashboard.php";
    </script>
    ';
}


?>

    
</body>
</html>