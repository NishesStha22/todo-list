<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tasktable;

class TasktableController extends Controller
{
    public function index()
    {
        try {
            $tasks = Tasktable::where('delete_flags', false)->orderBy('id', 'asc')->get();
            return response()->json([
                'status' => 1,
                'data' => $tasks
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function store(Request $request)
    {
        // dd($request);
        try {
            // $validatedData = $request->validate([
            //     'title' => 'required|string|max:255',
            //     'status' => 'required|in:Done,Pending',
            //     'date' => 'required|date',
            // ]);

            // dd()

            $task = new Tasktable();
            $task->title = $request->title;
            $task->status = $request->status;
            $task->delete_flags = false; 
            $task->date = $request->date;
            $task->save();

            return response()->json([
                'status' => 1,
                'message' => 'Task added successfully.',
                'data' => $task
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function show($id)
    {
        try {
            $task = Tasktable::where('id', $id)->where('delete_flags', false)->first();
            return response()->json([
                'status' => 1,
                'data' => $task
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'status' => 'required|in:Done,Pending',
                'date' => 'required|date',
            ]);

            $task = Tasktable::where('id', $id)->where('delete_flags', false)->first();
            $task->title = $validatedData['title'];
            $task->status = $validatedData['status'];
            $task->date = $validatedData['date'];
            $task->save();

            return response()->json([
                'status' => 1,
                'message' => 'Task updated successfully.',
                'data' => $task
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function destroy($id)
    {
        try {
            $task = Tasktable::where('id', $id)->where('delete_flags', false)->first();
            $task->delete_flags = true;
            $task->save();

            return response()->json([
                'status' => 1,
                'message' => 'Task deleted successfully.',
                'data' => $task
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
