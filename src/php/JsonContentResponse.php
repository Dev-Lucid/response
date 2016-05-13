<?php
namespace Lucid\Response;

class JsonContentResponse extends ContentResponse
{
    public function write(string $status='success')
    {
        ob_clean();
        header('Content-Type: application/json');
        $output = json_encode(['status'=>$status, 'data'=>$this->data], JSON_PRETTY_PRINT);
        echo($output);
        ob_flush();
    }


    public function redirect(string $newViewObject, $viewMethod='index')
    {
        $this->javascript('lucid.updateHash(\'#!'.$newViewObject.'.view.'.$viewMethod.'\');');
    }

}
