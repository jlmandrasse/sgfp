<?php

namespace Source\App\Admin;

use Source\Models\Auth;
use Source\Models\Sgfp\Categories;
use Source\Models\Sgfp\Launches;
use Source\Models\Sgfp\Types;

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
        extract($_GET);

        $head = $this->seo->render(
            CONF_SITE_NAME . " | Dashboard",
            CONF_SITE_DESC,
            url("/admin"),
            theme("/assets/images/share.jpg", CONF_VIEW_ADMIN),
            false
        );

        $monthOrYear = new \stdClass();
        if (!empty($month)) {
            $monthOrYear->month = $month;
            $monthOrYear->year = $year;
        } else {
            $monthOrYear->month = date('m');
            $monthOrYear->year = date('Y');
        }

        if (!empty($month) && !empty($year)) {
            $gateway = (new Launches())
                ->find(
                "types_id = :t AND month = :m AND year = :y",
                "t=1&m={$month}&y={$year}",
                "SUM(money) as total")
                ->fetch();

            $exit = (new Launches())
                ->find(
                    "types_id = :t AND month = :m AND year = :y",
                    "t=2&m={$month}&y={$year}",
                    "SUM(money) as total")
                ->fetch();

            $result = $gateway->total - $exit->total;

            $generalGatewayBalance = (new Launches())
                ->find(
                    "types_id = :t",
                    "t=1",
                    "SUM(money) as total")
                ->fetch();

        } else {
            $month = date("m");
            $year = date("Y");
            $gateway = (new Launches())
                ->find(
                "types_id = :t AND month = :m AND year = :y",
                "t=1&m={$month}&y={$year}",
                "SUM(money) as total")
                ->fetch();

            $exit = (new Launches())
                ->find(
                    "types_id = :t AND month = :m AND year = :y",
                    "t=2&m={$month}&y={$year}",
                    "SUM(money) as total")
                ->fetch();

            $result = $gateway->total - $exit->total;
        }

        $generalGateway = (new Launches())
        ->find(
            "types_id = :t",
            "t=1",
            "SUM(money) as total")
        ->fetch();

        $generalExit = (new Launches())
        ->find(
            "types_id = :t",
            "t=2",
            "SUM(money) as total")
        ->fetch();

        echo $this->view->render("home", [
            "app" => "dash",
            "head" => $head,
            "userName" => $this->user->name,
            "date" => date_fmt_mz(),

            "categories" => (new Categories())
                ->find()
                ->fetch(true),

            "totalAmount" => (new Launches())
                ->find("types_id = :type", "type=1")
                ->fetch(true),

            "totalUsed" => (new Launches())
                ->find("types_id = :type", "type=2")
                ->fetch(true),

            "totalGateway" => $gateway,
            "totalExit" => $exit,
            "result" => $result,
            "generalGateway" => $generalGateway,
            "generalExit" => $generalExit,
            "totalResult" => ($generalGateway->total - $generalExit->total),
            "total" => 0,
            "requested" => $monthOrYear,

            "launches" => (new Launches())
                ->innerJoinLaunchCategoryType()
                ->fetchAll(),

            "type" => (new Types())
                ->find()
                ->fetch(true)
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