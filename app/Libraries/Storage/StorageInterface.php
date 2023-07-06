<?php

namespace App\Libraries\Storage;

interface StorageInterface
{
    public function addStream($stream, $name): bool;
    public function readStream();
    public function delete(): bool;
}
