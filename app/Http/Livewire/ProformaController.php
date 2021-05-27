<?php

namespace App\Http\Livewire;

use App\Models\Garantia;
use App\Models\Proforma;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Webpatser\Uuid\Uuid;

class ProformaController extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $num_proforma, $hora_ingreso, $observacion, $archivo, $tecnico = 'Elegir', $vendedor = '';
    public $selected_id, $search, $event;
    public $action = 1, $pagination = 20;

    public function mount() {
        $this->event = false;
    }

    public function render()
    {
        $tecnicos = User::where('role', '=', 'TECNICO')->get();
        $vendedores = User::where('role', '=', 'ALMACEN')->get();

        if(strlen($this->search) > 0){
            $proformas = Proforma::where('num_proforma', 'like', '%'.$this->search.'%')
                ->paginate($this->pagination);

            return view('livewire.proforma.component', [
                "info" => $proformas,
                "tecnicos" => $tecnicos,
                "vendedores" => $vendedores,
            ]);
        }else{
            $proformas = Proforma::orderBy('id', 'desc')
                ->paginate($this->pagination);

            return view('livewire.proforma.component', [
                "info" => $proformas,
                "tecnicos" => $tecnicos,
                "vendedores" => $vendedores,
            ]);
        }
    }

    // Paginación
    public function updatingSearch(): void{
        $this->gotoPage(1);
    }

    public function doAction($action){
        $this->resetInput();
        $this->action = $action;
    }

    public function edit($id){
        $record = Proforma::findOrFail($id);
        $this->selected_id = $id;
        $this->num_proforma = $record->num_proforma;
        $this->hora_ingreso = $record->hora_ingreso;
        $this->observacion = $record->observacion;
        $this->vendedor = $record->nombre_vendedor;
        $this->action = 2;
        $this->event = false;
    }

    public function resetInput(){
        $this->fecha_ingreso = null;
        $this->tecnico = 'Elegir';
        $this->vendedor = '';
        $this->num_proforma = '';
        $this->hora_ingreso = null;
        $this->selected_id = null;
        $this->action = 1;
        $this->search = '';
        $this->archivo = null;
        $this->event = false;
    }

    public function StoreOrUpdate(){

        $this->validate([
            'vendedor' => 'required',
            'vendedor' => 'not_in:Elegir',
            'archivo' => 'max:1024', // 1MB Max
        ]);

        $this->fecha_ingreso = \Carbon\Carbon::now();
        $uuid = Uuid::generate()->string;

        if($this->selected_id <= 0){
            $proforma = Proforma::create([
                "num_proforma" => $this->num_proforma ?? $this->getCode($this->num_proforma, $this->fecha_ingreso->format('m')),
                "hora_ingreso" => $this->fecha_ingreso->format('h:i:s'),
                'documento' => ($this->archivo == null)? null :  $uuid . '.pdf',
                "tecnico_id" => ($this->tecnico == "Elegir")? null : $this->tecnico,
                "nombre_vendedor" => $this->vendedor,
            ]);

            if($this->archivo != null){
                $this->archivo->storeAs('public', $uuid . '.pdf');
            }

            event(new \App\Events\EventNew("new-registro"));

            $this->emit('msgok', 'Registrado con éxito');
        }else{
            $record = Proforma::find($this->selected_id);
            $record->update([
                "num_proforma" => $this->num_proforma ?? $this->getCode($this->num_proforma, $this->fecha_ingreso->format('m')),
                "hora_ingreso" => $this->fecha_ingreso->format('h:i:s'),
                'documento' => ($this->archivo == null)? null :  $uuid . '.pdf',
                "tecnico_id" => ($this->tecnico == "Elegir")? null : $this->tecnico,
                "nombre_vendedor" => $this->vendedor,
            ]);
            if($this->archivo != null){
                $this->archivo->storeAs('public', $uuid . '.pdf');
            }
            $this->emit('msgok', 'Actualizado con éxito');
        }

        $this->resetInput();
    }

    private function getCode($code, $mes) {
        // PRO-05-00001
        if(floor($code / 10000) > 0 ) {
            return 'PRO-'.$mes.'-' . $code;
        } else if(floor($code / 1000) > 0){
            return 'PRO-'.$mes.'-0' . $code;
        } else if(floor($code / 100) > 0){
            return 'PRO-'.$mes.'-00' . $code;
        } else if(floor($code / 10) > 0){
            return 'PRO-'.$mes.'-000' . $code;
        } else if($code > 0){
            return 'PRO-'.$mes.'-0000' . $code;
        } else{
            return 'SIN-CODE';
        }
    }

    protected $listeners = [
        'finish'     => 'finish',
        'deleteRow'     => 'destroy',
    ];

    public function finish(int $id){
        $record = Proforma::findOrFail($id);
        $record->salio = 1;
        $record->save();
        event(new \App\Events\EventNew("notification"));
    }

    public function destroy(int $id){
        try {
            $record = Proforma::findOrFail($id);
            $record->delete();
            $this->resetInput();
            $this->emit('msgok', 'Registro eliminado con éxito');
        } catch (\Exception $exception) {
            dd($exception);
        }
    }
}
