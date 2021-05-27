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

    public function StoreOrUpdate(){

        $this->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'role' => 'required',
            'role' => 'not_in:Elegir',
            'password' => 'required',
        ]);

        if($this->selected_id <= 0){
            $user = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'role' => $this->role,
                'password' => bcrypt($this->password),
            ]);

            $this->emit('msgok', 'Registrado con éxito');
        }else{

        }

        $this->resetInput();
    }
}
