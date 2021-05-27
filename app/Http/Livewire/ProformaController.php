<?php

namespace App\Http\Livewire;

use App\Models\Garantia;
use App\Models\Proforma;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ProformaController extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $dni, $nombre, $celular, $fecha_ingreso, $problema, $num_proforma, $hora_ingreso, $observacion, $archivo;
    public $selected_id, $search, $event;
    public $action = 1, $pagination = 30;

    public function mount() {
        $this->event = false;
    }

    public function render()
    {
        if(strlen($this->search) > 0){
            $proformas = Proforma::where('num_proforma', 'like', '%'.$this->search.'%')
                ->paginate($this->pagination);

            return view('livewire.proforma.component', [
                "info" => $proformas
            ]);
        }else{
            $proformas = Proforma::orderBy('id', 'desc')
                ->paginate($this->pagination);

            return view('livewire.proforma.component', [
                "info" => $proformas
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
        $this->event = false;
    }

    public function StoreOrUpdate(){

        $this->validate([
            'dni' => 'required',
            'nombre' => 'required',
            'celular' => 'required',
            'problema' => 'required',
            'archivo' => 'max:1024', // 1MB Max
        ]);

        $this->fecha_ingreso = \Carbon\Carbon::now();

        if($this->selected_id <= 0){
            $garantia = Garantia::create([
                'dni' => $this->dni,
                'nombre' => $this->nombre,
                'celular' => $this->celular,
                'problema' => $this->problema,
                'fecha_ingreso' => $this->fecha_ingreso,
            ]);

            $proforma = Proforma::create([
                "num_proforma" => $this->getCode($this->num_proforma),
                "hora_ingreso" => $this->fecha_ingreso->format('H:i:s'),
                "observacion" => $this->observacion,
            ]);

            if($this->archivo != null){
                $this->archivo->store('public');
            }

            event(new \App\Events\EventNew("new-registro"));

            $this->emit('msgok', 'Registrado con éxito');
        }else{

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
    ];

    public function finish(int $id){
        $record = Proforma::findOrFail($id);
        $record->salio = 1;
        $record->save();
        event(new \App\Events\EventNew("notification"));
    }
}
