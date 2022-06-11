<?php

namespace Source\Models\Sgfp;

use Source\Core\Model;

/**
 * Class Launches
 * @package Source\Models\Sgfp
 */
class Launches extends Model
{
    /**
     * Launches constructor.
     */
    public function __construct()
    {
        parent::__construct("launches", ["id"], ["categories_id", "money"]);
    }
}