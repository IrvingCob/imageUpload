<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\{Cliente,Dato};
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;



class Clientes extends Component
{
    use WithPagination;
    use WithFileUploads;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $nombre, $dato_id, $image, $save;
    public $updateMode = false;
    

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';

        $cliente = Cliente::latest() 
                            ->orWhere('nombre', 'LIKE', $keyWord)
                            ->orWhere('dato_id', 'LIKE', $keyWord)
                            ->paginate(10);

        $dato = Dato::all();

        return view('livewire.cliente.view', compact('cliente', 'dato'));
    }

    
	
    public function cancel()
    {
        $this->resetInput();
        $this->updateMode = false;
    }
	
    private function resetInput()
    {		
		$this->nombre = null;
        $this->dato_id = null;
        $this->image = null;
    }

    public function store()
    {

        
       $this->validate([
		'nombre' => 'required',
        'dato_id' => 'required',
        'image' => 'required|image|mimes:jpeg,png,svg,jpg,gif|max:1024',
        ]);

       Storage::disk('public')->put('fotos', 'image');
        

        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Cliente Successfully created.');
    }

    public function edit($id)
    {
        $record = Cliente::findOrFail($id);

        $this->selected_id = $id; 
		$this->nombre = $record->nombre;
        $this->dato_id = $record->dato_id;
        $this->image = $record->image;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'nombre' => 'required',
        'dato_id' => 'required',
        'image' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Cliente::find($this->selected_id);
            $record->update([ 
			'nombre' => $this->nombre,
            'dato_id' => $this->dato_id,
            'image' => $this->image
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Cliente Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Cliente::where('id', $id);
            $record->delete();
        }
    }
}
