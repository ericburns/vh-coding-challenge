<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\AnswerPostRequest;
use App\Http\Requests\QuestionPostRequest;
use App\Models\Question;
use App\Models\Answer;

class QuestionController extends Controller
{
    /**
     * Show a list of all questions
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $random_key = array_rand(config('constants.placeholderQuestions'), 1);

        return view('questions.index', [
            'placeholderQuestion' => config('constants.placeholderQuestions')[$random_key],
            'questions' => Question::all()->sortByDesc('created_at')
        ]);
    }

    /**
     * Show detail for a given question.
     * 
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        return view('questions.show', [
            'question' => Question::findOrFail($id)
        ]);
    }

    /**
     * Create a new question.
     * 
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionPostRequest $request)
    {
        $validated = $request->validated();

        Question::create($validated);

        return redirect(route('questions.index'));
    }

    /**
     * Answer a question.
     * 
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function answer(AnswerPostRequest $request, $id)
    {
        $question = Question::findOrFail($id);

        $validated = $request->validated();
        $answer = new Answer($validated);

        $question->answers()->save($answer);

        return redirect(route('questions.show', ['id' => $question->id]));
    }
}
