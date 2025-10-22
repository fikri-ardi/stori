<?php

use Illuminate\Support\Str;

if (!function_exists('cleanText')) {
    function cleanText(string $text): string
    {
        return Str::of($text)
            ->replace(["'", '"', ';', '-', '–', '—'], ' ')
            ->squish()
            ->lower()
            ->value();
    }
}
