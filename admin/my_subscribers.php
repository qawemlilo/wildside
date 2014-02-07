<?php
define('INCLUDE_CHECK',true);

require 'connect.php';
require 'function.php';

session_name('tzLogin');
session_set_cookie_params(2*7*24*60*60);
session_start();
include 'maststrip.php'; 
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
		"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>people</title>
<style type="text/css"> @import url("css.css"); </style>
<link rel="stylesheet" type="text/css" media="screen"  href="jscalendar/calendar-system.css"> 
<script type="text/javascript" src="jscalendar/calendar.js"></script>
<script type="text/javascript" src="jscalendar/calendar-en.js"></script>
<script type="text/javascript" src="jscalendar/calendar-setup.js"></script>
</head>
<body>
<div class="content">
<h1 style="padding-bottom:25px;">Subscribers</h1>
<?php
if($_SESSION['id'])
{




/*
 * IMPORTANT NOTE: This generated file contains only a subset of huge amount
 * of options that can be used with phpMyEdit. To get information about all
 * features offered by phpMyEdit, check official documentation. It is available
 * online and also for download on phpMyEdit project management page:
 *
 * http://platon.sk/projects/main_page.php?project_id=5
 *
 * This file was generated by:
 *
 *                    phpMyEdit version: 5.7.1
 *       phpMyEdit.class.php core class: 1.204
 *            phpMyEditSetup.php script: 1.50
 *              generating setup script: 1.50
 */

// MySQL host name, user name, password, database, and table
$opts['hn'] = 'mysql55.pointinspace.com';
$opts['un'] = 'LIG_lightship';
$opts['pw'] = 'lightinusa';
$opts['db'] = 'lig_wildside';
$opts['tb'] = 'w_subscribers';

// Name of field which is the unique key
$opts['key'] = 'sub_id';

// Type of key field (int/real/string/date etc.)
$opts['key_type'] = 'int';

// Sorting field(s)
$opts['sort_field'] = array('-date');

// Number of records to display on the screen
// Value of -1 lists all records in a table
$opts['inc'] = 25;

// Options you wish to give the users
// A - add,  C - change, P - copy, V - view, D - delete,
// F - filter, I - initial sort suppressed
$opts['options'] = 'ACDF';

// Number of lines to display on multiple selection filters
$opts['multiple'] = '4';

// Navigation style: B - buttons (default), T - text links, G - graphic links
// Buttons position: U - up, D - down (default)
$opts['navigation'] = 'UDG';

// Display special page elements
$opts['display'] = array(
	'form'  => true,
	'query' => true,
	'sort'  => true,
	'time'  => true,
	'tabs'  => true
);

// Set default prefixes for variables
$opts['js']['prefix']               = 'PME_js_';
$opts['dhtml']['prefix']            = 'PME_dhtml_';
$opts['cgi']['prefix']['operation'] = 'PME_op_';
$opts['cgi']['prefix']['sys']       = 'PME_sys_';
$opts['cgi']['prefix']['data']      = 'PME_data_';

/* Get the user's default language and use it if possible or you can
   specify particular one you want to use. Refer to official documentation
   for list of available languages. */
$opts['language'] = $_SERVER['HTTP_ACCEPT_LANGUAGE'] . '-UTF8';

/* Table-level filter capability. If set, it is included in the WHERE clause
   of any generated SELECT statement in SQL query. This gives you ability to
   work only with subset of data from table.

$opts['filters'] = "column1 like '%11%' AND column2<17";
$opts['filters'] = "section_id = 9";
$opts['filters'] = "PMEtable0.sessions_count > 200";
*/

/* Field definitions
   
Fields will be displayed left to right on the screen in the order in which they
appear in generated list. Here are some most used field options documented.

['name'] is the title used for column headings, etc.;
['maxlen'] maximum length to display add/edit/search input boxes
['trimlen'] maximum length of string content to display in row listing
['width'] is an optional display width specification for the column
          e.g.  ['width'] = '100px';
['mask'] a string that is used by sprintf() to format field output
['sort'] true or false; means the users may sort the display on this column
['strip_tags'] true or false; whether to strip tags from content
['nowrap'] true or false; whether this field should get a NOWRAP
['select'] T - text, N - numeric, D - drop-down, M - multiple selection
['options'] optional parameter to control whether a field is displayed
  L - list, F - filter, A - add, C - change, P - copy, D - delete, V - view
            Another flags are:
            R - indicates that a field is read only
            W - indicates that a field is a password field
            H - indicates that a field is to be hidden and marked as hidden
['URL'] is used to make a field 'clickable' in the display
        e.g.: 'mailto:$value', 'http://$value' or '$page?stuff';
['URLtarget']  HTML target link specification (for example: _blank)
['textarea']['rows'] and/or ['textarea']['cols']
  specifies a textarea is to be used to give multi-line input
  e.g. ['textarea']['rows'] = 5; ['textarea']['cols'] = 10
['values'] restricts user input to the specified constants,
           e.g. ['values'] = array('A','B','C') or ['values'] = range(1,99)
['values']['table'] and ['values']['column'] restricts user input
  to the values found in the specified column of another table
['values']['description'] = 'desc_column'
  The optional ['values']['description'] field allows the value(s) displayed
  to the user to be different to those in the ['values']['column'] field.
  This is useful for giving more meaning to column values. Multiple
  descriptions fields are also possible. Check documentation for this.
*/

$opts['fdd']['sub_id'] = array(
  'name'     => 'Sub ID',
  'select'   => 'T',
  'options'  => 'AVCPDR', // auto increment
  'maxlen'   => 11,
  'default'  => '0',
  'sort'     => true
);
$opts['fdd']['date'] = array(
  'name'     => 'Date',
  'select'   => 'T',
  'maxlen'   => 10,
  'sort'     => true,
  'nowrap' => true,
);
$opts['fdd']['delivery_lastname'] = array(
  'name'     => 'Delivery lastname',
  'select'   => 'T',
  'maxlen'   => 100,
  'sort'     => true
);
$opts['fdd']['delivery_firstname'] = array(
  'name'     => 'Delivery firstname',
  'select'   => 'T',
  'maxlen'   => 100,
  'sort'     => true
);
$opts['fdd']['subscription_type'] = array(
  'name'     => 'Subscription type',
  'select'   => 'T',
  'maxlen'   => 100,
  'sort'     => true
);
$opts['fdd']['email'] = array(
  'name'     => 'Email',
  'select'   => 'T',
  'maxlen'   => 100,
  'sort'     => true
);
$opts['fdd']['tel'] = array(
  'name'     => 'Tel',
  'select'   => 'T',
  'maxlen'   => 30,
  'sort'     => true
);
$opts['fdd']['delivery_street_address'] = array(
  'name'     => 'Delivery street address',
  'select'   => 'T',
  'maxlen'   => 100,
  'sort'     => true
);
$opts['fdd']['delivery_suburb'] = array(
  'name'     => 'Delivery suburb',
  'select'   => 'T',
  'maxlen'   => 100,
  'sort'     => true
);
$opts['fdd']['delivery_city'] = array(
  'name'     => 'Delivery city',
  'select'   => 'T',
  'maxlen'   => 100,
  'sort'     => true
);
$opts['fdd']['delivery_postcode'] = array(
  'name'     => 'Delivery postcode',
  'select'   => 'T',
  'maxlen'   => 100,
  'sort'     => true
);
$opts['fdd']['delivery_state'] = array(
  'name'     => 'Delivery state',
  'select'   => 'T',
  'maxlen'   => 100,
  'sort'     => true
);
$opts['fdd']['delivery_country'] = array(
  'name'     => 'Delivery country',
  'select'   => 'T',
  'maxlen'   => 100,
  'sort'     => true
);
$opts['fdd']['gift'] = array(
  'name'     => 'Gift',
  'select'   => 'T',
  'maxlen'   => 3,
  'sort'     => true
);
$opts['fdd']['payment_confirmation'] = array(
  'name'     => 'Payment confirmation',
  'select'   => 'T',
  'maxlen'   => 400,
  'sort'     => true
);

// Now important call to phpMyEdit
require_once 'phpMyEdit.class.php';
new phpMyEdit($opts);



}
?>
</div>
</body>
</html>
