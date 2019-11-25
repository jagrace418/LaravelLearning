@extends('layouts.app')

@section('content')
    <form method="POST" action="/projects">
        @csrf
        <h1 class="heading is-1">Create a project</h1>
        <div class="field">
            <label class="label" for="title">Title</label>
            <div class="control">
                <input type="text" class="input" name="title" placeholder="title">
            </div>
        </div>
        <div class="field">
            <label class="label" for="description">Description</label>
            <div class="control">
                <textarea name="description" class="textarea"></textarea>
            </div>
        </div>

        <div class="control">
            <button class="button is-link">Submit</button>
            <a href="/projects">Cancel</a>
        </div>
    </form>
@endsection