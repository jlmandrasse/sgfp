<?php

namespace Source\Models\Sgfp;

use Source\Core\Model;

/**
 * Class Types
 * @package Source\Models\Sgfp
 */
class Types extends Model
{
    /**
     * Types constructor.
     */
    public function __construct()
    {
        parent::__construct("types", ["id"], ["name"]);
    }
}