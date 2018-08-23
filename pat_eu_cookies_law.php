<?php
/**
 * pat_eu_cookies_law plugin. EU Cookies law compliance plugin for Textpattern CMS.
 * @author:  Patrick LEFEVRE.
 * @link:    https://github.com/cara-tm/pat_eu_cookies_law
 * @type:    Public
 * @prefs:   no
 * @order:   5
 * @version: 1.1
 * @license: GPLv2
 */

/**
 * This plugin tag registry
 */
if (class_exists('\Textpattern\Tag\Registry')) {
	Txp::get('\Textpattern\Tag\Registry')
		->register('pat_eu_cookies_law')
		->register('pat_eu_cookies_law_reload');
}


/**
 * This plugin admin callbacks
 */
if (txpinterface == 'admin')
{
	register_callback('pat_eu_cookies_law_prefs', 'plugin_lifecycle.pat_eu_cookies_law', 'installed');
	register_callback('pat_eu_cookies_law_cleanup', 'plugin_lifecycle.pat_eu_cookies_law', 'deleted');
	register_callback('pat_eu_cookies_law_disable', 'plugin_lifecycle.pat_eu_cookies_law', 'disabled');
}


/**
 * Main plugin function
 *
 * @param array   This plugin attributes
 * @param string
 * @return string HTML markup
 */
function pat_eu_cookies_law($atts)
{

	global $path_to_site, $_default, $pat_eu_cookies_law_switcher;

	extract(lAtts(array(
		'lang'         => substr(get_pref('language'), 0, 2),
		'duration'     => '1 Month',
		'minutes'      => 1,
		'days'         => 1,
		'force_reload' => false,
		'section'      => '<span></span>',
		'more'         => 'More',
		'class'        => false,
	), $atts));

	// Link creation
	$section = $section ? '<a href="'.hu.$section.'">'.$more.'</a>' : '';

	// js expression for force reload on demand
	$force = ($force_reload ? ",window.location=''" : "");


	// The default string entries for international translation
	$_default = array(
			'refuse' => 'You refuse external third-party cookies: none, at the initiative of this site, are present into your device', 
			'msg' => 'This website stores some third parts cookies within your device.',
			'accept' => 'You can <a href="?consent=1" title="I accept the use of cookies and I close this message" id="ok-cookies">Accept</a>',
			'decline' => 'or <a href="?consent=0" title="I refuse to use Cookies and a message will continue to appear" id="no-cookies">Decline</a> them.',
			'remind' => 'Time remaining before Cookies automatic launch',
			'no_allowed' => '<p>Currently, your browser is set to disable cookies (check preferences).</p>',
			'choice' => 'Cookies Choice',
			'no_js' => 'Please, enable javascript into your browser settings.',
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

	return '<div role="alertdialog" tabindex="-1" aria-hidden="false" class="pat_eu_cookies_law'.($class ? ' '.$class : '').'" id="pat_eu_cookies_law"><noscript><p class="" aria-hidden="true">'.$_default['no_js'].'</p></noscript></div><div id="pat_result_cookies"></div><div id="pat_widget"></div>'.n._pat_eu_cookies_law_inject($_default['refuse'], $_default['no_allowed'], $minutes, $days, get_pref('pat_eu_cookies_law_timer'), $duration, get_pref('pat_eu_cookies_law_hidden'), $force, $section);

}


/**
 * Javascript injector
 *
 * @param  string ($refuse)     A message for users
 * @param  string ($no_allowed) A message for users
 * @param  string ($future)     The delay for the stored user's choice into the internal cookie
 * @return string               javascript code
 */
function _pat_eu_cookies_law_inject($refuse, $no_allowed, $minutes, $days, $timer, $duration, $hidden, $force, $section)
{

	global $_default;

	$countries = get_pref('pat_eu_cookies_law_countries');
	$widgets = get_pref('pat_eu_cookies_law_widjets');

	// Variable convertion for convenient insertion into js. Removes all spaces
	$list = preg_replace('/\s+/', '', get_pref('pat_eu_cookies_law_js'));
	// Converts to an array
	$list = explode(',', $list);
	// Affects each quoted values
	foreach($list as $key => $value) {
		$list[$key] = '"'.$value.'"';
	}
	// $files is a list of quoted strings ready for a js array
	$files = implode($list, ',');

	$out = <<<EOJ
<script>/*! Simple EU Cookies Law Compliance without dependencies by cara-tm.com, 2017. GPL2 license */function EU_cookies_law(r){var domain=window.location.hostname,lang=(navigator.language||navigator.browserLanguage),countries=[$countries],affected=false,minutes={$minutes},days={$days},future="{$duration}",hidden={$hidden},timer={$timer},choice=document.getElementById("pat_widget"),refuse_msg="<p>$refuse</p>";future=parseInt(future.substring(0,1));if(false!==navigator.cookieEnabled){for(var i=0;i<countries.length;i++){if(countries[i]===lang.substring(0,2).toUpperCase()){affected=true;break;}}if(affected==true){choice.innerHTML="<span>{$_default['choice']}</span>";choice.style.display="none";var TemplateEngine=function(tpl,data){var re=/<%([^%>]+)?%>/g,match;while(match=re.exec(tpl)){tpl=tpl.replace(match[0],data[match[1]]);}return tpl;};var template=(true==timer&&true==hidden)?'<p id="pat_eu_cookies_law_message"><%info%> <%what%>. <br /><%accept%> <%decline%> <%remind%> <%policy%></p>':'<p id="pat_eu_cookies_law_message"><%info%> <%what%>. <br /><%accept%> <%decline%> <%policy%></p>',div=document.createElement("div");div.id="msg-cookies";div.innerHTML=TemplateEngine(template,{info:'{$_default['msg']}',what:'{$widgets}',accept:'{$_default['accept']}',decline:'{$_default['decline']}<br />',remind:'<span id="cookies-delay">{$_default['remind']} <strong id="counter">{$minutes}:00</strong></span>',policy:'{$section}'});if(getCookie('txp_login_public')==null)document.getElementById('pat_eu_cookies_law').appendChild(div);function storage(){var mod='pat_plugin';try{localStorage.setItem(mod,mod);localStorage.removeItem(mod);return true;}catch(e){return false;}};if(true!==storage()){if(getCookie(domain)==='Ok'+domain){widget(false);jsloader(r);}else if(getCookie(domain)==='No'+domain){widget(true);}}else{var obj=JSON.parse(localStorage.getItem("pat_eu_cookies_law"));if(null!=obj&&(obj.domain=='Ok'+domain && obj.expires>new Date().getTime())){widget(false);jsloader(r);timer=false;}else if(null!=obj && (obj.domain=='No'+domain && obj.expires>new Date().getTime())){widget(true);timer=false;}};var accept_cookies=document.getElementById('ok-cookies'),refuse_cookies=document.getElementById('no-cookies');null!=accept_cookies&&(accept_cookies.onclick=function(a){if(a=a||window.event, a.preventDefault(),true!==storage()){var b=new Date(new Date().setMonth(new Date().getMonth()+future));cookie_creation('Ok',b);}else{create_storage(future,'Ok');}jsloader(r);widget(false)$force});null!=refuse_cookies&&(refuse_cookies.onclick=function(){var b=new Date(new Date().setDate(new Date().getDate()+days));if(true!==storage()){cookie_creation('No',b);}else{create_storage(days,"No");}widget(true)$force});function countdown(a){function b(){if(document.getElementById("counter")){var f,d=document.getElementById("counter"),e=new Date(new Date().setMonth(new Date().getMonth()+future));c--,d.innerHTML=(a-1).toString()+":"+(10>c?"0":"")+(c+""),0<c?setTimeout(b,1e3):(1<a&&countdown(a-1),jsloader(r),document.getElementById("pat_eu_cookies_law").innerHTML="",storage()?create_storage(future,"Ok"):cookie_creation("Ok",e)$force)}}var c=60;b();};true==timer?countdown(minutes):'';function create_storage(a,b){var c=new Date(new Date().setMonth(new Date().getMonth()+a)),d={domain:b+domain,expires:new Date(c).getTime()};localStorage.setItem('pat_eu_cookies_law',JSON.stringify(d));}function getCookie(a){var b=new RegExp('(?:; )?'+a+'=([^;]*);?');return b.test(document.cookie)?decodeURIComponent(RegExp.$1):null;}function check_cookies(){getCookie(domain)==='Ok'+domain?(sanitize([{pat_eu_cookies_law:''}]),jsloader(r)):getCookie(domain)==='No'+domain&&sanitize_msg([{pat_result_cookies:msg}]);}function cookie_creation(a,b){return document.cookie=domain+'='+encodeURIComponent(a+domain)+';expires='+b.toGMTString();}}else{jsloader(r);}}else{document.getElementById("pat_result_cookies").innerHTML="{$no_allowed}";}function jsloader(b){var c=[],d=document.getElementsByTagName('script')[0];if(!window.scriptHasRun){window.scriptHasRun=!0;for(var e=0;e<b.length;e++)0===b[e]&&window.scriptHasRun||(window.scriptHasRun=!0,c[e]=document.createElement('script'),c[e].src=b[e],c[e].async=true,document.getElementsByTagName('head')[0].appendChild(c[e])||d.parentNode.insertBefore(c[e],d));}}function sanitize(a){a.forEach(function(b){for(var d in b)document.getElementById(d).innerHTML=b[d];});document.getElementById("counter")?document.getElementById("counter").innerHTML="":"";}function widget(b){true==b?sanitize([{pat_result_cookies:refuse_msg}]):"",true==hidden?(sanitize([{pat_eu_cookies_law:""}]),document.getElementById("pat_eu_cookies_law").style.display="none"):(document.getElementById("pat_eu_cookies_law").style.display="none",choice.style.display="block")}
choice.onclick=function(a){a.preventDefault();choice.style.display="none";document.getElementById("pat_eu_cookies_law").style.display="block";true==timer?countdown(minutes):'';}}EU_cookies_law([$files]);</script>
EOJ;

	return $out;

}


/**
 * A tag to remove this plugin localStorage markers
 * 
 * @param
 * @return string HTML link followed by a script
 */
function pat_eu_cookies_law_reload()
{
	return '<a href=\'javascript:(function(){domain=window.location.hostname;document.cookie=domain+"="+encodeURIComponent("Ok"+domain)+";expires=Thu, 01 Jan 1970 00:00:00 GMT";document.cookie=domain+"="+encodeURIComponent("No"+domain)+";expires=Thu, 01 Jan 1970 00:00:00 GMT";localStorage.removeItem("pat_eu_cookies_law");window.location="";})();\' title="Bookmaklet" style="color:red"><span title="Remove pat_eu_cookies_law">Reset pat_eu_cookies_law</span></a>';
}


/**
 * This plugin preferences installation
 *
 * @param
 * @return null Safe_field insertions
 */
function pat_eu_cookies_law_prefs()
{

	if (!safe_field('name', 'txp_prefs', "name='pat_eu_cookies_law_countries'"))
		safe_insert('txp_prefs', "name='pat_eu_cookies_law_countries', val='\'AT\',\'BE\',\'BG\',\'HR\',\'CZ\',\'CY\',\'DK\',\'EE\',\'FI\',\'FR\',\'DE\',\'EL\',\'HU\',\'IE\',\'IT\',\'LV\',\'LT\',\'LU\',\'MT\',\'NL\',\'PL\',\'PT\',\'SK\',\'SI\',\'ES\',\'SE\',\'GB\',\'UK\'', type=1, event='admin', html='text_input', position=0");

	if (!safe_field('name', 'txp_prefs', "name='pat_eu_cookies_law_hidden'"))
		safe_insert('txp_prefs', "name='pat_eu_cookies_law_hidden', val='0', type=1, event='admin', html='yesnoradio'");

	if (!safe_field('name', 'txp_prefs', "name='pat_eu_cookies_law_timer'"))
		safe_insert('txp_prefs', "name='pat_eu_cookies_law_timer', val='0', type=1, event='admin', html='yesnoradio'");

	if (!safe_field('name', 'txp_prefs', "name='pat_eu_cookies_law_js'"))
		safe_insert('txp_prefs', "name='pat_eu_cookies_law_js', val='".hu."js/file.js', type=1, event='admin', html='text_input'");

	if (!safe_field('name', 'txp_prefs', "name='pat_eu_cookies_law_widjets'"))
		safe_insert('txp_prefs', "name='pat_eu_cookies_law_widjets', val='(Google Analytics)', type=1, event='admin', html='text_input'");


}


/**
 * This plugin lifecycle for deletion
 *
 * @param
 * @return null Safe_field deletions
 */
function pat_eu_cookies_law_cleanup() {

	// Array of tables & rows to be removed
	$tables = array('pat_eu_cookies_law_countries', 'pat_eu_cookies_law_hidden', 'pat_eu_cookies_law_timer', 'pat_eu_cookies_law_js', 'pat_eu_cookies_law_widjets');
	foreach ($tables as $val) {
		safe_delete('txp_prefs', "name='".$val."'");
	}
	safe_delete('txp_lang', "owner='pat_speeder'");

	safe_repair('txp_prefs');
	safe_repair('txp_plugin');

}
