<?php

namespace KopeechkaLib;

use KopeechkaLib\Base\BaseApi;
use KopeechkaLib\Classes\MailboxApi;
use KopeechkaLib\Classes\UserApi;

class KopeechkaApi extends BaseApi
{
    /**
     * @var UserApi
     */

    protected $user_api;

    /**
     * @var MailboxApi
     */

    protected $mailbox_api;

    /**
     * @param string|null $token
     * @param int $api_version
     * @param string $response_type
     */

    public function __construct(string $token = null, int $api_version = 2, string $response_type = 'json')//$response_type = 'JSON'?
    {
        $this->setParams($token, $api_version, $response_type);

        $this->mailbox_api = new MailboxApi();
        $this->user_api = new UserApi();
    }

    /**
     * @return MailboxApi
     */

    public function mailbox(): MailboxApi
    {
        return $this->mailbox_api->setParams($this->token, $this->api_version, $this->response_type);
    }

    /**
     * @return UserApi
     */

    public function user(): UserApi
    {
        return $this->user_api->setParams($this->token, $this->api_version, $this->response_type);
    }
}