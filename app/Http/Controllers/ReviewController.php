<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    public function showReview(Request $request, $annId){
        $allRev = Review::where('announcement_id', $annId)->get();

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

        Review::create([
            "title" => $request->title,
            "description" => $request->description,
            "rating" => 0,
            "user_id" => $user->id,
            "announcement_id" => $request->announcement_id,
        ]);

        return [
            'data'=>[
                'message' => 'Review created'
            ]
        ];
    }

    public function deleteReview(Review $review){
        Review::where('id', $review->id)->delete();

        return [
            'data'=>[
                'message' => 'Review deleted'
            ]
        ];
    }

    public function updateReview(Request $request, Review $review){
        $data = $request->only(['title', 'description']);

        $review->update(array_filter($data));

        $review->fresh();

        return [
            'data' => [
                'message' => 'Review updated successfully'
            ]
        ];
    }

    public function ratingReview(Request $request, Review $review){
        $rev = Review::where('id', $review->id)->first();

        $rev->rating += $request->rating;

        $rev->save();

        return[
            'data'=>[
                'rating' => $rev->rating
            ]
        ];
    }

}
