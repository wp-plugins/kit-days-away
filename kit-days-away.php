<?php
/*
Plugin Name: Days Away
Plugin URI: http://kiwi-it.co.uk/?page_id=437
Description: Displays the number of days until/after a specified date.  Example: [kit-days-away day=25 month=12 year=2012]
Version: 1.2.2
Author: Steve Mosen
Author URI: http://kiwi-it.co.uk
License: GPL2

Copyright 2012 Steve Mosen (email: Steve.Mosen@Kiwi-IT.co.uk)

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
		'day' 		=> date("j"),
		'month'		=> date("n"),
		'year'		=> date("Y"),
		'before'	=> "Event occurs",
		'after'		=> "Event occurred",
		'today'		=> "Event occurs today!"
	), $atts ) );

	$diff = round((mktime(0, 0, 0, date("n"), date("j"), date("Y")) - mktime(0, 0, 0, $month, $day, $year)) / (60*60*24));

	if ( 0 == $diff ) {
		$result = $today;
	}
	elseif ( 0 > $diff ) {
		if (  $before != "" ) {
			if ( -1 == $diff ) {
				$result = $before . " tommorrow";
			}
			else {
				$result = $before . " in " . absint($diff) . " days";
			}
		}
	}
	elseif ( 0 < $diff ) {
		if ( $after != "" ) {
			if ( 1 == $diff ) {
				$result = $after . " yesterday";
			}
			else {
				$result = $after . " " . round($diff) . " days ago";
			}
		}
	}

	return $result;
}
add_shortcode( 'kit-days-away', 'kit_days_away' );

?>