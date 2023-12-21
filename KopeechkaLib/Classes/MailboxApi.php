<?php

namespace KopeechkaLib\Classes;

use KopeechkaLib\Base\BaseApi;
use KopeechkaLib\Base\HttpRequest;

class MailboxApi extends BaseApi
{
    /**
     * @param string $site
     * @param string $mail_type
     * @param bool|null $password
     * @param string|null $regex
     * @param string|null $subject
     * @param bool|null $investor
     * @param string|null $soft
     * @return string|null
     */

    public function getEmail(string $site, string $mail_type = 'all', bool $password = null, string $regex = null, string $subject = null, bool $investor = null, string $soft = null): ?string
    {
        $data = [
            'site' => $site,
            'mail_type' => $mail_type,
            'token' => $this->token,
            'password' => $password,
            'regex'=> $regex,
            'subject' => $subject,
            'investor' => $investor,
            'soft' => $soft,
            'type' => $this->response_type,
            'api' => $this->api_version,
        ];

        return HttpRequest::get($this->makeUrl(__FUNCTION__, $data));
    }

    /**
     * @param int $id
     * @param bool $full
     * @return string|null
     */

    public function getMessage(int $id, bool $full = true): ?string
    {
        $data = [
            'token' => $this->token,
            'id' => $id,
            'full' => (int)$full,
            'type' => $this->response_type,
            'api' => $this->api_version
        ];

        return HttpRequest::get($this->makeUrl(__FUNCTION__, $data));
    }

    /**
     * @param int $id
     * @return string|null
     */

    public function cancel(int $id): ?string
    {
        $data = [
            'token' => $this->token,
            'id' => $id,
            'type' => $this->response_type,
            'api' => $this->api_version,
        ];

        return HttpRequest::get($this->makeUrl(__FUNCTION__, $data));
    }

    /**
     * @param string $site
     * @param string $email
     * @param bool $password
     * @param string|null $subject
     * @param string|null $regex
     * @return string|null
     */

    public function reorder(string $site, string $email, bool $password = false, string $subject = null, string $regex  = null): ?string
    {
        $data = [
            'site' => $site,
            'email' => $email,
            'token' => $this->token,
            'password' => $password,
            'subject' => $subject,
            'regex'=> $regex,
            'type' => $this->response_type,
            'api' => $this->api_version,
        ];

        return HttpRequest::get($this->makeUrl(__FUNCTION__, $data));
    }

    /**
     * @param string $site
     * @param string $email
     * @return string|null
     */

    public function getFreshId(string $site, string $email): ?string
    {
        $data = [
            'site' => $site,
            'email' => $email,
            'token' => $this->token,
            'type' => $this->response_type,
            'api' => $this->api_version,
        ];

        return HttpRequest::get($this->makeUrl(__FUNCTION__, $data));
    }

    /**
     * @return string|null
     */

    public function getDomains(): ?string
    {
        $data = [
            'type' => $this->response_type,
            'api' => $this->api_version,
        ];

        return HttpRequest::get($this->makeUrl(__FUNCTION__, $data));
    }

    /**
     * @param bool $popular
     * @param string|null $site
     * @return string|null
     */
    public function zones(bool $popular = true, string $site = null): ?string
    {
        $data = [
            'popular' => (int)$popular,
            'site' => $site,
            'type' => $this->response_type,
            'api' => $this->api_version
        ];

        return HttpRequest::get($this->makeUrl(__FUNCTION__, $data));
    }
}