<?php
    require_once("coreClass/myObject.php");
    require_once("./coreClass/userObject.php");
    require_once("./coreClass/connection.php");

    class registrasiProcess{
        public function insertRegistrasi($table, $data)
        {
            $columns=array('kategori','description');

            $conn=new myConnection();
            $data_user=$conn->insert($table, $columns, $data);
        }
    }
?>