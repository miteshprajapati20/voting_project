<?php
    session_start();
    include("connection.php");

    $mobile = $_POST['mobile'];
    $password = $_POST['password'];
    $std = $_POST['std'];

    $check = mysqli_query($con, "select * from userdata where mobile='$mobile' and password='$password' and standard='$std' ");

    if(mysqli_num_rows($check)>0){
        $getGroups = mysqli_query($con, "select username, photo, votes, id from userdata where standard='group' ");
        if(mysqli_num_rows($getGroups)>0){
            $groups = mysqli_fetch_all($getGroups, MYSQLI_ASSOC);
            $_SESSION['groups'] = $groups;
        }
        $data = mysqli_fetch_array($check);
        $_SESSION['id'] = $data['id'];
        $_SESSION['status'] = $data['status'];
        $_SESSION['data'] = $data;
        echo '<script>
                window.location = "../partials/dashboard.php";
            </script>';
    }
    else{
        echo '<script>
        window.location = "../";
        alert("Invalid credentials!");
        </script>';
    }
    
?>

