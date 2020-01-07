<div class="calendar notices sidebar calendar-sidebar">

		<h2><a class="opener" href="#">Calendar events</a></h2>
		<ul class="children">
			<li id="sidebar-search">
				<div id="search-container">
        		<form method="post" id="event-search-form">
        		    <img id="ajax-loader" src="<?php echo content_url().'/themes/christchurchschool/assets/images/ajax-loader-2.gif'; ?>" />
        		    <label for="search_box">Search calendar</label>
        		    <input type="text" name="search" id="search_box" class="search_box"/>
        		    <input type="submit" value="Search" class="search_button" /><br />
        		</form>
        		</div>
        		<div>
        		<ul id="results" class="update">
        		</ul>
        </div>
			</li>
			<li id="todays-events">
				<a class="opener" href="<?php echo SITE_URL?>/ccgs-world-page/calendar">Today's events</a>
			</li>
			<li>
				<a href="<?php echo SITE_URL?>/ccgs-world-page/calendar">All calendar events</a>
			</li>
		</ul>
</div>
