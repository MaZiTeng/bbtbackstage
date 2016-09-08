<?php
header('content-type:text/html;charset=utf-8');
/**
function($id){
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
}
////////////////////////////////////////////////////////////////////////////////

**/

echo "<h1>lostItems</h1>";



 $data = '';
 $url = 'http://218.192.166.167/api/protype.php';

 $post_data = array(
     'table' => 'lostItems',
     'method' => "get",
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



foreach ($array as $q){
    echo 'title：' . $q['title'], '<br/>';
    echo 'publisher：' . $q['publisher'], '<br/>';
    echo 'account：' . $q['account'], '<br/>';
    echo 'thumbnail：' . $q['thumbnail'], '<br/>';
    echo 'originalPicture：' . $q['originalPicture'], '<br/>';
    echo 'campus：' . $q['campus'], '<br/>';
    echo 'location：' . $q['location'], '<br/>';
    echo 'type：' . $q['type'], '<br/>';
    echo 'phone：' . $q['phone'], '<br/>';
    echo 'otherContact：' . $q['otherContact'], '<br/>';
    echo 'date：' . $q['date'], '<br/>';
    echo 'details：' . $q['details'], '<br/>';
    $id = $q['ID'];
    echo "<a href='delete1.php?id=$id'>删除此条</a>";
    echo '<hr/>';
    
    
    
//    var_dump($q['ID']);
}



//////////////////////////////////////////////////////////////////////////
echo "<h1>pickItems</h1>";



$data = '';
$url = 'http://218.192.166.167/api/protype.php';

$post_data = array(
    'table' => 'pickItems',
    'method' => "get",
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



foreach ($array as $q){
    echo 'title：' . $q['title'], '<br/>';
    echo 'publisher：' . $q['publisher'], '<br/>';
    echo 'account：' . $q['account'], '<br/>';
    echo 'thumbnail：' . $q['thumbnail'], '<br/>';
    echo 'originalPicture：' . $q['originalPicture'], '<br/>';
    echo 'campus：' . $q['campus'], '<br/>';
    echo 'location：' . $q['location'], '<br/>';
    echo 'type：' . $q['type'], '<br/>';
    echo 'phone：' . $q['phone'], '<br/>';
    echo 'otherContact：' . $q['otherContact'], '<br/>';
    echo 'date：' . $q['date'], '<br/>';
    echo 'details：' . $q['details'], '<br/>';
    $id = $q['ID'];
    echo "<a href='delete2.php?id=$id'>删除此条</a>";
    echo '<hr/>';
}

