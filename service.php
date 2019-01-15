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
                $MyObject=$loginObject->checkLogin($username, $password, "tb_employee");
            }
        }
        else
        {
            $MyObject[0] = new MyObjectInJson();
            $MyObject[0]->ObjectID = 'key';
            $MyObject[0]->ObjectInJson = -1;
            $MyObject[1] = new MyObjectInJson();
            $MyObject[1]->ObjectID = 'message';
            $MyObject[1]->ObjectInJson = 'no url parameter matched';
        }
    }
    else
    {
        $MyObject[0] = new MyObjectInJson();
        $MyObject[0]->ObjectID = 'key';
        $MyObject[0]->ObjectInJson = -1;
        $MyObject[1] = new MyObjectInJson();
        $MyObject[1]->ObjectID = 'message';
        $MyObject[1]->ObjectInJson = 'no parameter passed';
    }

    echo json_encode($MyObject);
?>