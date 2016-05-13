<?php
namespace Lucid\Response;

interface DataResponseInterface
{
    public function reset();
    public function data(string $key, $data);
    public function getData(string $key) : array;
    public function write(string $status);
}