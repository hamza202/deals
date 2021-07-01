<?php

namespace App\Observers;

use App\Models\Advertising;

class AdvertisingObserver
{
    /**
     * Handle the advertising "created" event.
     *
     * @param  \App\Models\Advertising  $advertising
     * @return void
     */
    public function created(Advertising $advertising)
    {
        //
    }

    /**
     * Handle the advertising "updated" event.
     *
     * @param  \App\Models\Advertising  $advertising
     * @return void
     */
    public function updated(Advertising $advertising)
    {
        //
    }

    /**
     * Handle the advertising "deleted" event.
     *
     * @param  \App\Models\Advertising  $advertising
     * @return void
     */
    public function deleted(Advertising $advertising)
    {
        $advertising->advertisingComments()->delete();
        $advertising->ratingAdvertising()->delete();
        $advertising->favouriteAdvertising()->delete();
        $advertising->money()->delete();
    }

    /**
     * Handle the advertising "restored" event.
     *
     * @param  \App\Models\Advertising  $advertising
     * @return void
     */
    public function restored(Advertising $advertising)
    {
        //
    }

    /**
     * Handle the advertising "force deleted" event.
     *
     * @param  \App\Models\Advertising  $advertising
     * @return void
     */
    public function forceDeleted(Advertising $advertising)
    {

    }
}
