<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rewiew;

class ReviewController extends Controller
{
    public function showReview(Request $request){
        $allRev = Rewiew::get();

        foreach($allRev as $i){
            $list[] = array(
              "title" => $i->title,
              "description" => $i->description,
              "rating" => $i->rating,
              "user_id" => $i->user_id,
              "announcement_id" => $i->announcement_id
            );
        }

        return [
            'data' => $list
        ];

    }

    public function createReview(Request $request){
        $user = $request->user;
        $announcement = $request->announcement;

        Rewiew::create([
            "title" => $request->title,
            "description" => $request->description,
            "rating" => $request->rating,
            "user_id" => $user->id,
            "announcement_id" => $announcement->id
        ]);

        return [
            'data'=>[
                'message' => 'Review created'
            ]
        ];
    }

    public function deleteReview(Rewiew $rewiew){
        Rewiew::where('id', $rewiew->id)->delete();
    }

    public function updateReview(Request $request, Rewiew $rewiew){
        $user = $request->user;
        $announcement = $request->announcement;
        Rewiew::where('id', $request->id)->update([
            "title" => $request->title,
            "description" => $request->description,
            "rating" => $request->rating,
            "user_id" => $user->id,
            "announcement_id" => $announcement->id
        ]);

        return [
            'data'=>[
                'message' => 'Review update'
            ]
        ];
    }

    public function ratingReview(Request $request, Rewiew $rewiew){
        $rev = Rewiew::where('id', $rewiew->id)->first();

        $rev->rating += $request->reting;

        $rev->save();

        return[
            'data'=>[
                'rating' => $rev->rating
            ]
        ];
    }

}
