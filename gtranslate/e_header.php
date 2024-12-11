<?php
/*
 * e107 website system
 *
 * Copyright (C) 2008-2014 e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 * Related configuration module - News
 *
 *
*/

if (!defined('e107_INIT'))
{
	exit;
}

$data = e107::pref('gtranslate');

if (deftrue('USER_AREA'))
{


	$widget_short_name = $data['widget_look'];
	$target_lang = $data['target_lang'];
	$lang_string = array_keys($target_lang);

	$alt_flags = array();

	$raw_alt_flags = $data['alt_flags'];
	foreach ($raw_alt_flags as $country_code => $value)
	{

		switch ($country_code)
		{
			case 'us':
				$alt_flags['en'] = 'usa';
				break;
			case 'ca':
				$alt_flags['en'] = 'canada';
				break;
			case 'br':
				$alt_flags['pt'] = 'brazil';
				break;
			case 'mx':
				$alt_flags['es'] = 'mexico';
				break;
			case 'ar':
				$alt_flags['es'] = 'argentina';
				break;
			case 'co':
				$alt_flags['es'] = 'colombia';
				break;
			case 'qc':
				$alt_flags['fr'] = 'quebec';
				break;
			default:
				break;
		}
	}


	/* todo behaviour */


	if (strpos($data['widget_look'], '_') !== false)
	{
		$widget_short_name = explode('_', $data['widget_look']);
		foreach ($widget_short_name as $i => $segment)
			$widget_short_name[$i] = substr($segment, 0, 1);
		$widget_short_name = implode('', $widget_short_name);
	}
	else
	{
		$widget_short_name = $data['widget_look'];
	}



	if ($data['color_scheme'] == "dark")
	{
		$data['switcher_text_color'] = '#f7f7f7';
		$data['switcher_arrow_color'] = '#f2f2f2';
		$data['switcher_border_color'] = '#161616';
		$data['switcher_background_color'] = '#303030';
		$data['switcher_background_shadow_color'] = '#474747';
		$data['switcher_background_hover_color'] = '#3a3a3a';
		$data['dropdown_text_color'] = '#eaeaea';
		$data['dropdown_hover_color'] = '#748393';
		$data['dropdown_background_color'] = '#474747';
	}
	else
	{
		$data['switcher_text_color'] = '#666';
		$data['switcher_arrow_color'] = '#666';
		$data['switcher_border_color'] = '#ccc';
		$data['switcher_background_color'] = '#fff';
		$data['switcher_background_shadow_color'] = '#efefef';
		$data['switcher_background_hover_color'] = '#f0f0f0';
		$data['dropdown_text_color'] = '#000';
		$data['dropdown_hover_color'] = '#fff';
		$data['dropdown_background_color'] = '#eee';
	}


	$gt_settings = array(
		'default_language' => CORE_LC,
		'languages' => $lang_string,
		'alt_flags' => $alt_flags,
	    'dropdown_languages' => $lang_string,
		//'url_structure' => "none",
		'wrapper_selector' => ".gtranslate_wrapper",
		'globe_size' => $data['globe_size'],
		'globe_color' => $data['globe_color'],
		'flag_size' => $data['flag_size'],
		'flag_style' => $data['flag_style'],
		'custom_domains' => $data['custom_domains'] ? $data['custom_domains_data'] : null,
		'float_switcher_open_direction' => $data['float_switcher_open_direction'],
		'switcher_open_direction' => $data['switcher_open_direction'],
		'native_language_names' => (int) $data['native_language_names'],
		'detect_browser_language' => (int) $data['detect_browser_language'],
		'add_new_line' => (int) $data['add_new_line'],
		'select_language_label' => $data['select_language_label'],
		'custom_css' => $data['custom_css'],
		'switcher_text_color' => $data['switcher_text_color'],
		'switcher_arrow_color' => $data['switcher_arrow_color'],
		'switcher_border_color' => $data['switcher_border_color'],
		'switcher_background_color' => $data['switcher_background_color'],
		'switcher_background_shadow_color' => $data['switcher_background_shadow_color'],
		'switcher_background_hover_color' => $data['switcher_background_hover_color'],
		'dropdown_text_color' => $data['dropdown_text_color'],
		'dropdown_hover_color' => $data['dropdown_hover_color'],
		'dropdown_background_color' => $data['dropdown_background_color'],
	);

	if ($data['widget_look'] == 'globe')
	{
		$gt_settings['flags_location'] = e_PLUGIN_ABS . "gtranslate/flags/svg/";
	}
	else {
		$gt_settings['flags_location'] = e_PLUGIN_ABS . "gtranslate/flags/";
	}


	/*** position ***/
	$float_position = $data['float_position'];
	$position = $data['position'];
	if ($float_position == 'inline')
	{
		$switcher_horizontal_position = 'inline';
		$switcher_vertical_position = '';
	}
	else
		list($switcher_vertical_position, $switcher_horizontal_position) = explode('_', $float_position);
	$gt_settings['switcher_horizontal_position'] = $switcher_horizontal_position;
	$gt_settings['switcher_vertical_position'] = $switcher_vertical_position;

	if ($position == 'inline')
	{
		$horizontal_position = 'inline';
		$vertical_position = '';
	}
	else
		list($vertical_position, $horizontal_position) = explode('_', $position);
	$gt_settings['horizontal_position'] = $horizontal_position;
	$gt_settings['vertical_position'] = $vertical_position;

	/*** end of position ***/
 
	$settings = json_encode($gt_settings);
 
	$inline = " 
	  window.gtranslateSettings = " . $settings;

	e107::js('inline', $inline);

	if ($data['enable_cdn'])
	{
		header('Link: <https://cdn.gtranslate.net/>; rel=dns-prefetch', false);

		e107::js('footer', 'https://cdn.gtranslate.net/widgets/latest/' . $widget_short_name . '.js');
	}
	else
	{
		e107::js('footer',  e_PLUGIN . 'gtranslate/js/' . $widget_short_name . '.js');
	}
}
