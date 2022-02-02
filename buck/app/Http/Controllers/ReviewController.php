<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Review;
use Hash;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reviews = Review::all();
        $data = array(
            'reviews' => $reviews, 
        );
        return view('dashboard.reviews.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.reviews.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'from_id' => 'required',
            'to_id' => 'required',
            'rating' => 'required',
        ]);
       

        // Create review
        $review = new Review;
        
        $review->from_id = $request->input('from_id');
        $review->to_id = $request->input('to_id');
        $review->rating = $request->input('rating');
        $review->text = $request->input('text');
        $review->save();

        return Redirect::back()->with('success', 'Review Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $review = review::find($id);
        $data = array(
            'review' => $review
        );
        return view('dashboard.reviews.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $review = Review::find($id);
        $data = array(
            'review' => $review
        );
        return view('dashboard.reviews.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'from_id' => 'required',
            'to_id' => 'required',
            'rating' => 'required',
        ]);
       

        // Create review
        $review = Review::find($id);
        
        $review->from_id = $request->input('from_id');
        $review->to_id = $request->input('to_id');
        $review->rating = $request->input('rating');
        $review->text = $request->input('text');
        $review->save();

        return Redirect::back()->with('success', 'Review Edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Delete review
        $review = Review::find($id);

        $review->delete();

        return Redirect::back()->with('success', 'Review Deleted');
    }
}
