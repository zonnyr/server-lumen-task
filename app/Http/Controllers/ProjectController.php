<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\User;
use App\Project;

class ProjectController extends Controller
{
    /**
     * Instantiate a new UserController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get the authenticated User.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function createProject(Request $request)
    {
        
        // Validate incoming request
        $this->validate($request, [
            'name' => 'required|string',
        ]);

        $id_user = Auth::user();
        
        try {
            // $name = $request->input('name');

            $project = Project::create([
                'name' => $request->input('name'),
                'id_user' => $id_user['id'],
            ]);
            
            // Return successful response
            return response()->json($project, 201);
        // return response()->json(['project' => $name, 'id_user' => $id_user['id']], 200);

        } catch (\Exception $e) {
            // Return error message
            return response()->json(['message' => 'project Registration Failed!'], 409);
        }
    }

    /**
     * Get the authenticated User.
     *
     * @return JsonResponse
     */
    public function getProject()
    {
        $id_user = Auth::user();

        $results = app('db')->select("SELECT * FROM projects WHERE id_user =". $id_user['id']);
        return response()->json(['project' => $results], 200);
    }

    /**
     * Get the authenticated User.
     *
     * @return JsonResponse
     */
    public function getSearchProject(Request $request)
    {
        
        // Validate incoming request
        $this->validate($request, [
            'name' => 'required|string',
        ]);

        $name = $request->input('name');

        $id_user = Auth::user();

        $results = app('db')->select("SELECT * FROM projects WHERE id_user =". $id_user['id'] ." AND `name` LIKE '%". $name ."%'" );
        return response()->json(['project' => $results], 200);
    }

    /**
     * Get the authenticated User.
     *
     * @return JsonResponse
     */
    public function updateProject($id, Request $request)
    {
        
        // Validate incoming request
        $this->validate($request, [
            'name' => 'required|string',
        ]);

        $name = $request->input('name');
        
        try {

            $project = Project::find($id);

            $project->name = $name;

            $project->save();

            return response()->json(['project' => $project, 'name' => $name], 200);

        } catch (\Exception $e) {

            return response()->json(['message' => 'project not found!'], 404);
        }

    }

    /**
     * Get the authenticated User.
     *
     * @return JsonResponse
     */
    public function deleteProject($id)
    {
        
        try {

            $project = Project::find($id);

            $project->delete();

            return response()->json(['message' => 'se elimino con exito!'], 200);

        } catch (\Exception $e) {

            return response()->json(['message' => 'project not found!'], 404);
        }

    }


}
