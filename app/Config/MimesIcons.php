<?php

namespace Config;


class MimesIcons
{

    public static array $mimes_icons = [
        'jpg'    =>    'file-image',
        'png'    =>    'file-image',
        'gif'    =>    'file-image',
        'jpeg'    =>    'file-image',
        'tiff'    =>    'file-image',
        'svg'    =>    'file-image',
        'webp'    =>    'file-image',
        'pdf'    =>    'file-pdf',
        'zip'    =>    'file-zipper',
        'mp3'    =>    'file-audio',
        'mp4'    =>    'film',
        'php'    =>    'file-code'
    ];

    /**
     * Attempts to determine the best mime type for the given file extension.
     *
     * @return string|null The mime type found, or none if unable to determine.
     */
    public static function guessIconFromExtension(string $extension)
    {
        $extension = trim(strtolower($extension), '. ');

        if (!array_key_exists($extension, static::$mimes_icons)) {
            return null;
        }

        return static::$mimes_icons[$extension];
    }
}
