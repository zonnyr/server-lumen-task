<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\User;
use App\Project;
use App\Task;

class TaskController extends Controller
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
    public function createTask($id, Request $request)
    {
        
        // Validate incoming request
        $this->validate($request, [
            'name' => 'required|string',
        ]);

        
        try {

            $task = Task::create([
                'name' => $request->input('name'),
                'state' => false,
                'id_project' => $id,
            ]);
            
            // Return successful response
            return response()->json(['task' => $task, 'message' => 'task Created'], 201);

        } catch (\Exception $e) {
            // Return error message
            return response()->json(['message' => 'task Registration Failed!'], 409);
        }
    }

    /**
     * Get the authenticated User.
     *
     * @return JsonResponse
     */
    public function getTask($id)
    {
        // Validate incoming request
        // $this->validate($request, [
        //     'id_project' => 'required|string',
        // ]);

        // $id_project = $request->input('id_project');

        $results = app('db')->select("SELECT * FROM tasks WHERE id_project =". $id);
        return response()->json(['tasks' => $results], 200);
    }
    
    /**
     * Get the authenticated User.
     *
     * @return JsonResponse
     */
    public function getSearchTask($id, Request $request)
    {
        
        // Validate incoming request
        $this->validate($request, [
            'name' => 'required|string',
        ]);

        $name = $request->input('name');

        $results = app('db')->select("SELECT * FROM tasks WHERE id_project =". $id ." AND `name` LIKE '%". $name ."%'" );
        return response()->json(['task' => $results], 200);
    }

    /**
     * Get the authenticated User.
     *
     * @return JsonResponse
     */
    public function updateTask($id, Request $request)
    {
        
        // Validate incoming request
        $this->validate($request, [
            'name' => 'required|string',
            'state' => 'required|integer',
        ]);

        $name = $request->input('name');
        $state = $request->input('state');
        
        try {

            $task = Task::find($id);

            $task->name = $name;

            $task->state = $state;

            $task->save();

            return response()->json(['task' => $task, 'name' => $name], 200);

        } catch (\Exception $e) {

            return response()->json(['message' => 'task not found!'], 404);
        }

    }

    /**
     * Get the authenticated User.
     *
     * @return JsonResponse
     */
    public function deleteTask($id)
    {
        
        try {

            $task = Task::find($id);

            $task->delete();

            return response()->json(['message' => 'se elimino con exito!'], 200);

        } catch (\Exception $e) {

            return response()->json(['message' => 'task not found!'], 404);
        }

    }


}
