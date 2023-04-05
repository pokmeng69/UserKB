@extends('LayoutAdmin')
@section('konten')
@parent
<div class="col-lg-12 mb-8">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <center><h5 class="m-0 font-weight-bold text-primary">Add Aritcle</h5></center>
        </div>
        <div class="card-body">
            <form action="{{ url('AddArticle') }}" method="POST">
                    @csrf
                    <label>Category</label>
                    <select name="id_cat" id="id_cat" class="form-control">
                        <option value="">-- Pilih Category --</option>
                        @foreach ($category as $c)
                            <option value="{{ $c->id }}">{{ $c->Category_Name }}</option>
                        @endforeach
                    </select>
                    <div class="form-group">
                        <label>Judul Artikel</label>
                        <input type="text" class="form-control" name="title_article" placeholder="Judul artikel">
                    </div>
                    <div class="form-group">
                        <label>Isi Artikel</label>
                        <textarea class="form-control" id="editor1" name="content_article" rows="15"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="created_at" value="{{ now()->format('Y-m-d H:i:s') }}">
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="updated_at" value="{{ now()->format('Y-m-d H:i:s') }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div> 
  @endsection

  @section('javascript')
           <script>
                // Replace the <textarea id="editor1"> with a CKEditor 4
                // instance, using default configuration.
                CKEDITOR.replace( 'editor1' );
                CKEDITOR.on("instanceReady", function(event) {
                    event.editor.on("beforeCommandExec", function(event) {
                        // Show the paste dialog for the paste buttons and right-click paste
                        if (event.data.name == "paste") {
                            event.editor._.forcePasteDialog = true;
                        }
                        // Don't show the paste dialog for Ctrl+Shift+V
                        if (event.data.name == "pastetext" && event.data.commandData.from == "keystrokeHandler") {
                            event.cancel();
                        }
                    })
                });
                CKEDITOR.editorConfig = function( config ) {    
                    config.allowedContent = true;
                    config.extraAllowedContent = 'dl dt dd';
                    config.allowedContent = 'u em strong ul li;a[!href,target]';
                    config.disallowedContent = 'a[target]';
                    config.disallowedContent = 'a';
                    config.disallowedContent = 'img{width,height}';
                };
            </script>
  @endsection