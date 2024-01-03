@extends('statamic::layout')
@section('title', __('statamic-passport::messages.title'))

@section('content')

    <header class="flex items-center justify-between mb-6">
        <h1>{{ __('statamic-passport::messages.title') }}</h1>
    </header>

    <div>
        <passport-client-listing>
        </passport-client-listing>
    </div>
    <div class="mt-8">
        <passport-token-listing>
        </passport-token-listing>
    </div>

@endsection