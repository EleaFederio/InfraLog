<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Activity::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $request->validate([
            'title' => 'required',
            'description' => 'nullable'
        ]);
        Activity::create([
            'title' => $request->title,
            'description' => $request->description
        ]);
        return response()->json([
            'success' => true,
            'message' => "Acticity added!"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function show(Activity $activity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function edit(Activity $activity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Activity $activity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activity $activity)
    {
        //
    }

    public function galery(){
        $activities = Image::all();
        $activityImages = [];
        foreach($activities as $activity){
            array_push($activityImages, [
                'image_url' => asset(Storage::url($activity->image_path)),
                'data' => $activity->activities
            ]);
        }


        return $activityImages;
    }

    

    public function upload(Request $request){
        $request->validate([
            'activity_id' => 'required',
            'activity_image' => 'required|image'
        ]);
        $path = Storage::putFile('public/activity/'.date("Y-m-d"), $request->file('activity_image'));
        $activity = Activity::where('id', $request->activity_id)->first();
        $image = Image::create(['image_path' => $path]);
        $image->activities()->attach($activity->id);
        return response()->json([
            'success' => true,
            'message' => "Image upload success!"
        ]);
    }
}
