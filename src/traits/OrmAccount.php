<?php
/**
 * Created by PhpStorm.
 * User: melon
 * Date: 1/26/18
 * Time: 2:38 PM
 */

namespace OpenResourceManager\Laravel\Traits;

use OpenResourceManager\Client\Account as AccountClient;
use OpenResourceManager\Client\Email as EmailClient;
use OpenResourceManager\Client\MobilePhone as MobileClient;
use OpenResourceManager\Client\Addresses as AddressClient;
use OpenResourceManager\Client\Duty as DutyClient;
use OpenResourceManager\Laravel\Exception\ApiException;

trait OrmAccount
{

    protected function getArrayableAppends()
    {
        $this->appends = array_unique(array_merge($this->appends, ['account']));

        return parent::getArrayableAppends();
    }

    /**
     * @return mixed|object
     */
    public function getAccountAttribute()
    {
        try {
            return $this->account();
        } catch (ApiException $e) {
            return (object)[];
        }
    }

    /**
     * @return object
     * @throws ApiException
     */
    public function account()
    {
        if (!empty($this->orm_id)) {
            $orm = getORMConnection();
            $client = new AccountClient($orm);
            $response = $client->get($this->orm_id);

            if ($response->code === 200) {
                return $response->body->data;
            } else {
                throw new ApiException($response->raw_body, $response->code);
            }
        } else {
            return (object)[];
        }
    }

    /**
     * @param int $page
     * @return mixed
     * @throws ApiException
     */
    public function emails($page = 1)
    {
        if (!empty($this->orm_id)) {
            $orm = getORMConnection();
            $client = new EmailClient($orm);
            $client->setPage($page);
            $response = $client->getForAccount($this->orm_id);

            if ($response->code === 200) {
                return $response->body->data;
            } else {
                throw new ApiException($response->raw_body, $response->code);
            }
        } else {
            return (object)[];
        }
    }

    /**
     * @param int $page
     * @return mixed
     * @throws ApiException
     */
    public function mobilePhones($page = 1)
    {
        if (!empty($this->orm_id)) {
            $orm = getORMConnection();
            $client = new MobileClient($orm);

            $client->setPage($page);
            $response = $client->getForAccount($this->orm_id);

            if ($response->code === 200) {
                return $response->body->data;
            } else {
                throw new ApiException($response->raw_body, $response->code);
            }
        } else {
            return (object)[];
        }
    }

    /**
     * @param int $page
     * @return mixed
     * @throws ApiException
     */
    public function addresses($page = 1)
    {
        if (!empty($this->orm_id)) {
            $orm = getORMConnection();
            $client = new AddressClient($orm);

            $client->setPage($page);
            $response = $client->getForAccount($this->orm_id);

            if ($response->code === 200) {
                return $response->body->data;
            } else {
                throw new ApiException($response->raw_body, $response->code);
            }
        } else {
            return (object)[];
        }
    }

    /**
     * @param int $page
     * @return mixed
     * @throws ApiException
     */
    public function duties($page = 1)
    {
        if (!empty($this->orm_id)) {
            $orm = getORMConnection();
            $client = new DutyClient($orm);

            $client->setPage($page);
            $response = $client->getForAccount($this->orm_id);

            if ($response->code === 200) {
                return $response->body->data;
            } else {
                throw new ApiException($response->raw_body, $response->code);
            }
        } else {
            return (object)[];
        }
    }
}