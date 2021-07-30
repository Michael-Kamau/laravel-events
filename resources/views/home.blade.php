@extends('layouts.main_app')

@section('content')
<div class="">
    <div id="#">
{{--        <index></index>--}}
        <router-view></router-view>
    </div>
</div>
@endsection
