<?php
namespace Lucid\Response;

interface ContentResponseInterface
{
    public function title(string $title);
    public function description(string $description);
    public function keywords(string $keywords);
    public function javascript(string $js, $runBefore);
    public function message(string $message);
    public function replace(string $area, $content);
    public function append(string $area, $content);
    public function prepend(string $area, $content);
    public function clear(...$areas);
}