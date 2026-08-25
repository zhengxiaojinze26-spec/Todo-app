<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\View\View;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $keyword=$request->input('keyword');
        $status=$request->input('status');

        $todos=auth()->user()->todos()
        ->when($keyword,function($query) use ($keyword){
            $query->where('title','like','%' . $keyword . '%');
        })
        ->when($status==='incomplete',function($query){
            $query->where('completed',false);
        })
        ->when($status==='completed',function($query){
            $query->where('completed',true);
        })
        ->latest()->get();

        return view('index',compact('todos','keyword','status'));
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
            'title'=>'required|max:255',
        ]);

        Todo::create([
            'user_id'=>auth()->id(),
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
    public function edit(Todo $todo)
    {
        if($todo->user_id !== auth()->id()){
            abort(403);
        }

        $todos=auth()->user()->todos()->latest()->get();

        return view('edit',compact('todo','todos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Todo $todo)
    {
        if($todo->user_id!=auth()->id()){
            abort(403);
        }

        $request->validate([
            'title'=>'required|max:5',
        ]);

        $todo->update([
            'title'=>$request->title
        ]);

        return redirect('/todos');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        if($todo->user_id!=auth()->id()){
            abort(403);
        }

        $todo->delete();
        return redirect('/todos');
    }

    /**
     * タスク完了・未完了
     */
    public function complete(Todo $todo)
    {
        if($todo->user_id!=auth()->id()){
            abort(403);
        }

        $todo->update([
            'completed'=>!$todo->completed
        ]);

        return redirect('/todos');
    }

    /**
     * 検索処理
     */
    public function search(): View
    {
        return view('search');
    }
}
