<div class="widget-content-area ">
    <div class="widget-one">
        <form>
            <h3 class="text-center">Crear/Editar Registros</h3>
            <!--formulario-->
            <div class="row">
                <div class="form-group col-lg-4 col-sm-12 mb-8">
                    <label >Nombre **</label>
                    <input wire:model.lazy="name" type="text" class="form-control"  placeholder="Nombre">
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="form-group col-lg-4 col-sm-12 mb-8">
                    <label >Email **</label>
                    <input wire:model.lazy="email" type="email" class="form-control"  placeholder="Email">
                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="form-group col-lg-4 col-sm-12 mb-8">
                    <label >Role **</label>
                    <select wire:model.lazy="role" class="form-control text-center">
                        <option value="Elegir" disabled="">Elegir</option>
                        <option value="TECNICO">TECNICO</option>
                        <option value="ALMACEN">ALMACEN</option>
                        <option value="ADMIN">ADMIN</option>
                    </select>
                    @error('role') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="form-group col-lg-8 col-sm-12 mb-8">
                    <label >Contraseña **</label>
                    <input wire:model.lazy="password" type="text" class="form-control"  placeholder="Contraseña">
                    @error('password') <span class="text-danger">{{ $message }}</span> @enderror
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
