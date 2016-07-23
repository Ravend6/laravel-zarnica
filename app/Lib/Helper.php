<?php

namespace App\Lib;

use GrahamCampbell\Markdown\Facades\Markdown;
// use League\CommonMark\CommonMarkConverter;

class Helper
{
    private $text;

    public function markdown($text)
    {
        $this->text = $text;
        return $this;
    }

    public function render()
    {
        return Markdown::convertToHtml($this->text);
    }

    public function markdownRender($text, $safe = true)
    {
        // $converter = new CommonMarkConverter();
        // if ($safe) {
        //     return htmlentities($converter->convertToHtml($text));
        // } else {
        //     return $converter->convertToHtml($text);
        // }
        \Config::set(['markdown' => ['safe' => $safe]]);

        return Markdown::convertToHtml($text);
    }

    public function getText()
    {
        return $this->text;
    }
}

