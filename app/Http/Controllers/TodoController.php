<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\View\View;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * タスク一覧データの受け渡し
     */
    public function index(Request $request): View
    {
        //検索キーワードとステータスを取得
        $keyword=$request->input('keyword');
        $status=$request->input('status');
        $sort=$request->input('sort','latest');

        //ユーザ識別
        $todos=auth()->user()->todos()

        //キーワード検索
        ->when($keyword,function($query) use ($keyword){
            $query->where('title','like','%' . $keyword . '%');
        })

        //完了・未完了検索
        ->when($status==='incomplete',function($query){
            $query->where('completed',false);
        })
        ->when($status==='completed',function($query){
            $query->where('completed',true);
        })

        //期限日の昇順(期限近い順)並び替え
        ->when($sort==='due_date',function($query){
            $query->orderBy('due_date','asc');
        })

        //優先度並び替え
        ->when($sort==='priority',function($query){
            $query->orderByRaw("
            CASE priority
                WHEN 'high' THEN 1
                WHEN 'medium' THEN 2
                WHEN 'low' THEN 3
            END
            ");
        })
        ->when($sort==='latest',function($query){
            $query->latest();
        })
        ->get();

        return view('index',compact('todos','keyword','status','sort'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * タスク追加
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|max:255',
            'due_date'=>'nullable|date',
            'priority'=>'required|in:low,medium,high',
        ]);

        Todo::create([
            'user_id'=>auth()->id(),
            'title'=>$request->title,
            'completed'=>false,
            'due_date'=>$request->due_date,
            'priority'=>$request->priority,
        ]);

        return redirect(url()->previous());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * 編集ページへのリダイレクト
     */
    public function edit(Request $request,Todo $todo)
    {
        if($todo->user_id !== auth()->id()){
            abort(403);
        }

        //検索キーワードとステータスを取得
        $keyword=$request->input('keyword');
        $status=$request->input('status');
        $sort=$request->input('sort','latest');

        //ユーザ識別
        $todos=auth()->user()->todos()

        //キーワード検索
        ->when($keyword,function($query) use ($keyword){
            $query->where('title','like','%' . $keyword . '%');
        })

        //完了・未完了検索
        ->when($status==='incomplete',function($query){
            $query->where('completed',false);
        })
        ->when($status==='completed',function($query){
            $query->where('completed',true);
        })

        //期限日の昇順(期限近い順)並び替え
        ->when($sort==='due_date',function($query){
            $query->orderBy('due_date','asc');
        })

        //優先度並び替え
        ->when($sort==='priority',function($query){
            $query->orderByRaw("
            CASE priority
                WHEN 'high' THEN 1
                WHEN 'medium' THEN 2
                WHEN 'low' THEN 3
            END
            ");
        })
        ->when($sort==='latest',function($query){
            $query->latest();
        })
        ->get();

        return view('edit',compact('todo','todos','keyword','status','sort'));
    }

    /**
     * タスク名更新
     */
    public function update(Request $request, Todo $todo)
    {
        if($todo->user_id!=auth()->id()){
            abort(403);
        }

        $request->validate([
            'title'=>'required|max:255',
            'due_date'=>'nullable|date',
            'priority'=>'required|in:low,medium,high',
        ]);

        $todo->update([
            'title'=>$request->title,
            'due_date'=>$request->due_date,
            'priority'=>$request->priority,
        ]);

        return redirect()->route('todos.index',[
            'keyword'=>$request->input('keyword'),
            'status'=>$request->input('status'),
            'sort'=>$request->input('sort'),
        ]);
    }

    /**
     * タスク削除
     */
    public function destroy(Todo $todo)
    {
        if($todo->user_id!=auth()->id()){
            abort(403);
        }

        $todo->delete();
        return redirect(url()->previous());
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

        return redirect(url()->previous());
    }

    /**
     * 検索処理
     */
    public function search(): View
    {
        return view('search');
    }
}
