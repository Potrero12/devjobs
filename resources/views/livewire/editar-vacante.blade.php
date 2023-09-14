<form class="md:w-1/2 space-y-5" wire:submit.prevent='editarVacante'>
    <div>
        <x-input-label for="titulo" :value="__('Titulo Vacante')" />
        <x-text-input 
            id="titulo"
            class="block mt-1 w-full"
            type="text"
            wire:model="titulo"
            placeholder="Titulo Vacante"
        />
        @error('titulo')
            <livewire:mostrar-alerta :message="$message"/>
        @enderror
    </div>

    <div>
        <x-input-label for="salario" :value="__('Salario Mensual')" />
        <select
        id="salario"
        wire:model="salario"
        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
    >
        <option value="">--Selecciona Rango Salarial--</option>
        @foreach ($salarios as $salario)
            <option value="{{ $salario->id }}">{{ $salario->salario }}</option>
        @endforeach
    </select>
        @error('salario')
            <livewire:mostrar-alerta :message="$message"/>
        @enderror
    </div>

    <div>
        <x-input-label for="categoria" :value="__('Categoria')" />
        <select
        id="categoria"
        wire:model="categoria"
        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
    >
        <option value="">--Seleccione una Categoria--</option>
        @foreach ($categorias as $categoria)
            <option value="{{ $categoria->id }}">{{ $categoria->categoria }}</option>
        @endforeach
    </select>
        @error('categoria')
            <livewire:mostrar-alerta :message="$message"/>
        @enderror
    </div>

    <div>
        <x-input-label for="empresa" :value="__('Empresa')" />
        <x-text-input 
            id="empresa"
            class="block mt-1 w-full"
            type="text"
            wire:model="empresa"
            placeholder="Empresa: ej. Netflix, Uber, Shopify"
        />
        @error('empresa')
            <livewire:mostrar-alerta :message="$message"/>
        @enderror
    </div>

    <div>
        <x-input-label for="ultimo_dia" :value="__('Ultimo Dia para Postularse')" />
        <x-text-input 
            id="ultimo_dia"
            class="block mt-1 w-full"
            type="date"
            wire:model="ultimo_dia"
        />
        @error('ultimo_dia')
            <livewire:mostrar-alerta :message="$message"/>
        @enderror
    </div>

    <div>
        <x-input-label for="descripcion" :value="__('Descripcion Puesto')" />
        <textarea 
            id="descripcion"
            class="block mt-1 w-full"
            wire:model="descripcion"
            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full h-72"
            placeholder="Descripcion Generarl Del puesto, experiencia"
        ></textarea>
        @error('descripcion')
            <livewire:mostrar-alerta :message="$message"/>
        @enderror
    </div>

    <div>
        <x-input-label for="imagen" :value="__('Imagen')" />
        <x-text-input 
            id="imagen"
            class="block mt-1 w-full"
            type="file"
            wire:model="imagenNueva"
            accept="image/*"
        />

        <div class="my-5 w-80">
            <x-input-label :value="__('Imagen Actual')" />
            <img src="{{ asset('storage/vacantes/' . $imagen) }}" alt="{{'Imagen Vacante ' . $titulo}}" />
        </div>

        <div class="my-5 w-80">
            @if ($imagenNueva)
                Imagen Nueva:
                <img src="{{ $imagenNueva->temporaryUrl() }}" />
            @endif
        </div>

        @error('imagenNueva')
            <livewire:mostrar-alerta :message="$message"/>
        @enderror

    </div>

    <x-primary-button class="w-full justify-center">
        {{ __('Guardar Cambios') }}
    </x-primary-button>
</form>