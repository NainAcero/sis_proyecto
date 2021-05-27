<?php

namespace App\Http\Livewire;

use App\Models\Garantia;
use App\Models\Proforma;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Webpatser\Uuid\Uuid;

class GarantiaController extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $dni, $nombre, $celular, $fecha_ingreso, $problema, $tecnico = 'Elegir', $hora_ingreso, $observacion, $archivo;
    public $selected_id, $search, $event;
    public $action = 1, $pagination = 20;

    public function mount() {
        $this->event = false;
    }

    public function render()
    {
        $tecnicos = User::where('role', '=', 'TECNICO')->get();
        if(strlen($this->search) > 0){
            $garantias = Garantia::where('nombre', 'like', '%'.$this->search.'%')
                ->orWhere('dni', 'like', '%'.$this->search.'%')
                ->paginate($this->pagination);

            return view('livewire.garantia.component', [
                "info" => $garantias,
                "tecnicos" => $tecnicos
            ]);
        }else{
            $garantias = Garantia::orderBy('id', 'desc')
                ->paginate($this->pagination);

            return view('livewire.garantia.component', [
                "info" => $garantias,
                "tecnicos" => $tecnicos
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
        $record = Garantia::findOrFail($id);
        $this->selected_id = $id;
        $this->dni = $record->dni;
        $this->nombre = $record->nombre;
        $this->celular = $record->celular;
        $this->fecha_ingreso = $record->fecha_ingreso;
        $this->problema = $record->problema;
        $this->observacion = $record->observacion;
        $this->tecnico = $record->tecnico_id;
        $this->dni = $record->dni;
        $this->action = 2;
        $this->event = false;
    }

    public function resetInput(){
        $this->dni = '';
        $this->nombre = '';
        $this->celular = '';
        $this->fecha_ingreso = null;
        $this->problema = '';
        $this->num_proforma = '';
        $this->hora_ingreso = null;
        $this->observacion = '';
        $this->selected_id = null;
        $this->action = 1;
        $this->search = '';
        $this->archivo = null;
        $this->tecnico = 'Elegir';
        $this->event = false;
    }

    public function StoreOrUpdate(){

        $this->validate([
            'archivo' => 'max:1024', // 1MB Max
        ]);

        $this->fecha_ingreso = \Carbon\Carbon::now();
        $uuid = Uuid::generate()->string;

        if($this->selected_id <= 0){
            $garantia = Garantia::create([
                'dni' => $this->dni,
                'nombre' => $this->nombre,
                'celular' => $this->celular,
                'problema' => $this->problema,
                'fecha_ingreso' => $this->fecha_ingreso,
                'observacion' => $this->observacion,
                'tecnico_id' => ($this->tecnico == "Elegir")? null : $this->tecnico,
                'documento' => $uuid . '.pdf',
            ]);

            if($this->archivo != null){
                $this->archivo->storeAs('public', $uuid . '.pdf');
            }

            event(new \App\Events\EventNew("new-registro"));
            $this->emit('msgok', 'Registrado con éxito');
        }else{
            $record = Garantia::find($this->selected_id);
            $record->update([
                'dni' => $this->dni,
                'nombre' => $this->nombre,
                'celular' => $this->celular,
                'problema' => $this->problema,
                'fecha_ingreso' => $this->fecha_ingreso,
                'observacion' => $this->observacion,
                'tecnico_id' => ($this->tecnico == "Elegir")? null : $this->tecnico,
                'documento' => $uuid . '.pdf',
            ]);
            if($this->archivo != null){
                $this->archivo->storeAs('public', $uuid . '.pdf');
            }
            $this->emit('msgok', 'Actualizado con éxito');
        }

        $this->resetInput();
    }

    private function getCode($code) {
        // PRO-05-00001
        if(floor($code / 10000) > 0 ) {
            return 'PRO-05-' . $code;
        } else if(floor($code / 1000) > 0){
            return 'PRO-05-0' . $code;
        } else if(floor($code / 100) > 0){
            return 'PRO-05-00' . $code;
        } else if(floor($code / 10) > 0){
            return 'PRO-05-000' . $code;
        } else if($code > 0){
            return 'PRO-05-0000' . $code;
        } else{
            return 'SIN-CODE';
        }
    }

    protected $listeners = [
        'finish'     => 'finish',
        'deleteRow'     => 'destroy',
    ];

    public function finish(int $id){
        $record = Garantia::findOrFail($id);
        $record->salio = 1;
        $record->save();
        event(new \App\Events\EventNew("notification"));
    }

    public function destroy(int $id){
        try {
            $record = Garantia::findOrFail($id);
            $record->delete();
            $this->resetInput();
            $this->emit('msgok', 'Registro eliminado con éxito');
        } catch (\Exception $exception) {
            dd($exception);
        }
    }
}
