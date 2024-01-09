=== LearnPress - Content Drip ===
Contributors: thimpress, tunnhn, leehld
Donate link:
Tags: drip, lms, commission, fee, learnpress, elearning, e-learning, learning management system, education, course, courses, quiz, quizzes, questions, training, guru, sell courses
Requires at least: 6.8
Tested up to: 6.4.1
Stable tag: 4.0.5
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl-3.0.html

== Description ==

== Installation ==

1. Download Coming soon courses Plugin to your desktop.
2. If downloaded as a zip archive, extract the Plugin folder to your desktop.
3. With your FTP program, upload the Plugin folder to the wp-content/plugins folder in your WordPress directory online.
4. Go to Plugins screen and find the newly uploaded Plugin in the list.
5. Click Activate to activate it.

== Changelog ==

= 4.0.5 (2023-11-18) =
~ Tweak: change logic, user can view item Preview or item's course set "no requirement enroll" if haven't enrolled course.

= 4.0.4 (2023-07-04) =
~ Fixed: link item's course require.

= 4.0.3 (2023-04-07) =
~ Fixed: Drip type "Specific Day" timezone.
~ Fixed: error with max_input_vars.
~ Tweak: logic for each drip type.
~ Display: message in human time.
~ Added: message note if user does not save setting.
~ When configuring content drips, the message display timezone is now set.
~ Optimize code.

= 4.0.2 (2022-09-23) =
~ Fixed: some minor bugs.

= 4.0.1 =
~ Fixed: Call and min file js - hungkv

= 4.0.0 =
~ Fixed: Compatible LP4

= 3.1.8 =
~ Fixed: Cannot modify header information
~ Add hook: lp_calculate_time_drip_items, lp_drip_delay_types

= 3.1.7 =
~ Fixed: when user edit course then choose 'Drip Type' is 3. prerequisite on http://localhost/thimpress/eduma/wp-admin/admin.php?page=content-drip-items
~ Fixed: error save 'Delay access' set type 'Specific date' value is 1970,
when set 'Site Language' WP is 'Espanol, Vietnamese, v.v.. (not default English)'
and set Date Format is 'F j, Y', 'j. F, Y', Custom

= 3.1.6 =
~ Remove code fixed header by tuanta ('settings-updated updated' => element class removed)

= 3.1.5 =
~ Fixed some minor bugs

= 3.1.4 =
~ Fixed bug when using prerequisite type with Internal Time.

= 3.1.3 =
~ Fixed several notice messages when viewing on front end.
+ Added 1 more hook to check the status of the assignment item.

= 3.1.2 =
~ Fixed js error: not load select2.js.

= 3.1.1 =
~ Fixed bug: store January 1st 1970 when saving settings.

= 3.1.0 =
~ Allowed Instructors accessing Content Drip Settings page.
~ Fixed bug: several texts can not be translated.
~ Fixed bug: store wrong date when using unusally date format.

= 3.0.9 =
~ Fixed bug: error loadding when guest user view lesson

= 3.0.8 =
~ Fixed bug: Missing column "Prerequisite" in list of "Drip items"

= 3.0.7 =
~ Fixed bug: no lesson, quiz show in Content Drip Settings page for Course

= 3.0.6 =
+ Specific date to open for each item
+ Prerequisite items
+ Improve config drip items

= 3.0.5 =
+ Compatible with Learnpress 3.0.8

= 3.0.4 =
+ Update restrict content immediately items

= 3.0.3 =
+ Fix Cannot click on options in Drip items table

= 3.0.2 =
+ Update filter template content

= 3.0.1 =
+ Fix issue add content drip meta box in admin course page
+ Update feature Open course items sequentially

= 3.0.0 =
+ Updated to be compatible with Learnpress 3.0.0
