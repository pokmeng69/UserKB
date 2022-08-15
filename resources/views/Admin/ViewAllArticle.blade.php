@extends('LayoutAdmin')
@section('konten')
@parent
<div class="col-lg-12 mb-8">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <center><h5 class="m-0 font-weight-bold text-primary">View All Aritcle</h5></center>
        </div>
        <div class="card-body">
        <!--table-->
          <table class="table table-bordered">
            <thead class="table-primary">
              <tr>
                <th scope="col">No</th>
                <th scope="col">Title Article</th>
                <th scope="col">Content Article</th>
                <th scope="col">Category Article</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
            <input type="hidden" id="Number" name="Number" value="{{$i=1;}}" > 
            @foreach($article as $a)
              <tr>
                  <th scope="row">{{$i++}}</th>
                  <td>{{ $a->title_article}}</td>
                  <td>{!! $a->content_article !!}</td>
                  <td>{{ $a->id_cat}}</td>
                  <td>
                    <a class="btn btn-warning btn-detail open_modal" href="{{route('EditArticle.show',$a->id)}}">Edit</a>
                    <a class="btn btn-danger" href="/article/delete/{{ $a->id }}">Delete</a>
                  </td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
    </div>
</div>
@endsection