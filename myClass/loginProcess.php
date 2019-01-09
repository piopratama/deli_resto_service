<?php
    require_once("./coreClass/connection.php");

    class loginProcess
    {

        function checkLogin($username, $password, $table)
        {
            $columns=array('count(*)');

            $conditions=array(
                array('key'=>'username', 'operator'=>'=','value'=>"'".$username."'",'logic'=>'AND'),
                array('key'=>'password', 'operator'=>'=','value'=>"'".md5($password)."'",'logic'=>'')
            );

            $conn=new myConnection();
            if(count($conn->select($table, $columns, $conditions))>0)
            {
                return count($conn->select($table, $columns, $conditions));
            }
            else
            {
                return count($conn->select($table, $columns, $conditions));
            }
        }
    }
?>