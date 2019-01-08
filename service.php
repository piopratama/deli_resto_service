<?php
    class MyObjectInJson
    {
      public $ObjectID;
      public $ObjectInJson;
    }

    $MyObject = new MyObjectInJson();
    $MyObject->ObjectID = 'key';
    $MyObject->ObjectInJson = 1;

    echo json_encode($MyObject);
?>