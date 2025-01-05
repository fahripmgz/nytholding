<?php
function _RunSQL($sql)
{
	$q=mysql_query($sql);
	return $q;	
}

function _isBOF($table,$where,$value)
{
	$q=mysql_query("Select * from ".$table." where ".$where."='".$value."'");
	$c=mysql_num_rows($q);
	if($c==0)
	{
		return false;
	}else{
		return true;
	}
}

function _comboData($sql,$f_value,$f_output,$nameselect)
{
	echo '
	<select name="'.$nameselect.'">';
	$q=mysql_query($sql);
	while($r=mysql_fetch_array($q))
	{
		echo '<option value="'.$r[$f_value].'">'.$r[$f_output].'</option>';
	}
echo '
</select>';	
}

function _insert($table,$field,$value)
{
	$q=mysql_query("Insert into ".$table." (".$field.") values ('".$value."')");
	return $q;
}

function _insertmulti($table,$keyValue){ 
    if(is_array($keyValue)){
        foreach($keyValue as $key => $value){
            $fields[] = '`'.$key.'`';
            $values[] = ':'.$key;
        }

        $s='('.implode(' , ',$fields).') VALUES '.'('.implode(' , ',$values).')';
		$q=mysql_query("Insert into ".$table." ".$s);
		return $q;
    }
    return '';
}

function _getautoinc($table)
{
	$result = mysql_query("SHOW TABLE STATUS LIKE '".$table."'");
	$row = mysql_fetch_array($result);
	$nextId = $row['Auto_increment'];
	return $nextId;
}

function _getvalue($table,$field,$where,$output)
{
	$result = mysql_query("Select * from ".$table." Where ".$field."='".$where."'");
	$row = mysql_fetch_array($result);
	$nextId = $row[$output];
	return $nextId;
}
?>

