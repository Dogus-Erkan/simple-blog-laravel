@extends('front.layouts.master')
@section('title',$category->name.' Kategorisi | Toplam Makale Sayısı '.count($articles))
@section('content')
<div class="col-md-12 col-lg-8 col-xl-7">
    @include('front.widgets.articleList')
</div>
@include('front.widgets.categoryWidget')
@endsection
