<?php

namespace Source\Models\Sgfp;

use Source\Core\Model;

/**
 * Class Categories
 * @package Source\Models\Sgfp
 */
class Categories extends Model
{
    /**
     * Categories constructor.
     */
    public function __construct()
    {
        parent::__construct("categories", ["id"], ["name"]);
    }
}