<?
IF(Function_Exists("mysql_real_escape_string"))
	DEFINE("VA_REAL_ESCAPE", 1, 1);
ELSE
	DEFINE("VA_REAL_ESCAPE", 0, 1);

CLASS VA_MySQL {
	VAR $affected_rows;
	VAR $DB;
	VAR $mysql_queries;
	VAR $server_info;

//---------------------------------------------------------------------
	FUNCTION VA_MySQL($host, $user, $password, $database) {
		$this->DB = MySQL_Connect($host, $user, $password) OR Die(MySQL_Error());
		MySQL_Select_DB($database, $this->DB) OR Die(MySQL_Error());
		$this->mysql_queries += 2;
		$this->server_info = MySQL_Get_Server_info($this->DB);
		}
//---------------------------------------------------------------------
	FUNCTION Query($query) {
		$result = MySQL_Query($query, $this->DB) OR Die(VA_Message("MySQL Error #".MySQL_ErrNo()." :\n".MySQL_Error()."\n".$query, "bug"));
		$this->affected_rows = MySQL_Affected_Rows($this->DB);
		$this->mysql_queries++;

		RETURN NEW result($result);
		}
//---------------------------------------------------------------------
	FUNCTION Real_Escape_String($string) {
		IF(VA_REAL_ESCAPE)
			$string = MySQL_Real_Escape_String($string, $this->DB);
		ELSE
			$string = MySQL_Escape_String($string);

		RETURN $string;
		}
	}

CLASS result {
	VAR $num_rows;
	VAR $result;
	
	FUNCTION result($result) {
		$this->result = $result;
		$this->num_rows = @MySQL_Num_Rows($this->result);
		}
		
//---------------------------------------------------------------------
	FUNCTION Data_Seek($offset) {
		RETURN MySQL_Data_Seek($this->result, $offset);
		}
//---------------------------------------------------------------------
	FUNCTION Fetch_Assoc() {
		RETURN MySQL_Fetch_Assoc($this->result);
		}
//---------------------------------------------------------------------
	FUNCTION Fetch_Row() {
		RETURN MySQL_Fetch_Row($this->result);
		}
//---------------------------------------------------------------------
	FUNCTION Free_Result() {
		MySQL_Free_Result($this->result);
		}
	}
?>