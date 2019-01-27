<?php
    require_once("coreClass/myObject.php");
    require_once("./coreClass/userObject.php");
    require_once("./coreClass/connection.php");

    class loginProcess
    {

        function checkLogin($username, $password, $table)
        {
            $columns=array('username','password','level','nama as name');

            $conditions=array(
                array('key'=>'username', 'operator'=>'=','value'=>"'".$username."'",'logic'=>'AND'),
                array('key'=>'password', 'operator'=>'=','value'=>"'".md5($password)."'",'logic'=>'')
            );

            $conn=new myConnection();
            $data_user=$conn->select($table, $columns, $conditions);

            if(count($data_user)>0)
            {
                if($data_user[0]['username']==$username && $data_user[0]['password']==md5($password))
                {
                    $MyObject[0] = new MyObjectInJson();
                    $MyObject[0]->ObjectID = 'key';
                    $MyObject[0]->ObjectInJson = 1;
                    $MyObject[1] = new MyObjectInJson();
                    $MyObject[1]->ObjectID = 'message';
                    $MyObject[1]->ObjectInJson = '';
                    $MyObject[2] = new MyObjectInJson();
                    $MyObject[2]->ObjectID = 'data';
                    $MyObject[2]->ObjectInJson = json_encode($data_user);
                    return $MyObject;
                }
                else
                {
                    $MyObject[0] = new MyObjectInJson();
                    $MyObject[0]->ObjectID = 'key';
                    $MyObject[0]->ObjectInJson = -1;
                    $MyObject[1] = new MyObjectInJson();
                    $MyObject[1]->ObjectID = 'message';
                    $MyObject[1]->ObjectInJson = 'username or password incorrect';
                    return  $MyObject;
                }
            }
            else
            {
                $MyObject[0] = new MyObjectInJson();
                $MyObject[0]->ObjectID = 'key';
                $MyObject[0]->ObjectInJson = -1;
                $MyObject[1] = new MyObjectInJson();
                $MyObject[1]->ObjectID = 'message';
                $MyObject[1]->ObjectInJson = 'username or password incorrect';
                return  $MyObject;
            }
        }
    }
?>