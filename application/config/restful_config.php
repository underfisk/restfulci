<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * Specify here the allowed formats the application can reply
 * according to the asking data format (by default allow atleast 1)
 * (Full list under)
 * @link https://www.sitepoint.com/mime-types-complete-list/
 * 
 * @var array
 */
$config['allowed_content_types'] = array(
    'application/json',
    'application/x-www-form-urlencoded'
);


/**
 * Permits you to manually set server headers, which the output class will send for you 
 * when outputting the final rendered display
 * (Full list under)
 * @link https://en.wikipedia.org/wiki/List_of_HTTP_header_fields
 * 
 * @var array
 */
$config['server_headers'] = array(
    'Access-Control-Allow-Origin:'  => '*', //We do not recommend you to set for ALl but specify it
    'Access-Control-Allow-Headers:' => 'X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding',
    'Access-Control-Allow-Methods:' => 'POST, GET'
);

/**
 * Determinate whether you want the whitelist validation
 * to be enabled
 * (NOT RECOMMENDED IF YOU WANT TO USE THIRD PARTY TOOL'S LIKE POSTMAN)
 * 
 * @var bool
 */
$config['whitelist_enabled'] = true;

/**
 * Whitelist of addresses/ip that can get information of this API
 * (Disable if you want to allow everyone)
 * 
 * @var array
 */
$config['whitelist_addr'] = array(
    'localhost',
    '127.0.0.1'
);

