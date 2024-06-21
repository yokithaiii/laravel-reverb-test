<?php

namespace App\Contracts;

interface ImageSaverContract
{
    public function save(string $path, string $image);
    public function delete(string $image);
}
