<div>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Posts') }}
        </h2>
        
    </x-slot>
    <section>
        <div class="container">  
            @include('mensajes-flash') 
            <div class="row">
                <div class="card">
                    <div class="card-header">
                        <button class="btn btn-secondary" data-toggle="modal" 
                        data-target="#addNoticia" wire:click="resetInputFields()">Añadir Noticia</button>
                    </div>
                    <div class="card-body">
                        <table class="table table-responsive table-striped" >
                            <thead>
                                <tr>
                                    <th>Titulo</th>
                                    <th style="width:800px">Descripcion</th>
                                    <th>Autor</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($posts as $post)
                                    <tr>
                                        <td>{{$post->titulo}}</td>
                                        <td>{!!$post->descripcion!!}</td>
                                        <td>{{$post->autor}}</td>
                                        
                                        @if(isset($post->deleted_at))
                                            <td><button class="btn btn-success btn-sm" wire:click="restore({{$post->id}})">habilitar</button></td>
                                        @else
                                            <td><button class="btn btn-primary btn-sm" data-toggle="modal" 
                                            data-target="#editNoticia" onclick="limpiar()" wire:click="edit({{$post->id}})">Editar</button></td>
                                            <td><button class="btn btn-warning btn-sm" wire:click="delete({{$post->id}})">Desactivar</button></td>
                                        @endif
                                    </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        </div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="addNoticia" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Añadir Noticia</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form enctype="multipart/form-data">
                <input type="file" name="imagennoticia" wire:model="imagennoticia">
                @error('imagennoticia') <span class="error text-danger">{{ $message }}</span> @enderror
                <!-- <div class="custom-file">
                    
                    @error('imagennoticia') <span class="error">{{ $message }}</span> @enderror
                    <label class="custom-file-label" for="customFile">Imagen Noticia</label>
                </div> -->
                <div class="form-group">
                    <label for="Titulo">Titulo</label>
                    <input type="text" name="titulo" class="form-control" wire:model="titulo">
                    @error('titulo') <span class="error text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="form-group" wire:ignore wire:key="id2"  >
                    <label for="descripcion">Descripción</label>
                    
                    <textarea  rows="3" id="cont" name="descripcion" class="form-control cont" ></textarea>
                    @error('descripcion') <span class="error text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="Autor">Autor</label>
                    <input type="text" name="autor" class="form-control" wire:model="autor">
                    @error('autor') <span class="error text-danger">{{ $message }}</span> @enderror
                </div>
                <input type="file" name="imagenautor" wire:model="imagenautor">
                @error('imagenautor') <span class="error text-danger">{{ $message }}</span> @enderror
            </form>
                

        </div>
        <div class="modal-footer">
                <button type="button" class="btn btn-secondary" wire:click="resetInputFields()" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" wire:click="store(editor.getData())">Agregar Noticia</button>
            
        </div>
        </div>
    </div>
    </div>
    <!-- Modal -->
<div wire:ignore.self class="modal fade" id="editNoticia" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Editar Noticia</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form  enctype="multipart/form-data">
                 <input type="file" name="imagennoticia" wire:model="imagennoticia">
                @error('imagennoticia') <span class="error text-danger">{{ $message }}</span> @enderror
            <div class="form-group">
                <label for="Titulo">Titulo</label>
                <input type="text" name="titulo" class="form-control" wire:model="titulo">
                @error('titulo') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group" wire:ignore wire:key="id4">
                <label for="Descripcion">Descripción</label>
                <textarea rows="3" id="cont2" name="descripcion" class="form-control content"></textarea>
                @error('descripcion') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="Autor">Autor</label>
                <input type="text" name="autor" class="form-control" wire:model="autor">
                @error('autor') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <input type="file" name="imagenautor" wire:model="imagenautor">
            @error('imagenautor') <span class="error text-danger">{{ $message }}</span> @enderror
        </form>
            

      </div>
      <div class="modal-footer">
            <button type="button" class="btn btn-secondary" wire:click="resetInputFields()" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" wire:click="update(editor2.getData())">Editar Noticia</button>
        
      </div>
    </div>
  </div>
</div>

    </section>
</div>
<!-- <script src="https://cdn.ckeditor.com/4.15.1/basic/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'descripcion' );
</script> -->
<script src="https://cdn.ckeditor.com/ckeditor5/23.1.0/classic/ckeditor.js"></script>
<script>
    let editor;
        ClassicEditor
            .create( document.querySelector( '#cont' ) )
            .then( newEditor => {
                editor = newEditor;
            } )
            .catch( error => {
                console.error( error );
            } );
        let editor2;
        ClassicEditor
            .create( document.querySelector( '#cont2' ) )
            .then( newEditor => {
                editor2 = newEditor;
            } )
            .catch( error => {
                console.error( error );
            } );
    function limpiar(){
        editor.val('');
        editor2.val('');
    }
        
</script>

