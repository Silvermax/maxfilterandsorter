								<div id="MaxSorter" class="MaxFilterAndSorterButtons">
								<strong><% _t("MaxFilterAndSorter.SORTBY", "Sort by:") %></strong>
								<% control Me %>
										<a class="{$SorterId}" href="#" {$SorterConfig}>$SorterName</a>
								<% end_control %>
								</div>