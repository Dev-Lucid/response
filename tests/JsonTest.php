<?php
use Lucid\Response\JsonContentResponse;

class JsonTest extends \PHPUnit_Framework_TestCase
{
    public $response = null;

    public function setup()
    {
        $this->response = new JsonContentResponse();

    }

    public function testJson()
    {
        $this->expectOutputString('{
    "status": "success",
    "data": {
        "title": "test-title",
        "description": "test-description",
        "keywords": null,
        "preJavascript": "",
        "postJavascript": "",
        "replace": {
            "#body": "hiya"
        },
        "append": [],
        "prepend": [],
        "data": [],
        "messages": []
    }
}');
        $this->response->title('test-title');
        $this->response->description('test-description');
        $this->response->replace('#body','hiya');
        $this->response->write();
        ob_get_clean();
    }
}