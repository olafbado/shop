<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with(['user', 'product'])->paginate(10);
        return view('admin.reviews.index', compact('reviews'));
    }

    public function destroy(Review $review)
    {
        $review->delete();
        return back()->with('success', 'Review deleted.');
    }

    public function hide(Review $review)
    {
        $review->hidden = true;
        $review->save();
        return back()->with('success', 'Review hidden.');
    }

    public function toggle(Review $review)
    {
        $review->hidden = !$review->hidden;
        $review->save();
        $status = $review->hidden ? 'hidden' : 'shown';
        return back()->with('success', "Review {$status}.");
    }
}
