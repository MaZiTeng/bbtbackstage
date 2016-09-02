<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2016/9/2
 * Time: 12:18
 */

define("MYSQL_HOST"    	,'localhost');
define("MYSQL_USER"		,'root');
define("MYSQL_PASS"		,'');
define("MYSQL_DBNAME"	,'bbtapp');


/**
 * 连接数据库
 * @return PDO
 */
function connectDB(){
    try{
        $DB=new PDO('mysql:host='.MYSQL_HOST.'; dbname='.MYSQL_DBNAME, MYSQL_USER , MYSQL_PASS);
        $DB->query("SET NAMES UTF8");
        return $DB;
    }catch(PDOException $e){
        return $e->getMessage();
    }
}


/**
 * @param $db
 * @return mixed
 */
function rows($db){
    $sql = "select count(id) from $db";
    $DB = connectDB();
    $qwe = $DB ->query($sql);
    $rows = $qwe ->fetch();
    $num = $rows[0];
    return $num;
}

/**
 * @param $tb
 * @param $limit
 * @param $data1
 * @param $data2
 * @param $data3
 * @param $data4
 * @param $data5
 * @param $data6
 * @param $data7
 * @param $data8
 * @param $data9
 * @param $data10
 * @param $data11
 * @param $data12
 * @return array|string
 */
function get_data($tb,$limit,$data1,$data2,$data3,$data4,$data5,$data6,$data7,$data8,$data9,$data10,$data11,$data12,$data13,$data14){
    try{
        $DB = connectDB();
        $sql="select * from $tb $limit";
        //$pdo->query($sql)，执行SQL语句，返回PDOStatement对象
        $stmt=$DB->query($sql);
        //var_dump($stmt);
        foreach($stmt as $row){
            $a = $row["$data1"];
            $b = $row["$data2"];
            $c = $row["$data3"];
            $d = $row["$data4"];
            $e = $row["$data5"];
            $f = $row["$data6"];
            $g = $row["$data7"];
            $h = $row["$data8"];
            $i = $row["$data9"];
            $j = $row["$data10"];
            $k = $row["$data11"];
            $l = $row["$data12"];
            $m = $row["$data13"];
            $n = $row["$data14"];
        }
        $query = array(
            'back1' => "$a",
            'back2' => "$b",
            'back3' => "$c",
            'back4' => "$d",
            'back5' => "$e",
            'back6' => "$f",
            'back7' => "$g",
            'back8' => "$h",
            'back9' => "$i",
            'back10' => "$j",
            'back11' => "$k",
            'back12' => "$l",
            'back13' => "$m",
            'back14' => "$n",
        );
        return $query;
    }catch(PDOException $e){
        return $e->getMessage();
    }
}
