<div>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            @forelse ($vacantes as $vacante)
                
                <div class="p-6 bg-white border-b border-gray-200 md:flex md:justify-between md:items-center ">
                    <div class="space-y-3">
                        <a href="#" class="text-xl font-bold">
                            {{ $vacante->titulo }}
                        </a>
                        <p class="text-sx text-gray-600">{{ $vacante->empresa }}</p>
                        <p class="text-sm text-gray-500">Último día: {{ $vacante->ultimo_dia->format('d/m/Y') }}</p>
                    </div>
                    
                    <div class="flex flex-col md:flex-row items-stretch gap-3 mt-5 md:mt-0 text-center">
                        <a href="#" class="bg-slate-800 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase">
                            Candidatos
                        </a>
                        
                        <a href="{{ route('vacantes.edit', $vacante->id) }}" class="bg-blue-800 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase">
                            Editar
                        </a>
                        
                        <button wire:click="$dispatch('mostrarAlerta', {{ $vacante->id }})" class="bg-red-600 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase">
                            Eliminar
                        </button>
                    </div>
                </div>
            @empty
                <p class="p-3 text-center tex">No hay Vacantes para Mostrar</p>
            @endforelse   

    </div>
        
    <div class="mt-10">
        {{ $vacantes->links() }}
    </div>
</div>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('livewire:initialized', () => {

            Livewire.on('mostrarAlerta', (vacanteId) => {
                Swal.fire({
                title: '¿Eliminar Vacante?',
                text: "una vacante eliminada no se puede recuperar",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Eliminar!',
                cancelButtonText: 'Cancelar'
                }).then((result) => {
                if (result.isConfirmed) {
                    // eliminar la vacante desd el servidor
                    Livewire.dispatch('eliminarVacante', {vacante: vacanteId})
                    Swal.fire(
                    'Eliminado!',
                    'La vacante ha sido eliminada',
                    'success'
                    )
                }
                })
            })
        })
    </script>
@endpush