@extends('LayoutAdmin')
@section('konten')
@parent
<div class="col-lg-12 mb-8">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <center><h5 class="m-0 font-weight-bold text-primary">View All Aritcle</h5></center>
        </div>
        <div class="card-body">
            <div class="searchbox">
                <form action="{{ url('/Search') }}" method="POST">
                    <div class="input-group">
                        <input type="search" id="SearchParam" name="SearchParam" class="form-control" style="height: 50px;font-size: 20px;" placeholder="Cari Articel ... " aria-label="Search" aria-describedby="search-addon" />
                        <a class="newline"><br><br><br></a>
                        <button type="submit" class="btn btn-outline-primary" style="height: 50px; float:right;">Search</button>&nbsp;
                    </div>
                </form>
            </div>
        <!--table-->
          <table class="table">
            <thead class="table">
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
                  <td>{!! substr($a->content_article, 0, 100 ) !!}</td>
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