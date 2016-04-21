<?php
namespace Lucid\Component\Response;

class CliResponse extends Response
{
    public function __construct()
    {
        parent::__construct();
        while (ob_get_level() > 0) {
            ob_end_clean();
        }
    }

    public function write(string $status='success')
    {
        if (ob_get_level() > 0) {
            ob_end_clean();
        }
        echo ("\nResponse: $status\n-------------------\n");
        foreach($this->data as $key=>$value) {
            if (is_array($value) === true) {
                echo($key."=[" . ((count($value) > 0)?"\n":""));
                foreach($value as $subkey=>$subvalue) {
                    echo("\t".$subkey.' = '.$subvalue."\n");
                }
                echo("]\n");
            } else {
                echo($key.' = '.$value."\n");
            }
        }
        exit();
    }
}
