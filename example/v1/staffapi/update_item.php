<?php
include('../connect.php');
include("../../data/database/postgres.php"); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $item_id = pg_escape_string($dbconn, $_POST['item_id']);
    $goods_name = pg_escape_string($dbconn, $_POST['goods_name']);
    $price = pg_escape_string($dbconn, $_POST['price']);
    $day = pg_escape_string($dbconn, $_POST['day']);
    $image = pg_escape_string($dbconn, $_POST['image']);
    $description = pg_escape_string($dbconn, $_POST['user_comment']);
    $menu = pg_escape_string($dbconn, $_POST['menu']);
    $item_category = pg_escape_string($dbconn, $_POST['select_type']);
    $news = pg_escape_string($dbconn, $_POST['select_news']);
    $id_shop = pg_escape_string($dbconn, $_POST['TAG_ID']);
    $query = "UPDATE webshop_sell SET item_name = '$goods_name', price = '$price', day = '$day', image = '$image', user_comment = '$description', menu = '$menu', item_category = '$item_category', news = '$news', id_shop = '$id_shop' WHERE item_id = '$item_id'";
    $result = pg_query($dbconn, $query);
    
    if ($result) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'desc' => 'Database update failed', 'title' => 'Error']);
    }
} else {
    echo json_encode(['status' => 'error', 'desc' => 'Invalid request method', 'title' => 'Error']);
}
?>
