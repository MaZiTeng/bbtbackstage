<meta http-equiv="refresh" content="1;url=index.php" charset="UTF-8"/>
<?php
$id = $_GET['id'];
//echo $id;
if(is_numeric($id)) {        //判断id是否为数字


    $data = '{"ID":' . $id . '}';

    $url = 'http://218.192.166.167/api/protype.php';

    $post_data = array(
        'table' => 'lostItems',
        'method' => "delete",
        'data' => $data,
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    $return = curl_exec($ch);
    curl_close($ch);
    $array = json_decode($return, true);
    if ($array['status'] == 1) {
        echo '删除成功';
    } else {
        echo '删除失败';
    }


}else{
    echo "删除失败";
}
