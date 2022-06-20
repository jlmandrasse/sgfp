<?php

namespace Source\App\Admin;

use Source\Models\Sgfp\Categories;
use Source\Models\Sgfp\Launches;

/**
 * Class Launch
 * @package Source\App\Admin
 */
class Launch extends Admin
{
    /**
     * Launch constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * CREATE LAUNCH
     * @param array|null $data
     */
    public function create(?array $data): void
    {
        if (!empty($data["categories_id"]) && !empty($data["money"])) {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

            $launch = new Launches();
            $launch->categories_id = $data["categories_id"];
            $launch->types_id = $data["type_id"];
            $date = explode("-", $data["date"]);
            $launch->day = $date[2];
            $launch->month = $date[1];
            $launch->year = $date[0];
            $launch->description = $data["description"];
            $launch->money = $data["money"];

            if (!$launch->save()) {
                $json["message"] = $launch->message()->render();
                echo json_encode($json);
                return;
            }

            $this->message->success("Novo movimento adicionado com sucesso.")->flash();
            $json["redirect"] = url("/admin");
            echo json_encode($json);
            return;
        }

        $this->message->error("Prencha todos os campos para continuar.")->flash();
        $json["redirect"] = url("/admin");
        echo json_encode($json);
        return;
    }

    /**
     * READ LAUNCH
     * @param array|null $data
     */
    public function read(?array $data): void
    {
        if (!empty($data["id"])) {

            $launch = (new Launches())->findById($data["id"]);
            $category = (new Categories())->find("id = :id", "id={$launch->categories_id}")->fetch(true);

            echo json_encode([
                "launch" => [
                    "id" => $launch->id,
                    "category" => ["id" => $category[0]->id, "name" => $category[0]->name],
                    "type" => $launch->types_id,
                    "date" => date($launch->year . '-' . $launch->month . '-' . $launch->day),
                    "description" => $launch->description,
                    "money" => $launch->money,
                ]
            ]);
        }
    }

    /**
     * UPDATE LAUNCH
     * @param array|null $data
     */
    public function update(?array $data): void
    {
        if (!empty($data["id"])) {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

            $launch = (new Launches())->findById($data["id"]);

            if (!$launch) {
                $this->message->error("Você tentou atualizar um movimento que não existe ou foi removida")->flash();
                echo json_encode(["redirect" => url("/admin")]);
                return;
            }

            $launch->categories_id = $data["categories_id"];
            $launch->types_id = $data["types_id"];
            $date = explode("-", $data["date"]);
            $launch->day = $date[2];
            $launch->month = $date[1];
            $launch->year = $date[0];
            $launch->description = $data["description"];
            $launch->money = $data["money"];

            if (!$launch->save()) {
                $json["message"] = $launch->message()->render();
                echo json_encode($json);
                return;
            }

            $this->message->success("Movimento atualizado com sucesso...")->flash();

            echo json_encode(["redirect" => url("/admin")]);
            return;
        }

        $this->message->error("Houve um erro durante o processo de atualiação do movimento...")->flash();

        echo json_encode(["redirect" => url("/admin"), "data" => $data]);
        return;
    }

    /**
     * DELETE LAUNCH
     * @param array|null $data
     */
    public function delete(?array $data): void
    {
        if (!empty($data["id"])) {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $launch = (new Launches())->findById($data["id"]);

            if (!$launch) {
                $this->message->error("Você tentou remover um movimento que não existe")->flash();
                echo json_encode(["redirect" => url("/admin")]);
                return;
            }

            $launch->destroy();
            $this->message->success("Tudo pronto {$this->user->name}. O movimento foi removido com sucesso!")->flash();

            echo json_encode(["redirect" => url("/admin")]);
            return;
        }
    }
}