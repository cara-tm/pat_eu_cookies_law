# pat_eu_cookies_law
EU Cookie Law Compliance: A Textpattern plugin for Third-Party Cookies.

A simple solution that respects the EU Cookies law. Concerns only the external third-party cookies (the purpose of this law) but preserves the objectives for web marketers.
Displays a warning message for EU member visitors only. Displays explicit and responsible information messages.
Offers to visitors a double choice: acceptance or refusal of Cookies. Automatically loads js files that generate third party external cookies after a 60 seconds delay on the lack of choice of visitors. 
Keeps the visitors choice in order to avoid excessive call to action: 24 hours for refusals; 1 month (can be set) for acceptances.
Promotes a subtil acceptance of Cookies : displays a message for refusals only but removes all informations for acceptances.
Detects the ban of all cookies based on the browser's preferences.
Support for translations with JSON files.
Low impact that preserves the speed of page display. Pure javascript without requiring third-party libraries.

# Plugin Preferences

After plugin installation and activation, visit your _Site Preferences_ page to set:

* A comma separated list of js files to load if your visitors accept the use of Cookies into the "List of javascript files to load" field (i.e. http://my-domain.com/js/first-file.js, http://my-domain.com/js/second-file.js);
* The 4 letters countries's codes for the EU members (usefull for country deletion or addition. See the "List of EU country members codes" field).

# JSON Files for Translations

Install the `JSON` folder and its content into your `/root/` directory.
Note. The plugin use international translation by default if you don't use the correcponding JSON files.

# Plugin Attributes

* `lang` (string): the 4 letters language choice for localisation (i.e. `lang="en-us"`). Default: the active language preference sets within the Textpattern _Languages_ page.
* `duration` (string or integer): the delay in months for the saving user's choice. Default: `1 Month` (can be set with a number only. i.e. `1`).
* `force_reload` (boolean `1` or `0`): if set to `1` (true) the page will be reloaded on user acceptation. Default: `0`(false).
* `infos` (string): a section name where you want to display your legal staatement or confidential policy. That attribute create a link after the counting delay. Defaut: empty (no link creation).
* `more` (string): the label of the link above for translation conveniencies. Default: empty.

# JS files that generate cookies

Some third-parties libraries generate external cookies. For example the Google Analytics script or the scripts used by Social Networks. Create such a file (or multiple ones) for this acceptance by your visitors in order to respect the EU Cookies law.
You can find the [ga-lite script](https://github.com/cara-tm/pat_eu_cookies_law/blob/master/js/ga-lite.min.js) in this repository for your analytics as an example.

# Advice

Because Googlebot is based, currently, on Chromium 41(See: [https://developers.google.com/search/docs/guides/rendering](https://developers.google.com/search/docs/guides/rendering)) that do not supports Cookies, you can use this plugin to keep a hight level 100/100 Google Page Insights score by placing all Google adWords scripts into one, external then charging the plugin to load it (this plugin keeps an eye on "Cookies" feature disabled within the browser and do not load the file(s) in this case).

# Usage Example

Best place into a page template (perhaps into your "footer"):

    <txp:pat_eu_cookies_law lang="en" duration="2 Months" force_reload="1" infos="legal-statement" more="Read more" />

# Advices

Don't miss to create a _Legal_ page within your website and precise the purpose and the use of external third-party Cookies; the delay for automatic acceptance of the use of Cookies stored into the visitor's device; and the keeping time for Cookies acceptances and future visits. Thus, you will be into the total respect of the EU law and the respect of legal informations for your visitors.

# Changelog

* 2nd January 2018: version 0.1.4
* 16th December 2017: version 0.1.3
* 8th December 2017: version 0.1.2
* 27th July 2017: version 0.1.1
* 15th July 2017: version 0.1


