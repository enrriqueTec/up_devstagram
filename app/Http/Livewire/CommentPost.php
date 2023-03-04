<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Comentario;

class CommentPost extends Component
{
    public $post;
    public $comentario;
    

    protected $rules=[
        'comentario'=>'required|max:255'
    ];
    protected $listeners = ['refreshComponent' => '$refresh'];

    public function mount($post)
    {
        
    }

    public function comentar()
    {
     
        $this->validate();

        Comentario::create([
            'user_id' => auth()->user()->id ,
            'post_id' => $this->post->id ,
            'comentario'=>$this->comentario
        ]);


      
        

       $this->emit('refreshComponent');
       $this->dispatchBrowserEvent('contentChanged');
    }
    
    public function render()
    {
        return view('livewire.comment-post');
    }
}
