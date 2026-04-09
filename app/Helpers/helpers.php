<?php

if (!function_exists('avatar_data')) {
    function avatar_data($name)
    {
        $letter = strtoupper(substr($name, 0, 1));

        $colors = ['#FF5733', '#33C1FF', '#28A745', '#FFC107', '#6F42C1'];
        $color = $colors[crc32($name) % count($colors)];

        return [
            'letter' => $letter,
            'color'  => $color
        ];
    }
}