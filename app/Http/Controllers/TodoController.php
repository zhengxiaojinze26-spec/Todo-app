<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todos=Todo::latest()->get();

        return view('index',compact('todos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|max:5',
        ]);

        Todo::create([
            'title'=>$request->title,
            'completed'=>false
        ]);

        return redirect('/todos');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();
        return redirect('/todos');
    }

    /**
     * タスク完了・未完了
     */
    public function complete(Todo $todo)
    {
        $todo->update([
            'completed'=>!$todo->completed
        ]);

        return redirect('/todos');
    }
}
