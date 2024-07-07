<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function add(Request $request){
        $validator=Validator::make($request->all(),[
            'user_id' => 'required|exists:users,id',
            'task' => 'required|string',
        ]);

        if($validator->fails()){
            return response()->json([
                'status'=>0,
                'message'=>$validator->errors()
            ],400);
        }

        $taskdata= new Task();
        $taskdata->user_id=$request->user_id;
        $taskdata->task=$request->task;
        $taskdata->save();
        return response()->json([
            'task'=>Task::find($request->user_id),
            'status'=>1,
            'message'=>'successfully created a task',
        ]);

    }

    public function changeStatus(Request $request){
        $validator = Validator::make($request->all(),[
            'task_id'=>'required|exists:tasks,id',
            'status'=>'required|in:pending,done',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'=>0,
                'message'=>$validator->errors(),
            ], 400);
        }

        $taskdata = Task::findOrFail($request->task_id);
        $taskdata->status=$request->status;
        $taskdata->save();

        return response()->json([
            'task'=>$taskdata,
            'status'=>1,
            'message'=>'marked task as ' . $request->status,
        ]);
    }
}
