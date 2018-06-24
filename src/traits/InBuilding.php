<?php
/**
 * Created by PhpStorm.
 * User: melon
 * Date: 6/23/18
 * Time: 7:14 PM
 */

namespace OpenResourceManager\Laravel\Traits;

use OpenResourceManager\Client\Building as BuildingClient;
use OpenResourceManager\Laravel\Exception\ApiException;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

trait InBuilding
{

    /**
     * @return mixed
     */
    protected function getArrayableAppends()
    {
        $this->appends = array_unique(array_merge($this->appends, ['building']));
        return parent::getArrayableAppends();
    }

    /**
     * @return mixed|object
     */
    public function getBuildingAttribute()
    {
        try {
            return $this->building();
        } catch (ApiException $e) {
            return (object)[];
        }
    }

    /**
     * @return object
     * @throws ApiException
     */
    public function building()
    {
        if (!empty($this->building_id)) {

            $bid = $this->building_id;
            $orm = getORMConnection();
            $client = new BuildingClient($orm);

            $ttl = Carbon::now()->addMinutes(intval(config('orm.trait_response_cache_time', false)));

            $response = Cache::remember('orm_building' . $this->building_id, $ttl, function () use ($bid, $client) {
                return $client->get($bid);
            });

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