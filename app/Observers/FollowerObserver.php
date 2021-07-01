<?php

namespace App\Observers;

use App\Models\Advertise_Follower;
use App\Models\Advertiser_Points;
use App\Models\Point;

class FollowerObserver
{
    /**
     * Handle the advertise_ follower "created" event.
     *
     * @param  \App\Advertise_Follower  $advertiseFollower
     * @return void
     */
    public function created(Advertise_Follower $advertiseFollower)
    {

    }

    /**
     * Handle the advertise_ follower "updated" event.
     *
     * @param  \App\Advertise_Follower  $advertiseFollower
     * @return void
     */
    public function updated(Advertise_Follower $advertiseFollower)
    {
        //
    }

    /**
     * Handle the advertise_ follower "deleted" event.
     *
     * @param  \App\Advertise_Follower  $advertiseFollower
     * @return void
     */
    public function deleted(Advertise_Follower $advertiseFollower)
    {
        //
    }

    /**
     * Handle the advertise_ follower "restored" event.
     *
     * @param  \App\Advertise_Follower  $advertiseFollower
     * @return void
     */
    public function restored(Advertise_Follower $advertiseFollower)
    {
        //
    }

    /**
     * Handle the advertise_ follower "force deleted" event.
     *
     * @param  \App\Advertise_Follower  $advertiseFollower
     * @return void
     */
    public function forceDeleted(Advertise_Follower $advertiseFollower)
    {
        //
    }
}
