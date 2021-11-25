<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Dato;

class Datos extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $dato;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.dato.view', [
            'datos' => Dato::latest()
						->orWhere('dato', 'LIKE', $keyWord)
						->paginate(10),
        ]);
    }
	
    public function cancel()
    {
        $this->resetInput();
        $this->updateMode = false;
    }
	
    private function resetInput()
    {		
		$this->dato = null;
    }

    public function store()
    {
        $this->validate([
		'dato' => 'required',
        ]);

        Dato::create([ 
			'dato' => $this-> dato
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Dato Successfully created.');
    }

    public function edit($id)
    {
        $record = Dato::findOrFail($id);

        $this->selected_id = $id; 
		$this->dato = $record-> dato;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'dato' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Dato::find($this->selected_id);
            $record->update([ 
			'dato' => $this-> dato
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Dato Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Dato::where('id', $id);
            $record->delete();
        }
    }
}
