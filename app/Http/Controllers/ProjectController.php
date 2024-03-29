<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Resources\ProjectInfoResource;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Project[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();
        return $projects;
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
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'project_id' => 'required',
            'amount' => 'required',
            'details' => 'required',
        ]);
        Project::create($request->all());
        return response()->json([
            'success' => true,
            'message' => 'Product successfully added!'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if($projectDetails = Project::find($id)){
            return response()->json([
                'success' => true,
                'details' => new ProjectInfoResource($projectDetails)
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => 'Project not found!'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        // return $project;
        if($project = Project::find($project->id)){
            $project->delete();
            return response()->json([
                'success' => true,
                'details' => "project deleted successfuly"
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => "Project not found!"
        ]);
    }

    public function test(){
        echo asset('storage/file.txt');
    }
}
