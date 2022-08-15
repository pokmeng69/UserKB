@extends('LayoutAdmin')
@section('konten')
@parent
<div class="col-lg-12 mb-8">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <center><h5 class="m-0 font-weight-bold text-primary">Add Category</h5></center>
        </div>
        <div class="card-body">
          <form action="{{ url('AddCategory') }}" method="POST">
            @csrf
              <div class="form-group">
                <label for="AddCategory">Add Category</label>
                <input type="Text" class="form-control" id="Category_Name" name="Category_Name" placeholder="Enter Category">
              </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
    </div>
</div> 
<div class="col-lg-12 mb-8">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <center><h5 class="m-0 font-weight-bold text-primary">List Category</h5></center>
        </div>
        <div class="card-body">
        <table class="table table-bordered">
          <thead class="table-primary">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Category</th>
                <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
          @foreach($category as $c)
            <tr>
                <th scope="row">{{ $c->id}}</th>
                <td>{{ $c->Category_Name}}</td>
                <td>
                  <button class="btn btn-warning btn-detail open_modal" value="{{$c->id}}">Edit</button>
                  <a class="btn btn-danger" href="/category/delete/{{ $c->id }}">Delete</a>
                </td>
            </tr>
          @endforeach
          </tbody>
        </table>
        </div>
    </div>
</div> 
  <!--modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <form action="{{ url('/category/postedit/') }}" method="POST">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title" id="myModalLabel">Edit Category</h4>
                </div>
              <div class="modal-body">
                  @csrf
                    <div class="form-group">
                      <label for="inputName" class="col-sm-6 control-label">Category Name</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="Category_Modal_Name" name="Category_Modal_Name" placeholder="Category Name">
                        </div>
                    </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="btn-save">Save changes</button>
                <input type="hidden" id="id" name="id">
              </div>
            </form>
        </div>
      </div>
@endsection
@section('javascript')
<script>
  //ajax
  $(document).on('click','.open_modal',function(){
        var url = "http://127.0.0.1:8082/category/edit";
        var id= $(this).val();
        $.get(url + '/' + id, function (data) {
            //success data
            console.log(data);
            $('#id').val(data.id);
            $('#Category_Modal_Name').val(data.Category_Name);
            $('#myModal').modal('show');
        }) 
    });
</script>
@endsection
