<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function index() {
        $tasks = Task::orderBy('created_at', 'asc')->get();

        return view('tasks', [
            'tasks' => $tasks
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);
    
        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }

        $request->user()->tasks()->create([
            'name' => $request->name,
        ]);
    
        return redirect('/');
    }

    public function update(Request $request, $id)
    {
        $this->authorize('update', $request);

        // $validate = Validator::make($request->toArray(),[
        //     'name' => 'required',
        //     'completed' => 'required',
        // ]);
        // if($validate->fails()){
        //     return response($validate->errors(), 400);
        // }
        // $request->update($validate->validate());
        return redirect('/');
    }

    public function destroy(Request $request, $id)
    {
        
        $this->authorize('destroy', $request);

        $request->delete();

        return redirect('/');
    }
}
