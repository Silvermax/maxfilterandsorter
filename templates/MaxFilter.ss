								<div id="MaxFilter" class="MaxFilterAndSorterButtons">
								<strong><% _t("MaxFilterAndSorter.FILTERBY", "Filter by:") %></strong>
								<% control Me %>
										<a class="$FilterId" href="#">$FilterName</a>
										<% if Last %><a href="#" class="all"><% _t("MaxFilterAndSorter.ALL", "All") %></a><% end_if %> 
								<% end_control %>
								</div>