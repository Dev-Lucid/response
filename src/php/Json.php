<?php
namespace DevLucid\Component\Response;

class Json extends Response
{
    public $data = [];

    public function send($status='success')
    {
        ob_clean();
        header('Content-Type: application/json');
        $output = json_encode(['status'=>$status, 'data'=>$this->data], JSON_PRETTY_PRINT);
        exit($output);
    }
}