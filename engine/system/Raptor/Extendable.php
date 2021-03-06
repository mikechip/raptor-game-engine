<?php
	/**
	 * Class provides dynamic function creating
	*/
	
	namespace Raptor;
	
	class Extendable
	{
		/**
		 * Array with dynamic functions
		 */
		protected $_functions = array();
		
		/** 
		 * Creates dynamic function. Notice that class instance will always be given in last argument of function and you can't use $this variable
		 * @param string $fname 
		 * @param callable $function
		 */
		public function addFunction($fname, $function)
		{
			if(!is_string($fname)) { throw new Exception("Function name must be string"); }
			if(!is_callable($function)) { throw new Exception("Function must be callable"); }
			if(isset($this->_functions[$fname])) { throw new Exception("Trying to rewrite function, aborting"); }
			
			$this->_functions[$fname] = $function; // add function
		}
		
		/** 
		 * Calls dynamic-created function
		 *
		 * @param string $f 
		 * @param array $args 
		 * @return mixed
		 */
		public function __call($f, $args)
		{
			if(isset($this->_functions[$f])) {
				$args[] = $this; // adds class instance as last argument of dynamic function 
				return call_user_func_array($this->_functions[$f], $args);
			}
			else {
				return NULL; // pardon - function doesnt exists
			}
		}
		
	}