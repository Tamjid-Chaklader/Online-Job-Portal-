<?php

 include_once('../config.php');
// Data retreived  begins here
$email=$_POST['useremail'];
//echo $email;
$password=$_POST['pass1'];
$hash = password_hash($password, PASSWORD_DEFAULT);
//echo $password;
$name=$_POST['uname'];
$mobile=$_POST['mobno'];
$experience=$_POST['experience'];
$skills=$_POST['skills'];
$ug=$_POST['ugcourse'];
$pg=$_POST['pgcourse'];
$countryid=$_POST['country'];
$stateid=$_POST['state'];
$cityid=$_POST['city'];
$location="";
$type="jobseeker";
// data retreived ends here

// now wants to fetch data from location db

mysqli_select_db($db2,"location");
$query1=mysqli_query($db2,"select name from countries WHERE id = '$countryid'")  or die("Wrong Query");
$row = mysqli_fetch_assoc($query1);
$country= $row['name'];

$query2=mysqli_query($db2,"select name from states WHERE id = '$stateid'")  or die("Wrong Query");
$row = mysqli_fetch_assoc($query2);
$state= $row['name'];
//echo $state;

$query3=mysqli_query($db2,"select name from cities WHERE id = '$cityid'")  or die("Wrong Query");
$row = mysqli_fetch_assoc($query3);
$city= $row['name'];
//echo $city;
$location=$country.",".$state.",".$city;
//echo $location;
mysqli_close($db2);
mysqli_select_db($db1,"jobportal");

$query4="INSERT INTO login (email,password,usertype,status) VALUES ('$email','$hash','$type',1)";
    $result1 = mysqli_query($db1,$query4) or die("Cant Register , The user email may be already existing");
$query5 =  "INSERT INTO jobseeker (log_id,name,phone,location,experience,skills,basic_edu,master_edu)
                VALUES ((SELECT log_id FROM login WHERE email='$email'),'$name','$mobile','$location','$experience','$skills','$ug','$pg')";

 //$result2 = mysqli_query($db1,$query5);
if (!mysqli_query($db1,$query5))
{
 echo("Error description: " . mysqli_error($db1));
}
else{
    header('location:login.php?msg=registered');
}

?>