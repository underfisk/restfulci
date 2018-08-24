<?php

if (!function_exists('Ok'))
{
    /**
     * Ends the execution of this script with a given data to be rendered to the http request
     * This function formats the data automaticly if you don't send a format but if you specify it
     * it will try to convert for that data
     * 
     * @param any $data
     * @param any $format   We support XML, JSON and Text
     * 
     * @return void
     */
    function Ok($data, $format= NULL)
    {
        $CI = &get_instance();

        $data_output = "";
        $type_output = "text/plain";

        if ( isset($data) && $data !== "")
        {
            if ($format !== NULL)
            {
                if (is_array($data))
                {
                    if ($format === 'application/json' && !is_json($data))
                    {
                        $data_output = json_encode( $data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES );
                        $type_output = $format;  
                    }
                    else if ($format === 'application/xml' && !is_xml($data))
                    {
                        $xml = new SimpleXMLElement('<root/>');
                        array_walk_recursive($data, array ($xml, 'addChild'));
                        $data_output = $xml->asXML();
                        $type_output = $format;
                    }
                    else if (strpos($format, 'text') !== false)
                    {
                        $data_output = var_export($data);
                        $type_output = 'text/html';
                    }
                }
                else if ($format === "application/json")
                {
                    if (is_json($data))
                    {
                        $data_output = $data;
                    }
                    else if (is_xml($data))
                    {
                        $xml = simplexml_load_string($data);
                        $json = json_encode($xml);
                        $data_output = $json;
                    }
                    else
                    {
                        $data_output = json_encode( $data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES );
                    }

                    $type_output = $format;
                }
                else if ($format === "application/xml")
                {
                    if (is_xml($data))
                    {
                        $data_output = $data;
                    }
                    else if (is_json($data))
                    {
                        $arr = json_decode($data);
                        $xml = new SimpleXMLElement('<root/>');
                        array_walk_recursive($arr, array ($xml, 'addChild'));
                        $data_output = $xml->asXML();
                    }
                    else if (is_array($data))
                    {
                        $xml = new SimpleXMLElement('<root/>');
                        array_walk_recursive($data, array ($xml, 'addChild'));
                        $data_output = $xml->asXML();
                    }
                    else
                    {
                        $xml = "<message> {$data} </message>";
                        $data_output = $xml;
                    }
                    $type_output = $format;
                }
                else if (strpos($format, 'text') !== false)
                {
                    $data_output = var_export($data);
                    $type_output = 'text/html';
                }
                else
                {
                    $data_output = "Define a valid output format";
                    $type_output = "text/plain";
                }
            }
            else
            {
                if (is_array($data))
                {
                    $data_output = var_export($data);
                    $type_output = "text/html";
                }
                else if (is_json($data))
                {
                    $data_output = $data;
                    $type_output = 'application/json';
                }
                else if (is_xml($data))
                {
                    $data_output = $data;
                    $type_output = 'application/xml';
                }
                else
                {
                    $data_output = $data;
                    $type_output = 'text/plain';
                }
            }
        }
        else
            throw new Exception("Please insert a valid data information for OK Method");

        render($data_output, $type_output, 200, 'UTF-8');
    }
}

if (!function_exists('InternalServerError'))
{
    /**
     * Ends the execution of this script with a given error message
     * formated automaticly according to its type
     * 
     * @param any $error
     * 
     * @return void
     */
    function InternalServerError($error)
    {
        if (!isset($error) || $error === "")
            throw new Exception("Please insert a valid data information for InternalServerError Method");

        if (is_bool($error))
        {
            $error = json_encode($error);
            $format = "text/plain";
        }
        else if (is_array($error))
        {
            $format = "text/html"; 
            $error = var_export($error);
        }
        else if (is_xml($error))
            $format = "application/xml";
        else if (is_json($error))
            $format = "application/json";
        else
            $format = "text/plain";
        
        render($error, $format, 500, 'UTF-8');
    }
}

if (!function_exists('Forbidden'))
{
    /**
     * Ends the execution of the script forbidding the access to the page
     * 
     * @param string $msg
     * 
     * @return void
     */
    function Forbidden($msg)
    {
        if (!isset($msg) || $msg === "")
        throw new Exception("Please insert a valid data information for Forbidden Method");

        if (is_bool($msg))
        {
            $msg = json_encode($msg);
            $format = "text/plain";
        }
        else if (is_array($msg))
        {
            $format = "text/html"; 
            $msg = var_export($msg);
        }
        else if (is_xml($msg))
            $format = "application/xml";
        else if (is_json($msg))
            $format = "application/json";
        else
            $format = "text/plain";
        
        render($msg, $format, 403, 'UTF-8');
    }
}


if (!function_exists('is_json'))
{
    /**
     * Returns wheter the given string/object is a json object or not
     * 
     * @param string $string
     * 
     * @return bool
     */
    function is_json($string)
    {
        $decoded = json_decode($string);
        if ( !is_object($decoded) && !is_array($decoded) ) {
            return false;
        }
        return (json_last_error() == JSON_ERROR_NONE);
    }
}

if (!function_exists('is_xml'))
{
    /**
     * Returns wheter the given string/object is a xml object or not
     * 
     * @param string $string
     * 
     * @return bool
     */
    function is_xml($string)
    {
        if (is_array($string))
            return false;

        $content = trim($string);
        if (empty($content)) {
            return false;
        }

        if (stripos($content, '<!DOCTYPE html>') !== false) {
            return false;
        }
    
        libxml_use_internal_errors(true);
        simplexml_load_string($content);
        $errors = libxml_get_errors();          
        libxml_clear_errors();  
    
        return empty($errors);
    }
}

if (!function_exists('render'))
{
    /**
     * Displays the given information
     * 
     * @param any $data
     * @param string $type
     * @param int $code
     * @param string $charset
     * 
     * @return void
     */
    function render($data, $type, $code, $charset)
    {
        $CI = &get_instance();
        $CI->output->parse_exec_vars = FALSE; //disable parsing vars
        $CI->output->set_content_type($type, $charset)
                    ->set_output($data)
                    ->set_status_header($code)
                    ->_display();
        exit;
    }
}