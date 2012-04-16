<% if MaxFilterAndSorterDataList %>
<% require themedCSS(MaxFilterAndSorter) %>
<% require themedCSS(customMaxFilterAndSorter) %>
<div id="ChildrenList">	
	<div class="MaxFilterAndSorterButtonsWrapper">
		$MaxFilter
		$MaxSorter
	</div>
	<div id="MaxFilterAndSorter" class="MaxFilterAndSorterDataList"> 		
            <% control MaxFilterAndSorterDataList %>
            	<div class="ChildrenItem MaxFilterItem" data-id="$ID" data-type="$MaxFilterId">
            		<div class="ChildrenItemContent"> 
	            		$MaxSorterPageData
	                    <h2><a href="$Link" title="$Title.XML" class="$LinkingMode">$MenuTitle.XML</a></h2>
	                    <p>
		                    <% if Content %>
		                    	$Content.FirstParagraph
		                    	<br />
		                    <% end_if %>
		                    	<a href="$Link" title="$Title.XML"><% _t("Page.READMORE", "Read more") %></a>
	                    </p>
	                  </div>
                  </div>
            <% end_control %>
	</div>
 </div>
 <% end_if %>