<?php
namespace Lucid\Component\Response;

class Json extends Response
{
    public function write(string $status='success')
    {
        ob_clean();
        header('Content-Type: application/json');
        $output = json_encode(['status'=>$status, 'data'=>$this->data], JSON_PRETTY_PRINT);
        exit($output);
    }

    public function redirect(string $newViewObject, $viewMethod='index')
    {
        \Lucid\lucid::factory()->view($newViewObject)->$viewMethod();
        \Lucid\lucid::response()->javascript('lucid.updateHash(\'#!'.$newViewObject.'.view.'.$viewMethod.'\');');
    }
}
