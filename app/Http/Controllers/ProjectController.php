<?php
namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
            'approved_budget' => 'required',
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
            'message' => 'Project not found!x'
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
            'message' => "Project deletion error!"
        ]);
    }

    public function infraImage(Request $request){
        $infraImages = Image::all();

        $projectsImages = [];
        foreach($infraImages as $infraImage){
            array_push($projectsImages, [
                'image_url' => asset(Storage::url($infraImage->image_path)),
                'data' => $infraImage->projects
            ]);
        }


        return $projectsImages;
    }

    public function multiImageUpload(Request $request){

        
        $request->validate([
            'project_id' => 'required',
            'infra_images.*' => 'required:array:image'
        ]);

        $project = Project::where('project_id', $request->project_id)->first();
        $images = [];

        foreach($request->infra_images as $infraImage){
            $path = Storage::putFile('public/contract/' . $request->project_id, $infraImage);
            $image = Image::create(['image_path' => $path]);
            array_push($images, $image->id);
        }
        $project->images()->attach($images);
        return response()->json([
            'success' => true,
            'message' => "Image/s successfuly uploaded!"
        ]);
    }

    public function infraImageUpload(Request $request){
        $request->validate([
            'project_id' => 'required',
            'infra_image' => 'required|image'
        ]);
        $path = Storage::putFile('public/contract/' . $request->project_id, $request->file('infra_image'));
        $project = Project::where('project_id', $request->project_id)->first();
        $image = Image::create(['image_path' => $path]);
        $image->projects()->attach($project->id);
        return response()->json([
            'success' => true,
            'message' => "Image upload success!"
        ]);
    }
    
} 