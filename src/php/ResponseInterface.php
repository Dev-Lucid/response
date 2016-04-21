<?php
namespace Lucid\Component\Response;

interface ResponseInterface
{
    public function reset();
    public function title(string $title);
    public function description(string $description);
    public function keywords(string $keywords);
    public function data(string $key, $data);
    public function javascript(string $js, $runBefore);
    public function message(string $message);
    public function replace(string $area, $content);
    public function append(string $area, $content);
    public function prepend(string $area, $content);
    public function clear(...$areas);
    public function write(string $status);
}