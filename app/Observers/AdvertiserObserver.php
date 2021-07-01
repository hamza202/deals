<?php

namespace App\Observers;

use App\Models\Advertiser;

class AdvertiserObserver
{
    /**
     * Handle the advertiser "created" event.
     *
     * @param  \App\Models\Advertiser  $advertiser
     * @return void
     */
    public function created(Advertiser $advertiser)
    {
        //
    }

    /**
     * Handle the advertiser "updated" event.
     *
     * @param  \App\Models\Advertiser  $advertiser
     * @return void
     */
    public function updated(Advertiser $advertiser)
    {
        //
    }

    /**
     * Handle the advertiser "deleted" event.
     *
     * @param  \App\Models\Advertiser  $advertiser
     * @return void
     */
    public function deleted(Advertiser $advertiser)
    {
        $advertiser->advertiserFollower()->delete();
        $advertiser->advertiserFollowerAnother()->delete();
        $advertiser->advertiserFavourite()->delete();
        $advertiser->advertiserRating()->delete();
        $advertiser->voterRating()->delete();
        $advertiser->advertiserCode()->delete();
        $advertiser->advertiserPoints()->delete();
        $advertiser->advertiserGift()->delete();
        $advertiser->advertiserWriteComment()->delete();
        $advertiser->abues()->delete();
        $advertiser->consultations()->delete();
        $advertiser->black()->delete();
    }

    /**
     * Handle the advertiser "restored" event.
     *
     * @param  \App\Models\Advertiser  $advertiser
     * @return void
     */
    public function restored(Advertiser $advertiser)
    {
        //
    }

    /**
     * Handle the advertiser "force deleted" event.
     *
     * @param  \App\Models\Advertiser  $advertiser
     * @return void
     */
    public function forceDeleted(Advertiser $advertiser)
    {
        //
    }
}
