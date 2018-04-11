/**
 * pat_eu_cookies_law plugin. EU Cookies law compliance plugin for Textpattern CMS.
 * @author:  Patrick LEFEVRE.
 * @link:    https://github.com/cara-tm/pat_eu_cookies_law
 * @type:    Public
 * @prefs:   no
 * @order:   5
 * @version: 0.1.7
 * @license: GPLv2
 */

/**
 * This plugin tag registry
 */
if (class_exists('\Textpattern\Tag\Registry')) {
	Txp::get('\Textpattern\Tag\Registry')
		->register('pat_eu_cookies_law');
}


/**
 * This plugin admin callbacks
 */
if (txpinterface == 'admin')
{
	register_callback('pat_eu_cookies_law_prefs', 'prefs', '', 1);
	register_callback('pat_eu_cookies_law_prefs', 'plugin_lifecycle.pat_eu_cookies_law', 'installed');
	register_callback('pat_eu_cookies_law_cleanup', 'plugin_lifecycle.pat_eu_cookies_law', 'deleted');
}


/**
 * Main plugin function
 *
 * @param array   This plugin attributes
 * @param string
 * @return string HTML markup
 */
function pat_eu_cookies_law($atts, $thing = null)
{

	global $path_to_site;

	extract(lAtts(array(
		'lang'         => substr(get_pref('language'), 0, 2),
		'duration'     => '1 Month',
		'force_reload' => false,
		'infos'        => false,
		'more'         => false,
	), $atts));

	// js expression for force reload on demand
	$force = ($force_reload ? ",window.location=''" : "");


	// The default string entries for international translation
	$_default = array(
			'msg' => 'This website stores some third parts cookies within your device',
			'links' => 'You can <a href="#!" title="I accept the use of cookies and I close this message" id="ok-cookies">Accept</a> or <a href="#!" title="I refuse to use Cookies and a message will continue to appear" id="no-cookies">Refuse</a> them.',
			'remind' => 'Time remaining before Cookies automatic launch',
			'refuse' => 'You refuse external third-party cookies: none, at the initiative of this site, are present into your device',
			'no_allowed' => 'Currently, your browser is set to disable cookies (check preferences).',
			);

	// Get content of the json translation file based on the 'lang' plugin's attribute
	$json = @file_get_contents(hu.'json/pat_eu_cookies_law_'.$lang.'.json');

	// Decode the json datas
	if (strlen($json) > 0) {
		assert_string($json);
		// An error comes below:
		$json_datas = json_decode($json, true);
	}

	// Can we proceed? Simple test within the first json value
	if (json_last_error() === JSON_ERROR_NONE) {
		// Loop throught the json
		foreach ($json_datas as $key => $value) {
			// Change default values by json ones
			$_default[$key] = $value;
		}
	}

	return '<div role="alertdialog" tabindex="0" aria-hidden="false" aria-describedby="pat_eu_cookies_law_message" class="pat_eu_cookies_law" id="pat_eu_cookies_law"><div id="msg-cookies"><p id="pat_eu_cookies_law_message">'.$_default['msg'].' '.@get_pref('pat_eu_cookies_law_widjets').'. <br />'.$_default['links'].'<br /><span id="cookies-delay">'.$_default['remind'].' <strong id="counter">1:00</strong>'.($infos ? ' <a href="'.hu.$infos.'">'.$more.'</a>' : '').'</span></p></div> <p><span id="cookie-choices"></span></p></div>'.n._pat_eu_cookies_law_inject( $_default['refuse'], $_default['no_allowed'], $duration, $force );

}


/**
 * Javascript injector
 *
 * @param  string ($refuse)     A message for users
 * @param  string ($no_allowed) A message for users
 * @param  string ($future)     The delay for the stored user's choice into the internal cookie
 * @return string               javascript code
 */
function _pat_eu_cookies_law_inject($refuse, $no_allowed, $future, $force)
{

	global $prefs;

	// Variable convertion for convenient insertion into js. Removes all spaces
	$list = preg_replace('/\s+/', '', $prefs['pat_eu_cookies_law_js']);
	// Converts to an array
	$list = explode(',', $list);
	// Affects each quoted values
	foreach($list as $key => $value) {
		$list[$key] = '"'.$value.'"';
	}
	// $files is a list of quoted strings ready for a js array
	$files = implode($list, ',');

	$out = <<<EOJ
<script>
/*! Simple EU Cookies Law Compliance without dependencies by cara-tm.com, 2017. MIT license - https://github.com/cara-tm/EU-Cookies-Law-Compliance/ */
function EU_cookies_law(b){'use strict';function d(D){return document.getElementById('cookies-delay').innerHTML='',document.getElementById('msg-cookies').innerHTML=D}var f='$refuse',g='$future',l=window.location.hostname,n=navigator.language||navigator.browserLanguage,o=[{$prefs['pat_eu_cookies_law_countries']}],p=1,q=60,t=1,u=document.getElementById('ok-cookies'),v=document.getElementById('no-cookies');if(!1!==navigator.cookieEnabled){for(var x=function(){g=parseInt(g.substring(0,1));var D=new Date(new Date().setMonth(new Date().getMonth()+g));A('Ok',D),B(b),d('')},y=function(D){var E=new RegExp('(?:; )?'+D+'=([^;]*);?');return E.test(document.cookie)?decodeURIComponent(RegExp.$1):null},z=function(){C(),y(l)==='Ok'+l?(d(''),B(b)):y(l)==='No'+l&&d(f)},A=function(D,E){return document.cookie=l+'='+encodeURIComponent(D+l)+';expires='+E.toGMTString()},B=function(D){var E=[],F=document.getElementsByTagName('script')[0];if(!window.scriptHasRun){window.scriptHasRun=!0;for(var G=0;G<D.length;G++)0===D[G]&&window.scriptHasRun||(window.scriptHasRun=!0,E[G]=document.createElement('script'),E[G].src=D[G],document.getElementsByTagName('head')[0].appendChild(E[G])||F.parentNode.insertBefore(E[G],F))}},C=function(){if(null!==document.getElementById('counter')){var D=document.getElementById('counter');q--,null!==typeof D.innerHTML&&(D.innerHTML=(t-1).toString()+':'+(10>q?'0':'')+(q+'')),0<q?setTimeout(C,1e3):1<t,0==q&&(x(),d(''))}else null===document.getElementById('cookies-delay')?'':document.getElementById('cookies-delay').innerHTML=''},w=0;w<o.length;w++)if(o[w]===n.substring(0,2).toUpperCase()){break}z(),u.onclick=function(D){D.preventDefault(),x(D)$force},v.onclick=function(D){var E=new Date(new Date().setDate(new Date().getDate()+1));A('No',E),d(f),D.preventDefault()}}else d('$no_allowed')};
/*! Array of third part JS files to load */ 
EU_cookies_law([$files]);
</script>
EOJ;

	return $out;

}


/**
 * This plugin preferences installation
 *
 * @param
 * @return null Safe_field insertions
 */
function pat_eu_cookies_law_prefs()
{

	global $textarray;

	$textarray['pat_eu_cookies_law_countries'] = 'List of EU country members codes';
	$textarray['pat_eu_cookies_law_js'] = 'Comma separated list of js files to load';
	$textarray['pat_eu_cookies_law_widjets'] = 'List of widgets with third part cookies';

	if (!get_pref('pat_eu_cookies_law_countries')) {
		set_pref('pat_eu_cookies_law_countries', '\'AT\',\'BE\',\'BG\',\'HR\',\'CZ\',\'CY\',\'DK\',\'EE\',\'FI\',\'FR\',\'DE\',\'EL\',\'HU\',\'IE\',\'IT\',\'LV\',\'LT\',\'LU\',\'MT\',\'NL\',\'PL\',\'PT\',\'SK\',\'SI\',\'ES\',\'SE\',\'GB\',\'UK\'', 'admin', '1', 'text_input', '21');
	}
	if (!get_pref('pat_eu_cookies_law_js')) {
		set_pref('pat_eu_cookies_law_js', hu.'js/file.js', 'admin', '1', 'text_input', '22');
	}
	if (!get_pref('pat_eu_cookies_law_widjets')) {
		set_pref('pat_eu_cookies_law_widjets', '', 'admin', '1', 'text_input', '23');
	}

}


/**
 * This plugin lifecycle for deletion
 *
 * @param
 * @return null Safe_field deletions
 */
function pat_eu_cookies_law_cleanup() {

	// Array of tables & rows to be removed
	$els = array('txp_prefs' => 'pat_eu_cookies_law_countries', 'txp_prefs' => 'pat_eu_cookies_law_js', 'txp_prefs' => 'pat_eu_cookies_law_widjets');
	// Process actions
	foreach ($els as $table => $row) {
		//safe_delete($table, "name LIKE '".str_replace('_', '\_', $row)."\_%'");
		safe_delete($table, "name='".$row."'");
		safe_repair($table);
	}
	safe_repair('txp_plugin');

}
