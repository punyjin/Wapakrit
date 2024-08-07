<?php
error_reporting(0);
ini_set('display_errors', 0);
session_start();
include($_SERVER['DOCUMENT_ROOT'] . "/v1/connect.php");
include($_SERVER['DOCUMENT_ROOT'] . "/data/database/postgres.php");



function duration($begin, $end)
{
    $remain = intval(strtotime($end) - strtotime($begin));
    $minute = floor($remain / 60);
    return $minute;
}

function encripitar($pass)
{
    $output = password_hash($pass, PASSWORD_BCRYPT);
    return $output;
}

function is_str($txt)
{
    if (!preg_match("/^[a-zA-Z0-9_]+$/", $txt)) {
        return false;
    } else {
        return true;
    }
}

$result = pg_query_params($dbconn, "SELECT * FROM accounts WHERE login=$1", [@$_SESSION['login_true']]) or die("Err Can not to result");
$dbarr = pg_fetch_array($result);
date_default_timezone_set('Asia/Bangkok');
$date_now = date("Y-m-d H:i:s", time());
$get_staff_param = pg_query_params($dbconn,"SELECT * FROM employees");
$fetch_staff_data = pg_fetch_array($get_staff_param);

$data = new stdClass();

function getAccessLevel($dbarr) {
    switch ($dbarr['access_level']) {
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
function getworkid($fetch_staff_data){
    switch ($fetch_staff_data['workid']) {
        case "0":
            return "None";
        case "1":
            return "Normal";
        case "2":
            return "Fast";
        case "3":   
            return "VIP";
        default:
            return "Unknow Job";
    }
}
if ($_POST['action'] == 'login') {
    $user_login = addslashes(trim($_POST['username']));
    $pwd_login  = addslashes(trim($_POST['password']));
    $hashpass   = password_hash($pwd_login, PASSWORD_BCRYPT);
    
    $result = pg_query_params($dbconn, "SELECT login, password FROM accounts WHERE login=$1", [$user_login]); 
    //$num    = pg_num_rows($result);
    
    if (empty($_POST['username']) || empty($_POST['password'])) {
        $data->status = "error";
        $data->desc   = "กรุณากรอกข้อมูลให้ครบ";
    } else {
        if ($row = pg_fetch_assoc($result)) {
            $keeppassHash = $row['password'];
            if (password_verify($pwd_login, $keeppassHash)) {
                $_SESSION['login_true'] = $_POST['username'];
                $data->status           = "success";
                $data->desc             = "เข้าสู่ระบบสำเร็จ";
                $data->reload           = "true";
            }
            else{
                $data->status = "error";
                $data->desc   = "ชื่อผู้ใช้หรือรหัสผิดพลาด";
            }
        }
        else{
            $data->status = "error";
            $data->desc   = "ชื่อผู้ใช้หรือรหัสผิดพลาด";
        }
    }
} else if ($_POST['action'] == 'logout') {
    session_destroy();
    $data->status = "success";
    $data->desc   = "ออกจากระบบสำเร็จ";
    $data->reload = "true";
} else if ($_POST['action'] == 'changepassword') {
    $pass      = $_POST['oldpass'];
    $npassword = $_POST['newpass'];
    $rpassword = $_POST['re_newpass'];
    
    $sql     = "SELECT * FROM accounts WHERE login = $1";
    $query   = pg_query_params($dbconn, $sql, [$_SESSION['login_true']]);
    $numrows = pg_num_rows($query);
    $rows    = pg_fetch_array($query);
    
    $hashpass  = password_hash(PASSWORD_BCRYPT, $pass);
    $hashnpass = password_hash(PASSWORD_BCRYPT, $npassword);
    
    if (empty($pass) || empty($npassword) || empty($rpassword)) {
        $data->status = "error";
        $data->desc   = "กรุณากรอกข้อมูลให้ครบ";
    } elseif ($npassword != $rpassword) {
        $data->status = "error";
        $data->desc   = "รหัสผ่านใหม่ไม่ตรงกัน";
    } elseif ($hashpass != $rows['password']) {
        $data->status = "error";
        $data->desc   = "รหัสผ่านปัจจุบันไม่ถูกต้อง";
    } else {
        $data->status = "success";
        $data->desc   = "เปลี่ยนรหัสผ่านสำเร็จ";
        $data->reload = "true";
        pg_query_params($dbconn, "UPDATE accounts SET password=$1 WHERE login=$2", [$hashnpass, $_SESSION['login_true']]);
        session_destroy();
    }
} else if ($_POST['action'] == 'topup') {
    $tmnpassword = $_POST['tmnpassword'];
    $query = pg_query_params($dbconn, "SELECT * FROM player_id WHERE login=$1", [$dbarr["login"]]);
    $date  = date("Y-m-d");
    $time  = date("H:i:s");
    $time_active = date('H:i:s', strtotime('+5 minutes', strtotime($time)));
    $aaaeee = date('Y-m-d H:i:s', strtotime('+90 minutes', strtotime($sq)));
    $lsbm = $time_active;
    $row = pg_fetch_array($query);
    $num_row = pg_num_rows($query);
    $ccpp = "1";
    $strhistopup = $dbarr['player_name'];
    $strSQLs = $nickname;

    if (empty($tmnpassword)) {
        $data->status = "error";
        $data->desc = "กรุณากรอกคำร้องขอในช่องข้อความ";
    } else if (isset($_SESSION['last_submits']) && (time() - $_SESSION['last_submits'] < 60 * 5)) { // 5 นาที Cooldown
        $data->status = "error";
        $data->desc = "กรุณารอเวลานับถอยหลัง และ ลองใหม่อีกครั้งในอีก " . (60 * 5 - (time() - $_SESSION['last_submits'])) . " วินาที";
    } else {
        $data->status = "success";
        $data->desc   = "ส่งข้อความคำร้องเรียบร้อย";
        $data->reload = "true";
        pg_query_params($dbconn, "INSERT INTO web_history_topup (player_id, truemoney_pin, amount, tranid, process) VALUES ($1, $2, 0, $3, 0)", [$dbarr['player_id'], $tmnpassword, $isTransaction]);
        
        $webhook = "https://discord.com/api/webhooks/1067446460381155369/t3zljBGYOkaBC94V_C0iMVZAGKxfh86Hy-KbyAbir2aKsQ-QKRyT6mGog9SbW3o0NqA2";
        $message = "UID : $strhistopup \nส่งคำร้องขอ : $tmnpassword";
        $_SESSION['last_submits'] = time();
        
        $base = ['content' => $message];
        
        $options = [
            CURLOPT_URL => $webhook,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query($base),
            CURLOPT_RETURNTRANSFER => true,
        ];
        $ch = curl_init();
        curl_setopt_array($ch, $options);
        $response = curl_exec($ch);
        curl_close($ch);

        file_get_contents($webhook, false, stream_context_create($options));
    }
} else if ($_POST['action'] == 'nickname') {
    $nickname = $_POST['nickname'];
    
    if (strlen($nickname) <= 0) {
        $data->status = "error";
        $data->desc   = "กรุณากรอกข้อมูลให้ครบ";
    } else {
        $sql2      = "SELECT * FROM accounts WHERE login = $1 and player_name = $2";
        $checkname = pg_query_params($dbconn, $sql2, [$_SESSION['login_true'], $nickname]);
        $c2        = pg_fetch_array($checkname);
        if ($c2) {
            $data->status = "error";
            $data->desc   = "พบชื่อนี้แล้วในระบบ";
        } else {
            $sql    = "SELECT * FROM accounts WHERE login = $1";
            $query  = pg_query_params($dbconn, $sql, [$_SESSION['login_true']]);
            $num    = pg_num_rows($query);
            $result = pg_fetch_array($query);
            if ($result['coin'] >= $web['price_name']) {
                pg_query_params($dbconn, "UPDATE accounts SET player_name = $1 WHERE login = $2", [$nickname, $_SESSION['login_true']]);
                pg_query_params($dbconn, "UPDATE accounts SET coin = coin - $1 WHERE login = $2", [$web['price_name'], $_SESSION['login_true']]);
                $data->status = "success";
                $data->desc   = "เปลี่ยนชื่อสำเร็จ";
                $data->reload = "true";
            } else {
                $data->status = "error";
                $data->desc   = "พ้อยไม่เพียงพอ";
            }
        }
    }
} else if ($_POST['action'] == 'colorname') {
    $nickcolor = $_POST['nickcolor'];
    
    if (strlen($nickcolor) <= 0) {
        $data->status = "error";
        $data->desc   = "กรุณากรอกข้อมูลให้ครบ";
    } else {
        $sql = "SELECT * FROM accounts WHERE login = $1";
        $query  = pg_query_params($dbconn, $sql, [$_SESSION['login_true']]);
        $result = pg_fetch_array($query);
        if ($result['coin'] >= $web['price_color']) {
            pg_query_params($dbconn, "UPDATE accounts SET player_color = $1 WHERE login = $2", [$nickcolor, $_SESSION['login_true']]);
            pg_query_params($dbconn, "UPDATE accounts SET coin = coin - $1 WHERE login = $2", [$web['price_color'], $_SESSION['login_true']]);
            $data->status = "success";
            $data->desc   = "เปลี่ยนสีชื่อสำเร็จ";
            $data->reload = "true";
        } else {
            $data->status = "error";
            $data->desc   = "พ้อยไม่เพียงพอ";
        }
    }
} else if ($_POST['action'] == 'buycafe') {
    $cafeID = $_POST['cafeid'];
    $sql    = "SELECT * FROM accounts WHERE login = '" . $_SESSION['login_true'] . "'";
    $query  = pg_query($dbconn,$sql);
    $result = pg_fetch_array($query);
    $sub_gold = $web['sub_gold'];
    $sub_premium = $web['sub_premium'];
    if ($result['pc_cafe'] != "1" && $result['pc_cafe'] != "2") {
        if (!$sub_gold) {
            $data->status = "error";
            $data->desc   = "ไม่พบไอเท็มนี้ในระบบ";
        }else if (!$sub_premium) {
            $data->status = "error";
            $data->desc   = "ไม่พบไอเท็มนี้ในระบบ";
        }
        if ($cafeID == "1") {
            if ($result['coin'] < $web['sub_gold']) {
                $data->status = "error";
                $data->desc   = "พ้อยต์ของคุณไม่เพียงพอ";
            } else {
                pg_query($dbconn,"UPDATE accounts SET coin = coin - '" . $web['sub_gold'] . "' WHERE player_id = '" . $result['player_id'] . "'");
                pg_query($dbconn,"UPDATE accounts SET pc_cafe = '1' WHERE player_id = '" . $result['player_id'] . "'");
                $data->status = "success";
                $data->desc   = $web['sub_gold'] . " ได้รับสถานะ GOLD";
                $data->reload = "true";
            }
        } else {
            if ($result['coin'] < $web['sub_premium']) {
                $data->status = "error";
                $data->desc   = "พ้อยต์ของคุณไม่เพียงพอ";
            } else {
                pg_query($dbconn,"UPDATE accounts SET coin = coin - '" . $web['sub_premium'] . "' WHERE player_id = '" . $result['player_id'] . "'");
                pg_query($dbconn,"UPDATE accounts SET pc_cafe = '2' WHERE player_id = '" . $result['player_id'] . "'");
                $data->status = "success";
                $data->desc   = "คุณได้รับสถานะ PREMIUM";
                $data->reload = "true";
            }
        }
    } else {
        $data->status = "error";
        $data->desc   = "คุณมีสถานะอยู่แล้ว";
    }
} else if ($_POST['action'] == 'esportstatus') {
    $duration    = $_POST['status_esport'];
    $uid         = $_POST['uid'];
    $query_select = pg_query_params($dbconn, "SELECT * FROM accounts WHERE player_id = $1", [$uid]);
    $row         = pg_fetch_array($query_select);
    
    $esport_gold    = $web['price_esport_gold'];
    $esport_premium = $web['price_esport_premium'];
    
    if ($row['coin'] >= $esport_gold && $duration == 'GOLD') {
        pg_query_params($dbconn, "UPDATE accounts SET coin = coin - $1, end_date = end_date + interval '30 days' WHERE player_id = $2", [$esport_gold, $uid]);
        pg_query_params($dbconn, "UPDATE accounts SET esport = 'GOLD' WHERE player_id = $1", [$uid]);
        $data->status = "success";
        $data->desc   = "ซื้อ GOLD ESPORT สำเร็จ";
        $data->reload = "true";
    } elseif ($row['coin'] >= $esport_premium && $duration == 'PREMIUM') {
        pg_query_params($dbconn, "UPDATE accounts SET coin = coin - $1, end_date = end_date + interval '30 days' WHERE player_id = $2", [$esport_premium, $uid]);
        pg_query_params($dbconn, "UPDATE accounts SET esport = 'PREMIUM' WHERE player_id = $1", [$uid]);
        $data->status = "success";
        $data->desc   = "ซื้อ PREMIUM ESPORT สำเร็จ";
        $data->reload = "true";
    } else {
        $data->status = "error";
        $data->desc   = "พ้อยไม่เพียงพอ";
    }
} else if ($_POST['action'] == 'register') {
    $username    = $_POST['username'];
    $password    = $_POST['password'];
    $re_password = $_POST['re_password'];
    $email       = $_POST['email'];
    $hashpass   = password_hash(PASSWORD_BCRYPT, $pwd_login);
    
    $sql_check_username = "SELECT * FROM accounts WHERE login = $1";
    $query_check_username = pg_query_params($dbconn, $sql_check_username, [$username]);
    
    if (trim($username) == "" || trim($password) == "" || trim($re_password) == "" || trim($email) == "") {
        $data->status = "error";
        $data->desc   = "กรุณากรอกข้อมูลให้ครบ";
    } else if (!is_str($_POST['username'])) {
        $data->status = "error";
        $data->desc   = "ชื่อผู้ใช้ต้องเป็นภาษาอังกฤษและตัวเลขเท่านั้น!";
    } else if ($password != $re_password) {
        $data->status = "error";
        $data->desc   = "รหัสผ่านไม่ตรงกัน";
    } else {
        $strSQL    = "SELECT * FROM accounts WHERE login = '" . trim($username) . "' "; // Verifica  ID
        $objQuery  = pg_query($dbconn,$strSQL);
        $objResult = pg_fetch_array($objQuery);
        if ($objResult) {
            $data->status = "error";
            $data->desc   = "ชื่อผู้ใช้นี้ถูกใช้งานไปแล้ว";
        } else {
            $strSQL               = "INSERT INTO accounts (login,password,email,token,repassword) VALUES ('" . $username . "','" . encripitar($password) . "','" . $email . "','" . encripitar($username) . "','". ($re_password) ."')";
            $objQuery             = pg_query($dbconn,$strSQL);
            $_SESSION['username'] = $_POST['txtUsername'];
            $data->status         = "success";
            $data->desc           = "สมัครสมาชิกสำเร็จ";
            $data->reload         = "true";
        }
    }
} else if ($_POST['action'] == 'pointitem') {
    $item_id = $_POST['itemid'];
    $point_id = $_POST['pointid'];
    
    $sql_check_point = "SELECT * FROM points WHERE id = $1";
    $query_check_point = pg_query_params($dbconn, $sql_check_point, [$point_id]);
    $row_point = pg_fetch_array($query_check_point);
    
    $sql_check_user = "SELECT * FROM accounts WHERE login = $1";
    $query_check_user = pg_query_params($dbconn, $sql_check_user, [$_SESSION['login_true']]);
    $row_user = pg_fetch_array($query_check_user);
    
    if ($row_user['point'] >= $row_point['point']) {
        pg_query_params($dbconn, "UPDATE accounts SET point = point - $1 WHERE login = $2", [$row_point['point'], $_SESSION['login_true']]);
        pg_query_params($dbconn, "INSERT INTO web_history_point (login, item_id, point, date) VALUES ($1, $2, $3, NOW())", [$_SESSION['login_true'], $item_id, $row_point['point']]);
        $data->status = "success";
        $data->desc   = "ซื้อไอเท็มสำเร็จ";
        $data->reload = "true";
    } else {
        $data->status = "error";
        $data->desc   = "พ้อยไม่เพียงพอ";
    }
} else if ($_POST['action'] == 'buyitempoint') {
    $itemid = $_POST['itemid'];
    $sql    = "SELECT * FROM accounts WHERE login = '" . $_SESSION['login_true'] . "'";
    $query  = pg_query($dbconn,$sql);
    $result = pg_fetch_array($query);
    $sql    = "SELECT * FROM webshop_sell WHERE item_id = '" . $itemid . "'";
    $query  = pg_query($dbconn,$sql);
    $rows   = pg_fetch_array($query);
    if (!$rows) {
        $data->status = "error";
        $data->desc   = "ไม่พบไอเท็มนี้ในระบบ";
    }
    $day = $rows['day'] * 86400;
    if ($result['coin'] < $rows['price']) {
        $data->status = "error";
        $data->desc   = "พ้อย ไม่เพียงพอ";
    } else {
        $sqli   = "SELECT * FROM player_items WHERE owner_id='" . $result['player_id'] . "' AND item_id = '" . $rows['item_id'] . "'";
        $iquery = pg_query($dbconn,$sqli);
        $row_i  = pg_fetch_array($iquery);
        if ($row_i['equip'] == 1) {
            pg_query($dbconn,"UPDATE player_items SET count = count + '" . $day . "' WHERE object_id='" . $row_i['object_id'] . "'");
            pg_query($dbconn,"UPDATE accounts SET coin = coin - '" . $rows['price'] . "' WHERE player_id = '" . $result['player_id'] . "'");
            pg_query($dbconn,"UPDATE webshop_sell SET count = count + 1 WHERE item_id = '" . $itemid . "'");
            pg_query($dbconn,"INSERT INTO webshop_log (player_id, item_name,day,date,price,img) VALUES ('" . $result['player_id'] . "', '" . $rows['item_name'] . "', '" . $rows['day'] . "', '" . date("Y-m-d H:i:s", time()) . "','" . $rows['price'] . "','" . $rows['image'] . "')");
            $data->status = "success";
            $data->desc   = "ซื้อไอเท็มสำเร็จ";
            $data->reload = "true";
        } else if ($row_i['equip'] == 2) {
            $data->status = "error";
            $data->desc   = "ไอเทมถูกใช้งานแล้ว ไม่สามารถซื้อซ้ำได้";
        } else if ($row_i['equip'] == 3) {
            $data->status = "error";
            $data->desc   = "คุณมีไอเทมชิ้นนี้ในตัวแบบถาวรแล้ว ไม่สามารถซื้อซ้ำได้ !";
        } else {
            pg_query($dbconn,"INSERT INTO player_topups (player_id, item_id, item_name, count, equip) VALUES ('" . $result['player_id'] . "', '" . $rows['item_id'] . "', '" . $rows['item_name'] . "', '" . $day . "', '1)");
            pg_query($dbconn,"INSERT INTO player_items (owner_id, item_id, item_name, count, category, equip) VALUES ('" . $result['player_id'] . "', '" . $rows['item_id'] . "', '" . $rows['item_name'] . "', '" . $day . "', '" . $rows['item_category'] . "' , '1')");
            pg_query($dbconn,"UPDATE accounts SET coin = coin - '" . $rows['price'] . "' WHERE player_id = '" . $result['player_id'] . "'");
            pg_query($dbconn,"UPDATE webshop_sell SET count = count + 1 WHERE item_id = '" . $itemid . "'");
            pg_query($dbconn,"INSERT INTO webshop_log (player_id, item_name,day,date,price,img) VALUES ('" . $result['player_id'] . "', '" . $rows['item_name'] . "', '" . $rows['day'] . "', '" . date("Y-m-d H:i:s", time()) . "','" . $rows['price'] . "','" . $rows['image'] . "')");
            $data->status = "success";
            $data->desc   = "ซื้อไอเท็มสำเร็จ";
            $data->reload = "true";
        }
    }
} else if ($_POST['action'] == 'redeem') {
    $code = $_POST['code'];
    $sql_check_code = "SELECT * FROM redeem_codes WHERE code = $1";
    $query_check_code = pg_query_params($dbconn, $sql_check_code, [$code]);
    $row_code = pg_fetch_array($query_check_code);
    
    $sql_check_user = "SELECT * FROM accounts WHERE login = $1";
    $query_check_user = pg_query_params($dbconn, $sql_check_user, [$_SESSION['login_true']]);
    $row_user = pg_fetch_array($query_check_user);
    
    if ($row_code) {
        if ($row_code['used'] == 0) {
            pg_query_params($dbconn, "UPDATE redeem_codes SET used = 1 WHERE code = $1", [$code]);
            pg_query_params($dbconn, "UPDATE accounts SET point = point + $1 WHERE login = $2", [$row_code['point'], $_SESSION['login_true']]);
            $data->status = "success";
            $data->desc   = "แลกรางวัลสำเร็จ";
            $data->reload = "true";
        } else {
            $data->status = "error";
            $data->desc   = "โค้ดนี้ถูกใช้ไปแล้ว";
        }
    } else {
        $data->status = "error";
        $data->desc   = "ไม่พบโค้ดนี้";
    }
}else if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] == 'subject_staff') {
        $staff_id = $_POST['subject_staff'];

        if ($staff_id != '0') {
            $select_sql_staff = "SELECT * FROM staff_employees WHERE staff_id = $1";
            $result = pg_query_params($dbconn, $select_sql_staff, array($staff_id));

            if (pg_num_rows($result) > 0) {
                $staff_details = pg_fetch_assoc($result);
                ob_start();
                ?>
                
                <table class="table table-bordered">
                    <tr>
                        <td>UID พนักงาน</td>
                        <td><?php echo htmlspecialchars($staff_details['staff_id']); ?></td>
                    </tr>
                    <tr>
                        <td>ชื่อพนักงาน</td>
                        <td><?php echo htmlspecialchars($staff_details['staff_name']); ?></td>
                    </tr>
                    <tr>
                        <td>ตําแหน่ง</td>
                        <td><?php echo htmlspecialchars(getAccessLevel($staff_details)); ?></td>
                    </tr>
                    <tr>
                        <td>ประเภทงานที่ได้รับมอบหมาย</td>
                        <td><?php echo htmlspecialchars(getworkid($staff_details)); ?></td>
                    </tr>
                </table>
                <button type="button" class="btn btn-primary btn-block" style="margin:10px" data-bs-toggle="button"  ><i class="fas fa-edit"></i> แก้ไขงาน</button><br>
                <button type="button" class="btn btn-danger btn-block fd-danger aos-init aos-animate" style="margin:10px" data-bs-toggle="button"  ><i class="fas fa-trash-alt"></i> ลบงาน</button><br>
                <button type="button" class="btn btn-success btn-block fd-success" style="margin:10px" data-bs-toggle="button"  ><i class="fas fa-share"></i> แชร์งาน</button><br>
                    
                <?php
                $html = ob_get_clean();
                $data->status = 'success';
                $data->html = $html;
            } else {
                $data->desc = 'ไม่พบพนักงานที่ท่านเลือก';
            }
        } else {
            $data->desc = 'กรุณาเลือกพนักงานก่อนดำเนินการ';
        }
    } else {
        $data->desc = 'ไม่พบข้อมูลที่ถูกส่งมา';
    }
}



echo json_encode($data);
?>
