<div class="widget-content-area ">
    <div class="widget-one">
        <form>
            <h3 class="text-center">Crear/Editar Registros</h3>
            <!--formulario-->
            <div class="row">
                @if(Auth::user()->role == "ADMIN")
                <div class="form-group col-lg-4 col-sm-12 mb-8">
                    <label >INGRESE DNI DEL CLIENTE **</label>
                    <input wire:model.lazy="dni" id="dni" type="text" class="form-control"  placeholder="DNI">
                    @error('dni') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="form-group col-lg-4 col-sm-12 mb-8">
                    <label >INGRESE NOMBRE DEL CLIENTE **</label>
                    <input wire:model.lazy="nombre" type="text" class="form-control"  placeholder="NOMBRE">
                    @error('nombre') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="form-group col-lg-4 col-sm-12 mb-8">
                    <label >INGRESE CELULAR DEL CLIENTE **</label>
                    <input wire:model.lazy="celular" type="text" class="form-control"  placeholder="CELULAR">
                    @error('celular') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

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
                    <label >INGRESE PROBLEMA QUE REPRESENTA **</label>
                    <textarea wire:model.lazy="problema" class="form-control" rows="5"></textarea>
                    @error('problema') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="form-group col-lg-4 col-sm-12 mb-8">
                    <label >QUE DISPOSITIVOS DEJO PARA SU SERVICIO **</label>
                    <textarea wire:model.lazy="observacion" class="form-control" rows="5"></textarea>
                    @error('observacion') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="form-group col-lg-4 col-md-4 col-sm-12">
                    <label >BOLETA /FACTURA **</label>
                    <input type="file" accept="application/pdf" wire:model="archivo" class="form-control text-center" >
                    @error('archivo') <span class="error">{{ $message }}</span> @enderror
                </div>
                @elseif(Auth::user()->role == "ALMACEN")
                <div class="form-group col-lg-4 col-sm-12 mb-8">
                    <label >INGRESE DNI DEL CLIENTE **</label>
                    <input wire:model.lazy="dni" id="dni" type="text" class="form-control"  placeholder="DNI">
                    @error('dni') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="form-group col-lg-4 col-sm-12 mb-8">
                    <label >INGRESE NOMBRE DEL CLIENTE **</label>
                    <input wire:model.lazy="nombre" type="text" class="form-control"  placeholder="NOMBRE">
                    @error('nombre') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="form-group col-lg-4 col-sm-12 mb-8">
                    <label >INGRESE CELULAR DEL CLIENTE **</label>
                    <input wire:model.lazy="celular" type="text" class="form-control"  placeholder="CELULAR">
                    @error('celular') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="form-group col-lg-4 col-md-4 col-sm-12">
                    <label >BOLETA /FACTURA **</label>
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
                    <label >INGRESE PROBLEMA QUE REPRESENTA **</label>
                    <textarea wire:model.lazy="problema" class="form-control" rows="5"></textarea>
                    @error('problema') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="form-group col-lg-4 col-sm-12 mb-8">
                    <label >QUE DISPOSITIVOS DEJO PARA SU SERVICIO **</label>
                    <textarea wire:model.lazy="observacion" class="form-control" rows="5"></textarea>
                    @error('observacion') <span class="text-danger">{{ $message }}</span> @enderror
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

<script type="text/javascript">

    $('#dni').keyup(function(e) {
        if(e.keyCode==13){
            const url = `https://dniruc.apisperu.com/api/v1/dni/${ $("#dni").val() }?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6Im5haW4uYWNlcm8zMEBnbWFpbC5jb20ifQ.ZSQAFo5kOHS88zE_m9vAnO8VjHBqRrsKGcGqmIoioWs`;
            $.getJSON(url, onPersonLoaded);
        }
    });

    function onPersonLoaded(data) {
        if(data.dni != null && data.nombres != null){
            @this.set('nombre', data.apellidoPaterno + ' ' + data.apellidoMaterno + ',' +data.nombres);
            toastr.success(data.nombres, 'Usuario Encontrado')
            window.livewire.emit('updateDatos', data);
        }
    }
</script>
