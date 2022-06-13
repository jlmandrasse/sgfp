<?php

namespace Source\App\Admin;

use Source\Models\Sgfp\Categories;

class Category extends Admin
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * CREATE CATEGORY
     * @param null|array $data
     */
    public function create(?array $data): void
    {
        if (!empty($data["name"])) {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

            $category = new Categories();
            $category->name = $data["name"];

            if (!$category->save()) {
                $json["message"] = $category->message()->render();
                echo json_encode($json);
                return;
            }

            $this->message->success("Categoria criada com sucesso.")->flash();
            $json["redirect"] = url("/admin");

            echo json_encode($json);
            return;
        }

        $this->message->error("Prencha o campo nova categoria para continuar.")->flash();
        $json["redirect"] = url("/admin");
        echo json_encode($json);
        return;
    }
}