<?php
/**
 * Defines an PagePlus_Controller extension which enables filter and sorter on PagePlus pages
 * @package maxfilterandsorter
 * @author Pali Ondras
 */

class MaxFilterAndSorterByTitleFirstLetterHolderExtension extends Extension {
	
	function getMaxFilterField() {
		return "Title";
	}
	
	function getMaxFilter() {
		$items = $this->owner->getMaxFilterData();
		if ($items->exists()) {
			$map = array_keys($items->map($this->owner->getMaxFilterField()));
			$letters = array();
			foreach ($map as $title) {
				$letters[strtolower($title[0])] = strtolower($title[0]);
			}
			
			sort($letters);
			
			if (count($letters) > 1) {
			
				$filters = new DataObjectSet(); 
				foreach($letters as $value) {
					$filters->push(new ArrayData( array(
						 'FilterId' => $this->owner->getMaxFilterFilterId($value) , 
						 'FilterName' => $this->owner->getMaxFilterFilterName($value) 
					)));
				} 
			
				return $filters->renderWith(array("MaxFilter"));
				
			} 
			
		}	
	}
	
	function getMaxFilterFilterId($value) {
		return "filter".Convert::raw2htmlatt(strtolower($value[0]));
	}
		
}
