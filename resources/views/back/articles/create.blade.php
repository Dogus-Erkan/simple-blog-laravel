@extends('back.layouts.master')
@section('title','Makale Oluştur')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
    </div>
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error )
                   <li>{{ $error }}</li> 
                @endforeach
            </div>
        @endif
      <form action="{{ route('admin.makaleler.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
              <label for="">Makale Başlığı</label>
              <input type="text" class="form-control"  name="title"  required id="">
          </div>
          <div class="form-group">
            <label for="">Makale Kategori</label>
            <select name="category" class="form-control" required id="">
                <option value="" >Seçim Yapınız</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
             </div>
        <div class="form-group">
            <label for="">Makale Fotoğrafı</label>
            <input type="file" class="form-control" required name="image" required id="">
        </div>
        <div class="form-group">
            <label for="">Makale İçeriği</label>
            <textarea name="content" class="form-control" id="editor" rows="4"></textarea>    
        </div>
         <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Makaleyi Oluştur</button>
        </div>
      </form>
    </div>
</div>
@endsection
@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>
    $(document).ready(function() {
  $('#editor').summernote(
     { 'height':300}
  );
});
</script>
@endsection