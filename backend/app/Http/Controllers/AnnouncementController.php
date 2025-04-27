<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Models\Announcement;
use App\Models\Type;
use http\Message;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function showAnnouncement(Request $request){
        $allAnn = Announcement::get();

        foreach ($allAnn as $i){
            $list[] = array(
                "title" => $i->title,
                "description" => $i->description,
                "image" => $i->image,
                "rating" => $i->rating,
                "type_id" => $i->type_id,
                "user_id" => $i->user_id
            );
        }

    return [
        'data' => $list
    ];

    }

    public function oneAnnouncement(Request $request, Announcement $announcement){
        $oneAnn = Announcement::where('id', $announcement->id)->first();

        if(!$oneAnn) throw new ApiException(404, 'Not found');

        return [
            'data' =>[
                "title" => $oneAnn->title,
                "description" => $oneAnn->description,
                "image" => $oneAnn->image,
                "rating" => $oneAnn->rating,
                "type_id" => $oneAnn->type_id,
                "user_id" => $oneAnn->user_id
            ]
        ];
    }

    public function createAnnouncement(Request $request){
        $type = Type::where('id', $request->type_id)->first();
        $user = $request->user;

        Announcement::create([
            "title" => $request->title,
            "description" => $request->description,
            "image" => $request->image->store('resources/announcementImg', 'public'),
            "rating" => $request->rating,
            "type_id" => $type->id,
            "user_id" => $user->id
        ]);

        return [
            'data'=>[
                'message' => 'Announcement created'
            ]
        ];

    }

    public function deleteAnnouncement(Announcement $announcement){
        Announcement::where('id', $announcement->id)->delete();
    }

    public function updateAnnouncement(Request $request, Announcement $announcement){
        $type = Type::where('id', $request->type_id)->first();
        $user = $request->user;
        Announcement::where('id', $announcement->id)->update([
            "title" => $request->title,
            "description" => $request->description,
            "rating" => $request->rating,
            "type_id" => $type->id,
            "user_id" => $user->id
        ]);

        return [
            'data'=>[
                'message' => 'Announcement update'
            ]
        ];
    }

    public function ratingAnnouncement(Request $request, Announcement $announcement){
        $ann = Announcement::where('id', $announcement->id)->first();

        $ann->rating += $request->rating;

        $ann->save();

        return[
            'data'=>[
                'rating' => $ann->rating
            ]
        ];
    }
}
