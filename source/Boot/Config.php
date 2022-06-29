<?php
/**
 * DATABASE
 */
define("CONF_DB_HOST", "localhost");
define("CONF_DB_USER", "root");
define("CONF_DB_PASS", "");
define("CONF_DB_NAME", "sgfp");

/**
 * PROJECT URLs
 */
define("CONF_URL_BASE", "https://www.sgfp.com.mz");
define("CONF_URL_TEST", "http://www.localhost/sgfp");
define("CONF_URL_ADMIN", "/admin");

/**
 * SITE
 */
define("CONF_SITE_ABBR", "SGFP");
define("CONF_SITE_NAME", "Sistema de Gestão de Finanças Pessoais");
define("CONF_SITE_TITLE", "Gerencie suas finanças da melhor forma possível, simples, seguro e rápido");
define("CONF_SITE_DESC", "O sistema de gestão de finanças pessoais, é um sistema que facilita no processo de gerências de finanças.");
define("CONF_SITE_LANG", "pt");
define("CONF_SITE_DOMAIN", "com.mz");
define("CONF_SITE_ADDR_ZIPCODE", "Caixa Postal N° 1120");
define("CONF_SITE_ADDR_CITY", "Marracuene");
define("CONF_SITE_ADDR_STATE", "Maputo");
define("CONF_SITE_ADDR_COUNTRY", "Moçambique");

/**
 * DATES
 */
define("CONF_DATE_MZ", "d/m/Y H:i:s");
define("CONF_DATE_APP", "Y-m-d H:i:s");
define("CONF_CURRENCY", "MZN");

/**
 * PASSWORD
 */
define("CONF_PASSWD_MIN_LEN", 8);
define("CONF_PASSWD_MAX_LEN", 40);
define("CONF_PASSWD_ALGO", PASSWORD_DEFAULT);
define("CONF_PASSWD_OPTION", ["cost" => 10]);

/**
 * VIEW
 */
define("CONF_VIEW_PATH", __DIR__ . "/../../shared/views");
define("CONF_VIEW_EXT", "php");
define("CONF_VIEW_THEME", "sgfpweb");
define("CONF_VIEW_ADMIN", "sgfpadm");

/**
 * MAIL
 */
define("CONF_MAIL_HOST", "smtp.sendgrid.net");
define("CONF_MAIL_PORT", "587");
define("CONF_MAIL_USER", "apikey");
define("CONF_MAIL_PASS", "****************************************************");
define("CONF_MAIL_SENDER", ["name" => "Joel L. Mandrasse", "address" => "sender@email.com"]);
define("CONF_MAIL_SUPPORT", "sender@support.com");
define("CONF_MAIL_OPTION_LANG", "br");
define("CONF_MAIL_OPTION_HTML", true);
define("CONF_MAIL_OPTION_AUTH", true);
define("CONF_MAIL_OPTION_SECURE", "tls");
define("CONF_MAIL_OPTION_CHARSET", "utf-8");