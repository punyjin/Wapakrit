<?php
function getAccessLevel($staff_result) {
            switch ($staff_result['access_level']) {
                
                case "1":
                    return "Staff Community";
                case "2":
                    return "Game Master";
                case "3":
                    return "Moderator";
                case "4":
                    return "Admin";
                case "5":
                    return "Manager";
                case "6":
                    return "Developer";
                case "7":
                    return "Owner";
                default:
                    return "Unknown";
                    exit();
            }
        }
        function get_type_goods($shop_result) {
            switch ($shop_result['item_category']) {
                case "0":
                    return "NONE";
                case "1":
                    return "Weapon";
                case "2":
                    return "Character";
                case "3":
                    return "Items";
                default:
                    return "Unknown";
                    exit();
                }
        }
        function get_type_menu($shop_result) {
            switch ($shop_result['menu']) {
                case "0":
                    return "NONE";
                case "1":
                    return "Assault Rifle";
                case "2":
                    return "Submachine Gun";
                case "3":
                    return "Sniper Rifle";
                case "4":
                    return "Heavy Weapon";
                case "5":
                    return "Shotgun";
                case "6":
                    return "Melee Weapon";
                case "7":
                    return "Resources";
                case "8":
                    return "Promotions Sales";
                default:
                    return "Unknown";
                    exit();
                }
        }
        function get_type_news($shop_result) {
            switch ($shop_result['news']) {
                case "0":
                    return "NONE";
                case "1":
                    return "HOT";
                case "2":
                    return "NEWS";
                case "3":
                    return "EVENT";
                case "4":
                    return "SPECIAL";
                default:
                    return "Unknown";
                    exit();
                }
        }
        function get_id_shop($shop_result) {
            switch ($shop_result['id_shop']) {
                case "0":
                    return "NONE";
                case "1":
                    return "#ID 1";
                case "2":
                    return "#ID 2";
                case "3":
                    return "#ID 3";
                case "4":
                    return "#ID 4";
                default:
                    return "Unknown";
                    exit();
                }
        }
        // ตรวจสอบการเข้าสู่ระบบ
        if (!isset($_SESSION['login_true'])) {
            Header("Location: /?page=KazeNeko_Manager_Editor_Administator_Topup&user=admin&access=2&isteam=true&status=denied");
            exit();
        }

        // ดึงข้อมูลผู้ใช้ที่เข้าสู่ระบบ
        $result = pg_query($dbconn, "SELECT * FROM accounts WHERE login = '" . pg_escape_string($_SESSION['login_true']) . "'") or die("กำลังแก้ไขระบบกรุณารอสักครู่");
        $dbarr = pg_fetch_assoc($result);

        // ตรวจสอบสิทธิ์การเข้าถึง
        if ($dbarr['access_level'] <= "1") {
            Header("Location: /?page=KazeNeko_Manager_Editor_Administator_Topup&user=admin&access=2&isteam=true&status=denied");
            exit();
        }
        //Table Shop Database
        $select_shop_goods = "SELECT * FROM webshop_sell";
        $shop_result_query = pg_query($dbconn, $select_shop_goods);

        // ดึงข้อมูลทั้งหมดจากตาราง staff_employees
        $select_sql_staff = "SELECT * FROM staff_employees";
        $staff_result_query = pg_query($dbconn, $select_sql_staff);
        $get_good_table_rows = '';

        if (pg_num_rows($shop_result_query) > 0) {
            pg_result_seek($shop_result_query, 0);
            while ($shop_result = pg_fetch_assoc($shop_result_query)) {
                $get_good_table_rows .= '<tr>';
                $get_good_table_rows .= '<td style="text-align:center;width:15%;">' . $shop_result['item_name'] . '</td>';
                $get_good_table_rows .= '<td style="text-align:center;width:5%;">' . $shop_result['item_id']. '</td>';
                $get_good_table_rows .= '<td style="text-align:center;width:5%;">' . $shop_result['price'] . '</td>';
                $get_good_table_rows .= '<td style="text-align:center;width:5%;">' . $shop_result['day'] . '</td>';
                $get_good_table_rows .= '<td style="text-align:center;width:15%;"> <img src="assets/images/shop/' . $shop_result['image'] . '.png" style="width:75%">' .'</td>';
                $get_good_table_rows .= '<td style="text-align:center;width:15%;">' . get_type_goods($shop_result) . '</td>';
                $get_good_table_rows .= '<td style="text-align:center;width:15%;">' . get_type_menu($shop_result) . '</td>';
                $get_good_table_rows .= '<td style="text-align:center;width:15%;">' . get_type_news($shop_result) . '</td>';
                $get_good_table_rows .= '<td style="text-align:center;width:15%;">' . get_id_shop($shop_result) . '</td>';
                $get_good_table_rows .= '<td style="text-align:center;width:15%;">';
                $get_good_table_rows .= '<a href="javascript:void(0);" id="item_id_' . $shop_result['item_id'] . '" data-toggle="modal" data-target="#Modal_goods" onclick="loadModalData(' . $shop_result['item_id'] . ');">แก้ไข</a>';
                $get_good_table_rows .= '</tr>';
                
            }
        } else {
            $table_rows = '<tr><td colspan="10" style="text-align:center;">ไม่พบข้อมูล</td></tr>';
        }
        
        // ตรวจสอบการดึงข้อมูลและอัปเดต last_login
        date_default_timezone_set('Asia/Bangkok');
        if ($staff_result_query && pg_num_rows($staff_result_query) > 0) {
            $user_id = $dbarr['player_id']; 
            $current_time = date("Y-m-d H:i:s");

            $update_sql = "UPDATE staff_employees SET last_login = $1 WHERE staff_id = $2";
            pg_query_params($dbconn, $update_sql, array($current_time, $user_id));

        }

        // สร้างตัวเลือกจากผลลัพธ์ของการ query
        $options = '';
        if (pg_num_rows($staff_result_query) > 0) {
            while ($row = pg_fetch_assoc($staff_result_query)) {
                $options .= '<option value="' . $row['staff_id'] . '">' . $row['staff_name'] . '</option>';
            }
        } else {
            $options = '<option value="0" disabled>ไม่พบพนักงาน</option>';
        }

        // วนลูปผ่านผลลัพธ์เพื่อสร้างแถว <td>
        $table_rows = '';
        if (pg_num_rows($staff_result_query) > 0) {
            pg_result_seek($staff_result_query, 0); // ย้ายตัวชี้ผลลัพธ์ไปที่แถวแรก
            while ($staff_result = pg_fetch_assoc($staff_result_query)) {
                $table_rows .= '<tr>';
                $table_rows .= '<td style="text-align:center;width:15%;">' . ($staff_result['staff_id'] == "" ? "ยังไม่ได้ลงทะเบียน" : $staff_result['staff_id']) . '</td>';
                $table_rows .= '<td style="text-align:center;width:30%;">' . ($staff_result['staff_name'] == "" ? "ยังไม่ได้ลงทะเบียน" : $staff_result['staff_name']) . '</td>';
                $table_rows .= '<td style="text-align:center;width:15%;">' . $staff_result['workid'] . '</td>';
                $table_rows .= '<td style="text-align:center;width:15%;">' . getAccessLevel($staff_result) . '</td>';
                $table_rows .= '<td style="text-align:center;width:10%;">' . $staff_result['status'] . '</td>';
                $table_rows .= '<td style="text-align:center;width:15%;">' . $staff_result['allwork'] . '</td>';
                $table_rows .= '<td style="text-align:center;width:15%;">' . $staff_result['last_login'] . '</td>';
                $table_rows .= '<td style="text-align:center;width:25%;">' . $staff_result['last_mac'] . '</td>';
                $table_rows .= '<td style="text-align:center;width:15%;">' . $staff_result['register_time'] . '</td>';
                $table_rows .= '<td style="text-align:center;width:10%;">' . $staff_result['last_work'] . '</td>';
                $table_rows .= '</tr>';
            }
        } else {
            $table_rows = '<tr><td colspan="10" style="text-align:center;">ไม่พบข้อมูล</td></tr>';
        }
?>
