<?php

class Container
{
    static $instances = array();

    public static function getSess()
    {
        return static::get("sess") ?: static::set("sess", static::createSess());
    }

    public static function getTwig()
    {
        return static::get("twig") ?: static::set("twig", static::createTwig());
    }

    private static function get($key)
    {
        return isset(static::$instances[$key]) ? static::$instances[$key] : null;
    }

    private static function set($key, $val)
    {
        return static::$instances[$key] = $val;
    }

    private static function createTwig()
    {
        $app = static::getSess();
        $loader = new Twig_Loader_Filesystem(app_dir() . "/views");

        $twig = new Twig_Environment(
            $loader,
            array(
                'debug' => true,
                'cache' => app_dir() . "/cache",
                "strict_variables" => true
            )
        );

        $isGuestFunc = new Twig_SimpleFunction("is_guest", function () use ($app) {
            return !$app->getSession();
        });

        $getUserHandleFunc = new Twig_SimpleFunction("user_handle", function () use ($app) {
            $data = $app->getUser();

            return isset($data["username"]) ? $data["username"] : null;
        });

        $getenv = function ($name, $var) {
            return new Twig_SimpleFunction($name, function () use ($var) {
                return getenv($var);
            });
        };

        $alphaDomain  = $getenv("alpha_domain", "ALPHA_DOMAIN");
        $supportEmail = $getenv("support_email", "SUPPORT_EMAIL");
        $githubUrl    = $getenv("github_url", "GITHUB_URL");

        $hostName = new Twig_SimpleFilter("host_name", function ($url) {
            return parse_url($url, PHP_URL_HOST);
        });

        $twig->addFunction($isGuestFunc);
        $twig->addFunction($getUserHandleFunc);
        $twig->addFunction($alphaDomain);
        $twig->addFunction($supportEmail);
        $twig->addFunction($githubUrl);

        $twig->addFilter($hostName);

        $twig->addExtension(new Twig_Extension_Debug());

        return $twig;
    }

    private static function createSess()
    {
        return new EZAppDotNet();
    }
}
