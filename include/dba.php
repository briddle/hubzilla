<?php /** @file */

require_once('include/datetime.php');

/**
 *
 * MySQL database class
 *
 * For debugging, insert 'dbg(1);' anywhere in the program flow.
 * dbg(0); will turn it off. Logging is performed at LOGGER_DATA level.
 * When logging, all binary info is converted to text and html entities are escaped so that 
 * the debugging stream is safe to view within both terminals and web pages.
 *
 */
 
/*
class dba {

	private $debug = 0;
	private $db;
	public  $mysqli = true;
	public  $connected = false;
	public  $error = false;

	function __construct($server,$user,$pass,$db,$install = false) {

		$server = trim($server);
		$user = trim($user);
		$pass = trim($pass);
		$db = trim($db);

		if (!(strlen($server) && strlen($user))){
			$this->connected = false;
			$this->db = null;
			return;
		}

		if($install) {
			if(strlen($server) && ($server !== 'localhost') && ($server !== '127.0.0.1')) {
				if(! dns_get_record($server, DNS_A + DNS_CNAME + DNS_PTR)) {
					$this->error = sprintf( t('Cannot locate DNS info for database server \'%s\''), $server);
					$this->connected = false;
					$this->db = null;
					return;
				}
			}
		}

		if(class_exists('mysqli')) {
			$this->db = @new mysqli($server,$user,$pass,$db);
			if(! mysqli_connect_errno()) {
				$this->connected = true;
			}
		}
		else {
			$this->mysqli = false;
			$this->db = mysql_connect($server,$user,$pass);
			if($this->db && mysql_select_db($db,$this->db)) {
				$this->connected = true;
			}
		}
		if(! $this->connected) {
			$this->db = null;
			if(! $install)
				system_unavailable();
		}
	}

	public function getdb() {
		return $this->db;
	}

	public function q($sql) {
		global $a;

		if((! $this->db) || (! $this->connected))
			return false;

		$this->error = '';

		if(x($a->config,'system') && x($a->config['system'],'db_log'))
			$stamp1 = microtime(true);

		if($this->mysqli)
			$result = @$this->db->query($sql);
		else
			$result = @mysql_query($sql,$this->db);

		if(x($a->config,'system') && x($a->config['system'],'db_log')) {
			$stamp2 = microtime(true);
			$duration = round($stamp2-$stamp1, 3);
			if ($duration > $a->config["system"]["db_loglimit"]) {
				$backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
				@file_put_contents($a->config["system"]["db_log"], $duration."\t".
						basename($backtrace[1]["file"])."\t".
						$backtrace[1]["line"]."\t".$backtrace[2]["function"]."\t".
						substr($sql, 0, 2000)."\n", FILE_APPEND);
			}
		}

		if($this->mysqli) {
			if($this->db->errno)
				$this->error = $this->db->error;
		}
		elseif(mysql_errno($this->db))
				$this->error = mysql_error($this->db);

		if(strlen($this->error)) {
			logger('dba: ' . $this->error);
		}

		if($this->debug) {

			$mesg = '';

			if($result === false)
				$mesg = 'false';
			elseif($result === true)
				$mesg = 'true';
			else {
				if($this->mysqli)
					$mesg = $result->num_rows . ' results' . EOL;
    			else
					$mesg = mysql_num_rows($result) . ' results' . EOL;
			}

			$str =  'SQL = ' . printable($sql) . EOL . 'SQL returned ' . $mesg
				. (($this->error) ? ' error: ' . $this->error : '')
				. EOL;

			logger('dba: ' . $str );
		}
*/
		/**
		 * If dbfail.out exists, we will write any failed calls directly to it,
		 * regardless of any logging that may or may nor be in effect.
		 * These usually indicate SQL syntax errors that need to be resolved.
		 */
/*
		if($result === false) {
			logger('dba: ' . printable($sql) . ' returned false.' . "\n" . $this->error);
			if(file_exists('dbfail.out'))
				file_put_contents('dbfail.out', datetime_convert() . "\n" . printable($sql) . ' returned false' . "\n" . $this->error . "\n", FILE_APPEND);
		}

		if(($result === true) || ($result === false))
			return $result;

		$r = array();
		if($this->mysqli) {
			if($result->num_rows) {
				while($x = $result->fetch_array(MYSQLI_ASSOC))
					$r[] = $x;
				$result->free_result();
			}
		}
		else {
			if(mysql_num_rows($result)) {
				while($x = mysql_fetch_array($result, MYSQL_ASSOC))
					$r[] = $x;
				mysql_free_result($result);
			}
		}


		if($this->debug)
			logger('dba: ' . printable(print_r($r, true)));
		return($r);
	}

	public function dbg($dbg) {
		$this->debug = $dbg;
	}

	public function escape($str) {
		if($this->db && $this->connected) {
			if($this->mysqli)
				return @$this->db->real_escape_string($str);
			else
				return @mysql_real_escape_string($str,$this->db);
		}
	}

	function __destruct() {
		if ($this->db) 
			if($this->mysqli)
				$this->db->close();
			else
				mysql_close($this->db);
	}
}

*/
