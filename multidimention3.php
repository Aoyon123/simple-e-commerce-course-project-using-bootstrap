<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="style.css">
        <title>Array</title>
    </head>
    <body>
        <?php
        $conn = mysqli_connect("localhost", "root", "", "crud18");

        if (!$conn) {
            echo "Database Connection Failed";
        }

        //get user detail
        $user = array();
        $user_sql = "SELECT tableuser.* , division.name as division_name, district.name as district_name, thana.name as thana_name

            FROM tableuser

            LEFT JOIN division ON division.id =  tableuser.division_id

            LEFT JOIN district ON district.id = tableuser.district_id
            
            LEFT JOIN thana ON thana.id = tableuser.thana_id";

        $user_result = mysqli_query($conn, $user_sql);
        while ($row = mysqli_fetch_assoc($user_result)) {
            $user[$row['division_id']]['division_name'] = $row['division_name'];
            $user[$row['division_id']]['district'][$row['district_id']]['district_name'] = $row['district_name'];
            $user[$row['division_id']]['district'][$row['district_id']]['thana'][$row['thana_id']] ['thana_name'] = $row['thana_name'];
            $user[$row['division_id']]['district'][$row['district_id']]['thana'][$row['thana_id']]['user'][$row['id']]['first_name'] = $row['firstName'];
            // $user[$row['division_id']]['district'][$row['district_id']]['thana'][$row['thana_id']]['user'][$row['id']]['last_name'] = $row['lastName'];
            $user[$row['division_id']]['district'][$row['district_id']]['thana'][$row['thana_id']]['user'][$row['id']]['email'] = $row['email'];
        }

        $rowspanArr = [];
        if (!empty($user)) {
            foreach ($user as $divId => $divInfo) {
                if (!empty($divInfo['district'])) {
                    foreach ($divInfo['district'] as $disId => $disInfo) {
                        if (!empty($disInfo['thana'])) {
                            foreach ($disInfo['thana'] as $thanaId => $thanaInfo) {

                                if (!empty($thanaInfo['user'])) {
                                    foreach ($thanaInfo['user'] as $uId => $uInfo) {

                                        $rowspanArr['than'][$divId][$disId][$thanaId] = !empty($rowspanArr['than'][$divId][$disId][$thanaId]) ? $rowspanArr['than'][$divId][$disId][$thanaId] : 0;
                                        $rowspanArr['than'][$divId][$disId][$thanaId] += 1;

                                        $rowspanArr['dis'][$divId][$disId] = !empty($rowspanArr['dis'][$divId][$disId]) ? $rowspanArr['dis'][$divId][$disId] : 0;
                                        $rowspanArr['dis'][$divId][$disId] += 1;

                                        $rowspanArr['div'][$divId] = !empty($rowspanArr['div'][$divId]) ? $rowspanArr['div'][$divId] : 0;
                                        $rowspanArr['div'][$divId] += 1;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        echo "<pre>";
//        print_r($rowspanArr);
        print_r($user);
        echo "</pre>";
        ?>

        <!-- show data in table -->
        <table class="table-design" border="1" cellpadding="1" cellspacing="1">
            <thead class="table-header">
                <tr>
                    <th>Division</th>
                    <th>District</th>
                    <th>Thana</th>
                    <th>FirstName</th>
                    <!--                    
                                        <th>Email</th>
                                    </tr>
                                </thead>
                                <tbody> -->
                    <?php
                    if (!empty($user)) {
                        foreach ($user as $divId => $divInfo) {
                            ?>
                        <tr>
                            <td rowspan="<?php echo!empty($rowspanArr['div'][$divId]) ? $rowspanArr['div'][$divId] : 1; ?>"><?php echo!empty($divInfo['division_name']) ? $divInfo['division_name'] : 0; ?> </td>
                            <?php
                            if (!empty($divInfo['district'])) {
                                $i = 0;
                                foreach ($divInfo['district'] as $disId => $disInfo) {
                                    if ($i > 0) {
                                        echo "<tr>";
                                    }
                                    ?>
                                    <td rowspan="<?php echo!empty($rowspanArr['dis'][$divId][$disId]) ? $rowspanArr['dis'][$divId][$disId] : 1; ?>"><?php echo!empty($disInfo['district_name']) ? $disInfo['district_name'] : 0; ?> </td>


                                    <?php
                                    if (!empty($disInfo['thana'])) {
                                        $k = 0;
                                        foreach ($disInfo['thana'] as $thanaId => $thanaInfo) {
                                            if ($k > 0) {
                                                echo "<tr>";
                                            }
                                            ?>
                                            <td rowspan="<?php echo!empty($rowspanArr['than'][$divId][$disId][$thanaId]) ? $rowspanArr['than'][$divId][$disId][$thanaId] : 1; ?>"><?php echo!empty($thanaInfo['thana_name']) ? $thanaInfo['thana_name'] : 0; ?> </td>

                                            <?php
                                            if (!empty($thanaInfo['user'])) {
                                                $j = 0;
                                                foreach ($thanaInfo['user'] as $uId => $uInfo) {
                                                    if ($j > 0) {
                                                        echo "<tr>";
                                                    }
                                                    $uName = $uInfo['first_name'];
                                                    ?>

                                                    <td><?php echo!empty($uName) ? $uName : 0; ?></td>
                                                    <?php // echo!empty($uInfo['first_name']) ? ($uInfo['first_name']) : 0; ?></td>


                                                    <?php
                                                    if ($k < ($rowspanArr['than'][$divId][$disId][$thanaId]) - 1) {
                                                        echo "</tr>";
                                                    }
                                                    $k++;
                                                }
                                                ?>
                                                <?php
                                                if ($j < ($rowspanArr['dis'][$divId][$disId]) - 1) {
                                                    echo "</tr>";
                                                }
                                                $j++;
                                            }

                                            if ($i < ($rowspanArr['div'][$divId]) - 1) {
                                                echo "</tr>";
                                            }
                                            $i++;
                                        }
                                    }
                                    ?>
                                </tr>

                                <?php
                            }//end foreach dis
                        } //end if dis
                    }
                }
                ?>    
                </tbody>
        </table>
    </body>
</html>

