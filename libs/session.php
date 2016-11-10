<?php

class Session{

	public static function set($key, $value){
		$_SESSION[$key] = $value;
	}

	public static function get($key){
		if (isset($_SESSION[$key])) {
			return $_SESSION[$key];
		}else{
			return null;
		}
	}

	public static function delete($key){
		if (isset($_SESSION[$key])) {
			unset($_SESSION[$key]);
			return true;
		}else{
			return false;
		}
	}

	public static function destroy(){
		session_destroy();
	}
}