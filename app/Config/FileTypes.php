<?php

namespace Config;


class FileTypes
{

    public static array $file_types = [
        'jpg'    =>    'photo',
        'png'    =>    'photo',
        'gif'    =>    'photo',
        'jpeg'    =>   'photo',
        'tiff'    =>   'photo',
        'svg'    =>    '',
        'webp'    =>   'photo',
        'pdf'    =>    'document',
        'zip'    =>    'archive',
        'mp3'    =>    'audio',
        'mp4'    =>    'video',
        'php'    =>    'code'
    ];

    /**
     * Attempts to determine the best mime type for the given file extension.
     *
     * @return string|null The mime type found, or none if unable to determine.
     */
    public static function guessFileTypeFromExtension(string $extension)
    {
        $extension = trim(strtolower($extension), '. ');

        if (!array_key_exists($extension, static::$file_types)) {
            return null;
        }

        return static::$file_types[$extension];
    }
}
