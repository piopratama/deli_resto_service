<?php
    require_once("coreClass/myObject.php");
    require_once("myClass/loginProcess.php");

    $data_input=json_decode(trim(file_get_contents('php://input')), true);

    $url="";

    if(count($data_input)>0)
    {

        foreach($data_input as $data)
        {
            if($data['ObjectID']=="url")
            {
                $url=$data['ObjectInJson'];
            }
        }

        if($url!="")
        {
            if($url=="login")
            {
                $username="";
                $password="";
                foreach($data_input as $data)
                {
                    if($data['ObjectID']=="username")
                    {
                        $username=$data['ObjectInJson'];
                    }

                    if($data['ObjectID']=="password")
                    {
                        $password=$data['ObjectInJson'];
                    }
                }

                $loginObject=new loginProcess();
                $resultLogin=$loginObject->checkLogin($username, $password, "tb_employee");

                $MyObject = new MyObjectInJson();
                $MyObject->ObjectID = 'key';
                $MyObject->ObjectInJson = $resultLogin;
            }
        }
        else
        {
            $MyObject = new MyObjectInJson();
            $MyObject->ObjectID = 'key';
            $MyObject->ObjectInJson = -1;
        }
    }
    else
    {
        $MyObject = new MyObjectInJson();
        $MyObject->ObjectID = 'key';
        $MyObject->ObjectInJson = -1;
    }

    echo json_encode($MyObject);
?>