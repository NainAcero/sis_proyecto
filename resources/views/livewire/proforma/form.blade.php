<div class="widget-content-area ">
    <div class="widget-one">
        <form>
            <h3 class="text-center">Crear/Editar Registros</h3>
            <!--formulario-->
            <div class="row">
                @if(Auth::user()->role == "ADMIN")
                <div class="form-group col-lg-4 col-sm-12 mb-8">
                    <label >NOMBRE DEL TÉCNICO **</label>
                    <select wire:model.lazy="tecnico" class="form-control text-center">
                        <option value="Elegir" disabled="">Elegir</option>
                        @foreach ($tecnicos as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    @error('tecnico') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="form-group col-lg-4 col-sm-12 mb-8">
                    <label >NOMBRE DEL VENDEDOR **</label>
                    <input wire:model.lazy="vendedor" type="text" class="form-control"  placeholder="NOMBRE DEL VENDEDOR">
                    @error('vendedor') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="form-group col-lg-4 col-sm-12 mb-8">
                    <label >INGRESE NÚMERO PROFORMA **</label>
                    <input wire:model.lazy="num_proforma" type="text" class="form-control"  placeholder="NÚMERO PROFORMA">
                    @error('num_proforma') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="form-group col-lg-4 col-md-4 col-sm-12">
                    <label >DOCUMENTO**</label>
                    <input type="file" accept="application/pdf" wire:model="archivo" class="form-control text-center" >
                    @error('archivo') <span class="error">{{ $message }}</span> @enderror
                </div>
                @elseif(Auth::user()->role == "ALMACEN")
                <div class="form-group col-lg-4 col-sm-12 mb-8">
                    <label >NOMBRE DEL VENDEDOR **</label>
                    <input wire:model.lazy="vendedor" type="text" class="form-control"  placeholder="NOMBRE DEL VENDEDOR">
                    @error('vendedor') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="form-group col-lg-4 col-md-4 col-sm-12">
                    <label >DOCUMENTO**</label>
                    <input type="file" accept="application/pdf" wire:model="archivo" class="form-control text-center" >
                    @error('archivo') <span class="error">{{ $message }}</span> @enderror
                </div>
                @elseif(Auth::user()->role == "TECNICO")
                <div class="form-group col-lg-4 col-sm-12 mb-8">
                    <label >NOMBRE DEL TÉCNICO **</label>
                    <select wire:model.lazy="tecnico" class="form-control text-center">
                        <option value="Elegir" disabled="">Elegir</option>
                        @foreach ($tecnicos as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    @error('tecnico') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="form-group col-lg-4 col-sm-12 mb-8">
                    <label >NOMBRE DEL VENDEDOR **</label>
                    <input wire:model.lazy="vendedor" type="text" class="form-control"  placeholder="NOMBRE DEL VENDEDOR">
                    @error('vendedor') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="form-group col-lg-4 col-sm-12 mb-8">
                    <label >INGRESE NÚMERO PROFORMA **</label>
                    <input wire:model.lazy="num_proforma" type="text" class="form-control"  placeholder="NÚMERO PROFORMA">
                    @error('num_proforma') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                @endif
            </div>
            <!--botones guardar/regresar-->
            <div class="row ">
                <div class="col-lg-5 mt-2  text-left">
                    <button type="button" wire:click="doAction(1)" class="btn btn-dark mr-1">
                        <i class="mbri-left"></i> Regresar
                    </button>
                    <button type="button"
                        wire:click="StoreOrUpdate() "
                        class="btn btn-primary ml-2">
                        <i class="mbri-success"></i> Guardar
                    </button>
                </div>
            </div>

        </form>
    </div>
</div>
