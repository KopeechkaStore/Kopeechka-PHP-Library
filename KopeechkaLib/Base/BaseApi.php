<?php

namespace KopeechkaLib\Base;

class BaseApi
{
    /**
     * @var null|string
     */
    protected $token = null;
    /**
     * @var mixed|string
     */
    protected $response_type = 'json';
    /**
     * @var mixed|string
     */
    protected $api_version = 2;

    /**
     * @var string
     */
    protected $api_host = "https://api.kopeechka.store";

    /**
     * @param string|null $token
     * @param int $api_version
     * @param string $response_type
     * @return $this
     */
    public function setParams(string $token = null, int $api_version = 2, string $response_type = 'json'): BaseApi
    {
        $this->setToken($token);
        $this->setApiVersion($api_version);
        $this->setResponseType($response_type);

        return $this;
    }

    /**
     * @param string $token
     * @return void
     */
    public function setToken(string $token)
    {
        $this->token = $token;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param string $response_type
     * @return void
     */
    public function setResponseType(string $response_type)
    {
        $this->response_type = $response_type;
    }

    /**
     * @return string
     */
    public function getResponseType(): string
    {
        return $this->response_type;
    }

    /**
     * @param $api_version
     * @return void
     */
    public function setApiVersion($api_version)
    {
        $this->api_version = $api_version;
    }

    /**
     * @return string
     */
    public function getApiVersion(): string
    {
        return $this->api_version;
    }

    /**
     * @param string $api_host
     * @return void
     */
    public function setApiHost(string $api_host)
    {
        $this->api_host = (substr($api_host, -1) === "/")
            ? substr($api_host, 0, -1)
            : $api_host;
    }

    /**
     * @return string|null
     */
    public function getApiHost(): ?string
    {
        return $this->api_host;
    }

    /**
     * @return string
     */
    public static function getEntityName(): string
    {
        $class = static::class;
        $explode = explode('\\', $class);

        return str_replace('api', '', strtolower($explode[count($explode) - 1]));
    }

    /**
     * @param string $function
     * @param array $data
     * @return string
     */
    public function makeUrl(string $function, array $data = []): string
    {
        $preg_split = preg_split(
            '#([A-Z]{0,15}[a-z]+)(?=[A-Z])#u',
            $function,
            -1,
            PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE
        );

        return $this->api_host . '/' . static::getEntityName() . '-' .
            strtolower(implode('-', $preg_split)) .
            ($data  ? '?' : '') . http_build_query($data);
    }
}