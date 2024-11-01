<?php
// set default url //
if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
    $uri = 'https://';
} else {
    $uri = 'http://';
}
$uri .= $_SERVER['HTTP_HOST'];
//$uri = '127.0.0.1/wwwroot/xorbit/example';
// end set default url


// webconfig
$web = array();
$web['title'] = "GameWebsite - KazenoNeko Studio";
$web['header'] = "KazenoNeko Studio";
$web['status'] = "1"; // 1 = online - 2 = offline
$web['rate_exp'] = "50"; 
$web['rate_point'] = "2"; 
$web['rate_cash'] = "50"; 
$web['id'] = "1";
$web['type_news'] = "1";
$web['type_hot'] = "2";
$web['type_sale'] = "3";
$web['type_patch'] = "4";
$web['detail'] = "แมวอ้วนตัวสีขาวตาสองสีชอบสวบมนุด !";
$web['sub_gold'] = "79"; //ราคา Sub Gold
$web['sub_premium'] = "149"; //ราคา Sub Premium

// end webconfig


// postgresSQL config //
$postgres = array();
$postgres['host'] = "localhost"; // default :localhost
$postgres['port'] = "5432"; // default :5432
$postgres['username'] = "postgres"; // username
$postgres['password'] = "123456"; // password
$postgres['database'] = "pbv3"; // db name
// End postgresSQL config //


//Config Site
$config = array();
$config['title'] = "KazenoNeko Studio";


//server information under
$config['serverinformation_under'] = "KazenoNeko Studio";
$config['server_group'] = "GROUP: KazenoNeko Studio";
$config['server_discord'] = "https://discord.gg/KazenoNekoStudio";
$config['server_fanpage'] = "เพจ : KazenoNeko Studio";
$config['facebook_fanpage_link'] = "https://www.facebook.com/KazenoNekoStudio/";
$config['footer_credit'] = "KazenoNeko Studio";
?>
