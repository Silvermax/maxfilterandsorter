<?php

class MaxFilterAndSorterDefaultPageDecorator extends DataObjectDecorator {
	
	function getMaxFilterId() {
		$controller = Controller::curr();
		return $controller->getMaxFilterPageFilterId($this->owner);
	}
	
	function getMaxSorterPageData() {
		$controller = Controller::curr();
		return $controller->getMaxSorterPageSorterData($this->owner);
	}
	
}
