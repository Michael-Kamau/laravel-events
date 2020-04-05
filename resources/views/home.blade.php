@extends('layouts.app')

@section('content')
<div class="container">
    <div id="app">
{{--        <index></index>--}}
        <router-view></router-view>
    </div>
</div>
@endsection
