<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'BackEnd\Moderator', 'middleware' => 'guest:moderator'], function () {
    Route::get('login', 'LoginController@getLogin')->name('get.moderator.login');
    Route::post('login', 'LoginController@moderatorLogin')->name('moderator.login');

});

Route::group(['namespace' => 'BackEnd\moderator', 'middleware' => 'auth:moderator'], function () {
    Route::get('/', 'DashboardController@index')->name('moderator.dashboard');
    Route::get('logout', 'LoginController@logout')->name('moderator.logout');
    Route::get('review/{id}', 'DashboardController@review')->name('moderator.review.money');
    Route::get('charts', 'ChartController@index')->name('moderator.charts');

    Route::get('fixed/advertising', 'FixedAdvertisingController@index')->name('moderator.fixed.advertising');


    ######################### Begin city Route ########################
    Route::group(['prefix' => 'cities'], function () {
        Route::get('/', 'CityController@index')->name('moderator.cities');
        Route::post('store', 'CityController@store')->name('moderator.cities.store');
        Route::post('update', 'CityController@update')->name('moderator.cities.update');
        Route::get('delete/{id}', 'CityController@destroy')->name('moderator.cities.delete');
        Route::post('delete/{id}', 'CityController@destroy')->name('moderator.cities.delete');

    });
    ######################### End city Route ########################

    ######################### Begin attachmentKnowRights Route ########################
    Route::group(['prefix' => 'attachmentKnowRights'], function () {
        Route::get('/', 'AttachmentKnowRightsController@index')->name('moderator.attachmentKnowRights');
        Route::post('store', 'AttachmentKnowRightsController@store')->name('moderator.attachmentKnowRights.store');
        Route::get('delete/{id}', 'AttachmentKnowRightsController@destroy')->name('moderator.attachmentKnowRights.delete');
        Route::post('delete/{id}', 'AttachmentKnowRightsController@destroy')->name('moderator.attachmentKnowRights.delete');
    });
    ######################### End attachmentKnowRights Route ########################

    /*************/
    Route::group(['prefix' => 'questionnaire'], function () {
        Route::get('/', 'QuestionnaireController@index')->name('moderator.questionnaire');
        Route::post('/store', 'QuestionnaireController@store')->name('moderator.questionnaire.store');
    });


    ######################### Begin reports Route ########################
    Route::group(['prefix' => 'reports'], function () {
        Route::get('/', 'ReportController@index')->name('moderator.reports');
        Route::post('AdvertiserReport', 'ReportController@AdvertiserReport')->name('moderator.reports.AdvertiserReport');
        Route::post('AdvertiserReportExcel', 'ReportController@AdvertiserReportExcel')->name('moderator.reports.AdvertiserReportExcel');
        Route::post('AdvertiserSocialReport', 'ReportController@AdvertiserSocialReport')->name('moderator.reports.AdvertiserSocialReport');
        Route::post('AdvertiserSocialReportExcel', 'ReportController@AdvertiserSocialReportExcel')->name('moderator.reports.AdvertiserSocialReportExcel');
        Route::get('AdvertiserActiveReport', 'ReportController@AdvertiserActiveReport')->name('moderator.reports.AdvertiserActiveReport');
        Route::get('AdvertiserActiveReportExcel', 'ReportController@AdvertiserActiveReportExcel')->name('moderator.reports.AdvertiserActiveReportExcel');
        Route::post('AdvertiserAccountReport', 'ReportController@AdvertiserAccountReport')->name('moderator.reports.AdvertiserAccountReport');
        Route::post('AdvertiserAccountReportExcel', 'ReportController@AdvertiserAccountReportExcel')->name('moderator.reports.AdvertiserAccountReportExcel');
        Route::post('VisitorReport', 'ReportController@VisitorReport')->name('moderator.reports.VisitorReport');
        Route::post('VisitorReportExcel', 'ReportController@VisitorReportExcel')->name('moderator.reports.VisitorReportExcel');
        Route::post('GiftReport', 'ReportController@GiftReport')->name('moderator.reports.GiftReport');
        Route::post('GiftReportExcel', 'ReportController@GiftReportExcel')->name('moderator.reports.GiftReportExcel');
        Route::post('MoneyReport', 'ReportController@MoneyReport')->name('moderator.reports.MoneyReport');
        Route::post('MoneyReportExcel', 'ReportController@MoneyReportExcel')->name('moderator.reports.MoneyReportExcel');
        Route::post('CategoryReport', 'ReportController@CategoryReport')->name('moderator.reports.CategoryReport');
        Route::post('CategoryReportExcel', 'ReportController@CategoryReportExcel')->name('moderator.reports.CategoryReportExcel');

    });
    ######################### End reports Route ########################

    # ######################### Begin commission Route ########################
    Route::group(['prefix' => 'commission'], function () {
        Route::get('/', 'CommissionController@index')->name('moderator.commission');
        Route::get('update/{id}', 'CommissionController@update')->name('moderator.commission.update');
        Route::post('accept', 'CommissionController@accept')->name('moderator.commission.accept');
    });
    ######################### End category Route ########################

    /*************/


    # ######################### Begin category Route ########################
    Route::group(['prefix' => 'category'], function () {
        Route::get('/', 'CategoryController@index')->name('moderator.category');
        Route::post('store', 'CategoryController@store')->name('moderator.category.store');
        Route::post('update', 'CategoryController@update')->name('moderator.category.update');
        Route::get('delete/{id}', 'CategoryController@destroy')->name('moderator.category.delete');
        Route::post('delete/{id}', 'CategoryController@destroy')->name('moderator.category.delete');
    });
    ######################### End category Route ########################


    ######################### Begin sponsored Route ########################
    Route::group(['prefix' => 'sponsored'], function () {
        Route::get('/', 'SponsoredController@index')->name('moderator.sponsored');
        Route::post('store', 'SponsoredController@store')->name('moderator.sponsored.store');
        Route::get('delete/{id}', 'SponsoredController@destroy')->name('moderator.sponsored.delete');
        Route::post('delete/{id}', 'SponsoredController@destroy')->name('moderator.sponsored.delete');

    });
    ######################### End city Route ########################


    ########################## Begin sub_category Route #####################
    Route::group(['prefix' => 'subCategory'], function () {
        Route::get('/{id}', 'SubCategoryController@index')->name('moderator.sub_category');
        Route::post('store', 'SubCategoryController@store')->name('moderator.sub_category.store');
        Route::post('update', 'SubCategoryController@update')->name('moderator.sub_category.update');
        Route::get('deleteSubCategory/{id}', 'CategoryController@destroySubCategory')->name('moderator.category.deleteSubCategory');
        Route::post('deleteSubCategory/{id}', 'CategoryController@destroySubCategory')->name('moderator.category.deleteSubCategory');
    });
    ######################### End sub_category Route ########################


    # ######################### Begin membership Route ########################
    Route::group(['prefix' => 'membership'], function () {
        Route::get('/', 'MembershipController@index')->name('moderator.membership');
        Route::post('store', 'MembershipController@store')->name('moderator.membership.store');
        Route::get('edit/{id}', 'MembershipController@edit')->name('moderator.membership.edit');
        Route::post('update', 'MembershipController@update')->name('moderator.membership.update');
        Route::get('delete/{id}', 'MembershipController@destroy')->name('moderator.membership.delete');
        Route::post('delete/{id}', 'MembershipController@destroy')->name('moderator.membership.delete');
    });
    ######################### End membership Route ########################

    ########################## Begin advertisers Route ########################
    Route::group(['prefix' => 'advertisers'], function () {
        Route::get('/', 'AdvertiserController@index')->name('moderator.advertisers');
        Route::post('/', 'AdvertiserController@index')->name('moderator.advertiser.search');
        Route::post('store', 'AdvertiserController@store')->name('moderator.advertisers.store');
        Route::post('update', 'AdvertiserController@update')->name('moderator.advertisers.update');
        Route::post('updatePoints', 'AdvertiserController@updatePoints')->name('moderator.advertisers.updatePoints');
        Route::post('updateMembership', 'AdvertiserController@updateMembership')->name('moderator.advertisers.updateMembership');
        Route::get('delete/{id}', 'AdvertiserController@destroy')->name('moderator.advertisers.delete');
        Route::post('delete/{id}', 'AdvertiserController@destroy')->name('moderator.advertisers.delete');
    });
    ######################### End advertisers Route ########################


    # ######################### Begin gifts Route ########################
    Route::group(['prefix' => 'gifts'], function () {
        Route::get('/', 'GiftController@index')->name('moderator.gifts');
        Route::post('store', 'GiftController@store')->name('moderator.gifts.store');
        Route::post('update', 'GiftController@update')->name('moderator.gifts.update');
        Route::post('updateMembership', 'GiftController@updateMembership')->name('moderator.gifts.updateMembership');
        Route::post('updateAvailable', 'GiftController@updateAvailable')->name('moderator.gifts.updateAvailable');
        Route::get('delete/{id}', 'GiftController@destroy')->name('moderator.gifts.delete');
    });
    ######################### End gifts Route ########################


    ########################### Begin replace gifts Route ########################
    Route::group(['prefix' => 'replace_gifts'], function () {
        Route::get('/', 'ReplaceGiftController@index')->name('moderator.replace_gifts');
        /***/
        Route::post('/', 'ReplaceGiftController@index')->name('moderator.replace_gifts');
        Route::get('update/{id}', 'ReplaceGiftController@update')->name('moderator.replace_gifts.update');
        Route::post('update/accept', 'ReplaceGiftController@updateNotAccept')->name('moderator.replace_gifts.updateNotAccept');

    });
    ######################### End replace gifts Route ########################


    # ######################### Begin packages Route ########################
    Route::group(['prefix' => 'packages'], function () {
        Route::get('/', 'PackageController@index')->name('moderator.packages');
        Route::get('subscription', 'PackageController@subscription')->name('moderator.subscription.show');
        /***/
        Route::get('subscription/store/{id}', 'PackageController@storeSubscription')->name('moderator.package.addAdvertiser');
        Route::post('store', 'PackageController@store')->name('moderator.packages.store');
        Route::post('update', 'PackageController@update')->name('moderator.packages.update');
        Route::get('delete/{id}', 'PackageController@destroy')->name('moderator.packages.delete');
        Route::post('PackageAnswer', 'PackageController@PackageAnswer')->name('moderator.PackageAnswer');

    });
    ######################### End packages Route ########################


    # ######################### Begin moderators Route ########################
    Route::group(['prefix' => 'moderators'], function () {
        Route::get('/', 'ModeratorController@index')->name('moderator.moderators');
        Route::post('store', 'ModeratorController@store')->name('moderator.moderators.store');
        Route::get('edit/{id}', 'ModeratorController@edit')->name('moderator.moderators.edit');
        Route::get('add/roles/{id}', 'ModeratorController@addRole')->name('moderator.add.role');
        Route::get('add/all/roles/{id}', 'ModeratorController@addRoleAll')->name('moderator.add.all.role');

        //        Route::get('update/roles/{id}', 'ModeratorController@updateRole')->name('moderator.update.role');
        Route::post('update', 'ModeratorController@update')->name('moderator.moderators.update');
        Route::post('save/role', 'ModeratorController@saveRole')->name('moderator.update.role');
        Route::get('delete/{id}', 'ModeratorController@destroy')->name('moderator.moderators.delete');
        Route::post('delete/{id}', 'ModeratorController@destroy')->name('moderator.moderators.delete');
    });
    ######################### End moderators Route ########################


    # ######################### Begin amrtidall Route ########################
    Route::group(['prefix' => 'amrtidall'], function () {
        Route::get('/', 'AmrtidallController@index')->name('moderator.amrtidall');
        Route::post('store', 'AmrtidallController@store')->name('moderator.amrtidall.store');
        Route::get('edit/{id}', 'AmrtidallController@edit')->name('moderator.amrtidall.edit');//**
        Route::post('update', 'AmrtidallController@update')->name('moderator.amrtidall.update');
        Route::get('delete/{id}', 'AmrtidallController@destroy')->name('moderator.amrtidall.delete');//**
        Route::get('/downloadPDF', 'AmrtidallController@downloadPDF')->name('moderator.amrtidall.pdf');
        /***/
        Route::get('active/{id}', 'AmrtidallController@active')->name('moderator.points.active');

    });
    ######################### End amrtidall Route ########################


    # ######################### Begin pages Route ########################
    Route::group(['prefix' => 'pages'], function () {
        Route::get('sliders', 'PagesController@slider')->name('moderator.sliders');
        Route::post('sliders', 'PagesController@storeSliders')->name('moderator.sliders.store');
        Route::post('sliders/update', 'PagesController@updateSliders')->name('moderator.sliders.update');
        Route::get('sliders/delete/{id}', 'PagesController@destroySlider')->name('moderator.sliders.delete');
        Route::post('sliders/delete/{id}', 'PagesController@destroySlider')->name('moderator.sliders.delete');

    });
    ######################### End pages Route ########################


    # ######################### Begin pages Route ########################
    Route::group(['prefix' => 'pages'], function () {
        Route::get('knowUs', 'PagesController@knowUs')->name('moderator.pages.knowUs');
        Route::post('knowUs', 'PagesController@storeKnowUs')->name('moderator.knowUs.store');
        Route::post('knowUs/update', 'PagesController@updateKnowUs')->name('moderator.knowUs.update');
        Route::get('knowUs/delete/{id}', 'PagesController@destroyKnowUs')->name('moderator.knowUs.destroy');
        Route::post('knowUs/delete/{id}', 'PagesController@destroyKnowUs')->name('moderator.knowUs.destroy');
        Route::get('pages', 'PagesController@pages')->name('moderator.pages');
        Route::get('about_us', 'PagesController@aboutUs')->name('moderator.pages.about_us');
        Route::get('site_treaty', 'PagesController@siteTreaty')->name('moderator.pages.site_treaty');
        Route::get('terms-conditions', 'PagesController@termsConditions')->name('moderator.pages.terms_conditions');
        Route::get('amrtidall', 'PagesController@amrtidall')->name('moderator.pages.amrtidall');
        Route::get('social', 'PagesController@social')->name('moderator.pages.social');
        Route::post('social', 'PagesController@socialUpdate')->name('moderator.pages.socialUpdate');
        Route::post('store', 'PagesController@store')->name('moderator.pages.store');
        Route::post('update', 'PagesController@update')->name('moderator.pages.update');
        Route::get('know-right', 'PagesController@knowRight')->name('moderator.pages.know-right');
        Route::post('know-right', 'PagesController@knowRightStore')->name('moderator.know-right.store');
        Route::post('knowRightUpdate', 'PagesController@knowRightUpdate')->name('moderator.know-right.update');
        Route::get('delete/{id}', 'PagesController@destroy')->name('moderator.pages.delete');
        Route::post('delete/{id}', 'PagesController@destroy')->name('moderator.pages.delete');

    });
    ######################### End pages Route ########################


# ######################### Begin advertising Route ########################
    Route::group(['prefix' => 'advertising'], function () {
        Route::get('/', 'AdvertisingController@index')->name('moderator.advertising');
        Route::get('/update/all/advertising', 'AdvertisingController@advertiseNewUpdate')->name('moderator.advertising.new.update');
        Route::post('/update/all/advertising/new', 'AdvertisingController@advertiseNewUpdateAll')->name('moderator.update.all.advertising.new');
        Route::get('advertise/{id}', 'AdvertisingController@advertise')->name('moderator.advertise');
        Route::post('advertise/save', 'AdvertisingController@saveStatus')->name('moderator.advertise.save_status');
        Route::post('advertise/refuse', 'AdvertisingController@refuseStatus')->name('moderator.advertise.save_status_refuse');
        Route::get('newestAdvertising', 'AdvertisingController@newestAdvertising')->name('moderator.advertising.news');
        Route::post('store', 'AdvertisingController@store')->name('moderator.advertising.store');
        Route::post('update', 'AdvertisingController@update')->name('moderator.advertising.update');
        Route::get('all-advertising/{id}', 'AdvertisingController@allAdvertising')->name('moderator.advertising.all');
        Route::get('fixed-advertising/{id}', 'AdvertisingController@fixedAdvertising')->name('moderator.advertising.fixed');
        Route::get('main-fixed-advertising/{id}', 'AdvertisingController@mainFixedAdvertising')->name('moderator.advertising.mainFixed');
        Route::get('finish-advertising/{id}', 'AdvertisingController@finishAdvertising')->name('moderator.advertising.finish');
        Route::get('new-advertising/{id}', 'AdvertisingController@newAdvertising')->name('moderator.advertising.new');
        Route::get('accept-advertising/{id}', 'AdvertisingController@acceptAdvertising')->name('moderator.advertising.accept');
        Route::get('delete/{id}', 'AdvertisingController@destroy')->name('moderator.advertising.delete');
        Route::post('delete/{id}', 'AdvertisingController@destroy')->name('moderator.advertising.delete');
        Route::get('search/advertising', 'AdvertisingController@search')->name('moderator.search.advertising');
    });
    ######################### End advertising Route ########################

# ######################### Begin Consulting Route ########################
    Route::group(['prefix' => 'consulting'], function () {
        Route::get('abuse', 'ConsultingController@abuse')->name('moderator.abuse');
        Route::post('abuse', 'ConsultingController@abuseAnswer')->name('moderator.abuseAnswer');
        Route::get('contact-us', 'ConsultingController@contactUs')->name('moderator.contact-us');
        Route::post('contact-us', 'ConsultingController@contactAnswer')->name('moderator.contactAnswer');
        Route::get('consultations', 'ConsultingController@consultations')->name('moderator.consultations');
        Route::post('consultations', 'ConsultingController@consultations')->name('moderator.consultations');
        Route::post('consultations1', 'ConsultingController@consultationsAnswer')->name('moderator.consultationsAnswer');

    });
    ######################### End Consulting Route ########################


    # ######################### Begin black-list Route ########################
    Route::group(['prefix' => 'black_list'], function () {
        Route::get('/', 'BlackListController@index')->name('moderator.black_list');
        Route::post('store', 'BlackListController@store')->name('moderator.black_list.store');
        Route::get('delete/{id}', 'BlackListController@delete')->name('moderator.black_list.delete');
        Route::get('search', 'BlackListController@search')->name('moderator.advertiser.blackList.search');

    });
    ######################### End black-list Route ########################


    # ######################### Begin Messages Route ########################
    Route::group(['prefix' => 'messages'], function () {
        Route::get('/', 'MessagesController@index')->name('moderator.messages');
        Route::post('store', 'MessagesController@store')->name('moderator.messages.store');
    });
    ######################### End Messages Route ########################


});
