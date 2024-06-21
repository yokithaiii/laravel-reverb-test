<?php

namespace App;

use App\Contracts\ImageSaverContract;

class TestClass implements ImageSaverContract
{
    public function save($path, $image)
    {
        return true;
    }

    public function delete($image) {
        return true;
    }
}
