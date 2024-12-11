<?php

// Generated e107 Plugin Admin Area 

require_once('../../class2.php');
if (!getperms('P'))
{
	e107::redirect('admin');
	exit;
}

e107::lan('gtranslate', true);


class gtranslate_adminArea extends e_admin_dispatcher
{

	protected $modes = array(

		'main'	=> array(
			'controller' 	=> 'gtranslate_ui',
			'path' 			=> null,
			'ui' 			=> 'gtranslate_form_ui',
			'uipath' 		=> null
		),


	);


	protected $adminMenu = array(

		'main/prefs' 		=> array('caption' => LAN_PREFS, 'perm' => 'P'),

		// 'main/div0'      => array('divider'=> true),
		// 'main/custom'		=> array('caption'=> 'Custom Page', 'perm' => 'P'),

	);

	protected $adminMenuAliases = array(
		'main/edit'	=> 'main/list'
	);

	protected $menuTitle = 'GTranslate';
}





class gtranslate_ui extends e_admin_ui
{

	protected $pluginTitle		= GTRANSLATE_012;
	protected $pluginName		= 'gtranslate';
	//	protected $eventName		= 'gtranslate-'; // remove comment to enable event triggers in admin. 		
	protected $table			= '';
	protected $pid				= '';
	protected $perPage			= 10;
	protected $batchDelete		= true;
	protected $batchExport     = true;
	protected $batchCopy		= true;

	//	protected $sortField		= 'somefield_order';
	//	protected $sortParent      = 'somefield_parent';
	//	protected $treePrefix      = 'somefield_title';

	//	protected $tabs				= array('tab1'=>'Tab 1', 'tab2'=>'Tab 2'); // Use 'tab'=>'tab1'  OR 'tab'=>'tab2' in the $fields below to enable. 

	//	protected $listQry      	= "SELECT * FROM `#tableName` WHERE field != '' "; // Example Custom Query. LEFT JOINS allowed. Should be without any Order or Limit.

	protected $listOrder		= ' DESC';

	protected $fields 		= array();

	protected $fieldpref = array();


    protected $preftabs        = array('General', GTRANSLATE_034, GTRANSLATE_039 );
	protected $prefs = array(
		'widget_look'		=> array('title' => GTRANSLATE_013, 'tab' => 0, 'type' => 'dropdown', 'data' => 'str', 'help' => '', 'writeParms' => []),
		'float_position' => array('title' => GTRANSLATE_017, 'tab' => 0, 'type' => 'dropdown', 'data' => 'str', 'help' => '', 'writeParms' => []),
		'position' => array('title' => GTRANSLATE_033, 'tab' => 0, 'type' => 'dropdown', 'data' => 'str', 'help' => '', 'writeParms' => []),

		'source_lang'		=> array('title' => GTRANSLATE_014, 'tab' => 2, 'type' => 'text', 'data' => 'str', 'help' => '', 'writeParms' => ['disabled'=> true]),
		'target_lang'		=> array('title' => GTRANSLATE_014, 'tab' => 2, 'type' => 'checkboxes', 'data' => 'str', 'help' => '', 'writeParms' => []),


		'enable_cdn' => array('title' => GTRANSLATE_032, 'tab' => 1, 'type' => 'boolean', 'data' => 'str', 'help' => '', 'writeParms' => []),
		
		'url_structure'		=> array('title' => GTRANSLATE_035, 'tab' => 1, 'type' => 'text', 'data' => 'str', 'help' => '', 
		'writeParms' => ['default'=> 'none', 'disabled' => true]),

		'select_language_label' => array('title' => GTRANSLATE_038, 'tab' => 0, 'type' => 'text', 'data' => 'str', 'help' => '', 'writeParms' => []),
		
		'native_language_names' => array('title' => GTRANSLATE_015, 'tab' => 2, 'type' => 'boolean', 'data' => 'str', 'help' => '', 'writeParms' => []),
		'detect_browser_language' => array('title' => GTRANSLATE_016, 'tab' => 2, 'type' => 'boolean', 'data' => 'str', 'help' => '', 'writeParms' => []),

		'add_new_line' => array('title' => GTRANSLATE_036, 'tab' => 0, 'type' => 'radio', 'data' => 'str', 'help' => '', 'writeParms' => []),
		
		'color_scheme'		=> array('title' => GTRANSLATE_040, 'tab' => 0, 'type' => 'radio', 'data' => 'str', 'help' => '', 'writeParms' => []),
		'globe_size'		=> array('title' => GTRANSLATE_031, 'tab' => 0, 'type' => 'radio', 'data' => 'str', 'help' => '', 'writeParms' => []),

		'flag_size'		=> array('title' => GTRANSLATE_029, 'tab' => 0, 'type' => 'radio', 'data' => 'str', 'help' => '', 'writeParms' => []),
		'flag_style'		=> array('title' => GTRANSLATE_030, 'tab' => 0, 'type' => 'radio', 'data' => 'str', 'help' => '', 'writeParms' => []),
		
		'float_switcher_open_direction'		=> array('title' => GTRANSLATE_041, 'tab' => 0, 'type' => 'radio', 'data' => 'str', 'help' => '', 'writeParms' => []),
		'switcher_open_direction'		=> array('title' => GTRANSLATE_021, 'tab' => 0, 'type' => 'radio', 'data' => 'str', 'help' => '', 'writeParms' => []),
		
		'alt_flags'		=> array('title' => GTRANSLATE_044, 'tab' => 0, 'type' => 'checkboxes', 'data' => 'str', 'help' => '', 'writeParms' => []),

	);


	public function init()
	{

		$widget_look_options = array(
			'float' => GTRANSLATE_001,
			'dropdown_with_flags' => GTRANSLATE_002,
			'popup' => GTRANSLATE_003,
			'dropdown' => GTRANSLATE_004,
			'flags' => GTRANSLATE_005,
			'flags_dropdown' => GTRANSLATE_006,
			'flags_name' => GTRANSLATE_007,
			'flags_code' => GTRANSLATE_008,
			'lang_names' => GTRANSLATE_009,
			'lang_codes' => GTRANSLATE_010,
			'globe' => GTRANSLATE_011,
		);

		$floating_language_selector_options = array(
			'bottom_left' => GTRANSLATE_019,
			'bottom_right' => GTRANSLATE_022,
			'top_left' => GTRANSLATE_023,
			'top_right' => GTRANSLATE_024,
			'inline' => GTRANSLATE_037,
		);

		$position_options = array(
			'inline' => GTRANSLATE_037,
			'bottom_left' => GTRANSLATE_019,
			'bottom_right' => GTRANSLATE_022,
			'top_left' => GTRANSLATE_023,
			'top_right' => GTRANSLATE_024
		);

		$globe_size_options = array(
			'20' => "20px",
			'40' => "40px",
			'60' =>	"60px",
		);
 
		$flag_size_options = array(
			'16' => "16px", 
			'24' => "24px",
			'32' => "32px",
			'48' =>	"48px",
		);

		$flag_style_options = array(
			'3d' => "3D (.png)",
			'2d' => "2D (.svg)" 
		);

		$add_new_line_options = array(
			'0' => LAN_NO,
			'1' => LAN_YES
		);


		$color_scheme_options = array(
			'light' => "Light",
			'dark' => "Dark",
		);

		$open_direction_options = array(
			'down' => "Down",
			'up' => "Up",
		);

		$float_open_direction_options = array(
			'left' => "Left",
			'right' => "Right",
			'top' => "Top",
			'bottom' => "Bottom",
		);

		$alt_flags_options = [
			'us' => 'USA flag (English)',
			'ca' => 'Canada flag (English)',
			'br' => 'Brazil flag (Portuguese)',
			'mx' => 'Mexico flag (Spanish)',
			'ar' => 'Argentina flag (Spanish)',
			'co' => 'Colombia flag (Spanish)',
			'qc' => 'Quebec flag (French)',
		];

		$target_lang_options = [
			'af' => 'Afrikaans',
			'sq' => 'Albanian',
			'am' => 'Amharic',
			'ar' => 'Arabic',
			'hy' => 'Armenian',
			'az' => 'Azerbaijani',
			'eu' => 'Basque',
			'be' => 'Belarusian',
			'bn' => 'Bengali',
			'bs' => 'Bosnian',
			'bg' => 'Bulgarian',
			'ca' => 'Catalan',
			'ceb' => 'Cebuano',
			'ny' => 'Chichewa',
			'zh-CN' => 'Chinese (Simplified)',
			'zh-TW' => 'Chinese (Traditional)',
			'co' => 'Corsican',
			'hr' => 'Croatian',
			'cs' => 'Czech',
			'da' => 'Danish',
			'nl' => 'Dutch',
			'en' => 'English',
			'eo' => 'Esperanto',
			'et' => 'Estonian',
			'tl' => 'Filipino',
			'fi' => 'Finnish',
			'fr' => 'French',
			'fy' => 'Frisian',
			'gl' => 'Galician',
			'ka' => 'Georgian',
			'de' => 'German',
			'el' => 'Greek',
			'gu' => 'Gujarati',
			'ht' => 'Haitian Creole',
			'ha' => 'Hausa',
			'haw' => 'Hawaiian',
			'iw' => 'Hebrew',
			'hi' => 'Hindi',
			'hmn' => 'Hmong',
			'hu' => 'Hungarian',
			'is' => 'Icelandic',
			'ig' => 'Igbo',
			'id' => 'Indonesian',
			'ga' => 'Irish',
			'it' => 'Italian',
			'ja' => 'Japanese',
			'jw' => 'Javanese',
			'kn' => 'Kannada',
			'kk' => 'Kazakh',
			'km' => 'Khmer',
			'ko' => 'Korean',
			'ku' => 'Kurdish (Kurmanji)',
			'ky' => 'Kyrgyz',
			'lo' => 'Lao',
			'la' => 'Latin',
			'lv' => 'Latvian',
			'lt' => 'Lithuanian',
			'lb' => 'Luxembourgish',
			'mk' => 'Macedonian',
			'mg' => 'Malagasy',
			'ms' => 'Malay',
			'ml' => 'Malayalam',
			'mt' => 'Maltese',
			'mi' => 'Maori',
			'mr' => 'Marathi',
			'mn' => 'Mongolian',
			'my' => 'Myanmar (Burmese)',
			'ne' => 'Nepali',
			'no' => 'Norwegian',
			'ps' => 'Pashto',
			'fa' => 'Persian',
			'pl' => 'Polish',
			'pt' => 'Portuguese',
			'pa' => 'Punjabi',
			'ro' => 'Romanian',
			'ru' => 'Russian',
			'sm' => 'Samoan',
			'gd' => 'Scottish Gaelic',
			'sr' => 'Serbian',
			'st' => 'Sesotho',
			'sn' => 'Shona',
			'sd' => 'Sindhi',
			'si' => 'Sinhala',
			'sk' => 'Slovak',
			'sl' => 'Slovenian',
			'so' => 'Somali',
			'es' => 'Spanish',
			'su' => 'Sundanese',
			'sw' => 'Swahili',
			'sv' => 'Swedish',
			'tg' => 'Tajik',
			'ta' => 'Tamil',
			'te' => 'Telugu',
			'th' => 'Thai',
			'tr' => 'Turkish',
			'uk' => 'Ukrainian',
			'ur' => 'Urdu',
			'uz' => 'Uzbek',
			'vi' => 'Vietnamese',
			'cy' => 'Welsh',
			'xh' => 'Xhosa',
			'yi' => 'Yiddish',
			'yo' => 'Yoruba',
			'zu' => 'Zulu'
		];


		$this->prefs['widget_look']['writeParms']['optArray'] = $widget_look_options;
		$this->prefs['float_position']['writeParms']['optArray'] = $floating_language_selector_options;
		$this->prefs['position']['writeParms']['optArray'] = $position_options;


		$this->prefs['target_lang']['writeParms']['optArray'] = $target_lang_options;
		$this->prefs['target_lang']['writeParms']['multiple'] = 1;
		$this->prefs['target_lang']['writeParms']['inline'] = 1;

		$this->prefs['globe_size']['writeParms']['optArray'] = $globe_size_options;
		$this->prefs['flag_size']['writeParms']['optArray'] = $flag_size_options;
		$this->prefs['flag_style']['writeParms']['optArray'] = $flag_style_options;
		$this->prefs['flag_style']['writeParms']['default'] = "3d";
		$this->prefs['add_new_line']['writeParms']['optArray'] = $add_new_line_options;
		$this->prefs['add_new_line']['writeParms']['default'] = "0";
		$this->prefs['color_scheme']['writeParms']['optArray'] = $color_scheme_options;
		$this->prefs['switcher_open_direction']['writeParms']['optArray'] = $open_direction_options;
		$this->prefs['float_switcher_open_direction']['writeParms']['optArray'] = $float_open_direction_options;


		$this->prefs['alt_flags']['writeParms']['optArray'] = $alt_flags_options;
		$this->prefs['alt_flags']['writeParms']['multiple'] = 1;
		$this->prefs['alt_flags']['writeParms']['inline'] = 0;
		
	}

	// ------- Customize Create --------

	function help() {
		$text = "Source language is always CORE_LC from frontend language";
		
		return $text;
	}

	public function renderHelp()
	{
		$caption = LAN_HELP;
		$text = "Source language (Translate from) is always CORE_LC from frontend language<br>";
		$text .= "URL structure is managed by e107 CMS<br>";

		$text .= "Show floating language selector option is the easiest and suitable for most websites.";
		
		return array('caption' => $caption, 'text' => $text);
	}

}



class gtranslate_form_ui extends e_admin_form_ui
{
}


new gtranslate_adminArea();


$css = '.checkbox-inline  { min-width: 200px; }
.checkbox-inline:first-of-type {
    margin-left: 10px;;
}
	';
e107::css('inline', $css);

$code = '


$(document).ready(function() {
	$("select, input  ").each(function() {
        // Find the parent <tr> of each <select> or <input> and set its id
        var tr = $(this).closest("tr");
        
        // Generate an ID for the <tr> based on the name attribute of the input or select field
        var fieldName = $(this).attr("name");
        
        if (fieldName) {
            tr.attr("id",   "opt_" + fieldName);
        }
    });

	RefreshDoWidgetCode();
});

  document.addEventListener("DOMContentLoaded", function () {

    const widgetLookSelect = document.getElementById("widget-look");
    if (widgetLookSelect) {
        widgetLookSelect.setAttribute("onchange", "RefreshDoWidgetCode()");
    }
    const globeSizeSelect = document.getElementById("globe-size");
    if (globeSizeSelect) {
        globeSizeSelect.setAttribute("onchange", "RefreshDoWidgetCode()");
    }


});';
e107::js('inline', $code);



$script = <<<EOT
document.addEventListener('DOMContentLoaded', () => {
    // Get all the input elements inside the container
    const container = document.getElementById('alt-flags-container');
    const checkboxes = container.querySelectorAll('input[type="checkbox"]');

    // Iterate over each checkbox and add the appropriate data-lang-group
    checkboxes.forEach(checkbox => {
        const label = checkbox.closest('label');
        const text = label.querySelector('span').innerText;

        // Determine the language group based on the text content
        let langGroup = 'other';
        if (text.includes('(English)')) {
            langGroup = 'en';
        } else if (text.includes('(Spanish)')) {
            langGroup = 'es';
        } else if (text.includes('(French)')) {
            langGroup = 'fr';
        } else if (text.includes('(Portuguese)')) {
            langGroup = 'pt';
        }

        // Set the data-lang-group attribute
        checkbox.setAttribute('data-lang-group', langGroup);
    });
});

$('input[type="checkbox"][name^="alt_flags["]').change(function () {
    if ($(this).prop('checked')) {
        var langGroup = $(this).attr('data-lang-group');

        if (langGroup) {
            // Uncheck all other checkboxes in the same lang group
            $('input[type="checkbox"][data-lang-group="' + langGroup + '"]').not(this).prop('checked', false);
        }

        // Ensure the current checkbox remains checked
        $(this).prop('checked', true);
    }
});


 

function RefreshDoWidgetCode() {
    var widget_look = jQuery('#widget-look').val();


	if(widget_look == 'float' || widget_look == 'dropdown_with_flags') {
        $('#opt_float_position').show();
        $('#opt_position').hide();

 
        if(widget_look == 'float') {
            

            $('#opt_switcher_open_direction').hide();
            $('#opt_float_switcher_open_direction').show();
        } else {
           

            $('#opt_switcher_open_direction').show();
            $('#opt_float_switcher_open_direction').hide();
        }
    } else {
 
		$('#opt_float_position').hide();
   
        $('#opt_position').show();
 
    }	 

	if(widget_look == 'dropdown' || widget_look == 'lang_names' || widget_look == 'lang_codes' || widget_look == 'float') {
        $('#opt_flag_size').hide();
    } else {
 
        $('#opt_flag_size').show();
    }
 

    if(widget_look == 'dropdown' || widget_look == 'lang_names' || widget_look == 'lang_codes') {
        $('#opt_flag_style,#opt_alt_flags').hide();
    } else {
 
        $('#opt_flag_style,#opt_alt_flags').show();
    }

    if(widget_look == 'globe') {
        $('#opt_flag_style').hide();
        $('#opt_globe_size').show();
 
    } else {
        $('#opt_globe_size').hide();
    }

    if(widget_look == 'flags_dropdown') {
 
        $('#opt_add_new_line').show();
    } else {
        $('#opt_add_new_line').hide();
    }

    if(widget_look == 'dropdown' || widget_look == 'flags_dropdown') {
        $('#opt_select_language_label').show();
    } else {
        $('#opt_select_language_label').hide();
    }

    if(widget_look == 'dropdown_with_flags') {
 
        $('#opt_color_scheme').show();
    } else {
        $('#opt_color_scheme').hide();
    }

	$('input[name="alt_flags[]"]').change(function() {
		if($(this).prop('checked')) {
			var lang_group = $(this).attr('data-lang-group');

			// uncheck other items from lang group
			$('input[name="alt_flags[]"][data-lang-group="'+lang_group+'"]').prop('checked', false);
			$(this).prop('checked', true);
		}
	});
}	
EOT;

$script .= <<<EOT
RefreshDoWidgetCode();
EOT;
e107::js('footer-inline', $script);
require_once(e_ADMIN . "auth.php");

e107::getAdminUI()->runPage();

require_once(e_ADMIN . "footer.php");
exit;
