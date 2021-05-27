<div class="row layout-top-spacing">
    <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
        @if($action == 1)
        <div class="widget-content-area br-4">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 text-center">
                        <h5><b>Garantías en el Sistema</b></h5>
                    </div>
                </div>
            </div>

            @include('common.search')

            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped table-checkable table-highlight-head mb-4">
                    <thead>
                        <tr>
                            <th class="">DNI</th>
                            <th class="">NOMBRE</th>
                            <th class="">CELULAR</th>
                            <th class="">FECHA INGRESO</th>
                            <th class="">PROBLEMA</th>
                            <th class="">SALIO</th>
                            <th class="text-center">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($info as $r)
                            <tr>
                                <td>{{$r->dni}}</td>
                                <td>{{$r->nombre}}</td>
                                <td>{{$r->celular}}</td>
                                <td>{{$r->fecha_ingreso}}</td>
                                <td>{{$r->problema}}</td>
                                @if($r->salio == 1)
                                    <td class="text-left"><h7 class="text-info">Salio</h7><br></td>
                                @else
                                    <td class="text-left"><h7 class="text-danger">No Salio</h7><br></td>
                                @endif
                                <td class="text-center">
                                    @include('common.actions')
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$info->links()}}
            </div>
        </div>
        @elseif($action == 2)
            @include('livewire.form')
        @endif
    </div>
</div>

<script type="text/javascript">
    function Confirm (id) {
       let me = this
       swal({
            title: 'CONFIRMAR',
            text: '¿DESEAS ELIMINAR EL REGISTRO?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar',
            closeOnConfirm: false
        },
        function() {
            console.log('ID', id);
            window.livewire.emit('deleteRow', id)
            //toastr.success('info', 'Registro eliminado con éxito')
            swal.close()
        })
   }

   function Finish (id) {
       let me = this
       swal({
            title: 'CONFIRMAR',
            text: '¿SALIR GARANTÍA?',
            type: 'success',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar',
            closeOnConfirm: false
        },
        function() {
            console.log('ID', id);
            window.livewire.emit('finish', id)
            //toastr.success('info', 'Registro eliminado con éxito')
            swal.close()
        })
   }

</script>
