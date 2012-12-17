<?php

namespace Sidus\Properties;

class Boolean extends GenericProperty {

	/**
	 * @see Sidus\Properties\PropertyInterface::set()
	 * @param boolean $value
	 * @return boolean
	 */
	public function set($value){
		try {
			$value = (boolean)$value;
		} catch(Exception $e){
			return false;
		}
		return parent::set($value);
	}

	/**
	 * @see Sidus\Properties\PropertyInterface::check()
	 * @param boolean $value
	 * @return boolean
	 */
	public function check($value){
		try {
			$value = (boolean)$value;
		} catch(Exception $e){
			return false;
		}
		return true;
	}

}

?>
