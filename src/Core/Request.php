<?php

namespace Blogg\Core;

use Blogg\Core\FilteredMap;

// FilteredMap är endast relevant i request

class Request
{
    //Konstanter, metod-typ, statiska
    const GET = 'GET';
    const POST = 'POST';

    //Egenskaper
    private $domain;
    private $path;
    private $method;
    private $params;
    private $cookies;

    public function __construct()
    {
        $this->domain = $_SERVER['HTTP_HOST'];
        $this->path = $_SERVER['REQUEST_URI'];
        $this->method = $_SERVER['REQUEST_METHOD'];

        //Nyttjas av FilteredMap, array skickas in av Post och Get-data
        $this->params = new FilteredMap(array_merge($_POST, $_GET));
        $this->cookies = new FilteredMap($_COOKIE);
    }

    //Metoder för att hämta ut delar av requesten

    //Metod för att hämta ut URL:en
    public function getUrl(): string
    {
        return $this->domain . $this->path;
    }

    //Metod för domänen
    public function getDomain(): string
    {
        return $this->domain;
    }

    //Metod för path
    public function getPath(): string
    {
        return $this->path;
    }

    // Metod för metod :)
    public function getMethod(): string
    {
        return $this->method;
    }

    //Kollar på requesten som kommer in utan att gå in på metoden för att se om det är en post-request
    public function isPost(): bool
    {
        return $this->method === self::POST;
    }
    //Kollar på requesten som kommer in utan att gå in på metoden för att se om det är en get-request
    public function isGet(): bool
    {
        return $this->method === self::GET;
    }

    public function getParams(): FilteredMap
    {
        return $this->params;
    }

    public function getCookies(): FilteredMap
    {
        return $this->cookies;
    }
}
