<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use App\Models\Question;
use App\Models\Choice;
use Inertia\Inertia;

class QuestionController extends Controller
{
/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        $question->load('choices');
        
        return Inertia::render('Quiz/Question/Edit', [
            'question' => $question
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        Request::validate([
            'description' => ['required'],
            'source' => ['nullable'],
            'photo' => ['nullable', 'image'],
            'choices' => ['required']
        ]);
// dd(Request::get('choices')[0]['correct']);
        foreach(Request::get('choices') as $item){
            $choice = Choice::find($item['id']);
            $choice->correct = $item['correct'];
            $choice->save();
        }

        $question->update(Request::only('description', 'source'));

        if (Request::file('photo')) {
            $question->update(['image' => Request::file('photo')->store('/')]);
        }

        return Redirect::back()->with('success', 'Question updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        //
    }
}
