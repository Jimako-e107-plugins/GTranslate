<?php
/*
* Copyright (c) e107 Inc e107.org, Licensed under GNU GPL (http://www.gnu.org/licenses/gpl.txt)
* $Id: e_shortcode.php 12438 2011-12-05 15:12:56Z secretr $
*
* Featurebox shortcode batch class - shortcodes available site-wide. ie. equivalent to multiple .sc files.
*/

if(!defined('e107_INIT'))
{
	exit;
}



class gtranslate_shortcodes extends e_shortcode
{
	public $override = false; // when set to true, existing core/plugin shortcodes matching methods below will be overridden. 

	// Example: {GTRANSLATE} shortcode - available site-wide.
	function sc_gtranslate($parm = null)  // Naming:  "sc_" + [plugin-directory] + '_uniquename'
	{
		return '
	 
		<div class="gtranslate_wrapper">
		</div>

 ';
	}

}
