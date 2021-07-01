<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'BackEnd\Admin', 'middleware' => 'guest:admin'], function () {
    Route::get('login', 'LoginController@getLogin')->name('get.admin.login');
    Route::post('login', 'LoginController@adminLogin')->name('admin.login');

});


Route::group(['namespace' => 'BackEnd\Admin', 'middleware' => 'auth:admin'], function () {


    Route::get('/', 'DashboardController@index')->name('admin.dashboard');
    Route::get('charts', 'ChartController@index')->name('admin.charts');
    Route::get('logout', 'LoginController@logout')->name('admin.logout');
    Route::get('review/{id}', 'DashboardController@review')->name('admin.review.money');


    Route::get('fixed/advertising', 'FixedAdvertisingController@index')->name('fixed.advertising');


    ######################### Begin city Route ########################
    Route::group(['prefix' => 'cities'], function () {
        Route::get('/', 'CityController@index')->name('admin.cities');
        Route::post('store', 'CityController@store')->name('admin.cities.store');
        Route::post('update', 'CityController@update')->name('admin.cities.update');
        Route::get('delete/{id}', 'CityController@destroy')->name('admin.cities.delete');
        Route::post('delete/{id}', 'CityController@destroy')->name('admin.cities.delete');

    });
    ######################### End city Route ########################

    ######################### Begin sponsored Route ########################
    Route::group(['prefix' => 'sponsored'], function () {
        Route::get('/', 'SponsoredController@index')->name('admin.sponsored');
        Route::post('store', 'SponsoredController@store')->name('admin.sponsored.store');
        Route::get('delete/{id}', 'SponsoredController@destroy')->name('admin.sponsored.delete');
        Route::post('delete/{id}', 'SponsoredController@destroy')->name('admin.sponsored.delete');
    });
    ######################### End city Route ########################


    ######################### Begin attachmentKnowRights Route ########################
    Route::group(['prefix' => 'attachmentKnowRights'], function () {
        Route::get('/', 'AttachmentKnowRightsController@index')->name('admin.attachmentKnowRights');
        Route::post('store', 'AttachmentKnowRightsController@store')->name('admin.attachmentKnowRights.store');
        Route::get('delete/{id}', 'AttachmentKnowRightsController@destroy')->name('admin.attachmentKnowRights.delete');
        Route::post('delete/{id}', 'AttachmentKnowRightsController@destroy')->name('admin.attachmentKnowRights.delete');
    });
    ######################### End attachmentKnowRights Route ########################


    Route::group(['prefix' => 'questionnaire'], function () {
        Route::get('/', 'QuestionnaireController@index')->name('admin.questionnaire');
        Route::post('/store', 'QuestionnaireController@store')->name('admin.questionnaire.store');
    });
    ######################### Begin reports Route ########################
    Route::group(['prefix' => 'reports'], function () {
        Route::get('/', 'ReportController@index')->name('admin.reports');
        Route::post('AdvertiserReport', 'ReportController@AdvertiserReport')->name('admin.reports.AdvertiserReport');
        Route::post('AdvertiserReportExcel', 'ReportController@AdvertiserReportExcel')->name('admin.reports.AdvertiserReportExcel');
        Route::post('AdvertiserSocialReport', 'ReportController@AdvertiserSocialReport')->name('admin.reports.AdvertiserSocialReport');
        Route::post('AdvertiserSocialReportExcel', 'ReportController@AdvertiserSocialReportExcel')->name('admin.reports.AdvertiserSocialReportExcel');
        Route::get('AdvertiserActiveReport', 'ReportController@AdvertiserActiveReport')->name('admin.reports.AdvertiserActiveReport');
        Route::get('AdvertiserActiveReportExcel', 'ReportController@AdvertiserActiveReportExcel')->name('admin.reports.AdvertiserActiveReportExcel');
        Route::post('AdvertiserAccountReport', 'ReportController@AdvertiserAccountReport')->name('admin.reports.AdvertiserAccountReport');
        Route::post('AdvertiserAccountReportExcel', 'ReportController@AdvertiserAccountReportExcel')->name('admin.reports.AdvertiserAccountReportExcel');
        Route::post('VisitorReport', 'ReportController@VisitorReport')->name('admin.reports.VisitorReport');
        Route::post('VisitorReportExcel', 'ReportController@VisitorReportExcel')->name('admin.reports.VisitorReportExcel');
        Route::post('GiftReport', 'ReportController@GiftReport')->name('admin.reports.GiftReport');
        Route::post('GiftReportExcel', 'ReportController@GiftReportExcel')->name('admin.reports.GiftReportExcel');
        Route::post('MoneyReport', 'ReportController@MoneyReport')->name('admin.reports.MoneyReport');
        Route::post('MoneyReportExcel', 'ReportController@MoneyReportExcel')->name('admin.reports.MoneyReportExcel');
        Route::post('CategoryReport', 'ReportController@CategoryReport')->name('admin.reports.CategoryReport');
        Route::post('CategoryReportExcel', 'ReportController@CategoryReportExcel')->name('admin.reports.CategoryReportExcel');

    });
    ######################### End city Route ########################


    # ######################### Begin category Route ########################
    Route::group(['prefix' => 'category'], function () {
        Route::get('/', 'CategoryController@index')->name('admin.category');
        Route::post('store', 'CategoryController@store')->name('admin.category.store');
        Route::post('update', 'CategoryController@update')->name('admin.category.update');
        Route::get('delete/{id}', 'CategoryController@destroy')->name('admin.category.delete');
        Route::post('delete/{id}', 'CategoryController@destroy')->name('admin.category.delete');
    });
    ######################### End category Route ########################

    # ######################### Begin commission Route ########################
    Route::group(['prefix' => 'commission'], function () {
        Route::get('/', 'CommissionController@index')->name('admin.commission');
        Route::get('update/{id}', 'CommissionController@update')->name('admin.commission.update');
        Route::post('accept', 'CommissionController@accept')->name('admin.commission.accept');
    });
    ######################### End category Route ########################


    ########################## Begin sub_category Route #####################
    Route::group(['prefix' => 'subCategory'], function () {
        Route::get('/{id}', 'SubCategoryController@index')->name('admin.sub_category');
        Route::post('store', 'SubCategoryController@store')->name('admin.sub_category.store');
        Route::post('update', 'SubCategoryController@update')->name('admin.sub_category.update');
        Route::get('deleteSubCategory/{id}', 'CategoryController@destroySubCategory')->name('admin.category.deleteSubCategory');
        Route::post('deleteSubCategory/{id}', 'CategoryController@destroySubCategory')->name('admin.category.deleteSubCategory');
    });
    ######################### End sub_category Route ########################


    # ######################### Begin membership Route ########################
    Route::group(['prefix' => 'membership'], function () {
        Route::get('/', 'MembershipController@index')->name('admin.membership');
        Route::post('store', 'MembershipController@store')->name('admin.membership.store');
        Route::get('edit/{id}', 'MembershipController@edit')->name('admin.membership.edit');
        Route::post('update', 'MembershipController@update')->name('admin.membership.update');
        Route::get('delete/{id}', 'MembershipController@destroy')->name('admin.membership.delete');
        Route::post('delete/{id}', 'MembershipController@destroy')->name('admin.membership.delete');
    });
    ######################### End membership Route ########################

    ########################## Begin advertisers Route ########################
    Route::group(['prefix' => 'advertisers'], function () {
        Route::get('/', 'AdvertiserController@index')->name('admin.advertisers');
        Route::post('/', 'AdvertiserController@index')->name('admin.advertiser.search');
        Route::post('store', 'AdvertiserController@store')->name('admin.advertisers.store');
        Route::post('update', 'AdvertiserController@update')->name('admin.advertisers.update');
        Route::post('updateMembership', 'AdvertiserController@updateMembership')->name('admin.advertisers.updateMembership');
        Route::post('updatePoints', 'AdvertiserController@updatePoints')->name('admin.advertisers.updatePoints');
        Route::get('delete/{id}', 'AdvertiserController@destroy')->name('admin.advertisers.delete');
        Route::post('delete/{id}', 'AdvertiserController@destroy')->name('admin.advertisers.delete');

    });
    ######################### End advertisers Route ########################


    # ######################### Begin gifts Route ########################
    Route::group(['prefix' => 'gifts'], function () {
        Route::get('/', 'GiftController@index')->name('admin.gifts');
        Route::post('store', 'GiftController@store')->name('admin.gifts.store');
        Route::post('update', 'GiftController@update')->name('admin.gifts.update');
        Route::post('updateMembership', 'GiftController@updateMembership')->name('admin.gifts.updateMembership');
        Route::post('updateAvailable', 'GiftController@updateAvailable')->name('admin.gifts.updateAvailable');
        Route::get('delete/{id}', 'GiftController@destroy')->name('admin.gifts.delete');
    });
    ######################### End gifts Route ########################


    ########################### Begin replace gifts Route ########################
    Route::group(['prefix' => 'replace_gifts'], function () {
        Route::get('/', 'ReplaceGiftController@index')->name('admin.replace_gifts');
        Route::post('/', 'ReplaceGiftController@index')->name('admin.replace_gifts');
        Route::get('update/{id}', 'ReplaceGiftController@update')->name('admin.replace_gifts.update');
        Route::post('update/accept', 'ReplaceGiftController@updateNotAccept')->name('admin.replace_gifts.updateNotAccept');
    });
    ######################### End replace gifts Route ########################


    # ######################### Begin packages Route ########################
    Route::group(['prefix' => 'packages'], function () {
        Route::get('/', 'PackageController@index')->name('admin.packages');
        Route::get('subscription', 'PackageController@subscription')->name('admin.subscription.show');
        /*+++ */
        Route::get('subscription/store/{id}', 'PackageController@storeSubscription')->name('admin.package.addAdvertiser');
        Route::post('store', 'PackageController@store')->name('admin.packages.store');
        Route::post('update', 'PackageController@update')->name('admin.packages.update');
        Route::get('delete/{id}', 'PackageController@destroy')->name('admin.packages.delete');
        Route::post('PackageAnswer', 'PackageController@PackageAnswer')->name('admin.PackageAnswer');

    });
    ######################### End packages Route ########################


    # ######################### Begin moderators Route ########################
    Route::group(['prefix' => 'moderators'], function () {
        Route::get('/', 'ModeratorController@index')->name('admin.moderators');
        Route::post('store', 'ModeratorController@store')->name('admin.moderators.store');
        Route::get('edit/{id}', 'ModeratorController@edit')->name('admin.moderators.edit');
        Route::get('add/roles/{id}', 'ModeratorController@addRole')->name('admin.add.role');
        Route::get('add/all/roles/{id}', 'ModeratorController@addRoleAll')->name('admin.add.all.role');
        //Route::get('update/roles/{id}', 'ModeratorController@updateRole')->name('admin.update.role');
        Route::post('update', 'ModeratorController@update')->name('admin.moderators.update');
        Route::post('save/role', 'ModeratorController@saveRole')->name('admin.update.role');
        Route::get('delete/{id}', 'ModeratorController@destroy')->name('admin.moderators.delete');
        Route::post('delete/{id}', 'ModeratorController@destroy')->name('admin.moderators.delete');
    });
    ######################### End moderators Route ########################


    # ######################### Begin amrtidall Route ########################
    Route::group(['prefix' => 'amrtidall'], function () {
        Route::get('/', 'AmrtidallController@index')->name('admin.amrtidall');
        Route::post('store', 'AmrtidallController@store')->name('admin.amrtidall.store');
        Route::get('edit/{id}', 'AmrtidallController@edit')->name('admin.amrtidall.edit');
        Route::post('update', 'AmrtidallController@update')->name('admin.amrtidall.update');
        Route::get('active/{id}', 'AmrtidallController@active')->name('admin.points.active');
        Route::get('delete/{id}', 'AmrtidallController@destroy')->name('admin.amrtidall.delete');
        Route::get('/downloadPDF', 'AmrtidallController@downloadPDF')->name('admin.amrtidall.pdf');

    });
    ######################### End amrtidall Route ########################


    # ######################### Begin pages Route ########################
    Route::group(['prefix' => 'pages'], function () {
        Route::get('sliders', 'PagesController@slider')->name('admin.sliders');
        Route::post('sliders', 'PagesController@storeSliders')->name('admin.sliders.store');
        Route::post('sliders/update', 'PagesController@updateSliders')->name('admin.sliders.update');
        Route::get('sliders/delete/{id}', 'PagesController@destroySlider')->name('admin.sliders.delete');
        Route::post('sliders/delete/{id}', 'PagesController@destroySlider')->name('admin.sliders.delete');

    });
    ######################### End pages Route ########################


    # ######################### Begin pages Route ########################
    Route::group(['prefix' => 'pages'], function () {
        Route::get('pages', 'PagesController@pages')->name('admin.pages');
        Route::get('about_us', 'PagesController@aboutUs')->name('admin.pages.about_us');
        Route::get('site_treaty', 'PagesController@siteTreaty')->name('admin.pages.site_treaty');
        Route::get('terms-conditions', 'PagesController@termsConditions')->name('admin.pages.terms_conditions');
        Route::get('amrtidall', 'PagesController@amrtidall')->name('admin.pages.amrtidall');
        Route::get('social', 'PagesController@social')->name('admin.pages.social');
        Route::get('knowUs', 'PagesController@knowUs')->name('admin.pages.knowUs');
        Route::post('knowUs', 'PagesController@storeKnowUs')->name('admin.knowUs.store');
        Route::post('knowUs/update', 'PagesController@updateKnowUs')->name('admin.knowUs.update');
        Route::get('knowUs/delete/{id}', 'PagesController@destroyKnowUs')->name('admin.knowUs.destroy');
        Route::post('knowUs/delete/{id}', 'PagesController@destroyKnowUs')->name('admin.knowUs.destroy');
        Route::post('social', 'PagesController@socialUpdate')->name('admin.pages.socialUpdate');
        Route::post('store', 'PagesController@store')->name('admin.pages.store');
        Route::post('update', 'PagesController@update')->name('admin.pages.update');
        Route::get('know-right', 'PagesController@knowRight')->name('admin.pages.know-right');
        Route::post('know-right', 'PagesController@knowRightStore')->name('admin.know-right.store');
        Route::post('knowRightUpdate', 'PagesController@knowRightUpdate')->name('admin.know-right.update');
        Route::get('delete/{id}', 'PagesController@destroy')->name('admin.pages.delete');
        Route::post('delete/{id}', 'PagesController@destroy')->name('admin.pages.delete');

    });
    ######################### End pages Route ########################


# ######################### Begin advertising Route ########################
    Route::group(['prefix' => 'advertising'], function () {
        Route::get('/', 'AdvertisingController@index')->name('admin.advertising');
        Route::get('/update/all/advertising', 'AdvertisingController@advertiseNewUpdate')->name('admin.advertising.new.update');
        Route::post('/update/all/advertising/new', 'AdvertisingController@advertiseNewUpdateAll')->name('admin.update.all.advertising.new');
        Route::get('advertise/{id}', 'AdvertisingController@advertise')->name('admin.advertise');
        Route::post('advertise/save', 'AdvertisingController@saveStatus')->name('admin.advertise.save_status');
        Route::post('advertise/refuse', 'AdvertisingController@refuseStatus')->name('admin.advertise.save_status_refuse');
        Route::get('newestAdvertising', 'AdvertisingController@newestAdvertising')->name('admin.advertising.news');
        Route::post('store', 'AdvertisingController@store')->name('admin.advertising.store');
        Route::post('update', 'AdvertisingController@update')->name('admin.advertising.update');
        Route::get('all-advertising/{id}', 'AdvertisingController@allAdvertising')->name('admin.advertising.all');
        Route::get('fixed-advertising/{id}', 'AdvertisingController@fixedAdvertising')->name('admin.advertising.fixed');
        Route::get('main-fixed-advertising/{id}', 'AdvertisingController@mainFixedAdvertising')->name('admin.advertising.mainFixed');
        Route::get('finish-advertising/{id}', 'AdvertisingController@finishAdvertising')->name('admin.advertising.finish');
        Route::get('new-advertising/{id}', 'AdvertisingController@newAdvertising')->name('admin.advertising.new');
        Route::get('accept-advertising/{id}', 'AdvertisingController@acceptAdvertising')->name('admin.advertising.accept');
        Route::get('delete/{id}', 'AdvertisingController@destroy')->name('admin.advertising.delete');
        Route::post('delete/{id}', 'AdvertisingController@destroy')->name('admin.advertising.delete');
        Route::get('search/advertising', 'AdvertisingController@search')->name('admin.search.advertising');
    });
    ######################### End advertising Route ########################

# ######################### Begin Consulting Route ########################
    Route::group(['prefix' => 'consulting'], function () {
        Route::get('abuse', 'ConsultingController@abuse')->name('admin.abuse');
        Route::post('abuse', 'ConsultingController@abuseAnswer')->name('admin.abuseAnswer');
        Route::get('contact-us', 'ConsultingController@contactUs')->name('admin.contact-us');
        Route::post('contact-us', 'ConsultingController@contactAnswer')->name('admin.contactAnswer');
        Route::get('consultations', 'ConsultingController@consultations')->name('admin.consultations');
        Route::post('consultations', 'ConsultingController@consultations')->name('admin.consultations');
        Route::post('consultations1', 'ConsultingController@consultationsAnswer')->name('admin.consultationsAnswer');

    });
    ######################### End Consulting Route ########################


    # ######################### Begin black-list Route ########################
    Route::group(['prefix' => 'black_list'], function () {
        Route::get('/', 'BlackListController@index')->name('admin.black_list');
        Route::post('store', 'BlackListController@store')->name('admin.black_list.store');
        Route::get('search', 'BlackListController@search')->name('admin.advertiser.blackList.search');
        Route::get('delete/{id}', 'BlackListController@delete')->name('admin.black_list.delete');
    });
    ######################### End black-list Route ########################


    # ######################### Begin Messages Route ########################
    Route::group(['prefix' => 'messages'], function () {
        Route::get('/', 'MessagesController@index')->name('admin.messages');
        Route::post('store', 'MessagesController@store')->name('admin.messages.store');
    });
    ######################### End Messages Route ########################


});
