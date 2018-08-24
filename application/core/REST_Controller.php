<?php

/**
 * By extending of REST_Controller it's assured the configuration being loaded
 * and the CORS being defined
 * 
 * @author Enigma
 * @link https://github.com/underfisk/restfulci
 * @package CI_Restful
 * @version 1.0.0
 */

include APPPATH . 'exceptions/MissingException.php';

class REST_Controller extends CI_Controller
{
    /**
     * Holds the configuration file reference
     * 
     * @var object
     */
    private $_config = null;

    public function __construct($config_name = "restful_config" )
    {
        //Call parent constructor
        parent::__construct();

        //Make sure config is loaded
        if ( $this->_config === null && !$this->config->item($config_name) !== null)
        {
            try{
                $this->load->config($config_name, TRUE);
                $this->_config = $this->config->item($config_name);
            }
            catch(Exception $ex)
            {
                throw new Exception("Please check your configuration file, it is not being loaded and we can't proceed!");
            }
        }

        //Initialize Headers with Cross Origin Configs
        $this->InitializeHeaders();

        //Checks what's coming on
        $this->VerifyContentType();

        if ($this->_config['whitelist_enabled'])
        {
            //Validates allowed hosts
            $this->AddressOnWhiteList();
        }
    }

    /**
     * Loops trought whitelist array and check if the incoming request is allowed
     * 
     * @return void
     */
    private function AddressOnWhiteList()
    {
        if ( isset($this->_config['whitelist_addr']) && is_array($this->_config['whitelist_addr']))
        {
            if (count($this->_config['whitelist_addr']) > 0)
            {
                $request_addr = $this->input->server('REMOTE_ADDR');
                if ($request_addr === '::1')
                    $request_addr = "localhost";

                if (!in_array($request_addr, $this->_config['whitelist_addr']))
                {
                    Forbidden('No access allowed for this endpoint');
                }
            }
        }
    }

    /**
     * Loops trought the array of headers and defines the server headers
     * 
     * @return void
     */
    private function InitializeHeaders()
    {
        if ( isset($this->_config['server_headers']) && is_array($this->_config['server_headers']))
        {
            if (count($this->_config['server_headers']) > 0)
            {
                foreach($this->_config['server_headers'] as $key => $value)
                {
                    $this->output->set_header($key, $value);
                }
            }
        }
    }

    /**
     * Checks if the request content type is allowed
     * 
     * @return void
     */
    private function VerifyContentType()
    {
        if ($this->input->server('REQUEST_METHOD') === "OPTIONS")
           exit;

        if ( isset($this->_config['allowed_content_types']) && is_array($this->_config['allowed_content_types']) )
        {
            if ($this->input->server('REQUEST_METHOD') !== 'GET')
            {
                if ( !in_array( strtolower($this->input->server('CONTENT_TYPE')), $this->_config['allowed_content_types']) )
                {
                    InternalServerError("Content type is not accepted by this server");
                }
            }
        }
        else
            throw new MissingException("Please verify your allowed formats in your configuration file");
    }
}