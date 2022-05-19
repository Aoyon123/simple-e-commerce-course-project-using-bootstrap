<?php

include 'header.php';
//include_once('link.php');

?>

<?php

include 'connection.php';

  $id=$_GET['updateid'];
   
  $query2="select tableuser.* , division.name as division_name , district.name as district_name,thana.name as thana_name from tableuser
         left join division on division.id=tableuser.division_id
          left join district on district.id=tableuser.district_id
          left join thana on thana.id=tableuser.thana_id where tableuser.id=".$id;
  
  



//    echo $id;
//    exit;
 
  //$sql="Select * from `tableuser` where id=$id";
  
 
  
  $result=mysqli_query($conn,$query2);

  $row=mysqli_fetch_assoc($result);
  $firstName=$row['firstName'];
  $lastName=$row['lastName'];
  $gender=$row['gender'];
  $address=$row['address'];
  $divId=$row['division_id'];
  $division=$row['division_name'];
  $distId=$row['district_id'];
  $district=$row['district_name'];
  $thanaId=$row['thana_id'];
  $thana=$row['thana_name'];
  $email=$row['email'];
  $password=$row['password'];
  
 // for division
  
 $sql="SELECT * FROM division ORDER BY name ASC";
 $result= mysqli_query($conn, $sql);
  
  
  
  
if(isset($_POST['submit'])){
    $firstName=$_POST['firstName'];
    $lastName=$_POST['lastName'];
    //$gender=$_POST['gender'];
   // $address=$_POST['address'];
    $division=$_POST['division'];
    $district=$_POST['district'];
    $thana=$_POST['thana'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    
//      if (mysqli_num_rows($result) > 0) {      
//        $serial = $start_page;
//        while ($row = mysqli_fetch_assoc($result)) {
//        $divisionSql2="select name from division where id=" .$row['division_id'];
//          $divisionresult2=mysqli_query($conn,$divisionSql2);         
//          $row5= mysqli_fetch_assoc($divisionresult2);
//    }    
//}
    
    $sql2="update `tableuser` set id='$id',firstName='$firstName',lastName='$lastName',division_id='$division',district_id='$district',thana_id='$thana',email='$email',password='$password' where id='$id'";


    $result2=mysqli_query($conn,$sql2);
    
    if($result2){
         header('location:userlist.php');
    }
    else{
        die(mysqli_error($conn));
    }
     
}
?>


<div id="frmRegistration">
<form class="form-horizontal" action="" method="POST">
	<h1>User Registration</h1>
	<div class="form-group">
    <label class="control-label col-sm-2" for="firstName">First Name:</label>
    <div class="col-sm-6">
      <input type="text" name="firstName" class="form-control" id="firstName" placeholder="Enter Firstname" value=<?php echo $firstName; ?>>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="lastName">Last Name:</label>
    <div class="col-sm-6">
      <input type="text" name="lastName" class="form-control" id="lastName" placeholder="Enter Lastname" value=<?php echo $lastName; ?>>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="gender">Gender:</label>
    <div class="col-sm-6">
      <label class="radio-inline"><input type="radio" name="gender" value="Male">Male</label value=<?php echo $gender; ?>>
	  <label class="radio-inline"><input type="radio" name="gender" value="Female">Female</label>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="email">Email:</label>
    <div class="col-sm-6">
      <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" value=<?php echo $email; ?>>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="pwd">Password:</label>
    <div class="col-sm-6"> 
      <input type="password" name="password" class="form-control" id="pwd" placeholder="Enter password" value=<?php echo $password; ?>>
    </div>
  </div>
        
       <label>Division :</label>
        <br>
        <select id="division" name="division" onchange="showDistrict(this.value)">
          <?php if(isset($division)){
              echo '<option value=" '.$divId.'">'.$division.'</option>';
          }
          else{
              echo '<option value="0">Select a division</option>';
          }

            
            
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $divisionId = $row["id"];
                    $division = $row["name"];
                    echo '<option value=" ' . $divisionId . '">' . $division . '</option>';
                }
            }
             
             
            ?>
        </select>    
        <br>
                <label>District :</label>
        <br>
        <select id="district" name="district" onchange="showThana(this.value)">
          <?php if(isset($district)){
              echo '<option value=" '.$distId.'">'.$district.'</option>';
          }
          else{
              echo '<option value="0">Select a district</option>';
          }
          ?>
          </select>
        <br>
                <label>Thana :</label>
        <br>
        <select id="thana" name="thana" >
          <?php if(isset($thana)){
              echo '<option value=" '.$thanaId.'">'.$thana.'</option>';
          }
          else{
              echo '<option value="0">Select a thana</option>';
          }
          ?>
          </select>
  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" name="submit" class="btn btn-primary">Update</button>
    </div>
  </div>
</form>
</div>


<script src="script.js"></script>



<?php
include 'footer.php';
?>