@extends('front.layouts.master')
@section('title','İletişim')
@section('bg','https://startbootstrap.github.io/startbootstrap-clean-blog/assets/img/contact-bg.jpg')
@section('content')


<div class="row gx-4 gx-lg-5 justify-content-center">
    <div class="col-md-8 ">
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @elseif ($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error )
                <li>{{ $error }}</li>
                @endforeach</ul>
        </div>
        @endif
        
      
        <h2>Bizimle İletişime Geçebilirsiniz </h2>
        <div class="my-5">
            <form method="POST" action="{{ route('contact.post') }}">
                @csrf
                <div class="form-floating">
                    <input class="form-control" value="{{ old('name') }}" name="name" type="text" placeholder="Ad Soyad"
                        required />
                    <label for="name">Ad Soyad</label>

                </div>
                <div class="form-floating">
                    <input class="form-control" value="{{ old('email') }}" name="email" type="email" placeholder="Email"
                        required />
                    <label for="email">Email</label>

                </div>
                <div class="form-floating">

                    <select class="form-control" name="topic">
                        <option @if(old('topic')=="Bilgi" ) selected @endif>Bilgi</option>
                        <option @if(old('topic')=="Destek" ) selected @endif>Destek</option>
                        <option @if(old('topic')=="Genel" ) selected @endif>Genel</option>
                    </select>
                    <label for="topic">Konu</label>
                </div>
                <div class="form-floating">
                    <textarea class="form-control" name="message" placeholder="Mesajınız"
                        style="height: 12rem">{{ old('message') }}</textarea>
                    <label for="message">Mesajınız</label>

                </div>
                <br />

                <button class="btn btn-primary text-uppercase " id="submitButton" type="submit">Gönder</button>
            </form>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card card-default">
            <div class="card-body">Panel Content</div>
            <div class="card-body">Adred: ddsfsdf</div>

        </div>
    </div>
</div>



@endsection
