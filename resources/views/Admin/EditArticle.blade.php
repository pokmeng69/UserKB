@extends('LayoutAdmin')
@section('konten')
@parent
<div class="col-lg-12 mb-8">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <center><h5 class="m-0 font-weight-bold text-primary">Edit Aritcle</h5></center>
        </div>
        <div class="card-body">
        <form action="{{ url('/article/postedit/') }}" method="POST">
                @csrf
                <label>Category</label>
                <select name="edit_id_cat" id="edit_id_cat" class="form-control">
                    @foreach ($category as $c)
                        <option value="{{ $c->id_cat}}">{{ $c->Category_Name }}</option>
                    @endforeach
                </select>
                @foreach ($article as $a)
                    <div class="form-group">
                        <input type="hidden" name="edit_id" id="edit_id"value="{{ $a->id }}">
                    </div>
                    <div class="form-group">
                        <label>Judul Artikel</label>
                        <input type="text" class="form-control" name="edit_title_article" id="edit_title_article" placeholder="Judul artikel" value="{{$a->title_article}}">
                    </div>
                    <div class="form-group">
                        <label>Isi Artikel</label>
                        <textarea class="form-control" id="editor1" name="edit_content_article" rows="15">{{ $a->content_article }}</textarea>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="created_at" id="created_at"value="{{ $a->created_at }}">
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="edit_updated_at" id="edit_updated_at" value="{{ now()->format('Y-m-d H:i:s') }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                @endforeach
            </form>
        </div>
    </div>
</div> 
@endsection
@section('javascript')
  <script type="text/javascript">
    CKEDITOR.replace('editor1', {
        filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
    CKEDITOR.on('instanceReady', function (ev) {
    ev.editor.dataProcessor.htmlFilter.addRules( {
        elements : {
            img: function( el ) {
                // Add bootstrap "img-responsive" class to each inserted image
                el.addClass('img-fluid');
                // Remove inline "height" and "width" styles and
                // replace them with their attribute counterparts.
                // This ensures that the 'img-responsive' class works
                var style = el.attributes.style;
                if (style) {
                    // Get the width from the style.
                    var match = /(?:^|\s)width\s*:\s*(\d+)px/i.exec(style),
                        width = match && match[1];
                    // Get the height from the style.
                    match = /(?:^|\s)height\s*:\s*(\d+)px/i.exec(style);
                    var height = match && match[1];
                    // Replace the width
                    if (width) {
                        el.attributes.style = el.attributes.style.replace(/(?:^|\s)width\s*:\s*(\d+)px;?/i, '');
                        el.attributes.width = width;
                    }
                    // Replace the height
                    if (height) {
                        el.attributes.style = el.attributes.style.replace(/(?:^|\s)height\s*:\s*(\d+)px;?/i, '');
                        el.attributes.height = height;
                    }
                }
                // Remove the style tag if it is empty
                if (!el.attributes.style)
                    delete el.attributes.style;
                    }
                }
            });
        });
  </script>
@endsection