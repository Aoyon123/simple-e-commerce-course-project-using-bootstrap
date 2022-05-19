
<!DOCTYPE html>
<?php
$conn = mysqli_connect("localhost", "root", "", "crud18");

if (!$conn) {
    echo "Database Connection Failed";
}

$getQuery = "SELECT * FROM tableuser";
$result = mysqli_query($conn, $getQuery);
?>
<body>
    <?php
    while ($row = mysqli_fetch_array($result)) {

        $userdata[$row['division_id']][$row['id']]['firstName'] = $row['firstName'];
        $userdata[$row['division_id']][$row['id']]['lastName'] = $row['lastName'];
        $userdata[$row['division_id']][$row['id']]['email'] = $row['email'];
    }

    echo '<pre>';
    print_r($userdata);

    $divisionArr = array();
    $div_sql = "SELECT * FROM division";
    $getdata = mysqli_query($conn, $div_sql);

    while ($row = mysqli_fetch_assoc($getdata)) {
        $divisionArr[$row['id']] = $row['name'];
    }

    echo "<pre>";
    print_r($divisionArr);
    ?>

    <table border="3" cellpadding="10" cellspacing="3">
        <thead>
            <tr>
                <th>Id</th>
                <th>Division</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>

            </tr>
        </thead>
        <tbody>
            <?php
            $rowSpan = 0;
            foreach ($userdata as $divId => $userInfo) {
                //echo "<br>";
                //print_r($userInfo);
                $rowSpan = count($userInfo);
                $rowCounter = 0;
                foreach ($userInfo as $userId => $value) {
                    //print_r($value);
                    $fname = $value['firstName'];
                    $lname = $value['lastName'];
                    $email = $value['email'];
                    ?>
                    <tr>
                        <td><?php echo $divId; ?></td>
                        <?php
                        if ($rowCounter == 0) {
                            ?>
                            <td rowspan="<?php echo $rowSpan; ?>"><?php echo $divisionArr[$divId]; ?></td>
                            <?php
                        }
                        ?>
                        <td><?php echo $fname; ?></td>
                        <td><?php echo $lname; ?></td>
                        <td><?php echo $email; ?></td>

                    </tr>
                    <?php
                    $rowCounter++;
                }
            }
            exit;
            ?>
            </tr>
        </tbody>
    </table>






    <div class="tm-25">
        <?php include 'footer.php'; ?>
    </div>
</div>


</body>
</html>