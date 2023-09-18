<?php

namespace App\Livewire;

use App\Models\Vacante;
use App\Notifications\NuevoCandidato;
use Livewire\Component;
use Livewire\WithFileUploads;

class PostularVacante extends Component
{

    public $cv;
    public $vacante;

    use WithFileUploads;

    protected $rules = [
        'cv' => ['required', 'mimes:pdf']
    ];

    public function render()
    {
        return view('livewire.postular-vacante');
    }

    public function mount(Vacante $vacante)
    {
        $this->vacante = $vacante;
    }

    public function postularme()
    {   
        // validar campos
        $datos = $this->validate();

        // almacenar el cv
        $cv = $this->cv->store('public/cv');
        $datos['cv'] = str_replace('public/cv/', '', $cv);

        // crear la postulacion
        $this->vacante->candidatos()->create([
            'user_id' => auth()->user()->id,
            'cv' => $datos['cv'],
        ]);

        // crear la notificacion y enviar email -- no funciona por el internet revisar mas adelante
        // $this->vacante->reclutador->notify(new NuevoCandidato($this->vacante->id, $this->vacante->titulo, auth()->user()->id));

        // mostrar el usuario el mensaje de ok
        session()->flash('mensaje', 'Se envio correctamente tu información, mucha suerte');

        return redirect()->back();


    }
}
