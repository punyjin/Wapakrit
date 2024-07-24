<?php
include("v1/connect.php");
include("data/database/postgres.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['subject_staff'])) {
    $staff_id = $_POST['subject_staff'];

    if ($staff_id != '0') {
        $select_sql_staff = "SELECT * FROM staff_employees WHERE staff_id = $1";
        $result = pg_query_params($dbconn, $select_sql_staff, array($staff_id));

        if (pg_num_rows($result) > 0) {
            $staff_details = pg_fetch_assoc($result);
            // Display the staff details
            echo '<pre>';
            print_r($staff_details);
            echo '</pre>';
        } else {
            echo '<p>ไม่พบพนักงานที่เลือก</p>';
        }
    } else {
        echo '<p>กรุณาเลือกพนักงาน</p>';
    }
} else {
    echo '<p>ไม่มีข้อมูลถูกส่งมา</p>';
}
?>
