<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
class Posts extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $data_id;
    public $titulo;
    public $descripcion;
    public $autor;
    public $imagenautor;
    public $imagennoticia;

    public function render()
    {
        $posts = Post::orderBy('id','DESC')->withTrashed()->paginate(5);  
        return view('livewire.posts',['posts'=>$posts]);
    }
    /**
     * Metodo para limpiar los campos que se guardaran o editaran.
     */
    public function resetInputFields(){
        $this->data_id = '';
        $this->titulo = '';
        $this->descripcion = '';
        $this->autor = '';
        $this->imagenautor = '';
        $this->imagennoticia = '';
    }
    /**
     * Metodo para guardar un Post
     */
    public function store($contenido){
         $this->descripcion = $contenido;  
        
        $validateData = $this->validate([
            'titulo' => 'required|max:100',
            'descripcion' => 'required',
            'autor' => 'required',
            'imagennoticia' => 'image',
            'imagenautor' => 'image',
        ]);

        $urlnot = $this->imagennoticia->store('public/images');
        $urlaut = $this->imagenautor->store('public/images'); 
        Post::create([
            'titulo' => $validateData['titulo'],
            'descripcion' =>$validateData['descripcion'],
            'autor' =>$validateData['autor'],
            'rutaimagen' => $urlnot,
            'autorimagen' => $urlaut,
        ]);
        session()->flash('success','Noticia Agregada con Éxito.');
        $this->resetInputFields();
        $this->emit('noticiaAgregada');
    }
    /**
     * Metodo para setear los valores del post que se actualizara
     */
    public function edit($id)
    {
        $data = Post::findOrFail($id);

        $this->data_id = $id;
        $this->titulo = $data->titulo;
        $this->autor = $data->autor;
    }
    /**
     * Metodo para actualizar los datos de un Post
     */
    public function update($contenido)
    {
        $this->descripcion = $contenido; 
        $validateData = $this->validate([
            'titulo' => 'required|max:100',
            'descripcion' => 'required',
            'autor' => 'required',
            'imagennoticia' => 'image',
            'imagenautor' => 'image',
        ]);
        $data = Post::find($this->data_id);
        $urlnot = $this->imagennoticia->store('public/images');
        $urlaut = $this->imagenautor->store('public/images'); 
        $data->update([
            'titulo' => $this->titulo,
            'descripcion' => $this->descripcion,
            'autor' => $this->autor,
            'rutaimagen' => $urlnot,
            'autorimagen' => $urlaut,
        ]);
        session()->flash('success','Noticia Actualizada con exito!');

        $this->resetInputFields();

        $this->emit('noticiaAgregada');
    }
    /**
     * Metodo para eliminar un post(utilizando softdelete)
     */
    public function delete($id)
    {
        if($id)
        {   
            Post::where('id',$id)->delete();
            session()->flash('success','Noticia desactivada exitosamente!');
        }
    }
    /**
     * Metodo para restaurar un post
     */
    public function restore($id)
    {
        if($id)
        {   
            Post::where('id',$id)->restore();
            session()->flash('success','Noticia activada exitosamente!');
        }
    }
}
