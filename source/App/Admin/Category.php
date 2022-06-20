<?php

namespace Source\App\Admin;

use Source\Models\Sgfp\Categories;

/**
 * Class Category
 * @package Source\App\Admin
 */
class Category extends Admin
{
    /**
     * Category constructor.
     */
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

    /**
     * READ CATEGORY
     * @param array|null $data
     */
    public function read(?array $data): void
    {
        if (!empty($data["id"])) {

            $category = (new Categories())->findById($data["id"]);

            echo json_encode([
                "category" => [
                    "id" => $category->id,
                    "name" => $category->name
                ]
            ]);
        }
    }

    /**
     * UPDATE CATEGORY
     * @param array|null $data
     */
    public function update(?array $data): void
    {
        if (!empty($data["id"])) {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

            $category = (new Categories())->findById($data["id"]);

            if (!$category) {
                $this->message->error("Você tentou atualizar uma categoria que não existe ou foi removida")->flash();
                echo json_encode(["redirect" => url("/admin")]);
                return;
            }

            $category->name = $data["name"];

            if (!$category->save()) {
                $json["message"] = $category->message()->render();
                echo json_encode($json);
                return;
            }

            $this->message->success("Categoria atualizada com sucesso...")->flash();

            echo json_encode(["redirect" => url("/admin")]);
            return;
        }

        $this->message->error("Houve um erro durante o processo de atualiação da categoria...")->flash();

        echo json_encode(["redirect" => url("/admin")]);
        return;
    }

    /**
     * DELETE CATEGORY
     * @param array|null $data
     */
    public function delete(?array $data): void
    {
        if (!empty($data["id"])) {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $category = (new Categories())->findById($data["id"]);

            if (!$category) {
                $this->message->error("Você tentou remover uma categoria que não existe")->flash();
                echo json_encode(["redirect" => url("/admin")]);
                return;
            }

            if (!$category->destroy()) {
                $this->message->warning("Esta categoria não pode ser removida, pois há movimentos associados...")->flash();
                echo json_encode(["redirect" => url("/admin")]);
                return;
            }

            $this->message->success("Tudo pronto {$this->user->name}. A categoria foi removida com sucesso!")->flash();

            echo json_encode(["redirect" => url("/admin")]);
            return;
        }
    }
}