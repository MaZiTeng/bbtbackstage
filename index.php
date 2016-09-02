<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2016/9/2
 * Time: 12:24
 */
header('content-type:text/html;charset=utf-8');

require_once "function.php";

echo "<h1>lostItems</h1>";
$num = rows('lostItems');
$i = 0;
if($num != 0) {
    do {

        @$q = get_data("lostItems", "", "ID", "title", "publisher", "account", "thumbnail",
            "originalPicture", "campus", "location", "type", "phone", "otherContact", "date", "details");
        $id = $q['back1'];
        echo 'title：' . $q['back2'], '<br/>';
        echo 'publisher：' . $q['back3'], '<br/>';
        echo 'account：' . $q['back4'], '<br/>';
        echo 'thumbnail：' . $q['back5'], '<br/>';
        echo 'originalPicture：' . $q['back6'], '<br/>';
        echo 'campus：' . $q['back7'], '<br/>';
        echo 'location：' . $q['back8'], '<br/>';
        echo 'type：' . $q['back9'], '<br/>';
        echo 'phone：' . $q['back10'], '<br/>';
        echo 'otherContact：' . $q['back11'], '<br/>';
        echo 'date：' . $q['back12'], '<br/>';
        echo 'details：' . $q['back13'], '<br/>';
        echo "<a href='delete1.php?id=$id'>删除此条</a>";
        echo '<hr/>';
        $i++;
    } while ($i < $num);
}else{
    echo "<h1>无</h1>";
}




echo "<h1>pickItems</h1>";
$num = rows('pickItems');
$i = 0;
if($num != 0) {
    do {

        @$q = get_data("pickItems", "", "ID", "title", "publisher", "account", "thumbnail",
            "originalPicture", "campus", "location", "type", "phone", "otherContact", "date", "details");
        $id = $q['back1'];
        echo 'title：' . $q['back2'], '<br/>';
        echo 'publisher：' . $q['back3'], '<br/>';
        echo 'account：' . $q['back4'], '<br/>';
        echo 'thumbnail：' . $q['back5'], '<br/>';
        echo 'originalPicture：' . $q['back6'], '<br/>';
        echo 'campus：' . $q['back7'], '<br/>';
        echo 'location：' . $q['back8'], '<br/>';
        echo 'type：' . $q['back9'], '<br/>';
        echo 'phone：' . $q['back10'], '<br/>';
        echo 'otherContact：' . $q['back11'], '<br/>';
        echo 'date：' . $q['back12'], '<br/>';
        echo 'details：' . $q['back13'], '<br/>';
        echo "<a href='delete2.php?id=$id'>删除此条</a>";
        echo '<hr/>';
        $i++;
    } while ($i < $num);
}else{
    echo "<h1>无</h1>";
}
