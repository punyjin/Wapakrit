<?php
// ตัวแปร $menu_items
$menu_items = [
    "1" => "Assault Rifle",
    "2" => "Submachine Gun",
    "3" => "Sniper Rifle",
    "4" => "Heavy Weapon",
    "5" => "Shotgun",
    "6" => "Melee Weapon",
    "7" => "Resources",
    "8" => "Promotions Sales"
];

$type_items = [
    "1" => "Weapon",
    "2" => "Character",
    "3" => "Items",
];

$news_items = [
    "0" => "NONE",
    "1" => "HOT",
    "2" => "NEWS",
    "3" => "EVENT",
    "4" => "Special",
];

// รับค่าจาก POST หรือกำหนดค่าเริ่มต้น
$selected_menu = isset($_POST["selected_menu"]) ? htmlspecialchars($_POST["selected_menu"]) : ''; 
$selected_type = isset($_POST["selected_type"]) ? htmlspecialchars($_POST["selected_type"]) : ''; 
$selected_news = isset($_POST["selected_news"]) ? htmlspecialchars($_POST["selected_news"]) : ''; 

// สร้างตัวเลือกหมวดหมู่
$options_category = '';
foreach ($menu_items as $value => $label) {
    $selected = ($value == $selected_menu) ? ' selected' : '';
    $options_category .= "<option value=\"$value\"$selected>$label</option>";
}

// สร้างตัวเลือกประเภท
$options_type = '';
foreach ($type_items as $value => $type_label) {
    $type_selected = ($value == $selected_type) ? ' selected' : '';
    $options_type .= "<option value=\"$value\"$type_selected>$type_label</option>";
}

// สร้างตัวเลือกข่าว
$options_news = '';
foreach ($news_items as $value => $news_label) {
    $news_selected = ($value == $selected_news) ? ' selected' : '';
    $options_news .= "<option value=\"$value\"$news_selected>$news_label</option>";
}
?>
