<?php
	class myConnection
	{
		var $servername = "localhost";
		var $username = "root";
		var $password = "";
		var $dbname = "db_restaurant";
		var $conn=null;

		function __construct()
		{
			// Create connection
			$this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
			// Check connection
			if ($this->conn->connect_error) {
				die("Connection failed: " . $this->conn->connect_error);
			}
		}

		function removeWhiteSpace($text)
		{
			$text = preg_replace('/[\t\n\r\0\x0B]/', '', $text);
			$text = preg_replace('/([\s])\1+/', ' ', $text);
			$text = trim($text);
			return $text;
		}

		function arrayToStringCondition($conditions)
		{
			$sql_where="";
			$logic_operator="";
			foreach($conditions as $condition)
			{
				if($sql_where=="")
				{
					$sql_where=$condition['key']." ".$condition['operator']." ".$condition['value'];
					$logic_operator=$condition['logic'];
				}
				else
				{
					$sql_where=$sql_where." ".$logic_operator." ".$condition['key']." ".$condition['operator']." ".$condition['value'];
					$logic_operator=$condition['logic'];
				}
			}

			return "where ".$this->removeWhiteSpace($sql_where);
		}

		function arrayToStringColumn($columns)
		{
			$sql_column="";
			foreach($columns as $column)
			{
				if($sql_column=="")
				{
					$sql_column=$column;
				}
				else
				{
					$sql_column=$sql_column.", ".$column;
				}
			}

			return $this->removeWhiteSpace($sql_column);
		}

		function errorMessage($class, $method, $sql, $description)
		{
			return "Class: ".$class."<br>Method: ".$method."<br>SQL: ".$sql."<br>Description: ".$description;
		}
		
		function select($table, $columns, $conditions)
		{
			try
			{
				$sql="SELECT ".$this->arrayToStringColumn($columns)." FROM ".$table." ".$this->arrayToStringCondition($conditions).";";
				
				if($raw_data=mysqli_query($this->conn, $sql))
				{
					return $raw_data->fetch_all(MYSQLI_ASSOC);
				}
				else
				{
					return $this->errorMessage(get_class($this), __METHOD__, $sql, mysqli_error($this->conn));
				}
			}
			catch(Exception $e)
			{
				echo 'Message: ' .$e->getMessage();
			}
			//$sql = mysqli_query($this->conn, "SELECT * FROM ".$table_name." where username='$usernamed';");
		}


	}
?>