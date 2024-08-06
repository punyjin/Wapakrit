<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('../connect.php');
include("../../data/database/postgres.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action']) && $_POST['action'] == 'get_modal_sell') {
        if (isset($_POST['item_id'])) {
            $item_id = pg_escape_string($dbconn, $_POST['item_id']);

            $query = "SELECT * FROM webshop_sell WHERE item_id = '$item_id'";
            $result = pg_query($dbconn, $query);

            if (!$result) {
                echo json_encode(["error" => pg_last_error($dbconn)]);
                exit();
            }
            
            $data = pg_fetch_assoc($result);
            echo json_encode($data);
            exit();
        } else {
            echo json_encode(["error" => "Item ID not provided"]);
            exit();
        }
    }
}
?>
