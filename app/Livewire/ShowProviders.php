<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use App\Models\Provider;
use App\Models\Answer;
use App\Models\User;
use App\Models\Geolocation;
use App\Models\Country_code;
use Illuminate\Support\Facades\Storage;

class ShowProviders extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $search;
    public $sort = "created_at";
    public $direction = 'desc';
    public $providerId;
    public $textAlert;

    public $openInfo = false, $openEdit = false, $openCreate = false, $openDelete = false, $openAlertSuccess = false, $openAlertError = false;

    //datos para openModalInf
    public $nitInf, $nombreInf, $razonInf, $paisInf, $departamentoInf, $municipioInf, $direccionInf, $celInf, $telInf, $representanteInf, $contactoInf, $emailInf, $email2Inf, $rutInf, $camInf, $preferenciaMarcasInf = [], $preferenciaCategoriaInf = [], $estadoInf;

    #[On('refresh')]
    public function render()
    {
        // Lista de codigos celulares
        $codigos = Country_code::all();

        $proveedor = Provider::where('nit_empresa', 'like', '%' . $this->search . '%')
            ->orWhere('razon_social', 'like', '%' . $this->search . '%')
            ->orWhere('pais', 'like', '%' . $this->search . '%')
            ->orWhere('departamento', 'like', '%' . $this->search . '%')
            ->orWhere('municipio', 'like', '%' . $this->search . '%')
            ->orWhere('direccion', 'like', '%' . $this->search . '%')
            ->orWhere('celular', 'like', '%' . $this->search . '%')
            ->orWhere('telefono', 'like', '%' . $this->search . '%')
            ->orWhere('representante_legal', 'like', '%' . $this->search . '%')
            ->orWhere('contacto_principal', 'like', '%' . $this->search . '%')
            ->orWhere('email', 'like', '%' . $this->search . '%')
            ->orWhere('email_secundario', 'like', '%' . $this->search . '%')
            ->orWhere('marcas_preferencias', 'like', '%' . $this->search . '%')
            ->orWhere('especialidad', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate(15);

        $proveedores = Provider::all();
        $preferencias_de_marcas = [];

        foreach ($proveedores as $proveedor_m) {
            if (is_string($proveedor_m->marcas_preferencias)) {
                // Decodificar la cadena JSON y almacenar las preferencias de marcas en un array asociativo
                $preferencias_de_marcas[$proveedor_m->id] = json_decode($proveedor_m->marcas_preferencias, true);
            }
        }

        // Lista de departamentos
        $departamentos = Geolocation::distinct()->pluck('departamento');

        // Lista de municipios
        $group = [];

        foreach ($departamentos as $departamento) {
            $municipios = Geolocation::where('departamento', $departamento)->pluck('municipio');
            $group[$departamento] = $municipios;
        }

        return view('livewire.show-providers', compact('proveedor', 'proveedor_m', 'preferencias_de_marcas', 'departamentos', 'group', 'codigos'));
    }

    public function order($sort)
    {
        if ($this->sort == $sort) {
            if ($this->direction == 'desc') {
                $this->direction = 'asc';
            } else {
                $this->direction = 'desc';
            }
        } else {
            $this->sort = $sort;
            $this->direction = 'asc';
        }
    }

    // Abrir y cerrar modales
    public function openModalCreate(){
        $this->openCreate = true;
    }

    public function closeModalCreate()
    {
        $this->openCreate = false;
    }

    public function openModalInf($providerId)
    {
        $this->providerId = $providerId;
        $this->openInfo = true;

        $proveedor = Provider::find($providerId);

        $this->nitInf = $proveedor->nit_empresa;
        $this->nombreInf = $proveedor->nombre_comercial;
        $this->razonInf = $proveedor->razon_social;
        $this->paisInf = $proveedor->pais;
        $this->departamentoInf = $proveedor->departamento;
        $this->municipioInf = $proveedor->municipio;
        $this->direccionInf = $proveedor->direccion;
        $this->celInf = $proveedor->celular;
        $this->telInf = $proveedor->telefono;
        $this->representanteInf = $proveedor->representante_legal;
        $this->contactoInf = $proveedor->contacto_principal;
        $this->emailInf = $proveedor->email;
        $this->email2Inf = $proveedor->email_secundario;
        $this->rutInf = $proveedor->rut;
        $this->camInf = $proveedor->camara_comercio;
        $this->estadoInf = $proveedor->estado;

        $marcas = json_decode($proveedor->marcas_preferencias, true);
        if ($marcas) {
            for ($i = 0; $i < count($marcas); $i++) {
                $this->preferenciaMarcasInf[] = $marcas[$i];
            }
        } else {
            $this->preferenciaMarcasInf[] = 'No hay preferencias de marcas para este proveedor.';
        }


        $categorias = json_decode($proveedor->especialidad, true);
        if ($categorias) {
            for ($i = 0; $i < count($categorias); $i++) {
                $this->preferenciaCategoriaInf[] = $categorias[$i];
            }
        } else {
            $this->preferenciaCategoriaInf[] = 'No hay especialidades para este proveedor.';
        }
    }

    public function openModalEdit(){
        $this->openEdit = true;
    }

    public function closeModalEdit(){
        $this->openEdit = false;
    }

    public function openModalDelete(){
        $this->openDelete = true;
    }

    public function closeModalDelete(){
        $this->openDelete = false;
    }

    public function closeModalInf()
    {
        $this->openInfo = false;
    }

    public function closeAlert(){
        $this->openAlertError = false;
        $this->openAlertSuccess = false;
    }

    //Actualizar proveedor
    public function update(){

    }

    //Eliminar Proveedor
    public function delete(){

        $proveedor = Provider::find($this->providerId);
        $answers = Answer::where('idProveedor', $this->providerId)->get();

        if ($proveedor) {

            // Obtener la ruta de los archivos asociados al proveedor
            $rutaArchivoRut = $proveedor->rut;
            $rutaArchivoCam = $proveedor->camara_comercio;

            $users = $proveedor->user;

            try{
                 if ($users) {
                    foreach ($users as $user) {
                        $user->delete();
                    }
                }

                if($answers){
                    foreach ($answers as $answer) {
                        $answer->delete();
                    }
                }

                // Eliminar el proveedor
                $proveedor->delete();

                // Eliminar los archivos asociados al proveedor desde el storage
                if ($rutaArchivoRut and $rutaArchivoCam) {
                    Storage::delete('uploads/' . $rutaArchivoRut);
                    Storage::delete('uploads/' . $rutaArchivoCam);
                }

                $this->openInfo = false; $this->openEdit = false; $this->openCreate = false; $this->openDelete = false; $this->openAlertSuccess = true;
                $this->textAlert = 'Proveedor eliminado exitosamente';
            }catch(\exception $e){
                $this->openAlertError = true;
                $this->textAlert = 'No se pudo encontrar al proveedor o ya ha sido eliminado. Detalles: ' . $e;
            }

        }
    }
}
