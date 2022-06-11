<?php

namespace Source\App\Admin;

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
        if (!empty($data["categories_id"]) || !empty($data["money"])) {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

            $launch = new Launches();
            $launch->categories_id = $data["categories_id"];
            $launch->type = $data["type"];
            $date = explode("/", $data["date"]);
            $launch->day = $date[0];
            $launch->month = $date[1];
            $launch->year = $date[2];
            $launch->description = $data["description"];
            $launch->money = $data["money"];

            if (!$launch->save()) {
                $json["message"] = $launch->message()->render();
                echo json_encode($json);
                return;
            }

            $this->message->success("Novo lançamento criado com sucesso.")->flash();
            $json["redirect"] = url("/admin");
            echo json_encode($json);
            return;
        }

        $this->message->error("Prencha o campo para continuar.")->flash();
        $json["redirect"] = url("/admin");
        echo json_encode($json);
        return;
    }
}