@extends('layouts.base')

@section('title', $question->text)

@section('content')
<div class="row">
    <div class="col-lg-6 offset-lg-3">
        <h2 class="mb-3 p-3 bg-primary text-white">{{ $question->text }}</h2>

        @foreach ($question->answers->sortBy('created_at') as $answer)
            <p class="border-bottom pb-3">{{ $answer->text }}</p>
        @endforeach

        <form class="pb-3 border-bottom mb-3" method="POST" action="{{ route('questions.answer', ['id' => $question->id]) }}">
            @csrf
            <div class="form-group">
                <h4 class="bg-primary text-white p-3">Answer the question!</h4>
                <textarea name="text" type="text" class="form-control @error('text') is-invalid @enderror">{{ old('text') }}</textarea>
                @error('text')
                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="text-right">
                <button class="btn btn-primary" type="submit">Answer question</button>
            </div>
        </form>
    </div>
</div>
@stop
