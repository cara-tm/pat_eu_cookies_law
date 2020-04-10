/*!
 * EU GPRD compliance for external third party cookies
 * MIT license - https://github.com/cara-tm/pat_eu_cookies_law
 */
function EU_cookies_law(r){
"use strict";
// Variables
var seconds=31,
future="1 Month",
privacy_link="#link",
ressources="from: Google Analytics, Facebook, Twitter",
countries=['GB','UK','AT','BE','BG','HR','CZ','CY','DK','EE','FI','FR','DE','EL','HU','IE','IT','LV','LT','LU','MT','NL','PL','PT','SK','SI','ES','SE'],
msg="You refuse third party Cookies: none at the initiative of this website are present into your device.",
no_alowed_cookies="Your browser is set to refuse all Cookies (check its preferences).",
used="You allowed the use of external third party Cookies into your device from this website.",
extern="This website stores some external third party Cookies within your device ",
you_can="You can ",
do_accept="I accept the use of external Cookies",
accept="Accept",
or=" or ",
do_decline="I refuse the use of external Cookies",
decline="Decline",
privacy="Read our Privacy Policy",
more="Read more",
delay=" Time reminding before the automatic launch of external Cookies ",
close="Close",
domain=window.location.hostname,lang=(navigator.language||navigator.browserLanguage),minutes=0,f=Number(future.replace(/\D+$/,"")),affected=false;var _css=document.createElement('style'),_styles="#pat-eu-cookies-law{overflow:hidden;position:absolute;position:fixed;*position:absolute;z-index:1000;left:2%;bottom:0;width:50%;min-width:450px;max-width:48vw;max-width:calc(100% - 48px);margin:24px auto 0;padding:1em;text-align:center;cursor:default;outline:none;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;-webkit-animation-name:moveUp;animation-name:moveUp;-webkit-animation-duration:1s;animation-duration:1s;-webkit-animation-fill-mode:both;animation-fill-mode:both;will-change:transform}@-webkit-keyframes moveUp{from{-webkit-transform:translate3d(0,100%,0);transform:translate3d(0,100%,0)}to{-webkit-transform:translate3d(0,0,0);transform:translate3d(0,0,0)}}@keyframes moveUp{from{-webkit-transform:translate3d(0,100%,0);transform:translate3d(0,100%,0)}to{-webkit-transform:translate3d(0,0,0);transform:translate3d(0,0,0)}}@media (prefers-reduced-motion){html #pat-eu-cookies-law{-webkit-animation:unset;animation:unset;-webkit-transition:none;transition:none}}@media only screen and (max-width:689px){body{position:relative}#pat-eu-cookies-law{position:absolute;position:fixed;left:0;bottom:8em;bottom:23vh;width:98%;min-width:0;max-width:none;max-height:none;margin:0 1%;padding:8px 0;-webkit-animation:unset;animation:unset;-webkit-transition:none;transition:none}}#pat-eu-cookies-law,#pat-eu-cookies-law-message,#pat_result-cookies,#msg-cookies,#cookies-info{text-align:center!important;font:normal normal normal 14px/20px 'Nunito Sans','Open Sans','Helvetica Neue',HelveticaNeue,Helvetica,Arial,sans-serif!important}#msg-cookies{margin:1em 3%;background:#fff}#pat-eu-cookies-law-message{margin:0;padding:.5em 2em 0 0}#msg-cookies,#pat_eu_cookies_law noscript p,#more{position:relative;z-index:999999;width:92%;padding:1em 5px;outline:none;border:1px solid #eee;border-radius:.2rem}#msg-cookies,#pat_eu_cookies_law noscript p{-moz-box-shadow:0 0 17px rgba(0,0,0,.15);-webkit-box-shadow:0 0 17px rgba(0,0,0,0.15),0 5px 10px rgba(0,0,0,0.2);box-shadow:0 0 17px rgba(0,0,0,.15);box-shadow:0 1.3px 3.6px rgba(0,0,0,.07),0 3.6px 10px rgba(0,0,0,.046),0 8.7px 24.1px rgba(0,0,0,.035),0 29px 80px rgba(0,0,0,.024)}#msg-cookies,noscript p{color:#757575}#msg-cookies p:first-child:before{content:'♨';width:auto;height:1em;margin-right:.2em;vertical-align:middle;color:#dda000;font-size:1.4em;line-height:1;text-shadow:0 0 0 #dda000}@supports (display:grid){#msg-cookies p:first-child:before{content:'🍪'}}@media only screen and (max-width:740px){#msg-cookies p,noscript p{left:0;max-width:none;width:92%;margin:.9em 1% 0}}#msg-cookies p a,#msg-cookies #more{opacity:1;position:static;z-index:unset;display:inline-block;width:auto;margin:.2em 0;padding:6px 8px;background-color:transparent;border:1px solid #d7f2fe;font-size:inherit;line-height:1.429em;text-overflow:ellipsis;text-transform:uppercase;white-space:nowrap;color:#5c6bc0;cursor:pointer;box-shadow:none;transition:background-color .2s,box-shadow .2s;filter:alpha(opacity=100);*vertical-align:middle}#msg-cookies #ok-cookies{background:#5c6bc0;color:#fff}#msg-cookies a:hover,#msg-cookies #more:hover,#msg-cookies #ok-cookies:hover{background:#dff1fa;text-decoration:underline;color:#014c70;box-shadow:0 0 1px #039be5}#pat_result-cookies{position:absolute;bottom:10px;width:94%;margin:0 2%;text-align:center}#pat_result-cookies{line-height:1.2}#msg-cookies-close{position:absolute;top:.09em;right:.1em;padding:0 .3em;text-decoration:none;color:#aaa;font-size:1.8em;line-height:1em;border:1px solid #eee;animation:all 500ms ease-in-out;*display:none}#cookies-info{padding:1em;text-align:center;font-size:17px}html #msg-cookies-close:hover{text-decoration:none}",_h=document.getElementsByTagName('head')[0];_css.setAttribute("type","text/css");_h.appendChild(_css);if(_css.styleSheet){_css.styleSheet.cssText=_styles;}else{var _r=document.createTextNode(_styles);_css.appendChild(_r);}document.getElementById("no-js-warning").style.display="none";var _e$l=document.getElementById('pat-eu-cookies-law'),_c$_=_build$_({tagName:"div","id":"msg-cookies",children:[{tagName:"p","id":"pat-eu-cookies-law-message",children:[{tagName:"text",text:extern+"("+ressources+")."},{tagName:"br"},{tagName:"text",text:you_can},{tagName:"a","class":"tooltip tooltip-bottom","id":"ok-cookies","href":"#!","title":do_accept,text:accept,"aria-label":do_accept,"tabindex":"0"},{tagName:"text",text:or},{tagName:"a","class":"tooltip tooltip-bottom","id":"no-cookies","href":"#!","title":do_decline,text:decline,"aria-label":do_decline,"tabindex":"0"},{tagName:"text",text:" "},{tagName:"a","class":"tooltip tooltip-bottom","id":"more","href":privacy_link,"rel":"noreferrer","title":privacy,text:more,"aria-label":more},{tagName:"br"}]},{tagName:"span","id":"cookies-delay",text:delay},{tagName:"b","id":"counter"},{tagName:"text",text:" "},{tagName:"a","id":"msg-cookies-close","href":"#!",text:"×","title":close,"onclick":"document.getElementById('pat-eu-cookies-law').style.display='none';return false;","aria-label":close}]});/*! code by https://bumbu.me */function _build$_(obj){if(obj.tagName==="text"){return document.createTextNode(obj.text);}else{var parentNode=document.createElement(obj.tagName.toUpperCase());var index;for(index in obj){if(index!=="tagName"&&index!=="text"&&index!=="children"){parentNode.setAttribute(index,obj[index]);}}if("children"in obj){for(index in obj.children){parentNode.appendChild(_build$_(obj.children[index]));}}else if("text"in obj){parentNode.appendChild(document.createTextNode(obj.text));}return parentNode;}}if(false!==navigator.cookieEnabled){for(var i=28;i--;){if(countries[i]===lang.substring(0,2).toUpperCase()){affected=1;break;}}}if(affected!==1){jsloader(r);}else{check_cookies();}var accept_cookies=document.getElementById("ok-cookies"),refuse_cookies=document.getElementById("no-cookies");function future_date(f){return new Date(new Date().setMonth(new Date().getMonth()+f));}function tomorrow_date(){return new Date(new Date().setDate(new Date().getDate()+1));}function launch(r){cookie_creation("Ok",future_date(f));jsloader(r);_e$l.parentNode.removeChild(_e$l);document.getElementById("cookies-info").innerText="";}function cookie_creation(c,e){if(e.length==1){e=Number(e);}return document.cookie=domain+"="+encodeURIComponent(c+domain)+";expires="+e+";path=/;SameSite=Lax;";}function countdown(){function f(){if(null!==document.getElementById("counter")){var k=document.getElementById("counter");g--,k.innerText=(j).toString()+":"+(10>g?"0":"")+(g+""),0<g?setTimeout(f,1e3):1<j&&countdown(j),0==g&&(launch(r));}}var g=seconds,j=1<seconds?0:seconds;f();}function check_cookies(){if(getCookie(domain)==="Ok"+domain){jsloader(r);document.getElementById("cookies-info").innerText=used;}else if(getCookie(domain)==="No"+domain){var w=document.getElementById("cookies-info");w.setAttribute("aria-label",msg);w.innerText=msg;}else{_e$l.appendChild(_c$_);countdown();}}function getCookie(sName){var oRegex=new RegExp("(?:; )?"+sName+"=([^;]*);?");if(oRegex.test(document.cookie))return decodeURIComponent(RegExp.$1);else return null;}if(accept_cookies!=null){accept_cookies.onclick=function(){launch(r);document.location.reload(false);};}if(refuse_cookies!=null){refuse_cookies.onclick=function(){cookie_creation('No',tomorrow_date());document.location.reload(true);};}function jsloader(r){var s=[],a=document.getElementsByTagName("script")[0];if(!window.scriptHasRun){window.scriptHasRun=true;for(var i=0,len=r.length;i<len;i++){if(r[i]!== 0||!window.scriptHasRun){window.scriptHasRun=true;s[i]=document.createElement("script");s[i].src=r[i];document.getElementsByTagName("head")[0].appendChild(s[i])||a.parentNode.insertBefore(s[i],a);}}}}function sanitize_msg(m){document.getElementById("cookies-delay").innerText="";document.getElementById("counter").innerText="";return document.getElementById("cookies-info").innerText=m;}}
// Loader:
EU_cookies_law(["http://example.com/js/google-analytics.js", "http://example.com/js/example.js"]);