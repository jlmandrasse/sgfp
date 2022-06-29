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

        if (!empty($month) || !empty($year)) {
            $m = $month;
            $y = $year;
        }

        if (!empty($month) && !empty($year)) {

            $gateway = launchInOrOut(1, $m, $y);
            $exit = launchInOrOut(2, $m, $y);
            $totalThisMonth = $gateway->total - $exit->total;
        } else {

            $gateway = launchInOrOut(1, date("m"), date("Y"));
            $exit = launchInOrOut(2, date("m"), date("Y"));
            $totalThisMonth = $gateway->total - $exit->total;
        }

        if (!empty($m)) {

            $thisMonth = (new Launches())
                ->find("month = :m AND year = :y", "m={$m}&y={$y}")
                ->order("created_at DESC")
                ->fetch(true);
        }

        if (empty($m)) {

            $month = date("m");
            $year = date("Y");

            $thisMonth = (new Launches())
                ->find("month = :m AND year = :y", "m={$month}&y={$year}")
                ->order("created_at DESC")
                ->fetch(true);
        }

        if (!empty($filter)) {

            $month = (!empty($m) ? $m : date("m"));

            $find = $filter;
            $thisMonth = (new Launches())
                ->find("categories_id = :fk AND month = :m", "fk={$find}&m={$month}")
                ->fetch(true);
            $sum = (new Launches())
                ->find("categories_id = :fk AND month = :m", "fk={$find}&m={$month}", "types_id, SUM(money) as total")
                ->fetch();
            $totalFilter = $sum->total;

        } elseif (empty($filter)) {
            $thisMonth = (new Launches())
                ->find("month = :m AND year = :y", "m={$month}&y={$year}")
                ->fetch(true);
            $sum = (new Launches())
                ->find("month = :m AND year = :y AND types_id = :t", "m={$month}&y={$year}&t=1", "types_id, SUM(money) as total")
                ->fetch();
            $sub = (new Launches())
                ->find("month = :m AND year = :y AND types_id = :t", "m={$month}&y={$year}&t=2", "types_id, SUM(money) as total")
                ->fetch();
            $totalFilter = $sum->total - $sub->total;
        }

        echo $this->view->render("home", [
            "app" => "dash",
            "head" => $head,
            "userName" => $this->user->name,
            "date" => date_fmt_mz(),

            "filterGateway" => $_REQUEST,

            "categories" => (new Categories())
                ->find()
                ->fetch(true),

            "category" => (new Categories())
                ->find("id = :id", "id={}")
                ->fetch(true),

            "totalAmount" => (new Launches())
                ->find("types_id = :type", "type=1")
                ->fetch(true),

            "totalUsed" => (new Launches())
                ->find("types_id = :type", "type=2")
                ->fetch(true),

            "filter" => (object)[
                "month" => $month,
                "year" => $year,
                "category" => (!empty($filter) ? $filter : 0),
                "count" => ($sum->types_id ?? 0)
            ],
            "totalFilter" => $totalFilter,

            "totalGateway" => $gateway,
            "totalExit" => $exit,
            "totalThisMonth" => $totalThisMonth,
            "generalGateway" => launchGeneralInOrOut(1),
            "generalExit" => launchGeneralInOrOut(2),
            "totalResult" => (launchGeneralInOrOut(1)->total - launchGeneralInOrOut(2)->total),

            "thisMonth" => ($thisMonth ?? 0),

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