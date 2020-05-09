<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

class Image extends DataLayer
{
    public function __construct()
    {
        parent::__construct("image", ["id_notice"], false);
    }

    public function add(Notice $notice, string $name): Image
    {
        $this->id_notice = $notice->id;
        $this->name = $name;

        return $this;
    }
}
