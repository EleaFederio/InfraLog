<?php

namespace App\Http\Controllers;

use App\Http\Resources\EngineerCollection;
use App\Http\Resources\EngineerResource;
use App\Models\Engineer;
use Illuminate\Http\Request;


class EngineerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Engineer[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Http\Response
     */
    public function index()
    {
//        $projects = ;
        return EngineerResource::collection(Engineer::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function create(Request $request)
    {
       //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'middle_name' => ''
        ]);
        Engineer::create($request->all());
        return response()->json([
            'success' => true,
            'message' => 'Data Added!'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Engineer  $engineer
     * @return \Illuminate\Http\Response
     */
    public function show(Engineer $engineer)
    {
        $selectedEngineer = Engineer::find($engineer->id);
        return response()->json([
            'success' => true,
            'engineer' => new EngineerResource($selectedEngineer)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Engineer  $engineer
     * @return \Illuminate\Http\Response
     */
    public function edit(Engineer $engineer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Engineer  $engineer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Engineer $engineer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Engineer  $engineer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Engineer $engineer)
    {
        if($engineer = Engineer::find($engineer->id)){
            $engineer->delete();
            return response()->json([
                'success' => true,
                'details' => "engineer data deleted successfuly"
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => "Project not found!"
        ]);
    }
}
