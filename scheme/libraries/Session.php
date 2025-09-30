<?php
// ✅ Make sure walang whitespace or echo/HTML bago nito!

class Session {

	public $config = [];
	public $userdata = [];

	public function __construct($config = [])
	{
		$this->config = $config;

		// Start session configuration BEFORE sending output
		if (session_status() === PHP_SESSION_NONE) {
			// Example config array (you may already have this in your code)
			$this->config = isset($this->config) ? $this->config : [];

			// --- Set up cookie name ---
			if (empty($this->config['cookie_name'])) {
				$this->config['cookie_name'] = ini_get('session.name');
			} else {
				// ✅ Must set before session_start()
				ini_set('session.name', $this->config['cookie_name']);
			}

			// --- Set up session expiration ---
			if (empty($this->config['sess_expiration'])) {
				$this->config['sess_expiration'] = (int) ini_get('session.gc_maxlifetime');
			}
			ini_set('session.gc_maxlifetime', $this->config['sess_expiration']);

			// --- Set up cookie lifetime ---
			if (empty($this->config['cookie_lifetime'])) {
				$this->config['cookie_lifetime'] = 0; // session cookie
			}
			ini_set('session.cookie_lifetime', $this->config['cookie_lifetime']);

			// ✅ Finally, start the session safely
			session_start();

			//Set time before session updates
			$regenerate_time = (int) ($this->config['sess_time_to_update'] ?? 0);

			//Check for Ajax
			if ((empty($_SERVER['HTTP_X_REQUESTED_WITH']) OR strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest') AND ($regenerate_time > 0))
			{
				if (!isset($_SESSION['last_session_regenerate']))
				{
					$_SESSION['last_session_regenerate'] = time();
				} elseif ($_SESSION['last_session_regenerate'] < (time() - $regenerate_time)) {
					$this->sess_regenerate((bool) ($this->config['sess_regenerate_destroy'] ?? false));
				}
			} elseif (isset($_COOKIE[$this->config['cookie_name']]) AND $_COOKIE[$this->config['cookie_name']] === $this->session_id()){
				//Check for expiration time
				$expiration = empty($this->config['cookie_expiration']) ? 0 : time() + $this->config['cookie_expiration'];

				setcookie(
					$this->config['cookie_name'],
					$this->session_id(),
					array('samesite' => $this->config['cookie_samesite'] ?? 'Lax',
					'secure'   => $this->config['cookie_secure'] ?? false,
					'expires'  => $expiration,
					'path'     => $this->config['cookie_path'] ?? '/',
					'domain'   => $this->config['cookie_domain'] ?? '',
					'httponly' => $this->config['cookie_httponly'] ?? true,
					)
				);
			}

			$this->_lava_init_vars();
		}
	}

	/**
	 * Generates key as protection against Session Hijacking & Fixation. This
	 * works better than IP based checking for most sites due to constant user
	 * IP changes (although this method is not as secure as IP checks).
	 * @return string
	 */
	    public function generate_fingerprint()
	{
		//We don't use the ip-adress, because it is subject to change in most cases
		foreach(array('ACCEPT_CHARSET', 'ACCEPT_ENCODING', 'ACCEPT_LANGUAGE', 'USER_AGENT') as $name) {
			$key[] = empty($_SERVER['HTTP_'. $name]) ? NULL : $_SERVER['HTTP_'. $name];
		}
		//Create an MD5 has and return it
		return md5(implode("\0", $key));
	}


	protected function _lava_init_vars()
	{
		if ( ! empty($_SESSION['__lava_vars']))
		{
			$current_time = time();

			foreach ($_SESSION['__lava_vars'] as $key => &$value)
			{
				if ($value === 'new')
				{
					$_SESSION['__lava_vars'][$key] = 'old';
				}
				elseif ($value === 'old' || $value < $current_time)
				{
					unset($_SESSION[$key], $_SESSION['__lava_vars'][$key]);
				}
			}

			if (empty($_SESSION['__lava_vars']))
			{
				unset($_SESSION['__lava_vars']);
			}
		}

		$this->userdata =& $_SESSION;
	}

	/**
	 * SID length
	 *
	 * @return int SID length
	 */
	private function _get_sid_length()
	{
		$bits_per_character = (int) ini_get('session.sid_bits_per_character');
		$sid_length = (int) ini_get('session.sid_length');
		if (($bits = $sid_length * $bits_per_character) < 160)
			$sid_length += (int) ceil((160 % $bits) / $bits_per_character);
		return $sid_length;
	}

	/**
	 * Regenerate Session ID
	 *
	 * @param  bool FALSE by Default
	 * @return string    Session ID
	 */
	public function sess_regenerate($destroy = FALSE)
	{
		$_SESSION['last_session_regenerate'] = time();
		session_regenerate_id($destroy);
		return session_id();
	}

	/**
	 * Mark as Flash
	 *
	 * @param  string $key Session
	 * @return bool
	 */
	public function mark_as_flash($key)
	{
		if (is_array($key))
		{
			for ($i = 0, $c = count($key); $i < $c; $i++)
			{
				if ( ! isset($_SESSION[$key[$i]]))
				{
					return FALSE;
				}
			}

			$new = array_fill_keys($key, 'new');

			$_SESSION['__lava_vars'] = isset($_SESSION['__lava_vars'])
				? array_merge($_SESSION['__lava_vars'], $new)
				: $new;

			return TRUE;
		}

		if ( ! isset($_SESSION[$key]))
		{
			return FALSE;
		}

		$_SESSION['__lava_vars'][$key] = 'new';
		return TRUE;
	}

	/**
	 * Keep flash data
	 *
	 * @param mixed $key
	 * @return void
	 */
	public function keep_flashdata($key)
	{
		$this->mark_as_flash($key);
	}

   	/**
   	 * Return Session ID
   	 * @return string Session ID
   	 */
	public function session_id()
	{
		$seed = str_split('abcdefghijklmnopqrstuvwxyz0123456789');
        $rand_id = '';
        shuffle($seed);
        foreach (array_rand($seed, 32) as $k)
		{
            $rand_id .= $seed[$k];
        }
        return $rand_id;
	}

	/**
	 * Check if session variable has data
	 *
	 * @param  string $key Session
	 * @return boolean
	 */
	public function has_userdata($key = null)
	{
		if(! is_null($key))
		{
			if(isset($_SESSION[$key]))
			{
				return TRUE;
			}
		}
		return FALSE;
	}

	/**
	 * Set Data to Session Key
	 *
	 * @param array $keys array of Sessions
	 */
	public function set_userdata($keys, $value = NULL)
	{
		if(is_array($keys))
		{
			foreach($keys as $key => $val)
			{
				$_SESSION[$key] = $val;
			}
		} else {
			$_SESSION[$keys] = $value;
		}
	}

	/**
	 * Unset Session Data
	 *
	 * @param  array  $keys Array of Sessions
	 * @return void
	 */
	public function unset_userdata($keys)
	{
		if(is_array($keys))
		{
			foreach ($keys as $key)
			{
				if($this->has_userdata($key))
				{
					unset($_SESSION[$key]);
				}
			}
		} else {
			if($this->has_userdata($keys))
			{
				unset($_SESSION[$keys]);
			}
		}
	}

	/**
	 * Get Flash Keys
	 *
	 * @return mixed
	 */
	public function get_flash_keys()
	{
		if ( ! isset($_SESSION['__lava_vars']))
		{
			return array();
		}

		$keys = array();
		foreach (array_keys($_SESSION['__lava_vars']) as $key)
		{
			is_int($_SESSION['__lava_vars'][$key]) OR $keys[] = $key;
		}

		return $keys;
	}

	/**
	 * Unmark Flash keys
	 *
	 * @param mixed $key
	 * @return void
	 */
	public function unmark_flash($key)
	{
		if (empty($_SESSION['__ci_vars']))
		{
			return;
		}

		is_array($key) OR $key = array($key);

		foreach ($key as $k)
		{
			if (isset($_SESSION['__ci_vars'][$k]) && ! is_int($_SESSION['__ci_vars'][$k]))
			{
				unset($_SESSION['__ci_vars'][$k]);
			}
		}

		if (empty($_SESSION['__ci_vars']))
		{
			unset($_SESSION['__ci_vars']);
		}
	}

   	/**
   	 * Get specific session key value

   	 * @param  array $key Session Keys
   	 * @return string      Session Data
   	 */
	public function userdata($key = NULL)
	{
		if(isset($key))
		{
		if (is_array($key)) {
			$result = [];
			foreach ($key as $k) {
				if (is_int($k) || is_string($k)) {
					$result[$k] = isset($_SESSION[$k]) ? $_SESSION[$k] : NULL;
				}
			}
			return $result;
		} else {
			return (is_int($key) || is_string($key)) && isset($_SESSION[$key]) ? $_SESSION[$key] : NULL;
		}
		}
		elseif (empty($_SESSION))
		{
			return json_encode([]);
		}
		$userdata = array();
		$_exclude = array_merge(
			array('__lava_vars'),
			$this->get_flash_keys(),
		);

		foreach (array_keys($_SESSION) as $key)
		{
			if ( ! in_array($key, $_exclude, TRUE))
			{
				$userdata[$key] = $_SESSION[$key];
			}
		}

		// If $key is NULL, return all session data as a JSON string
		return json_encode($userdata);
	}

	/**
	 * Session Destroy
	 *
	 * @return void
	 */
	public function sess_destroy()
	{
		session_destroy();
	}

	/**
	 * Get flash data to Session
	 *
	 * @param  array $key Session Keys
	 * @return string      Session Data
	 */
	public function flashdata($key = NULL)
	{
		if (isset($key))
		{
			if ((is_int($key) || is_string($key)) && isset($_SESSION['__lava_vars'], $_SESSION['__lava_vars'][$key], $_SESSION[$key]) && !is_int($_SESSION['__lava_vars'][$key])) {
				return $_SESSION[$key];
			} else {
				return NULL;
			}
		}

		$flashdata = array();

		if ( ! empty($_SESSION['__lava_vars']))
		{
			foreach ($_SESSION['__lava_vars'] as $key => &$value)
			{
				is_int($value) OR $flashdata[$key] = $_SESSION[$key];
			}
		}

		return $flashdata;
	}

	/**
	 * Set flash data to Session
	 *
	 * @param  array $key Session Keys
	 * @return void
	 */
	public function set_flashdata($data, $value = NULL)
	{
		$this->set_userdata($data, $value);
		$this->mark_as_flash(is_array($data) ? array_keys($data) : $data);
	}
}

?>