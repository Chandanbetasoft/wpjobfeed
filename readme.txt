=== WP Jobfeed ===
Contributors: wpmarkuk, keithdevon, highrisedigital
Tags: jobs, recruitment
Requires at least: 5.1
Requires PHP: 5.6
Tested up to: 5.2
Stable tag: 3.0.6
Donate link: https://store.highrise.digital/downloads/wpjobfeed-support-docs/
License: GPLv3 or later
License URI: https://www.gnu.org/licenses/gpl-3.0.html

Simple integration of Jobfeed job posting & distribution with WordPress.

== Description ==
The WP Jobfeed plugin provides a simple integration between [Jobfeed](https://www.Jobfeed.com/uk/products/features/job-posting-distribution/) and WordPress. The jobs that you write in Jobfeed are delivered to your website and candidate applications from your website are delivered back to your Jobfeed account.

_ – _ – _ – _ – _ – _ – _ – _ – _ – _ – _ – _ – _ – _ –

## Read this first

**This plugin is not the best way to integrate Wordpress with Jobfeed!**

We built this plugin 6 years ago and times have changed. It will still work, and might suit some people.

However, since launching this plugin we've developed our understanding of the technology and customer needs and have found better ways to provide WP>BB integrations.

We would be very happy to talk you through the options available and advise you on the best course of action. You can book a call with us using the link below:

[Book a call](https://calendly.com/highrisedigital/wp-dot-org-wpjobfeed)

Or use our contact form and we will get back to you asap:

[Contact us](https://highrise.digital/contact/)

_ – _ – _ – _ – _ – _ – _ – _ – _ – _ – _ – _ – _ – _ –

### Who is this plugin for

This plugin is primarily for developers of recruitment websites or people who are happy to tinker with code.

If you're uncomfortable with code or want a 'done for you' solution please [book a call](https://calendly.com/highrisedigital/wp-dot-org-wpjobfeed) or [contact us](https://highrise.digital/contact/).

### What the plugin does

1. Creates a new jobs post type
2. Creates taxonomies for job industry, location, type and skills
3. Allows each job to store key meta data such as reference, salary etc.
4. Creates a job application which gets sent back to Jobfeed

### This plugin **does not**

1. Expire the jobs or remove them from your WordPress site
2. Provide a comprehensive job search to your site
3. Provide front end output of jobs
4. Provide a styled job listing page
5. Style the application form to match other forms on your site

See "GETTING THE MOST OUT OF THE WP Jobfeed PLUGIN" below for how to overcome some of these.

If you want to know more about the plugin's capabilities please [book a call](https://calendly.com/highrisedigital/wp-dot-org-wpjobfeed) or [contact us](https://highrise.digital/contact/).

## Getting the most out of the WP Jobfeed plugin

For those who have already integrated their site using the WP Jobfeed plugin, we have a number of **add-ons** to enhance the plugins functionality, **available to purchase from our store**.

* [Support and documetation](https://store.highrise.digital/downloads/wpjobfeed-support-docs/) - get access to the plugins documentation which covers customisations, installation and setup.
* [Search](https://store.highrise.digital/downloads/wp-Jobfeed-search/) - add a search form to your website that will allow users to search for jobs you have posted from Jobfeed.
* [Shortcode](https://store.highrise.digital/downloads/wp-Jobfeed-shortcodes/) - a handy shortcode to allow you to display Jobfeed posted jobs anywhere on your site.
* [Auto expire jobs](https://store.highrise.digital/downloads/wp-Jobfeed-auto-expire-jobs/) - make sure that jobs are removed from WordPress when they have passed their expiry date, set when written in Jobfeed.

For the sake of clarity, the WP Jobfeed plugin is not affiliated in any way with [Jobfeed](https://www.Jobfeed.com/).

== Installation ==

To install the plugin:

1. Upload `wpjobfeed` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Visit the settings page under WP Jobfeed > Settings
4. Enter a username and password as well as choosing a page to use for your application form.
5. Request your integration with Jobfeed, instructing them how to send the data to your site.

== Frequently Asked Questions ==

Frequently asked questions are available [here](https://store.highrise.digital/docs/wp-Jobfeed/).

== Screenshots ==

1. The job edit screen in WordPress

== Changelog ==

= 3.0.6 =
* Preparations for WP Jobfeed search add-on which is now available.
* Correct an error where the license key for add-ons reports as failed but is actually working.

= 3.0.5 =
* Minor tweaks to the plugin updates and news sign-up form on the settings screen.
* Add the current logged in users email address to pre-populate the sign-up form on the settings screen.

= 3.0.4 =
* Added job feed notes to the default job fields and taxonomies.
* Added information to the settings page and the new support add-on.
* Move the after settings hooks so it is actually after all the settings on the settings page.
* Allows the job author to be set in WordPress based on the `consultant_email` field.

= 3.0.3 =
* Correct check for an empty value for the posted XML before proceeding with the inbox template. Prevents warnings when the posted data is incorrect and gives the appropriate error message.
* Fix a call to and undefined function in the post title filter functions. Thanks to @bencorke for contributing this fix and finding the bug.
* Add declaration that the plugin works with WP version 5.2.

= 3.0.2 (29/04/2019) =
* Correct the number of args referenced in the function `wpjf_set_application_email_data()`. Was set to reference 3 and now corrected to 4.
* Includes the permalink of a newly created job in the success message when a new job is posted successfully.
* Various minor bug fixes inlcuding typos.
* Show a checkbox field description next to rather than beneath the field input.

= 3.0.1 (24/04/2019) =
* Adds support for application via either an application form on site, or an external application URL.
* Improved some functions in terms of coding standards.
* Added a setting for the application type - allows site admins to choose whether candidates should apply via a form or an external URL.
* Escaped settings field description using `wp_kses_post` rather than 'esc_html' so they can include links.
* Added new function `wpjf_get_job_application_type()` which returns the type of application chosen. Either `form` or `url`.
* If applications are set to url, output a apply now button linking to the URL below the job content.
* Correct an incorrect entry in the `sample-add.xml` file.
* Adds plugin update routines.
* Corrects an issue where the plugin version does not show correctly in the admin settings page.


= 3.0 =
* IMPORTANT NOTICE BEOFRE UPDATING: WP Jobfeed version 3.0 is a major overhaul of the plugin from earlier versions. With this in mind, this version is NOT backward compatible to earlier versions. This means if you are running a version earlier than version 3.0 already, it is crucial that you test the update on a staging or test site before updating to the latest version.
* Deprecated the theme inbox file version located at `wpjf/inbox.php` in the active theme and replaced with `wpjobfeed.php` in the root of the active theme.
* Deprecated the double settings arrays. Settings should now be registered against the `wpjf_plugin_settings` filter.
* Adds options footer credit with a link back to plugin authors.
* No longer use the CMB Meta Box framework to provide the job fields on the job edit screen. This framework is no longer supported and therefore this has been removed and replaced with a native meta box solution.
* Newly configured way of storing applications, temporarily whilst notifications are sent and then removed for privacy and security reasons.
* Extensible application form where developers can now make changes to application fields.
* New endpoint URL which no longer uses a query string name and value, but an actual URL. The endpoint for jobs to be posted to is now `/wpjf/jobfeed/`.
* Application forms are now shown on job single page views rather than having a seperate page.
* Added a check for SSL. If your site is not running over SSL (https) a warning message is shown on the settings page.
* Allow users to display a credit to Highrise Digital below each single job post, should they wish the give something back to us!
* Allow the jobs post type to show in the REST API. This means that partial block editor (aka Gutenberg) support is provided. The edit screens now use the new block editor.
* Prepared the plugin for add-ons being released, namely allow add-ons to add settings to different admin menu pages.
* The job post ID is now appended to the jobs permalink slug. This prevents a job having the same URL as a deleted job in the future. 

To view the changelog for older versions of the plugin, please visit [the Github releases page](https://github.com/highrisedigital/wpjobfeed/releases).

== Upgrade Notice ==
Update through the WordPress admin as notified but always be sure to make a site backup before upgrading and better still, test on a staging or test site first.

Also please note that versions 2 and 3 are breaking change versions, and therefore updating from version 0 to 2 or 2 to 3 will cause the plugin to break without additional work being carried out.