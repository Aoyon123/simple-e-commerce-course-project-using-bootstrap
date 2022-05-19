<?php
include 'header.php';
include 'connection.php';
?>


<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <body class="container-fluid p-0">

        <?php
        $records = mysqli_query($conn, "SELECT count(*) FROM tableuser ORDER BY id ASC");
        $row_db = mysqli_fetch_row($records);
        $total_records = $row_db[0];
        ?>
        

        <div class="">
            <table class="table table-bordered table-striped mt-4">
                <tr>
                    <td><h1>Total Number of Records </h1></td>
                    <td><h1><?php echo $total_records; ?></h1></td>
                </tr>
            </table>
            <div class="">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">SL No</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Gender</th>
                         <th scope="col">Address</th>
                       
                        <th scope="col">Email</th>
                        <th scope="col">Password</th>
                        <th scope="col">Operation</th>
                       
                    </tr>
                </thead>
                <tbody>


                    <?php
                    // for get the current page number
                    if (isset($_GET["page"])) {
                        $page = $_GET["page"];
                    } else {
                        $page = 1;
                    }

                    $get_page_decrement = $page - 1;
                    $get_page_increment = $page + 1;



                    $numberOfRecordsPerPage = !empty($_GET['page_limit']) ? $_GET['page_limit'] : 3;

                    if (isset($_POST['limit_submit'])) {
                        $numberOfRecordsPerPage = $_POST['choice'];
                    }

                    $start_page = ($page - 1) * $numberOfRecordsPerPage;
                    $offsetStr = !empty($start_page) ? ' offset ' . $start_page : '';

                    $query = "SELECT * FROM tableuser ORDER BY id ASC LIMIT " . $numberOfRecordsPerPage . $offsetStr;

                    $result = mysqli_query($conn, $query);

                    if (mysqli_num_rows($result) > 0) {
                        $serial = $start_page;
                        while ($row = mysqli_fetch_assoc($result)) {
                        
                            
                            
                            
                            
                            
                            
                            $divisionSql = "select name from division where id=" . $row['division_id'];
                            $divisionresult = mysqli_query($conn, $divisionSql);
                            $row2 = mysqli_fetch_assoc($divisionresult);
                            
                            if($row['division_id']==0){
                                $division="No Division";
                            }
                            else{
                                $division= $row2['name'];
                            }
                            
                            
                            

                            $districtSql = "select name from district where id=" . $row['district_id'];
                            $districtresult = mysqli_query($conn, $districtSql);
                            $row3 = mysqli_fetch_assoc($districtresult);
                            
                            if($row['district_id']==0){
                                $district="No District";
                            }
                            else{
                                $district= $row3['name'];
                            }

                            $thanaSql = "select name from thana where id=" . $row['thana_id'];
                            $thanaresult = mysqli_query($conn, $thanaSql);
                            $row4 = mysqli_fetch_assoc($thanaresult);
                            
                            
                            if($row['thana_id']==0){
                                $thana="No Thana";
                            }
                            else{
                                $thana= $row4['name'];
                            }

                            
                            
                            
                            $id = $row['id'];
                            $firstName = $row['firstName'];
                            $lastName = $row['lastName'];
                            $gender = $row['gender'];
                            $address = $row['address'];
                       
                      
                            $email = $row['email'];
                            $password = $row['password'];
                            $status = $row['status'];
                            echo ' <tr>
                  <th scope="row">' . ++$serial . '</th>
        <td>' . $firstName . '</td>
        <td>' . $lastName . '</td>
        <td>' . $gender . '</td>  
       <td> 
     <button onclick="showAddress('. $id .')" type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">
      View Address
     </button>
       </td> 

        
        <td>' . $email . '</td>
        <td>' . $password . '</td>
       
        <td>
        <button class="btn btn-warning"><a href="update.php?updateid=' . $row['id'] . '" class="text-light">Update</a></button>
        <button class="btn btn-dark"><a href="delete.php?deleteid=' . $row['id'] . '" class="text-light">Delete</a></button>
       </td>
      </tr>';
                        }
                    }
                    ?>

                </tbody>
            </table>
            </div>

            <div class="pagination-drop d-flex gy-5">

                <div class="pageLink"> 
                    <?php
                    $total_pages = ceil($total_records / $numberOfRecordsPerPage);
                    //($pageno%3==0) ? $x :

                    $y2 = ceil($page / 3) * 3;
                    $xy = $page / 3;

                    $xyP = ($page % 3 == 0) ? ($xy - 1) : floor($xy);

                    $x = ((empty($page)) || ($page > 0 && $page <= 3)) ? 1 : (($xyP * 3) + 1);


                    $y = (empty($page) || ($page > 0 && $page <= 3)) ? ($total_pages < 3 ? $total_pages : 3) : ($total_pages < $y2 ? $total_pages : $y2);

                    echo $x > 1 ? '<a href="userlist.php?page=1&numberOfRecordsPerPage=' . $numberOfRecordsPerPage . '"><button class="class="btn btn-success">Fast-Backword</button></a>' : '';

                    echo $x > 1 ? '<a href="userlist.php?page=' . ($x - 1) . '&numberOfRecordsPerPage=' . $numberOfRecordsPerPage . '"><button class="btn btn-success">Prev</button></a>' : '';

                    for ($i = $x; $i <= $y; $i++) {
                        echo '<a class="pageLink page-item" href="userlist.php?page=' . $i . '&numberOfRecordsPerPage=' . $numberOfRecordsPerPage . '"><button class="btn btn-success">' . $i . '</button></a>';
                    }

                    echo $y < $total_pages ? '<a  href="userlist.php?page=' . ($y + 1) . '&numberOfRecordsPerPage= ' . $numberOfRecordsPerPage . '"><button class="btn btn-success">Next</button></a>' : '';

                    echo $y < $total_pages ? '<a href="userlist.php?page=' . ($total_pages) . '&numberOfRecordsPerPage= ' . $numberOfRecordsPerPage . '"><button class="btn btn-success">Fast-Forward</button></a>' : '';
                    ?>

                </div>


                <div class="option-select">
                    <form method="post" action="">
                        <select class=""  name="choice">
                            <option selected>Select Option...</option>   
                            <option <?php
                            if ($numberOfRecordsPerPage == 3) {
                                echo 'selected';
                            }
                            ?> value="3">3</option>
                            <option <?php
                            if ($numberOfRecordsPerPage == 6) {
                                echo 'selected';
                            }
                            ?> value="6">6</option>
                            <option <?php
                            if ($numberOfRecordsPerPage == 9) {
                                echo 'selected';
                            }
                            ?> value="9">9</option>
                        </select>

                        <button class="limit_submit_design btn btn-secondary" name="limit_submit" type="submit" >select option</button>
                    </form> 
                </div>  
            </div>
        </div>
<!--    <style>
        .pageLink{
            display:flex;
        }
        .pagelink{
            display: flex;
        }
        .pagination-drop{
            display: flex;
        }
        .option-select{
            margin-left: 90px;
        }
        .limit_submit_design{
            background-color: brown;
            font-weight: 20px;
            border-radius: 5px;

        }
    </style> -->
        
   <!---- Modal ---->
   
   
   <div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Address</h4>
          
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            <p id="modal_address"></p>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>
   <div>
  
</div> 
 <script>
     
     
    function showAddress(id) {
        
         console.log(id);
        if (id == "") {
           
            return false;
        }
       var xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function () {

            if (this.readyState == 4 && this.status == 200) {

                document.getElementById("modal_address").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "getaddress.php?id="+id, true);
        xhttp.send();
    }  
     
     
     
     
     
  </script>
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   <!---- Modal Closed ----->
        
   
       

</body>

</html>

<?php
  include 'footer.php';
  ?>


