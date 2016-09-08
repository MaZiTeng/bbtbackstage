<?php
define("MYSQL_HOST"    	, "localhost");
define("MYSQL_USER"	, "wechat");
define("MYSQL_PASS"	, "wechat@)!#");



if (!$_POST) {
    $_POST = $_GET;
    # code...
}
class SQL{
    public function init($table,$option=NULL)
    {
        $this->table = $table;

        $this->lineLists = array(
            "users"      => array("account","userName","sex","institution","className","password","userLogo","nickname"),
            "lostItems"  => array(/*modified needed for all*/"account","title","publisher","thumbnail","originalPicture","campus","location","type","phone","otherContact","date","details"),
            "pickItems"  => array("account","title","publisher","thumbnail","originalPicture","campus","location","type","phone","otherContact","date","details"),
            "schoolInformation"  => array("date","title","author","article","summary","picture"),
            "dailySoup" => array("date","title","author","article","summary","authorIntroduce"),
            "favouritedSoup"=> array("account","articleID","date"),
            "favouritedInformation"=> array("account","articleID","date"),
            "emptyroom"  => array("building","room","campus","period","date")
        );

        $authority = array(
            "users"     => "gdsm",
            "lostItems" => "gdsm",
            "pickItems" => "gdsm",
            "dailySoup" => "gdsm",
            "schoolInformation" => "gdsm",
            "favouritedSoup" => "gdsm",
            "favouritedInformation"=>"gdsm",
            "emptyroom" => "gdsm");
        $this->authority = $authority[$table];

        if($table == 'emptyroom')
            $this->db = "wechat";
        else
            $this->db = "bbtapp";
        $option = json_decode($option);

        $this->fuzzy = $option->fuzzy;
        $this->nofuzzy = $option->nofuzzy;
        $this->limit = $option->limit;

    }

    private function connectDB()
    {

        $DB=new PDO('mysql:host=localhost; dbname='.$this->db , MYSQL_USER , MYSQL_PASS);
        $DB->query("SET NAMES UTF8");
        return $DB;
    }

    public function get($data=null)
    {
        if(!strstr($this->authority,"g"))
            return json_encode(array("status" => 0, "error" => "authority denied"));

        if($data) $data = json_decode($data);
        $DB = $this->connectDB();
        $sql = "SELECT * FROM $this->table";
        $sql .= $this->restrictionSql($data);
        $res = $DB->query($sql);
        return json_encode($res->fetchAll());
    }

    public function delete($data)
    {
        if(!strstr($this->authority,"d"))
            return json_encode(array("status" => 0, "error" => "authority denied"));

        $data = json_decode($data);
        $DB = $this->connectDB();
        $sql = "DELETE FROM $this->table";
        $sql .= $this->restrictionSql($data);
        $column = $DB->exec($sql);
        if(!$column)
        {
            return json_encode(array("status" => 0));
        }else
        {
            return json_encode(array("status" => 1, "column" => $column));
        }
    }

    public function save($data)
    {
        if(!strstr($this->authority,"s"))
            return json_encode(array("status" => 0, "error" => "authority denied"));

        $DB = $this->connectDB();

        $dataArray = json_decode($data);

        $lineList = $this->lineLists[$this->table];


        $sql = "INSERT INTO $this->table (";

        foreach($lineList as $line){
            $sql .= "$line,";
        }
        $sql = rtrim($sql,",");
        $sql .= ") values (";

        foreach($lineList as $line){
            //echo $dataArray[$line];
            $sql .= ("'".$dataArray->$line."',");
        }
        $sql = rtrim($sql,",");
        $sql .= ")";

        $sql .= " ON DUPLICATE KEY UPDATE";
        foreach($dataArray as $key => $data){
            $sql .= " $key='$data',";
        }
        $sql = rtrim($sql,",");
        //echo $sql; //For test

        $column = $DB->exec($sql);
        if(!$column)
        {
            return json_encode(array("status" => 0));
        }else
        {
            return json_encode(array("status" => 1, "column" => $column));
        }
    }

    public function modify($data,$set)
    {
        if(!strstr($this->authority,"m"))
            return json_encode(array("status" => 0, "error" => "authority denied"));

        $data = json_decode($data);
        $set = json_decode($set);

        $DB = $this->connectDB();
        $sql = "UPDATE $this->table SET";

        foreach($set as $row => $value){
            $sql .= " $row='$value',";
        }
        $sql = rtrim($sql,",");
        //echo $sql; //For test

        $sql .= $this->restrictionSql($data);
        $column = $DB->exec($sql);
        if($DB->errorCode()!='00000')
        {
            return json_encode(array("status" => 0));
        }else
        {
            return json_encode(array("status" => 1, "column" => $column));
        }
    }

    private function restrictionSql($inputRestriction=null)
    {
        $sql = " WHERE 1";
        foreach($inputRestriction as $row => $restriction)
        {
            if($this->fuzzy == $row)
            {
                if(is_array($restriction))
                {
                    foreach($restriction as $each)
                        $sql .= " AND $this->fuzzy LIKE '%{$each}%'";
                }else
                {
                    $sql .= " AND $this->fuzzy LIKE '%{$restriction}%'";
                }
            }else
            {
                $sql .= " AND $row in (";
                if(is_array($restriction))
                {
                    foreach($restriction as $each)
                        $sql .= "'$each',";
                }else
                {
                    $sql .= "'$restriction',";
                }
                $sql = substr($sql, 0, -1);
                $sql .= ")";
            }
        }

        if($this->limit)
        {
            $sql .= " ORDER BY date DESC,id DESC";
            $sql .= " LIMIT {$this->limit[0]},{$this->limit[1]}";
        }
        return $sql;
    }
}

$handler = new SQL();
$handler->init($_POST['table'],$_POST['option']);
try
{
    echo call_user_func(array($handler, $_POST['method']), $_POST['data'],$_POST['set']);
} catch(Exception $e) {
    echo 0;
}
?>