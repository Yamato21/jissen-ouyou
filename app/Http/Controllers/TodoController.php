<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\todo;
use App\Http\Requests\todoRequest;
use App\Models\User;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    public function index()
    {
        $indexs = todo::all();
        $user = Auth::user();
        $tags = Tag::all();
        return view(
            'index',
            [
                'indexs' => $indexs,
                'user' => $user,
                'tags' => $tags
            ]
        );
    }

    public function create(todoRequest $request)
    {
        $form = $request->all();
        $form['user_id'] = Auth::id();
        todo::create($form);
        return redirect('/home');
    }

    public function update(todoRequest $request)
    {
        $form = $request->all();
        unset($form['_token']);
        todo::where('id', $request->id)->update($form);
        return redirect('/home');
    }

    public function delete(Request $request)
    {
        $id = todo::find($request->id);
        $id->delete();
        return redirect('/home');
    }

    public function search(Request $request)
    {
        $todos = Todo::all();
        $tags = Tag::all();
        $user = Auth::user();
        $time =  $request->input('created_at');

        return view('search', 
        ['todos' => $todos,
        'tags' => $tags, 'user' => $user,
         'time' => $time]);
    }

    public function find(Request $request)
    {
        $task_name = $request->input('task_name');
        $tag_id = $request->input('tag_id');

        $todo = Todo::query();
        $tags = Tag::all();
        $user = Auth::user();

        if ($task_name !== null) {
            $todo->where('task_name', 'like', '%' . $task_name . '%');
        }
        if ($tag_id !== null) {
            $todo->where('tag_id', $tag_id);
        }
        $todos = $todo->get();

        return view('search', ['todos' => $todos, 'tags' => $tags, 'user' => $user ]);
    }
}
