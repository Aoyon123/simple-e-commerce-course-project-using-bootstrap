<?php
include 'header.php';

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SWAPNOLOKE-BOOTSTRAP</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
   
</head>
<body>
    
  
    <section class="h-100 bg-dark">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col">
        <div class="card card-registration my-4">
          <div class="row g-0">
            <div class="col-xl-6 d-none d-xl-block">
              <img src="https://www.inserito.com/wp-content/uploads/2020/08/web-1.png"
                alt="Sample photo" class="img-fluid"
                style="border-top-left-radius: .25rem; border-bottom-left-radius: .25rem;" />
            </div>
            <div class="col-xl-6">
              <div class="card-body p-md-5 text-black">
                <h3 class="mb-5 text-uppercase"> Registration form</h3>
                <form class="form-horizontal" action="registration_insert.php" method="POST">
                <div class="row">
                  <div class="col-md-6 mb-4">
                    <div class="form-outline">
                      <input type="text" id="firstName" name="firstName" class="form-control form-control-lg" />
                      <label class="form-label" for="form3Example1m">First name</label>
                    </div>
                  </div>
                  <div class="col-md-6 mb-4">
                    <div class="form-outline">
                      <input type="text" id="lastName" name="lastName" class="form-control form-control-lg" />
                      <label class="form-label" for="form3Example1n">Last name</label>
                    </div>
                  </div>
                </div>
               
                <!--
                <div class="row">
                  <div class="col-md-6 mb-4">
                    <div class="form-outline">
                      <input type="text" id="form3Example1m1" class="form-control form-control-lg" />
                      <label class="form-label" for="form3Example1m1">Mother's name</label>
                    </div>
                  </div>
                  <div class="col-md-6 mb-4">
                    <div class="form-outline">
                      <input type="text" id="form3Example1n1" class="form-control form-control-lg" />
                      <label class="form-label" for="form3Example1n1">Father's name</label>
                    </div>
                  </div>
                </div>
                
                <div class="form-outline mb-4">
                  <input type="text" id="address" name="address" class="form-control form-control-lg" />
                  <label class="form-label" for="form3Example8">Address</label>
                </div>
                  -->
                <div class="d-md-flex justify-content-start align-items-center mb-4 py-2">

                  <h6 class="mb-0 me-4">Gender: </h6>

                  <div class="form-check form-check-inline mb-0 me-4">
                    <input class="form-check-input" type="radio" name="gender" id="gender"
                      value="option1" />
                    <label class="form-check-label" name="gender" id="gender" for="femaleGender">Female</label>
                  </div>

                  <div class="form-check form-check-inline mb-0 me-4">
                    <input class="form-check-input" type="radio" name="gender" id="gender"
                      value="option2" />
                    <label class="form-check-label" name="gender" id="gender" for="gender">Male</label>
                  </div>

                

                </div>

                <div class="row">
                    <div class="form-group form-outline mb-4">
                <label class="control-label col-sm-2" for="address">Address:</label>
                 <br>
                    <br>
                   <?php  include 'address.php' ?>
                    <div class="col-sm-6">
                 <input type="text" name="address" class="form-control" id="address" placeholder="Enter Address">
                </div>
                      </div>
                </div>

          <div class="form-group form-outline mb-4">
              <tr>
            <label class="control-label col-sm-2" for="lastname">Status</label>
            
            <td><select name="status">
                    <option value="1">Active</option>
                    <option value="2" selected>InActive</option>
              </select>
            
           </tr>
              </div>
                
                <div class=" form-outline mb-4">
                  <input type="text" id="password" name="password" class="form-control form-control-lg" />
                  <label class="form-label" for="form3Example90">Password</label>
                </div>

               

                <div class="form-outline mb-4">
                  <input type="text" id="email" name="email" class="form-control form-control-lg" />
                  <label class="form-label" for="form3Example97">Email</label>
                </div>

                <div class="d-flex justify-content-end pt-3">
                  <button type="button" class="btn btn-light btn-lg">Reset</button>
                  <button type="submit" name="create" class="btn btn-warning btn-lg ms-2">Submit</button>
                </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
    
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> 
    
    
</body>

</html>
<?php
include 'footer.php';
?>