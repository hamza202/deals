<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    public function refreshcaptcha()
    {
        return response()->json(['captcha' => captcha_img()]);
    }

    public function getAnalyticsSummary(Request $request)
    {
        $from_date = date('Y - m - d', strtotime($request->get('from_date', '7 days ago')));
        $to_date = date('Y - m - d', strtotime($request->get('to_date', $request->get('from_date', 'today'))));
        $gAData = $this->gASummary($from_date, $to_date);
        return $gAData;
    }

//to get the summary of google analytics.
    private function gASummary($date_from, $date_to)
    {
        $service_account_email = 'deal-608@deal-289116.iam.gserviceaccount.com';
// Create and configure a new client object.
        $client = new \Google_Client();
        $client->setApplicationName('dealsa');
        $analytics = new \Google_Service_Analytics($client);
        $cred = new \Google_Auth_AssertionCredentials(
            $service_account_email,
            array(\Google_Service_Analytics::ANALYTICS_READONLY),
            'MIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQCp3PaRzGbWvNjI
            \n6uD8Yw2TyfDsyGOUzRuXPORu9EvLZpp4Ba5kpb6Han7LNzNqYc3l153703AQJ7gj\nAvl+G9K/Z
            PH9dkaN5uhE7nlKPwSAH4sO5uhCJpaXmbnUw9MLQZyKFjBb/poJU2Wz\nZlih1j9mZXA9yrSl83nOYj
            l6dxr8J3S2tlvn3ckXt+hCHFEbicxlcoV3pYJBAB36\nKaxFjQwz2zHd5yqqiKyZvFO+wC8XUH2DbnV
            QAhYg8PAmwkXcsj2wmzpV9B1KvmPM\nApCJsrb2puj35ik5xsz6Etvoe3IBl8g7GQboNyyTJwNqiIQS
            1wZywVoEFslw1pjO\nyF2rgZIPAgMBAAECggEADgZLaWBKAWLYN0aFSvFWtqQOu04UQr3okEUbyzlqZK
            HV\nESHO80pn/8BANcEaAqeOm3KA/cDIWN0eq+1b8hiT/u9zt2yjiKXO+ZoC86leUsHH\n9nQEKyoKdvv
            fRvzgGObS6OfKGF5eE3UKSZSirsIEvAyWBtQMtEL1BKBBhKX+2WC6\nB8WurAriD4NpEVgH0uyIsBJ1Yk
            w+OuP3aoFZr/p0RGeTt684346pvj6ImPKi1LCy\nJvapdo2XBEtUx0r8p6ptLm0fVBPEL6f8tbvZkLh4qO
            8zG8xRam3AJxS9ad/inh3k\nbWPG/aLt3J7shvONEa+BLoAYJqksBseWywzTgx8mWQKBgQDjHZwJE2xzc
            z+o+mky\n9q7N2kol8XDwghujKAazyisqkwRfFuMnmpHFumyL/28EyPE09TuMH5Q7eBs8a6PV\nj6GpzE7D8

            hwjD9wHytHhCd80JUYo5nRxMbrU+WBYqhwTZgkuqbSAlvVDbBs/hwB+\nSR9MtEfbuj/qxZSySkZLISP
            OowKBgQC/d1YaivFCOecqAHHSEeoCoYdmQQHHlE2j\nP9yoRjKzXWGIlNJPGgQumageETOPHErOIXCJeAIZ
            lrK8W/zNkUiNy669NIc0f0mr\nW8OqsaSblvSYX9GDexlsxjnYnGmo+wGuj4mxcgw8iS3ek/9vR8ZBnv/ros
            TP0MsT\nSnm4FZJBpQKBgQDBBqVbQVrnNIhigZFvcyFWa7ShUvb+MlZy8M3heG3/nTwV5Uni\nmwhR2QPwaI
            ReuLnonJSjnyNI9+eODp4MICryOWaoOtmXIx+Kr+J5NP6zPwrGMDe/\nDNkRsXElak66Xfpn4mw67hI931+5




            OnA85MDpXD/GjCFO0+ZxMZdUuzHHqQKBgCwC\najA/r6ThWlk1MPRwWbGxH0ZJuvb9B7t2em
            nTeOPxmvGiA5VbDYsIlrQSkB9dCXTI\nCu4OP61SDlNtcXZu5pZxMwEaidlvSKeyuA8MNiHtWNuNasMmEH
            oINlOr4D2PNJvD\nMosvA9EGVxzKN/SEMvXybjDjgQmjnIoanE/L5YphAoGAGYPs6mSxQeddAjj2Uba5\nNVA2YkTc53
            FIcRawnphv3K2WoFTyBPEU0i7O+8VkJ/MIiA+ipbod0trmQK5B7ZUO\n9cKNvEx3NU8lwYpO11KYev10kxlZasPl/Ez
            tX+EZWe/RTKmEoQEiVEJDtIok0B4a\nywo/gbdb0VYR/sCTtn3tUfE='
        );
        $client->setAssertionCredentials($cred);
        if ($client->getAuth()->isAccessTokenExpired()) {
            $client->getAuth()->refreshTokenWithAssertion($cred);
        }
        $optParams = [
            'dimensions' => 'ga:date',
            'sort' => ' - ga:date'
        ];
        $results = $analytics->data_ga->get(
            'ga:{
        View ID}',
            $date_from,
            $date_to,
            'ga:sessions,ga:users,ga:pageviews,ga:bounceRate,ga:hits,ga:avgSessionDuration',
            $optParams
        );
        $rows = $results->getRows();
        $rows_re_align = [];
        foreach ($rows as $key => $row) {
            foreach ($row as $k => $d) {
                $rows_re_align[$k][$key] = $d;
            }
        }
        $optParams = array(
            'dimensions' => 'rt:medium'
        );
        try {
            $results1 = $analytics->data_realtime->get(
                'ga:{
     1727ff4b8c96f5e14cfed39cb1e19929a7c0c2e0}',
                'rt:activeUsers',
                $optParams);
// Success.
        } catch (apiServiceException $e) {
// Handle API service exceptions.
            $error = $e->getMessage();
        }
        $active_users = $results1->totalsForAllResults;
        return [
            'data' => $rows_re_align,
            'summary' => $results->getTotalsForAllResults(),
            'active_users' => $active_users['rt:activeUsers']
        ];
    }
}
