@extends('back.layouts.master')
@section('title','Kategoriler')
@section('content')
<div class="row">


    <div class="col-md-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Yeni Kategori Oluştur</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.category.create') }}">
                    @csrf
                    <div class="form-group">
                        <label>Kategori Adı</label>
                        <input type="text" class="form-control" name="category" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block ">Ekle</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Kategori Adı</th>
                                <th>Makale Sayısı</th>
                                <th>Durum</th>
                                <th>İşlemler</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category )
                            <tr>
                                <td>{{$category->name }}</td>
                                <td>{{ $category->articleCount() }}</td>
                                <td><input class="switch" category-id="{{ $category->id }}" data-on="Aktif"
                                        data-off="Pasif" data-offstyle="danger" type="checkbox" @if($category->status==1) checked
                                    @endif data-toggle="toggle"></td>
                                <td>
                                   <a category-id="{{ $category->id }}" id="" class="edit-click btn btn-sm btn-primary" title="Kategoriyi Düzenle"><i class="fa fa-edit"></i></a>
                                   <a category-id="{{ $category->id }}" category-name="{{ $category->name }}" category-count="{{ $category->articleCount() }}" id="" class="remove-click btn btn-sm btn-danger" title="Kategoriyi Sil"><i class="fa fa-times"></i></a>
                                    

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal" tabindex="-1" id="editModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Kategoriyi Düzenle</h5>
         
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('admin.category.update') }}">
                @csrf
                <div class="form-group">
                    <label>Kategori Adı</label>
                    <input id="category" type="text" class="form-control" name="category" required>
                    <input id="category_id" type="hidden" class="form-control" name="id" required>
                </div>
                <div class="form-group">
                    <label>Kategori Slug</label>
                    <input id="slug" type="text" class="form-control" name="slug" required>
                </div>
                <div class="form-group">
                   
                </div>
           
        </div>
        <div class="modal-footer">
            <button type="submit"  class="btn btn-success ">Düzenle</button>
            <button type="button" data-dismiss="modal" class="btn btn-danger ">Kapat</button>
        </div>
    </form>
      </div>
    </div>
  </div>
  <div class="modal" tabindex="-1" id="deleteModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Kategoriyi Sil</h5>
         
        </div>
        <div id=body class="modal-body">
            <div class="alert alert-danger" id="articleAlert"></div>
        </div>
        <div class="modal-footer">
            <form method="POST" action="{{ route('admin.category.delete') }}">
            @csrf
            <input id="deleteId" type="hidden" class="form-control" name="id" required>
            <button id="deleteButton" type="submit"  class="btn btn-success ">Sil</button>
        </form> 
            <button type="button" data-dismiss="modal" class="btn btn-danger ">Kapat</button>
        </div>
    </form>
      </div>
    </div>
  </div>
@endsection
@section('css')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection
@section('js')
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script>
    $(function () {
        $('.remove-click').click(function(){
            id = $(this)[0].getAttribute('category-id');
            count = $(this)[0].getAttribute('category-count');
            name = $(this)[0].getAttribute('category-name');
            if(id==1){
                $('#articleAlert').html(name+' kategorisi sabit kategoridir. Silinen diğer kategorilere ait makaleler buraya eklenecektir.');
                $('#body').show();
                $('#deleteButton').hide();
                $('#deleteModal').modal();
                return;
            }
            $('#deleteButton').show();
            $('#deleteId').val(id);
            $('#articleAlert').html('');
            $('#body').hide();
            if(count>0){
                $('#articleAlert').html('Bu kategoriye ait '+count+ ' makale bulunmaktadır. Silmek istediğinize emin misiniz ?');
                $('#body').show();
            }
            else{
            $('#articleAlert').html('Bu kategoride hiç makale bulunmamaktadır.Silmek istediğinize emin misiniz ?');
            $('#body').show();
          } 
            
          $('#deleteModal').modal();
        });
        $('.edit-click').click(function(){
            id = $(this)[0].getAttribute('category-id');
            $.ajax({
                type:'GET',
                url:'{{ route('admin.category.getData')}}',
                data:{id:id},
                success:function(data){
                    console.log(data);
                    
                    $('#category').val(data.name);
                    $('#slug').val(data.slug);
                    $('#category_id').val(data.id);
                    $('#editModal').modal();
                }
            });
        });

        $('.switch').change(function () {
            id = $(this)[0].getAttribute('category-id');
            statu = $(this).prop('checked');
            $.get("{{ route('admin.category.switch') }}", {
                id: id,
                statu: statu
            }, function (data, status) {});
        });
    });

</script>
@endsection
