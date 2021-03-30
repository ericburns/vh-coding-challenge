@extends('layouts.base')

@section('title', 'Questions')

@section('content')
<div class="row">
    <div class="col-lg-6 offset-lg-3">
        <form class="pb-3 border-bottom mb-3" method="POST" action="{{ route('questions.store') }}">
            @csrf
            <div class="form-group">
                <textarea name="text" type="text" class="form-control @error('text') is-invalid @enderror" placeholder="{{ $placeholderQuestion }}">{{ old('text') }}</textarea>
                @error('text')
                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="text-right">
                <button class="btn btn-primary" type="submit">Ask away</button>
            </div>
        </form>

        <h2 class="mb-3 p-3 bg-primary text-white">Questions</h2>

        @foreach ($questions as $question)
            <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
                <h3 class="m-0">
                    <a class="text-dark" href="{{ route('questions.show', ['id' => $question->id]) }}">{{ $question->text }}</a>
                </h3>
                <span class="badge badge-primary">{{ $question->answers->count() }} answers</span>
            </div>
        @endforeach
    </div>
</div>
@stop
