<?php

namespace Source\App\Admin;

use Source\Models\Auth;

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

        echo $this->view->render("home", [
            "app" => "dash",
            "head" => $head,
            "userName" => $this->user->name
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