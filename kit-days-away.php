<?php
/*
Plugin Name: Kiwi IT - Days Away
Plugin URI: http://kiwi-it.co.uk/?page_id=437
Description: Displays the number of days until/after a specified date.  Example: [kit-days-away day=25 month=12 year=2012]
Version: 1.0
Author: Steve Mosen
Author URI: http://kiwi-it.co.uk
License: GPL2

Copyright 2012  Steve Mosen  (email : Steve.Mosen@Kiwi-IT.co.uk)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

function kit_days_away( $atts ) {
	extract( shortcode_atts( array(
		'day' 		=> 1,
		'month'		=> 1,
		'year'		=> 1960,
		'offset'	=> 0,
		'before'	=> "Event occurs",
		'after'		=> "Event occurred",
		'today'		=> ""
	), $atts ) );

	$days = (int)((time(void) + ($offset * 3600) - mktime(0, 0, 0, $month, $day, $year)) / 86400);

	if ( $days < 0  && $before != "" ) {
		$result = $before . " in " . absint($days) . " days";
	}
	elseif ( $days > 0 && $after != "" ) {
		$result = $after . " " . $days . " days ago";
	}
	elseif ( 0 == $days ) {
		$result = $today;
	}

	return $result;
}
add_shortcode( 'kit-days-away', 'kit_days_away' );

?>