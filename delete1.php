<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2016/9/2
 * Time: 14:36
 */

header('content-type:text/html;charset=utf-8');

$id = $_GET['id'];
echo $id;
require_once "function.php";
$DB = connectDB();

$sql = "DELETE FROM lostItems WHERE id = $id";
$result = $DB -> exec($sql);

$url = "index.php";
header("Refresh:4;url={$url}");