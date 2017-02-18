<?php

/**
 * Class Mysql
 */
class Mysql
{
	protected static $pdo;
    public static function _init()
    {
    	if (empty(self::$pdo))
    	{
    		self::$pdo = new PDO("mysql:host=127.0.0.1;dbname=hire;charset=utf8", "hire", "lfding");
    	}
    }
    public static function findOne($where, $table)
    {
    	if (is_array($where))
    	{
    		$whe = '';
    		foreach ($where as $key => $value) {
    			$whe .= $key . '=' . '\'' . $value . '\'' . ' AND '; 
    		}
            $whe .= '`quantity`!=0';
    	}
    	$sql = "SELECT * FROM $table WHERE $whe ORDER BY `create_time` asc";
    	$result = self::$pdo->query($sql);
    	$list = $result->fetch();
    	return $list;
    }
    public static function findAll($where, $table)
    {
        if (is_array($where))
        {
            $whe = '';
            foreach ($where as $key => $value) {
                $whe .= $key . '=' . '\'' . $value . '\'' . ' AND ';
            }
            $whe .= '`quantity`!=0';
        }
        $sql = "SELECT * FROM $table WHERE $whe ORDER BY `create_time` asc";
        $result = self::$pdo->query($sql);
        $list = $result->fetchAll();
        return $list;
    }
    public static function upDateOne($data, $where, $table)
    {
    	if (is_array($where))
    	{
    		$whe = '';
    		foreach ($where as $key => $value) {
    			$whe .= $key . '=' . '\'' . $value . '\'' . ' AND '; 
    		}
    		$whe = substr($whe, 0, -4);
    	}
    	if(is_array($data))
    	{
    		$up = '';
    		foreach ($data as $key => $value) {
    			$up .= $key . '=' . '\'' . $value . '\'' . ' , ';  
    		}
    		$up = substr($up, 0, -3);
    	}
    	$sql = "UPDATE $table SET $up WHERE $whe";
    	if (self::$pdo->exec($sql))
        {
            return true;
        }
        else
            {
                return false;
            }
    }

    public static function insertOne($data, $table)
    {
        $attr = '';
        $val = '';
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $attr .= $key. ',';
                if (!is_numeric($value)) {
                    $val .= '\''. $value. '\''. ',';
                } else {
                    $val .= $value. ',';
                }
            }
            $attr = substr($attr, 0, -1);
            $val = substr($val, 0, -1);
            $sql = 'INSERT INTO '. $table . '('. $attr.')'. 'VALUE'. '('. $val. ')';
//            var_dump($sql); exit;
            if (self::$pdo->exec($sql)) {
                return true;
            } else {
                return false;
            }
        }
    }

    public static function findDeal($bid_price)
    {
        $sql = 'SELECT * FROM `hire_order` WHERE `type`="ask" AND `quantity` != 0 AND `price`<='. $bid_price. ' ORDER BY `price` desc, `number` asc';
        $result = self::$pdo->query($sql);
        $list = $result->fetch();
        return $list;
    }
}
