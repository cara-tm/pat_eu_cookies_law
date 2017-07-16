# pat_eu_cookies_law
EU Cookie Law Compliance: A Textpattern plugin for Third-Party Cookies.

A simple solution that respects the EU Cookies law. Concerns only the external third-party cookies but preserves the objectives for web marketers.
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

# JS files that generate cookies

Some third-parties libraries generate external cookies. For example the Google Analytics script or the scripts used by Social Networks. Create such a file (or multiple ones) for this acceptance by your visitors in order to respect the EU Cookies law.
You can find the [ga-lite script](https://github.com/cara-tm/pat_eu_cookies_law/blob/master/js/ga-lite.min.js) in this repository for your analytics as an example.

# Usage Example

Best place into a page template:

    <txp:pat_eu_cookies_law lang="fr-fr" duration="2 Months" />

# Changelog

* 15th July 2017: version 0.1


