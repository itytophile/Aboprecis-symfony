<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    public function getFunctions()
    {
        return [
            new TwigFunction('he_decode', [$this, 'he_decode'])
        ];
    }

    public function he_decode(string $str)
    {
        return html_entity_decode($str, ENT_QUOTES);
    }
}