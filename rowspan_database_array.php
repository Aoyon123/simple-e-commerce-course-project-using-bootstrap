<!DOCTYPE html>
<html>
    <head>
        <title>Array</title>
    </head>
    <body>
        <?php
//        require_once 'header.php';
        require_once 'db.php';

        // create array from database
        // get division
//        $division = array();
//        $division_sql = "SELECT * FROM division";
//        $division_result = mysqli_query($conn,$division_sql);
//        while ($row = mysqli_fetch_assoc($division_result)) {
//            
//            $division[$row['id']] = $row['name'];
//        }
        //get user detail
        $user = array();
        $user_sql = "SELECT users.* , division.name as division_name, district.name as district_name, thana.name as thana_name

            FROM users

            LEFT JOIN division ON division.id =  users.division_id

            LEFT JOIN district ON district.id = users.district_id

            LEFT JOIN thana ON thana.id = users.thana_id";

        $user_result = mysqli_query($conn,
                $user_sql);
        while ($row = mysqli_fetch_assoc($user_result)) {
            $user[$row['division_id']]['division_name'] = $row['division_name'];
            $user[$row['division_id']]['district'][$row['district_id']]['district_name'] = $row['district_name'];
            $user[$row['division_id']]['district'][$row['district_id']]['user'][$row['id']]['first_name'] = $row['fname'];
            $user[$row['division_id']]['district'][$row['district_id']]['user'][$row['id']]['last_name'] = $row['lname'];
            $user[$row['division_id']]['district'][$row['district_id']]['user'][$row['id']]['username'] = $row['username'];
        }

        $rowspanArr = [
];
        if (!empty($user)) {
            foreach ($user as
                    $divId =>
                    $divInfo) {
                if (!empty($divInfo['district'])) {
                    foreach ($divInfo['district'] as
                            $disId =>
                            $disInfo) {
                        if (!empty($disInfo['user'])) {
                            foreach ($disInfo['user'] as
                                    $uId =>
                                    $uInfo) {
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

        echo "<pre>";
//        print_r($rowspanArr);
        print_r($user);
        echo "</pre>";
        ?>

        <!-- show data in table -->
        <table border="1" cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th>Division</th>
                    <th>District</th>
                    <th>Name</th>
                    <th>Username</th>
                </tr>
            </thead>
            <tbody>
                    <?php
                    if (!empty($user)) {
                        foreach ($user as $divId =>$divInfo) {
                            ?>
                        <tr>
                            <td rowspan="<?php echo!empty($rowspanArr['div'][$divId]) ? $rowspanArr['div'][$divId] : 1; ?>"><?php echo!empty($divInfo['division_name']) ? $divInfo['division_name'] : 0; ?> </td>
                            <?php
                            if (!empty($divInfo['district'])) {
                                $i = 0;
                                foreach ($divInfo['district'] as
                                        $disId =>
                                        $disInfo) {
                                    if ($i > 0) {
                                        echo "<tr>";
                                    }
                                    ?>
                                    <td rowspan="<?php echo!empty($rowspanArr['dis'][$divId][$disId]) ? $rowspanArr['dis'][$divId][$disId] : 1; ?>"><?php echo!empty($disInfo['district_name']) ? $disInfo['district_name'] : 0; ?> </td>
                                    <?php
                                    if (!empty($disInfo['user'])) {
                                        $j = 0;
                                        foreach ($disInfo['user'] as $uId =>$uInfo) {
                                            if ($j > 0) {
                                                echo "<tr>";
                                            }
                                            $uName = $uInfo['first_name'] . " " . $uInfo['last_name'];
                                            ?>
                                            <td><?php echo!empty($uName) ? $uName : 0; ?></td>
                                            <td><?php echo!empty($uInfo['username']) ? $uInfo['username'] : 0; ?></td>
                                            <?php
                                            if ($j < ($rowspanArr['dis'][$divId][$disId]) - 1) {
                                                echo "</tr>";
                                            }
                                            $j++;
                                        }
                                        ?>
                                    <?php
                                    if ($i < ($rowspanArr['div'][$divId]) - 1) {
                                        echo "</tr>";
                                    }
                                    $i++;
                                }
                                ?>
                                </tr>
                <?php
            }
        }
    }
}
?>    
            </tbody>
        </table>
    </body>
</html>