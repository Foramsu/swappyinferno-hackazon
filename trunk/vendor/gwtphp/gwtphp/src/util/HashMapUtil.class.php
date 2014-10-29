<?PHP
/*
 * GWTPHP is a port to PHP of the GWT RPC package.
 * 
 * <p>This framework is based on GWT (see {@link http://code.google.com/webtoolkit/ gwt-webtoolkit} for details).</p>
 * <p>Design, strategies and part of the methods documentation are developed by Google Team  </p>
 * 
 * <p>PHP port, extensions and modifications by Rafal M.Malinowski. All rights reserved.<br>
 * For more information, please see {@link http://gwtphp.sourceforge.com/}.</p>
 * 
 * 
 * <p>Licensed under the Apache License, Version 2.0 (the "License"); you may not
 * use this file except in compliance with the License. You may obtain a copy of
 * the License at</p>
 * 
 * {@link http://www.apache.org/licenses/LICENSE-2.0 http://www.apache.org/licenses/LICENSE-2.0}
 * 
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations under
 * the License.
 */

/*
 * GWTPHP is a port to PHP of the GWT RPC package.
 * 
 * <p>This framework is based on GWT (see {@link http://code.google.com/webtoolkit/ gwt-webtoolkit} for details).</p>
 * <p>Design, strategies and part of the methods documentation are developed by Google Team  </p>
 * 
 * <p>PHP port, extensions and modifications by Rafal M.Malinowski. All rights reserved.<br>
 * For more information, please see {@link http://gwtphp.sourceforge.com/}.</p>
 * 
 * 
 * <p>Licensed under the Apache License, Version 2.0 (the "License"); you may not
 * use this file except in compliance with the License. You may obtain a copy of
 * the License at</p>
 * 
 * {@link http://www.apache.org/licenses/LICENSE-2.0 http://www.apache.org/licenses/LICENSE-2.0}
 * 
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations under
 * the License.
 */

/**
 * @package gwtphp.util
 */

//TODO: marge this class with mapped java.lang.HashMap
/**
 * primitive implementation form java.lang.HashMap
 *
 */
class HashMapUtil {

	/**
	 * @var array
	 */
	protected  $keys = array();
	/**
	 * @var array
	 */
	protected $values = array();

	/**
	 *
	 * @param Object $key
	 * @param Object $value
	 */
	public function put($key,$value) {
		$this->keys[] = $key;
		$this->values[] = $value;
	}

	/**
	 * 
	 *
	 */
	public function clear() {
		$this->keys[] = array();
		$this->values[] = array();
	}

	/**
	 * 
	 *
	 * @return integer
	 */
	public function size() {
		return count($this->values);
	}

	/**
	 * 
	 *
	 * @param object $key
	 * @return object - if not found return null
	 */
	protected function getKeyIndex($key) {
		foreach ($this->keys as $keyIndex => $keyValue) {
			if ($keyValue === $key) 
				return $keyIndex;
		}
		return null;
	}
	/**
	 * 
	 *
	 * @param object $key
	 * @return object
	 */
	public function get($key) {
		return (($keyIndex = $this->getKeyIndex($key)) == null) ? null : $this->values[$keyIndex];
//		foreach ($this->keys as $keyIndex => $keyValue) {
//			if ($keyValue == $key) return $this->values[$keyIndex];
//		}
//		return null;
	}
	
	/**
	 * 
	 *
	 * @param Object $key
	 * @return boolean
	 */
	public function containsKey($key) {
		return (($keyIndex = $this->getKeyIndex($key)) == null) ? false : true;
	}


}

?>