<?php

namespace Source\Models\Sgfp;

use Source\Core\Connect;
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

    /**
     * @return false|\PDOStatement
     */
    public function innerJoinLaunchCategoryType()
    {
        $data = Connect::getInstance()->query("SELECT l.id, c.name as category, t.name as type,
                                                            l.description, l.money as amount, l.created_at,
                                                            l.updated_at FROM launches as l INNER JOIN
                                                            categories as c INNER JOIN types as t ON
                                                            l.categories_id = c.id AND l.types_id = t.id");
        return $data;
    }
}