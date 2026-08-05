@extends('layouts.dashboard')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-2xl">
    <div class="mb-8">
        <div class="flex items-center gap-4 mb-6">
            <div class="w-10 h-10 rounded-full bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center">
                <svg class="w-5 h-5 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </div>
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Paso 1 de 4</p>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Datos Personales y Fiscales</h1>
            </div>
        </div>

        <form action="{{ route('creador.onboarding.step1.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
                <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-white">Datos Personales</h3>
                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nombre Completo</label>
                        <input type="text" name="name" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white" value="{{ old('name', auth()->user()->name) }}" required>
                        @error('name')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
                <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-white">Configuración Fiscal (Argentina)</h3>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tipo de Contribuyente AFIP/ARCA</label>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        @foreach($taxpayerTypes as $key => $label)
                        <label class="relative cursor-pointer">
                            <input type="radio" name="taxpayer_type" value="{{ $key }}" class="sr-only peer" {{ old('taxpayer_type', auth()->user()->taxpayer_type) === $key ? 'checked' : '' }}>
                            <div class="p-4 border-2 rounded-xl text-center
                                peer-checked:border-primary-500 peer-checked:bg-primary-50 dark:peer-checked:bg-primary-900/20
                                border-gray-200 dark:border-gray-700 hover:border-primary-500/50 transition-colors">
                                <p class="font-semibold text-gray-900 dark:text-white">{{ $label }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                    {{ match($key)
                                        'responsable_inscripto' => 'Factura A/B, IVA, Ganancias'
                                        'monotributo' => 'Factura C, cuota fija mensual'
                                        'exento' => 'Factura E, sin IVA'
                                        'consumidor_final' => 'Factura B, sin obligaciones'
                                    }}
                                </p>
                            </div>
                        </label>
                        @endforeach
                    </div>
                    @error('taxpayer_type')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-6 grid md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">CUIT / CUIL</label>
                        <input type="text" name="cuit_cuil" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white" value="{{ old('cuit_cuil', auth()->user()->cuit_cuil) }}" maxlength="11" pattern="\d{11}" placeholder="20123456789" required>
                        @error('cuit_cuil')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Provincia</label>
                        <select name="tax_province" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white" required>
                            <option value="">Seleccionar</option>
                            @foreach($provinces as $code => $name)
                            <option value="{{ $code }}" {{ old('tax_province', auth()->user()->tax_province) === $code ? 'selected' : '' }}>
                                {{ $name }}
                            </option>
                            @endforeach
                        </select>
                        @error('tax_province')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Domicilio Fiscal Completo</label>
                        <textarea name="tax_address" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white" rows="2" required>{{ old('tax_address', auth()->user()->tax_address) }}</textarea>
                        @error('tax_address')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Ciudad</label>
                        <input type="text" name="tax_city" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white" value="{{ old('tax_city', auth()->user()->tax_city) }}" required>
                        @error('tax_city')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Código Postal</label>
                        <input type="text" name="tax_zip_code" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white" value="{{ old('tax_zip_code', auth()->user()->tax_zip_code) }}" maxlength="4" pattern="\d{4}" required>
                        @error('tax_zip_code')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-6 grid md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Número IIBB Provincial</label>
                        <input type="text" name="iibb_number" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white" value="{{ old('iibb_number', auth()->user()->iibb_number) }}" placeholder="Ej: 12345678-9">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Categoría Monotributo</label>
                        <select name="monotributo_category" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                            <option value="">No aplica / No es Monotributo</option>
                            @foreach(range('A', 'K') as $cat)
                            <option value="{{ $cat }}" {{ old('monotributo_category', auth()->user()->monotributo_category) === $cat ? 'selected' : '' }}>
                                Categoría {{ $cat }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex items-center gap-2">
                        <input type="checkbox" name="ganancias_exempt" class="w-4 h-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500" {{ old('ganancias_exempt', auth()->user()->ganancias_exempt) ? 'checked' : '' }}>
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Exento Ganancias (certificado)</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <input type="checkbox" name="iva_exempt" class="w-4 h-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500" {{ old('iva_exempt', auth()->user()->iva_exempt) ? 'checked' : '' }}>
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Exento IVA</span>
                    </div>
                </div>
            </div>

            <div class="flex justify-end gap-4 pt-6 border-t border-gray-200 dark:border-gray-700">
                <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white font-medium py-3 px-6 rounded-lg transition-colors inline-flex items-center gap-2">
                    Continuar al Paso 2
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection