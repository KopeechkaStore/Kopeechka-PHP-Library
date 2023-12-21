<?php

namespace KopeechkaLib\Base;

class HttpRequest
{
    /**
     * @var null|resource
     */
    private static $curl = null;

    /**
     * @return void
     */
    private static function init()
    {
        if (!self::$curl) {
            self::$curl = curl_init();

            curl_setopt_array(self::$curl, [
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_HTTPHEADER => [
                    'User-Agent: Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (HTML, like Gecko, php_kopeechka_api) Chrome/119.0.0.0 Mobile Safari/537.36',
                ],
            ]);
        }
    }

    /**
     * @param string $url
     * @return bool|string
     */
    public static function get(string $url)
    {
        self::init();

        curl_setopt(self::$curl, CURLOPT_URL, $url);

        return curl_exec(self::$curl);
    }

    /**
     * @param string $url
     * @param array $data
     * @return bool|string
     */
    public static function post(string $url, array $data)
    {
        self::init();

        $host = (preg_match("#(?<=https://).*?(?=/)|(?<=http://).*?(?=/)#", $url, $host))? $host[0]: null;
        $params = [
            CURLOPT_URL => $url,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => [
                'User-Agent: Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Mobile Safari/537.36',
            ]
        ];
        curl_setopt_array(self::$curl, $params);

        return curl_exec(self::$curl);
    }

    private function __construct(){}
}
