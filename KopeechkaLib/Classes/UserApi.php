<?php

namespace KopeechkaLib\Classes;

use KopeechkaLib\Base\BaseApi;
use KopeechkaLib\Base\HttpRequest;

class UserApi extends BaseApi
{
    /**
     * @return string|null
     */
    public function balance(): ?string
    {
        $data = [
            'token' => $this->token,
            'type' => $this->response_type,
            'api' => $this->api_version,
        ];

        return HttpRequest::get($this->makeUrl(__FUNCTION__, $data));
    }
}
