<?php

namespace Sidus\Properties;

class Text extends GenericProperty {

	/**
	 * @see Sidus\Properties\PropertyInterface::get()
	 * @return string $value
	 */
	public function get(){
		return (string)$this->value;
	}
	
	/**
	 * @see Sidus\Properties\PropertyInterface::set()
	 * @param string $value
	 * @return boolean
	 */
	public function set($value){
		try{
			$value = (string)$value;
		} catch(Exception $e){
			return false;
		}
		return parent::set($value);
	}

	/**
	 * @see Sidus\Properties\PropertyInterface::check()
	 * @param string $value
	 * @return boolean
	 */
	public function check($value){
		try{
			$value = (string)$value;
		} catch(Exception $e){
			return false;
		}
		return true;
	}

	/**
	 * Escape the sting properly to display in HTML content
	 * @see Sidus\Properties\PropertyInterface::__toString()
	 * @return string $value
	 */
	public function __toString(){
		return htmlspecialchars($this->value);
	}
}
