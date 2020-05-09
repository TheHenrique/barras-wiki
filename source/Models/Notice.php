<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

class Notice extends DataLayer
{
    public function __construct()
    {
        parent::__construct("notice", ["user_id", "type_notice", "title", "description"]);
    }

    public function images()
    {
        return (new Image())->find("id_notice = :uid", "uid={$this->id}")->fetch(true);
    }
}
