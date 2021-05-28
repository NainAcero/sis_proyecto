<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class UserController extends Component
{
    use WithPagination;

    public $name, $email, $role = 'Elegir', $password;
    public $selected_id, $search, $event;
    public $action = 1, $pagination = 30;

    public function mount() {
        $this->event = false;
    }

    public function render()
    {
        if(Auth::user()->role != "ADMIN"){
            return view('livewire.user.not_found',);
        }
        if(strlen($this->search) > 0){
            $users = User::where('name', 'like', '%'.$this->search.'%')
                ->orWhere('email', 'like', '%'.$this->search.'%')
                ->paginate($this->pagination);

            return view('livewire.user.component', [
                "info" => $users,
            ]);
        }else{
            $users = User::orderBy('id', 'desc')
                ->paginate($this->pagination);

            return view('livewire.user.component', [
                "info" => $users,
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
        $this->name = '';
        $this->email = '';
        $this->role = 'Elegir';
        $this->password = '';
        $this->selected_id = null;
        $this->action = 1;
        $this->search = '';
        $this->event = false;
    }

    public function edit($id){
        $record = User::findOrFail($id);
        $this->selected_id = $id;
        $this->name = $record->name;
        $this->email = $record->email;
        $this->role = $record->role;
        $this->action = 2;
        $this->event = false;
    }

    public function StoreOrUpdate(){
        if($this->selected_id <= 0){
            $this->validate([
                'name' => 'required',
                'email' => 'required|unique:users',
                'role' => 'required',
                'role' => 'not_in:Elegir',
                'password' => 'required',
            ]);

            $user = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'role' => $this->role,
                'password' => bcrypt($this->password),
            ]);

            $this->emit('msgok', 'Registrado con éxito' . $this->role);
        }else{
            $this->validate([
                'name' => 'required',
                'email' => 'required',
                'role' => 'required',
                'role' => 'not_in:Elegir',
            ]);

            $record = User::find($this->selected_id);
            $record->name = $this->name;
            $record->email = $this->email;
            $record->role = $this->role;
            if(strlen($this->password) > 3){
                $record->password = bcrypt($this->password);
            }
            $record->save();
            $this->emit('msgok', 'Actualizado con éxito');
        }

        $this->resetInput();
    }

    protected $listeners = [
        'deleteRow'     => 'destroy',
    ];

    public function destroy(int $id){
        try {
            $record = User::findOrFail($id);
            $record->delete();
            $this->resetInput();
            $this->emit('msgok', 'Registro eliminado con éxito');
        } catch (\Exception $exception) {
            dd($exception);
        }
    }
}
