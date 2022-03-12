<?php


session_start();
if(!isset($_SESSION["utype"]) )
{
    include "ASignin.php";
}elseif ( $_SESSION["utype"]!="Admin") {
    header("location:signout.php");
}
elseif ( $_SESSION["utype"]="Admin" && isset($_REQUEST['emailid']) && (isset($_REQUEST['status']) || isset($_REQUEST['delete'])) ) {
    if (isset($_REQUEST['status'])) {
        
        $con=mysqli_connect("localhost","root","","ServiceDb");
        if(mysqli_connect_errno()>0)
        {
            echo mysqli_connect_error();
            exit();
        }
        if ($_REQUEST['status'] == "Active") {
            $status = 'Disabled';
            
        }elseif ($_REQUEST['status'] == "Disabled") {
            $status = 'Active';
        }
        
        $emileid = $_REQUEST['emailid'];
        $query="update user_table set status=? where email_id=?";
        $stmt=$con->prepare($query);
        $stmt->bind_param("ss",$status,$emileid);
        echo 'Status Hi!  '.$query.' ';
        $stmt->execute();
        $stmt->store_result();
        
        $con->close();
        header('location:user.php?emailid='.$emileid);
    }
    if (isset($_REQUEST['delete']) && $_REQUEST['delete'] == 'delete') {
        $con=mysqli_connect("localhost","root","","ServiceDb");
        if(mysqli_connect_errno()>0)
        {
            echo mysqli_connect_error();
            exit();
        }
        $emileid = $_REQUEST['emailid'];
        $query="delete from user_table where email_id=?";
        $stmt=$con->prepare($query);
        $stmt->bind_param("s",$emileid);
        $stmt->execute();
        $stmt->store_result();
        if($stmt->affected_rows>0)
        {
        $msg="Account Deleted...";
        }
        else
        {
        $msg="Account not Deleted...";
       
            //	die(mysqli_error($con));
        }
        
        $con->close();
        header("location:admin.php");
    }
    
}else {
    header("location:index.php");
}

?>
