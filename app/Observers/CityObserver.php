<?php

namespace App\Observers;

use App\Models\City;

class CityObserver
{
    /**
     * Handle the city "created" event.
     *
     * @param  \App\Models\City  $city
     * @return void
     */
    public function created(City $city)
    {
        //
    }

    /**
     * Handle the city "updated" event.
     *
     * @param  \App\Models\City  $city
     * @return void
     */
    public function updated(City $city)
    {
        //
    }

    /**
     * Handle the city "deleted" event.
     *
     * @param  \App\Models\City  $city
     * @return void
     */
    public function deleted(City $city)
    {
       $advertising =  $city->cityAdvertising();
       return $advertising;
        $city->advertiserCity()->delete();
    }

    /**
     * Handle the city "restored" event.
     *
     * @param  \App\Models\City  $city
     * @return void
     */
    public function restored(City $city)
    {
        //
    }

    /**
     * Handle the city "force deleted" event.
     *
     * @param  \App\Models\City  $city
     * @return void
     */
    public function forceDeleted(City $city)
    {
        //
    }
}
