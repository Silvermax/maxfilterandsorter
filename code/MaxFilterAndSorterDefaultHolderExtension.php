<?php
/**
 * Defines an ContentController extension which enables default  filter and sorter (based on PageTypes)
 * This is not probably usable, you should build your extensions if you need custom filtering and sorting solution
 * @package maxfilterandsorter
 * @author Pali Ondras
 */

class MaxFilterAndSorterDefaultHolderExtension extends Extension {
	
	function getMaxFilterAndSorterDataList() {
		return $this->owner->Children();
	}
	
	/*
	 * Filter
	*/
	function getMaxFilterField() {
		return "ClassName";
	}
	
	function getMaxFilterFilterId($value) {
		return "filter".Convert::raw2htmlatt($value);
	}
	
	function getMaxFilterFilterName($value) {
		return $value;
	}
	
	function getMaxFilter() {
		$items = $this->owner->getMaxFilterAndSorterDataList();
		if ($items->exists()) {
			$map = array_keys($items->map($this->owner->getMaxFilterField()));
			
			if (count($map) > 1) {
			
				$filters = new DataObjectSet(); 
				foreach($map as $value) {
					$filters->push(new ArrayData( array(
						 'FilterId' => $this->owner->getMaxFilterFilterId($value) , 
						 'FilterName' => $this->owner->getMaxFilterFilterName($value) 
					)));
				} 
			
				return $filters->renderWith(array("MaxFilter"));
				
			} 
			
		}	
	}
	
	function getMaxFilterPageFilterId($page) {
		$field = $this->owner->getMaxFilterField();
		return $this->owner->getMaxFilterFilterId($page->$field);
	}
	
	/*
	 * Sorter 
	 */
	function getMaxSorterFields() {
		return array(
			"Sort" => array(
				"type" => "numbers"
			),
			"Title" => array(),
			"Created" => array(
				"reversed" => "true"
			),
			"LastEdited"  => array(
				"reversed" => "true"
			)
		);
	}
	
	function getMaxSorter() {
		$map = $this->owner->getMaxSorterFields();
		if (is_array($map) && count($map) > 1) {
				
			$sorters = new DataObjectSet(); 
			foreach($map as $key => $value) {
				$config = "";
				foreach ($value as $c_key => $c_value) {
					$config .= " data-sorter".$c_key." = '".$c_value."' ";
				}
				
				$sorters->push(new ArrayData( array( 'SorterId' => $this->owner->getMaxSorterSorterId($key) , 'SorterName' => $this->owner->getMaxSorterSorterName($key), 'SorterConfig' => $config )));
			} 
			
			return $sorters->renderWith(array("MaxSorter"));
		}	
	}
	
	function getMaxSorterSorterId($value) {
		return "sorter".$value;
	}
	
	function getMaxSorterSorterName($value) {
		return _t("MaxSorter.SORTBY-".$value, $value);
	}
	
	function getMaxSorterPageSorterData($page) {
		$map = $this->owner->getMaxSorterFields();
		if (is_array($map) && count($map) > 1) {
			$output = "";
			foreach ($map as $key => $value) {
				$output .= '<span style="display: none" class="MaxSorterPageData" data-type="'.$this->owner->getMaxSorterSorterId($key).'">'.$page->$key.'</span>';
			}
		return $output;
		}
	}
	
	/*
	 * Init - call all needed JS
	 */
	function onAfterInit() {
		
		if ($this->owner->getMaxFilter()) {
			Requirements::javascript(THIRDPARTY_DIR . '/jquery/jquery.js');
			Requirements::javascript("maxfilterandsorter/javascript/jquery.cookie.js");
			Requirements::javascript("maxfilterandsorter/javascript/quicksand.js");
			Requirements::javascript("maxfilterandsorter/javascript/quicksand.sort.js");
			Requirements::javascript("maxfilterandsorter/javascript/quicksand.init.js");
		}
		
	}
		
}
