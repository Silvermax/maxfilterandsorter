	
		// default page load, prepare everything. if cookies set, change it to stored selection
		jQuery(function(){		
		jQuery(document).ready(function() { 
			// default sort class is first sort link   
			var defaultSortClass = $('#MaxSorter a:first').attr("class");
			
			// element containing all items, must be first parent of filtered/sorted items
			$clientsHolder = $("#MaxFilterAndSorter");
			$clientsClone = $clientsHolder.clone(); 
			
			// any filter/sorter selected before? use it...
			if ($.cookie("filterClass") || $.cookie("sortClass")) {
				var go = false;
				if ($.cookie("filterClass") && $.cookie("filterClass") != "all" && $.cookie("filterClass") != "xall") {
					$('#MaxFilter a.active').removeClass('active');
					$('#MaxFilter a.' + $.cookie("filterClass")).addClass('active');
					go = true; 
				}
				if ($.cookie("sortClass") && $.cookie("sortClass") != defaultSortClass) {
					$('#MaxSorter a.active').removeClass('active');
					$('#MaxSorter a.' + $.cookie("sortClass")).addClass('active');
					go = true;
				}
				if (!$('#MaxSorter a.active').length > 0) {
					$('#MaxSorter a:first').addClass("active")
				}
				if (!$('#MaxFilter a.active').length > 0) {
					$('#MaxFilter a.all').addClass("active")
				}
				if (go) {
					 $.applyFilter();
				}
			}
			 
			$("#MaxFilter a, #MaxSorter a").click(function(e) {
			    e.preventDefault();
			 	
					if (!$(this).hasClass("active")) {
					 	$("#MaxFilter a").removeClass("active");
					 	if ($(this).hasClass("xall")) {
					 		$("#MaxFilter a.all").addClass("active");
					 	} else {
					 		$(this).addClass("active");
					 	}
					    $.applyFilter();
				    }	
			});
		});
		});
		
		// Apply filter
		jQuery.applyFilter = function() {
			
					/* 
					 * Filter section 
					 */
					$filterActive = $("#MaxFilter a.active").toggleClass("active");
				    $filterClass = $filterActive.attr("class");
				    $filterActive.toggleClass("active");
				    $.cookie("filterClass",$filterClass);
				 
				    if($filterClass == "all" || $filterClass === undefined){			 
				        $filters = $clientsClone.find(".MaxFilterItem");
				    } else {
				        $filters = $clientsClone.find(".MaxFilterItem[data-type~="+ $filterClass +"]");
				    }
					
					/* 
					 * Sorter section 
					 */
					$sortActive = $("#MaxSorter a.active");
					  
					if ($sortActive.length > 0) {
					    	
					    $sortActive.toggleClass("active");
					    $sortClass = $sortActive.attr("class");
						$sortActive.toggleClass("active");
						$.cookie("sortClass",$sortClass);
					    	
					    var $sorterreversed = $sortActive.attr("data-sorterreversed");
					    if ($sorterreversed == "true") {$sorterreversed = true;} else {$sorterreversed = false;}
					    	
					    var $sortertype = $sortActive.attr("data-sortertype");
					    
					    if ($sortertype == "numbers") {
					    	var $sortedData = $filters.sorted({
						   		reversed: $sorterreversed,
						       	by: function(v) {return parseFloat($(v).find('span[data-type='+$sortClass+']').text()); }
						   	});
					    } else {
					    	var $sortedData = $filters.sorted({
						   		reversed: $sorterreversed,
						       	by: function(v) {return $(v).find('span[data-type='+$sortClass+']').text().toLowerCase(); }
							});
					    }
					} else {
						var $sortedData = $filters;
					}
				   
				   /* 
				    * Quicksand init 
				    */
				    $clientsHolder.quicksand($sortedData, {
				        duration: 1000,
				        adjustHeight: 'auto',
				        useScaling: 'false'
				    });
		  };