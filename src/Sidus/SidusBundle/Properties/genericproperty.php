<?php

namespace Sidus\Properties;

use Sidus\Nodes\Permission;

class GenericProperty implements propertyInterface{

	/**
	 * The actual value of the property in PHP
	 * @var mixed
	 */
	protected $value;

	/**
	 * Define if property has changed (to update)
	 * @var boolean
	 */
	protected $has_changed = false;

	/**
	 * Table name in the database
	 * @var string
	 */
	protected $table_name;

	/**
	 * Column name of the table
	 * @var string
	 */
	protected $column_name;

	/**
	 * The PDO param used to bind the value to a prepared statement
	 * @var integer
	 */
	protected $pdo_param = \PDO::PARAM_STR;

	/**
	 * Model name of the property, the name that PHP will use to identify it
	 * @var string
	 */
	protected $model_name;

	/**
	 * The input object that allows user_input
	 * @var Input
	 */
	protected $input;

	/**
	 * Define if the user is authorized to modify the property
	 * @var boolean
	 */
	protected $read_only;

	/**
	 * The current node associated with the property
	 * @var Node
	 */
	protected $node;

	/**
	 * @see Sidus\Properties\PropertyInterface::__constructor()
	 * @see http://php.net/manual/en/pdo.constants.php Documentation for PDO Params
	 * @param Sidus\Nodes\Node $node
	 * @param boolean $read_only If the user is allowed to set the value
	 * @param string $table_name Table name of the property in the Database
	 * @param string $column_name Column name of the property in the Database
	 * @param integer $pdo_type The PDO param type of the value in the DB
	 * @param string $model_name If different from column name, the PHP name
	 */
	public function __construct(\Sidus\Nodes\Node $node, $table_name, $column_name, $read_only = true, $model_name = null){
		$this->node = $node;
		$this->table_name = (string)$table_name;
		$this->column_name = (string)$column_name;
		$this->read_only = (boolean)$read_only;
		$this->model_name = (string)($model_name ? $model_name : $column_name);
	}

	/**
	 * @see Sidus\Properties\PropertyInterface::get()
	 * @return mixed $value
	 */
	public function get(){
		return $this->value;
	}

	/**
	 * @see Sidus\Properties\PropertyInterface::set()
	 * @param mixed $value
	 * @return boolean
	 */
	public function set($value){
		if(!$this->canWrite()){
			return false;
		}
		if($value == $this->value){
			return true;
		}
		$this->value = $value;
		$this->has_changed = true;
		return true;
	}

	/**
	 * @see Sidus\Properties\PropertyInterface::hasChanged()
	 * @return boolean
	 */
	public function hasChanged(){
		return $this->has_changed;
	}

	/**
	 * @see Sidus\Properties\PropertyInterface::reset()
	 * @return boolean
	 */
	public function reset(){
		if(!$this->canWrite()){
			return false;
		}
		$this->has_changed = false;
		return true;
	}

	/**
	 * @see Sidus\Properties\PropertyInterface::toDB()
	 * @return string $value
	 */
	public function toDB(){
		return (string)$this->value;
	}

	/**
	 * @see Sidus\Properties\PropertyInterface::check()
	 * @param mixed $value
	 * @return boolean
	 */
	public function check($value){
		return true;
	}

	/**
	 * @see Sidus\Properties\PropertyInterface::__toString()
	 * @return string $value
	 */
	public function __toString(){
		return (string)$this->value;
	}

	/**
	 * @see Sidus\Properties\PropertyInterface::getTableName()
	 * @return string $table_name
	 */
	public function getTableName(){
		return $this->table_name;
	}

	/**
	 * @see Sidus\Properties\PropertyInterface::getColumnName()
	 * @return string $column_name
	 */
	public function getColumnName(){
		return $this->column_name;
	}

	/**
	 * @see Sidus\Properties\PropertyInterface::getFullColumnName()
	 * @return string ${$table_name.'.'.$column_name}
	 */
	public function getFullColumnName($separator = '.'){
		return $this->table_name.$separator.$this->column_name;
	}

	/**
	 * @see Sidus\Properties\PropertyInterface::getModelName()
	 * @return string $mode_name
	 */
	public function getModelName(){
		return $this->model_name;
	}

	/**
	 * @see Sidus\Properties\PropertyInterface::getPDOParam()
	 * @return string $value
	 */
	public function getPDOParam(){
		return $this->pdo_param;
	}

	/**
	 * @see Sidus\Properties\PropertyInterface::getInput()
	 * @return string $value
	 */
	public function getInput(){
		if(!$this->input){
			$this->input = new \Sidus\HTML\Input("n[{$this->node->id}][{$this->getModelName()}]", (string)$this);
		}
		return $this->input;
	}

	/**
	 * @see Sidus\Properties\PropertyInterface::setInput()
	 * @param \Sidus\HTML\Input $input
	 * @return boolean
	 */
	public function setInput(\HTML\Input $input){
		if($this->canWrite()){
			return false;
		}
		$this->input = $input;
		return true;
	}

	/**
	 * @see Sidus\Properties\PropertyInterface::canWrite()
	 * @return boolean
	 */
	public function canWrite(){
		return !$this->read_only;
	}

	/**
	 * Get the node associated to the property
	 * @return Sidus\Nodes\Node
	 */
	public function getNode(){
		return $this->node;
	}

}