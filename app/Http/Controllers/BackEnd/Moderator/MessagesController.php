<?php

namespace App\Http\Controllers\BackEnd\Moderator;

use App\Http\Controllers\Controller;
use App\Models\Advertiser;
use App\Notifications\Messages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class MessagesController extends Controller
{
    public function index(){

        $check = $this -> checkRole(94);
        if($check == false){
            return view('back-end.moderator-panel.notRole');
        }
        return view('back-end.moderator-panel.message');
    }

    public function store(Request $request){

        try{

            $title = $request->title;
            $contents = $request->contents;
            $advertisers = Advertiser::where('messages' , 1)->get();

            foreach ($advertisers as $advertiser) {
                Notification::send($advertiser, new Messages($advertiser, $title ,$contents));
            }
            return redirect()->route('moderator.messages')->with(['success' => 'تم الارسال  ']);

        }
        catch (\Exception $ex) {

            return redirect()->route('moderator.messages')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }

}
