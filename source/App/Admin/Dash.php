<?php

namespace Source\App\Admin;

use Source\Models\Auth;
use Source\Models\Sgfp\Categories;
use Source\Models\Sgfp\Launches;

/**
 * Class Dash
 * @package Source\App\Admin
 */
class Dash extends Admin
{
    /**
     * Dash constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     *
     */
    public function dash(): void
    {
        redirect("/admin/dash/home");
    }

    /**
     * @param array|null $data
     * @throws \Exception
     */
    public function home(?array $data): void
    {
        $head = $this->seo->render(
            CONF_SITE_NAME . " | Dashboard",
            CONF_SITE_DESC,
            url("/admin"),
            theme("/assets/images/share.jpg", CONF_VIEW_ADMIN),
            false
        );

        $monthOrYear = new \stdClass();
        if (!empty($_REQUEST["month"])) {
            $monthOrYear->month = $_REQUEST["month"];
            $monthOrYear->year = $_REQUEST["year"];
        } else {
            $monthOrYear->month = date('m');
            $monthOrYear->year = date('Y');
        }

        echo $this->view->render("home", [
            "app" => "dash",
            "head" => $head,
            "userName" => $this->user->name,
            "date" => date_fmt_mz(),
            "categories" => (new Categories())->find()->fetch(true),
            "totalAmount" => (new Launches())->find("type = :type", "type=1")->fetch(true),
            "totalUsed" => (new Launches())->find("type = :type", "type=0")->fetch(true),
            "total" => 0,
            "requested" => $monthOrYear
        ]);
    }

    /**
     *
     */
    public function logoff(): void
    {
        $this->message->success("Você saiu com sucesso {$this->user->name}.")->flash();

        Auth::logout();
        redirect("/");
    }
}