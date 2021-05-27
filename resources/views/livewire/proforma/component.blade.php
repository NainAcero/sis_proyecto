<div class="row layout-top-spacing">
    <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
        @if($action == 1)
        <div class="widget-content-area br-4">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 text-center">
                        <h5><b>Proformas en el Sistema</b></h5>
                    </div>
                </div>
            </div>

            @include('common.search')

            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped table-checkable table-highlight-head mb-4">
                    <thead>
                        <tr>
                            <th class="">NÚMERO PROFORMA</th>
                            <th class="">HORA INGRESO</th>
                            <th class="">OBSERVACIÓN</th>
                            <th class="">SALIO</th>
                            <th class="text-center">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($info as $r)
                            <tr>
                                <td>{{$r->num_proforma}}</td>
                                <td>{{$r->hora_ingreso}}</td>
                                <td>{{$r->observacion}}</td>
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

    document.addEventListener('DOMContentLoaded', function () {
        window.livewire.on('fileChoosen', () => {
            console.log($(this))
            let inputField = document.getElementById('image')
            let file = inputField.files[0]
            let reader = new FileReader();
            reader.onloadend = () => {
                window.livewire.emit('fileUpload', reader.result)
            }
            reader.readAsDataURL(file);
        })
    })

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
            text: '¿SALIR PROFORMA?',
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
