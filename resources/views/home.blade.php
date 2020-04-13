@extends('layouts.app')

@section('content')
<div class="container">
    <div id="#">
{{--        <index></index>--}}
        <router-view></router-view>
    </div>
</div>
@endsection
