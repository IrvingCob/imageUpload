<!-- Modal -->
<div wire:ignore.self class="modal fade" id="exampleModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create New Cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
           <div class="modal-body">
				<form  enctype="multipart/form-data">
            <div class="form-group">
                <label for="nombre"></label>
                <input wire:model="nombre" type="text"  class="form-control" id="nombre" placeholder="Nombre">@error('nombre') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>

            

            <label for="validationCustomUsername">Dato</label>
                          <div class="input-group">
                            <select wire:model="dato_id" class="custom-select" required>
                                <option  selected value="">Seleccione un dato</option>
                                    @foreach($dato as $role)
                                    <option value="{{ $role->id }}">{{ $role->dato }}</option>
                                    @endforeach
                            </select>
                          </div>
                            @error('dato_id') <span class="error text-danger">{{ $message }}</span>@enderror


            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" accept="image/*" wire:model="image" id="image" >

 
            </div>
                    
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
                <button type="button" wire:click.prevent="store()" class="btn btn-primary close-modal">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>