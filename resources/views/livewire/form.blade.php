<div class="widget-content-area ">
    <div class="widget-one">
        <form>
            <h3 class="text-center">Crear/Editar Registros</h3>
            <!--formulario-->
            <div class="row">

                <div class="form-group col-lg-4 col-sm-12 mb-8">
                    <label >INGRESE DNI **</label>
                    <input wire:model.lazy="dni" id="dni" type="text" class="form-control"  placeholder="DNI">
                    @error('dni') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="form-group col-lg-4 col-sm-12 mb-8">
                    <label >INGRESE NOMBRE **</label>
                    <input wire:model.lazy="nombre" type="text" class="form-control"  placeholder="NOMBRE">
                    @error('nombre') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="form-group col-lg-4 col-sm-12 mb-8">
                    <label >INGRESE CELULAR **</label>
                    <input wire:model.lazy="celular" type="text" class="form-control"  placeholder="CELULAR">
                    @error('celular') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="form-group col-lg-4 col-sm-12 mb-8">
                    <label >INGRESE NÚMERO PROFORMA **</label>
                    <input wire:model.lazy="num_proforma" type="text" class="form-control"  placeholder="NÚMERO PROFORMA">
                    @error('num_proforma') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="form-group col-lg-4 col-sm-12 mb-8">
                    <label >INGRESE PROBLEMA **</label>
                    <textarea wire:model.lazy="problema" class="form-control" rows="5"></textarea>
                    @error('problema') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="form-group col-lg-4 col-sm-12 mb-8">
                    <label >INGRESE OBSERVACIÓN **</label>
                    <textarea wire:model.lazy="observacion" class="form-control" rows="5"></textarea>
                    @error('observacion') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="form-group col-lg-4 col-md-4 col-sm-12">
                    <label >DOCUMENTO**</label>
                    <input type="file" wire:model="archivo" class="form-control text-center" >
                    @error('archivo') <span class="error">{{ $message }}</span> @enderror
                </div>
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
