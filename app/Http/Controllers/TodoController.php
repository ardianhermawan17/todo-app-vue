<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Todo;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $todos = Todo::all();
        return Inertia::render('Todos/Todos', ['data' => $todos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
           'title'  =>  ['required'],
           'text'   =>  ['required']
        ]);

        $new_todos = new Todo;

        $new_todos->slug = Str::slug($request->title, '-');
        $new_todos->title = $request->get('title');
        $new_todos->text = $request->get('text');

        $new_todos->save();

        return redirect()->back()
            ->with('message', 'Todo Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request)
    {
        Validator::make($request->all(), [
            'title' => ['required'],
            'text' => ['required'],
        ])->validate();


        if ($request->has('id')) {
            Todo::find($request->input('id'))->update($request->all());
            return redirect()->back()
                ->with('message', 'Post Updated Successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request)
    {
        if ($request->has('id')){
            $todo = Todo::findOrFail($request->input('id'));
            $todo->delete();
//            dd($request->input('id'));
//            Todo::find($request->input('id')->delete());
            return redirect()->back();
        }
        //
    }
}
