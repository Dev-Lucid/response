<?php
namespace Lucid\Response;

class DataResponse implements DataResponseInterface
{
    public $data = [];

    public function __construct()
    {
        $this->reset();
    }

    public function reset()
    {
        ob_start();
        $this->data = [
            'data'=>[],
        ];
    }

    public function data(string $key, $data)
    {
        $this->data['data'][$key] = $data;
        return $this;
    }

    public function getData(string $key) : array
    {
        return $this->data[$key];
    }

    public function write(string $status='success')
    {
        ob_clean();
        header('Content-Type: application/json');
        $output = json_encode(['status'=>$status, 'data'=>$this->data], JSON_PRETTY_PRINT);
        echo($output);
        ob_flush();
    }
}
