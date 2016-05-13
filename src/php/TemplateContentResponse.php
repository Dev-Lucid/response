<?php
namespace Lucid\Response;

class TemplateContentResponse extends ContentResponse
{
    public function write(string $status='success')
    {
        ob_clean();
        header('Content-Type: application/json');
        $output = json_encode(['status'=>$status, 'data'=>$this->data], JSON_PRETTY_PRINT);
        exit($output);
    }
}
