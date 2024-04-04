<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();

        return view('pages.dashboard.projects.index',compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        $types = Type::all();
        $technologies = Technology::all();
        return view('pages.dashboard.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $validatedData = $request->validated();

        $slug = Project::generateSlug($request->nome_progetto);

        $validatedData['slug'] = $slug;
        if($request->hasFile('immagine')){
            $path = Storage::disk('public')->put('project_images', $request->immagine);
            $validatedData['immagine'] = $path;

        }

        $new_project = Project::create($validatedData);

        if($request->has('technologies')){
            $new_project->technologies()->attach($request->technologies);
        }

        return redirect()->route('dashboard.projects.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('pages.dashboard.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {   
        $types = Type::all();
        $technologies = Technology::all();
        return view('pages.dashboard.projects.edit', compact('project', 'types', 'technologies'));
    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePostRequest $request, Project $project)
    {
        $validatedData = $request->validated();
    
        $slug = Project::generateSlug($validatedData['nome_progetto']);
    
        $validatedData['slug'] = $slug;

        if($request->hasFile('immagine')){
            if( $project->immagine){
                Storage::delete($project->immagine);
            }
                $path = Storage::disk('public')->put('project_images',$request->immagine);

                $validatedData['immagine'] = $path;
            

        }

        $project->update($validatedData);

        if($request->has('technologies')){
            $project->technologies()->sync($request->technologies);
        }
    
        return redirect()->route('dashboard.projects.index');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->technologies()->sync([]);

        if ($project->immagine){
            Storage::delete($project->immagine);
        }
        $project->delete();
        return redirect()->route('dashboard.projects.index');
    }
}
