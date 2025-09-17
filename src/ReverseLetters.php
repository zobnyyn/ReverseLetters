<?php

class ReverseLetters
{
    public static function reverse($text)
    {
        if ($text === '') {
            return $text;
        }

        $result = preg_replace_callback('/(\p{L}+)/u', function ($matches) {
            $segment = $matches[1];

            // Разбиваем сегмент на графемные кластеры для корректной работы с Unicode
            preg_match_all('/\X/u', $segment, $m);
            $chars = $m[0];

            // Флаги заглавности для каждой позиции исходного слова
            $origCases = array_map(function ($ch) {
                $upper = mb_strtoupper($ch, 'UTF-8');
                $lower = mb_strtolower($ch, 'UTF-8');
                return ($upper !== $lower) && ($ch === $upper);
            }, $chars);

            $reversed = array_reverse($chars);
            $new = array();

            // Применяем исходные флаги по позициям
            $len = count($reversed);
            for ($i = 0; $i < $len; $i++) {
                $ch = $reversed[$i];
                $isUpper = isset($origCases[$i]) ? $origCases[$i] : false;
                if ($isUpper) {
                    $new[] = mb_strtoupper($ch, 'UTF-8');
                } else {
                    $new[] = mb_strtolower($ch, 'UTF-8');
                }
            }

            return implode('', $new);
        }, $text);

        return $result === null ? $text : $result;
    }
}
