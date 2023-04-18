<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function create(StoreReviewRequest $request)
    {
        Review::create($request->validated());
        return back()->with('message', trans('general.thanksforreview'));
    }
}
