<?php


use Illuminate\Support\Facades\Route;

//Route::get('google-analytics-summary','HomeController@getAnalyticsSummary');
//
//
//Route::get('/', 'HomeController@index')->name('index');
Route::get('get-state-list', 'FrontEnd\AdvertisingController@getSubCategoryList');

Route::get('/test/{id}', 'FrontEnd\AdvertiserController@test')->name('test-mai');
Route::post('/messages/store', 'FrontEnd\AdvertiserController@messagesStore')->name('messages.store');

Route::get('/redirect', 'FrontEnd\Auth\LoginController@redirectToProvider');
Route::get('/callback', 'FrontEnd\Auth\LoginController@handleProviderCallback');


//Route::get('/home', 'HomeController@index')->name('home');

Route::group(['namespace' => 'FrontEnd'], function () {
    Route::get('/', 'HomeController@index')->name('index');
    Route::get('/questionnaire', 'HomeController@index1')->name('index1');
    Route::get('/about-us', 'PagesController@index')->name('about_us');
    Route::get('/site-treaty', 'PagesController@siteTreaty')->name('site-treaty');
    Route::get('/type-member', 'PagesController@typeMember')->name('type-member');
    Route::get('/know-rights', 'KnowRightsController@index')->name('know-rights');
    Route::get('/amr-tidall', 'AmrTidallController@index')->name('amr-tidall');
    Route::get('/terms-and-conditions', 'PagesController@termsConditions')->name('terms-and-conditions');
    Route::get('/gifts-deal', 'GiftsController@index')->name('gifts-deal');
    Route::post('/addUUID', 'AdvertiserController@addUUID')->name('addUUID');


    ######################### Begin Auth advertiser Route #########################
    Route::group(['prefix' => 'advertiser'], function () {

        Route::get('/login', 'Auth\RegisterController@loginForm')->name('advertiser.login');
        Route::get('/loginn', 'Auth\RegisterController@sendWhatsAppSMS')->name('advertiser1.login');
        Route::post('/login', 'Auth\LoginController@login')->name('advertiser2.login');
        Route::get('/register', 'Auth\RegisterController@index')->name('advertiser.register');
        Route::get('/register/fast', 'Auth\RegisterController@fast')->name('advertiser.register.fast');
        Route::get('/activation/{id}', 'Auth\RegisterController@formActivation')->name('advertiser.activation');
        Route::get('/sendActiveCode/{id}', 'Auth\RegisterController@sendActiveCode')->name('advertiser.sendActiveCode');
        Route::get('/fastActive/{id}', 'AdvertiserController@fastActive')->name('advertiser.fastActive');
        Route::post('/deleteCode/{id}', 'Auth\RegisterController@deleteCode')->name('advertiser.deleteCode');

        Route::get('/sendPassword', 'Auth\RegisterController@sendPassword')->name('advertiser.sendPassword');
        Route::post('/sendPasswordValue', 'Auth\RegisterController@sendPasswordValue')->name('advertiser.active_password.store');

        Route::post('/storeActiveCode', 'Auth\RegisterController@storeActiveCode')->name('advertiser.active_code.store');
        Route::post('/updateActiveAccount', 'Auth\RegisterController@updateActiveAccount')->name('advertiser.updateActiveAccount');
        Route::post('/register/store', 'Auth\RegisterController@register')->name('advertiser.register.store');
        Route::post('/register/store1', 'Auth\RegisterController@register1')->name('advertiser.register.store1');
        Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
    });
    ######################### End  Auth advertiser Route ############################


    ######################### Begin search index Route #########################
    Route::group(['prefix' => 'search'], function () {
        Route::post('/first-search', 'SearchController@firstSearch')->name('index.first_search');
        Route::get('/first-search', 'SearchController@firstSearch')->name('index.first_search');
    });
    ######################### End  search index Route ############################

    ######################### Begin second search index Route #########################
    Route::group(['prefix' => 'search'], function () {
        Route::post('/second-search', 'SearchController@secondSearch')->name('index.second_search');
        Route::get('/second-search', 'SearchController@secondSearch')->name('index.second_search');
    });
    ######################### End second search index Route ############################


    ######################### Begin third search index Route #########################
    Route::group(['prefix' => 'search'], function () {
        Route::post('/third-search', 'SearchController@thirdSearch')->name('index.third_search');
        Route::get('/third-search', 'SearchController@thirdSearch')->name('index.third_search');
    });
    ######################### End third search index Route ############################


    ######################### Begin call-us Route #########################
    Route::group(['prefix' => 'call-us'], function () {
        Route::get('/', 'CallUsController@index')->name('call_us');
        Route::post('store', 'CallUsController@store')->name('call_us.store');
    });
    ######################### End call-us Route ############################

    ######################### Begin Black list Route #######################
    Route::group(['prefix' => 'black-list'], function () {
        Route::get('/', 'BlackListController@index')->name('black-list');
        Route::post('/', 'BlackListController@index')->name('black-list');
    });
    ######################### End Black list Route #########################


    ######################### Begin Category Route #######################
    Route::group(['prefix' => 'Category'], function () {
        Route::get('/{id}', 'CategoryController@index')->name('Category');
    });
    Route::group(['prefix' => 'Category', 'middleware' => 'auth:advertiser'], function () {
        Route::get('/card-details/{id}', 'AdvertisingController@cardDetails')->name('advertising.card-details');
    });
    ######################### End Category Route #########################
});


Route::group(['namespace' => 'FrontEnd', 'middleware' => 'auth:advertiser'], function () {

    Route::post('/gifts-deal', 'GiftsController@store')->name('gifts-deal.store');

    ######################### Begin Advertising  Route ########################
    Route::post('/save_fcm_token', 'AdvertiserController@save_fcm_token')->name('advertiser.save_fcm_token');

    Route::get('notification', 'AdvertiserController@notificationAll')->name('advertiser.notification');
    Route::get('notification/delete/{id}', 'AdvertiserController@notificationDelete')->name('advertiser.notification.delete');

    Route::group(['prefix' => 'advertising'], function () {
        Route::get('/', 'AdvertisingController@index')->name('advertising');
        Route::post('store', 'AdvertisingController@store')->name('advertising.store');
        Route::post('fixed', 'AdvertisingController@fixed')->name('advertiser.fixed.advertising');
        Route::get('edit/{id}', 'AdvertisingController@edit')->name('advertising.edit');
        Route::get('price/{id}', 'AdvertisingController@price')->name('advertising.price');
        Route::post('update', 'AdvertisingController@update')->name('advertising.update');
        Route::post('update/price', 'AdvertisingController@updatePrice')->name('advertising.update.price');
        Route::get('delete/{id}', 'AdvertisingController@destroy')->name('advertising.delete');

    });
    ######################### End Advertising Route ########################

    ######################### Begin Advertising Rate  Route ########################
    Route::group(['prefix' => 'advertising'], function () {
        Route::post('/rate', 'AdvertisingController@storeRating')->name('advertising.addRating');
    });
    ######################### End Advertising Rate Route ########################


    ######################### Begin Advertising Comments  Route ########################
    Route::group(['prefix' => 'advertising'], function () {
        Route::post('/comments', 'AdvertisingController@storeComment')->name('advertising.addComment');
    });
    ######################### End Advertising Comments Route ########################
    Route::post('/storeMassege', 'AdvertisingController@storeMassege')->name('storeMassege');


    ######################### Begin follow advertiser  Route ########################
    Route::group(['prefix' => 'advertiser'], function () {
        Route::get('/follow/{id}', 'AdvertiserController@addFollowing')->name('advertiser.addFollowing');
        Route::get('/un_follow/{id}', 'AdvertiserController@removeFollowing')->name('advertiser.removeFollowing');
    });
    ######################### End follow advertiser Route ########################


    ######################### Begin favourite advertiser  Route ########################
    Route::group(['prefix' => 'advertiser'], function () {
        Route::get('/favourite/{id}', 'AdvertiserController@addFavourite')->name('advertiser.addFavourite');
        Route::get('/un_favourite/{id}', 'AdvertiserController@removeFavourite')->name('advertiser.removeFavourite');
    });

    Route::group(['prefix' => 'advertiser_profile'], function () {
        Route::get('/favourite/{id}', 'AdvertiserController@addFavouriteProfile')->name('advertiser_profile.addFavourite');
        Route::get('/un_favourite/{id}', 'AdvertiserController@removeFavouriteProfile')->name('advertiser_profile.removeFavourite');
    });
    ######################### End follow favourite Route ########################


    ######################### Begin advertiser_search  Route ########################
    Route::group(['prefix' => 'favorite'], function () {
        Route::get('/favourite/{id}/{form_type}', 'SearchController@addFavourite')->name('advertiser_search.addFavourite');
        Route::get('/un_favourite/{id}/{form_type}', 'SearchController@removeFavourite')->name('advertiser_search.removeFavourite');
    });
    ######################### End advertiser_search Route ########################


    ######################### Begin favourite advertiser Category  Route ########################
    Route::group(['prefix' => 'advertiser/category'], function () {
        Route::get('/favourite/{id}/{card_id}', 'CategoryController@addFavourite')->name('advertiser_category.addFavourite');
        Route::get('/un_favourite/{id}/{card_id}', 'CategoryController@removeFavourite')->name('advertiser_category.removeFavourite');
    });

    ######################### End  favourite Category Route ########################
    ######################### Begin favourite advertiser Category  Route ########################
    Route::group(['prefix' => 'category/advertising'], function () {
        Route::get('/favourite/{id}/{card_id}', 'AdvertisingController@addFavourite')->name('advertiser_card_advertising.addFavourite');
        Route::get('/un_favourite/{id}/{card_id}', 'AdvertisingController@removeFavourite')->name('advertiser_card_advertising.removeFavourite');
    });

    ######################### End  favourite Category Route ########################


    ######################### Begin favourite advertiser Category  Route ########################
    Route::group(['prefix' => 'advertiser/index'], function () {
        Route::get('/favourite/{id}', 'HomeController@addFavourite')->name('advertiser_index.addFavourite');
        Route::get('/un_favourite/{id}', 'HomeController@removeFavourite')->name('advertiser_index.removeFavourite');
    });
    ######################### End  favourite Category Route ########################


    ######################### Begin Advertiser Account  Route ########################
    Route::group(['prefix' => 'advertiser'], function () {
        Route::get('profile', 'AdvertiserController@advertiserProfile')->name('advertiser.profile');
        Route::get('profile/data/{id}', 'AdvertiserController@advertiserProfile1')->name('advertiser.profile.data');
        Route::get('points', 'AdvertiserController@advertiserPoints')->name('advertiser.points');
        Route::post('report-abuse', 'ReportAbuseController@store')->name('advertiser.report-abuse');
        Route::post('report-abuse-advertising', 'ReportAbuseController@storeAdvertising')->name('advertiser.report-abuse.advertising');
        Route::post('consultations', 'KnowRightsController@store')->name('advertiser.consultations');
        Route::get('detection-points', 'AdvertiserController@detectionPoints')->name('advertiser.detection-points');
        Route::get('update-account', 'AdvertiserController@updateAccount')->name('advertiser.update-account');
        Route::post('update-account', 'AdvertiserController@update')->name('advertiser.update-account');
        Route::post('update-password', 'AdvertiserController@updatePassword')->name('advertiser.update-password');
        Route::post('update-messeges', 'AdvertiserController@updateMesseges')->name('advertiser.update-messeges');
        Route::get('/following/{id}', 'AdvertiserController@addFollow')->name('advertiser.addFollow');
        Route::get('/un_following/{id}', 'AdvertiserController@removeFollow')->name('advertiser.removeFollow');
        Route::get('delete/{id}', 'AdvertiserController@destroy')->name('advertiser.advertising.delete');
        Route::post('delete/{id}', 'AdvertiserController@destroy')->name('advertiser.advertising.delete');

    });
    ######################### End Advertiser Account Route ########################


    ######################### Begin subscription  Route ########################
    Route::group(['prefix' => 'subscription'], function () {
        Route::get('/', 'SubscriptionController@index')->name('advertiser.subscription');
        Route::get('/{id}', 'SubscriptionController@store')->name('advertiser.subscription.store');
        Route::get('request/{id}', 'SubscriptionController@storeRequest')->name('advertiser.request.subscription.store');
    });
    ######################### End subscription Route ########################


});

//Route::get('refresh_captcha', 'HomeController@refreshcaptcha')->name('refresh_captcha');
//
//Route::get('/testNotification/{id?}', function ($id =1) {
//
//    //$user = advertiser();
//
//    $user = \App\Models\Advertiser::find($id);
//    $uuid = 'fHJz1Gm7r1gHhmlZy1G7k2:APA91bGQVFmMEtb8RLfpK9ELH_aDH5QLtc0Af4LIefcDo5RlImAWd1DRXdjzomrgrsY4Ek5wF0G65_A6sEtglo1R1aUu0zPXK4FRUUIlQVsaiCxbQfvcDcus2A69quJyaUT8Ey_hSEWt';
//    $uuid = \App\Models\UUID::where('uuid', $uuid)->first();
//
//    if(!$uuid){
//        $uuid = \App\Models\UUID::create([
//            'uuid' => 'fH1z1Gm7r1gHhmlZy1G7k2:APA91bGQVFmMEtb8RLfpK9ELH_aDH5QLtc0Af4LIefcDo5RlImAWd1DRXdjzomrgrsY4Ek5wF0G65_A6sEtglo1R1aUu0zPXK4FRUUIlQVsaiCxbQfvcDcus2A69quJyaUT8Ey_hSEWt',
//            'uuidable_id' => $user->id,
//            'uuidable_type' => \App\Models\Advertiser::class
//        ]);
//        $user->uuids()->attach($uuid->id);
//    }
//
////    dd($user->toArray());
//   // foreach ($user -> unreadnotifications as $not)
////    foreach ($user -> notifications as $not)
////    foreach ($user -> readnotifications as $not)
////    {
////        //var_dump($not->markAsRead());
////        var_dump($not->type);
////    }
//    $comment = \App\Models\AdvertisingComment::first();
//
////    $advertiser = $comment->advertising->Advertiser;
////
////    $advertiser->notify(new \App\Notifications\NewCommentNotification($comment));
//   $dddd = $user->notify(new \App\Notifications\NewCommentNotification($comment));
//
//    return 'sent';
//});
//

