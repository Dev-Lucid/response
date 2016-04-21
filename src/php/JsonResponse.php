<?php
namespace Lucid\Component\Response;

class JsonResponse extends Response
{
    public function write(string $status='success')
    {
        ob_clean();
        header('Content-Type: application/json');
        $output = json_encode(['status'=>$status, 'data'=>$this->data], JSON_PRETTY_PRINT);
        echo($output);
        ob_flush();
    }
}
