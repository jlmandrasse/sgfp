<?php

/**
 * ####################
 * ###   VALIDATE   ###
 * ####################
 */

/**
 * @param string $email
 * @return bool
 */
function is_email(string $email): bool
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

/**
 * @param string $password
 * @return bool
 */
function is_passwd(string $password): bool
{
    if (password_get_info($password)['algo'] || (mb_strlen($password) >= CONF_PASSWD_MIN_LEN && mb_strlen($password) <= CONF_PASSWD_MAX_LEN)) {
        return true;
    }

    return false;
}


/**
 * ##################
 * ###   ASSETS   ###
 * ##################
 */

/**
 * @param string|null $path
 * @return string
 * strpos = https ou strstr = http
 */
function theme(string $path = null, string $theme = CONF_VIEW_THEME): string
{
    if (strstr($_SERVER['HTTP_HOST'], "localhost")) {
        if ($path) {
            return CONF_URL_TEST . "/themes/{$theme}/" . ($path[0] == "/" ? mb_substr($path, 1) : $path);
        }

        return CONF_URL_TEST . "/themes/{$theme}";
    }

    if ($path) {
        return CONF_URL_BASE . "/themes/{$theme}/" . ($path[0] == "/" ? mb_substr($path, 1) : $path);
    }

    return CONF_URL_BASE . "/themes/{$theme}";
}


/**
 * ###############
 * ###   URL   ###
 * ###############
 */

/**
 * @param string $path
 * @return string
 * * strpos = https ou strstr = http
 */
function url(string $path = null): string
{
    if (strstr($_SERVER['HTTP_HOST'], "localhost")) { //Ambiente de teste
        if ($path) {
            return CONF_URL_TEST . "/" . ($path[0] == "/" ? mb_substr($path, 1) : $path);
        }
        return CONF_URL_TEST;
    }

    if ($path) { //Ambiente de produção
        return CONF_URL_BASE . "/" . ($path[0] == "/" ? mb_substr($path, 1) : $path);
    }

    return CONF_URL_BASE;
}

/**
 * retornando para a página anterior, a que estava navegando
 * @return string
 */
function url_back(): string
{
    return ($_SERVER['HTTP_REFERER'] ?? url());
}

/**
 * @param string $url
 */
function redirect(string $url): void
{
    header("HTTP/1.1 302 Redirect");
    if (filter_var($url, FILTER_VALIDATE_URL)) {
        header("Location: {$url}");
        exit;
    }

    if (filter_input(INPUT_GET, "route", FILTER_DEFAULT) != $url) {
        $location = url($url);
        header("Location: {$location}");
        exit;
    }
}

/**
 * @return string|null
 */
function request_uri(): ?string
{
    $uri = $_SERVER['REQUEST_URI'];
    $style = null;
    if (!empty($uri)) {
        if ($uri == "/sgfp/") {
            $style = "mt-sgfp-auth";
        }
        if ($uri == "/sgfp/recuperar") {
            $style = "mt-sgfp-forget";
        }
        if ($uri == "/sgfp/termos") {
            $style = "mt-sgfp-terms";
        }
    }
    return $style;
}

/**
 * ####################
 * ###   PASSWORD   ###
 * ####################
 */

/**
 * @param string $password
 * @return string
 */
function passwd(string $password): string
{
    if (!empty(password_get_info($password)['algo'])) {
        return $password;
    }

    return password_hash($password, CONF_PASSWD_ALGO, CONF_PASSWD_OPTION);
}

/**
 * @param string $password
 * @param string $hash
 * @return bool
 */
function passwd_verify(string $password, string $hash): bool
{
    return password_verify($password, $hash);
}

/**
 * @param string $hash
 * @return bool
 */
function passwd_rehash(string $hash): bool
{
    return password_needs_rehash($hash, CONF_PASSWD_ALGO, CONF_PASSWD_OPTION);
}


/**
 * ###################
 * ###   REQUEST   ###
 * ###################
 */

/**
 * @return string
 */
function csrf_input(): string
{
    $session = new \Source\Core\Session();
    $session->csrf();
    return "<input type='hidden' name='csrf' value='" . ($session->csrf_token ?? "") . "'/>";
}

/**
 * @param $request
 * @return bool
 */
function csrf_verify($request): bool
{
    $session = new \Source\Core\Session();
    if (empty($session->csrf_token) || empty($request['csrf']) || $request['csrf'] != $session->csrf_token) {
        return false;
    }
    return true;
}

/**
 * @return null|string
 */
function flash(): ?string
{
    $session = new \Source\Core\Session();
    if ($flash = $session->flash()) {
        return $flash;
    }
    return null;
}

/**
 * @param string $key
 * @param int $limit
 * @param int $seconds
 * @return bool
 */
function request_limit(string $key, int $limit = 5, int $seconds = 60): bool
{
    $session = new \Source\Core\Session();
    if ($session->has($key) && $session->$key->time >= time() && $session->$key->requests < $limit) {
        $session->set($key, [
            "time" => time() + $seconds,
            "requests" => $session->$key->requests + 1
        ]);
        return false;
    }

    if ($session->has($key) && $session->$key->time >= time() && $session->$key->requests >= $limit) {
        return true;
    }

    $session->set($key, [
        "time" => time() + $seconds,
        "requests" => 1
    ]);

    return false;
}

/**
 * @param string $field
 * @param string $value
 * @return bool
 */
function request_repeat(string $field, string $value): bool
{
    $session = new \Source\Core\Session();
    if ($session->has($field) && $session->$field == $value) {
        return true;
    }

    $session->set($field, $value);
    return false;
}

/**
 * @param string $month
 * @return string
 */
function months(string $month): string
{
    switch ($month) {
        case 01:
        case 1:
            $month = "Janeiro";
            break;
        case 02:
        case 2:
            $month = "Fevereiro";
            break;
        case 03:
        case 3:
            $month = "Março";
            break;
        case 04:
        case 4:
            $month = "Abril";
            break;
        case 05:
        case 5:
            $month = "Maio";
            break;
        case 06:
        case 6:
            $month = "Junho";
            break;
        case 07:
        case 7:
            $month = "Julho";
            break;
        case '08':
        case 8:
            $month = "Agosto";
            break;
        case '09':
        case 9:
            $month = "Setembro";
            break;
        case 10:
            $month = "Outubro";
            break;
        case 11:
            $month = "Novembro";
            break;
        case 12:
            $month = "Dezembro";
            break;
    }
    return $month;
}

/**
 * @return string
 */
function date_fmt_mz(): string
{
    $date = "Hoje: " . date('d') . " de " . months(date('m')) . " de " .
        date('Y') . " - " . date("H\hi");
    return $date;
}

/**
 * @param string $amount
 * @return string
 */
function str_amount(?string $amount): string
{
    return number_format((!empty($amount) ? $amount : 0), 2, ",", ".") . CONF_CURRENCY;
}


/**
 * @param string $day
 * @param string $month
 * @return string
 */
function month_date(string $day, string $month): string
{
    if (strlen($month) != 1) {
        return date("{$day}/{$month}");
    }

    return date("{$day}/0{$month}");
}

/**
 * @param int $category_id
 * @return object|null
 */
function category(int $category_id): ?object
{
    return (new \Source\Models\Sgfp\Categories())
        ->find("id = :id", "id={$category_id}", "name")
        ->fetch();
}

/**
 * @param int $type
 * @param int $month
 * @param int $year
 * @return array|mixed|\Source\Core\Model|null
 */
function launchInOrOut(int $type, int $month, int $year)
{
    return (new \Source\Models\Sgfp\Launches())
        ->find("types_id = :t AND month = :m AND year = :y", "t={$type}&m={$month}&y={$year}",
            "SUM(money) as total")
        ->fetch();
}

/**
 * @param int $type
 * @return array|mixed|\Source\Core\Model|null
 */
function launchGeneralInOrOut(int $type)
{
    return (new \Source\Models\Sgfp\Launches())
        ->find("types_id = :t", "t={$type}", "SUM(money) as total")
        ->fetch();
}