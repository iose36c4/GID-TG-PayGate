<?php

namespace App\Services;

class ArgentineTaxService
{
    public const TAXPAYER_TYPES = [
        'responsable_inscripto' => 'Responsable Inscripto',
        'monotributo' => 'Monotributo',
        'exento' => 'Exento',
        'consumidor_final' => 'Consumidor Final',
    ];

    public const PROVINCES = [
        'B' => 'Buenos Aires',
        'C' => 'Capital Federal',
        'D' => 'San Luis',
        'E' => 'Entre Ríos',
        'F' => 'La Rioja',
        'G' => 'Santiago del Estero',
        'H' => 'Chaco',
        'J' => 'San Juan',
        'K' => 'Catamarca',
        'L' => 'La Pampa',
        'M' => 'Mendoza',
        'N' => 'Misiones',
        'P' => 'Formosa',
        'Q' => 'Neuquén',
        'R' => 'Río Negro',
        'S' => 'Santa Fe',
        'T' => 'Tucumán',
        'U' => 'Chubut',
        'V' => 'Tierra del Fuego',
        'W' => 'Corrientes',
        'X' => 'Córdoba',
        'Y' => 'Jujuy',
        'Z' => 'Santa Cruz',
    ];

    public static function validateCuitCuil(string $cuit): bool
    {
        $cuit = preg_replace('/\D/', '', $cuit);

        if (strlen($cuit) !== 11) {
            return false;
        }

        if (! ctype_digit($cuit)) {
            return false;
        }

        $base = [5, 4, 3, 2, 7, 6, 5, 4, 3, 2];
        $sum = 0;

        for ($i = 0; $i < 10; $i++) {
            $sum += (int) $cuit[$i] * $base[$i];
        }

        $remainder = $sum % 11;
        $checkDigit = 11 - $remainder;

        if ($checkDigit === 11) {
            $checkDigit = 0;
        } elseif ($checkDigit === 10) {
            $checkDigit = 9;
        }

        return (int) $cuit[10] === $checkDigit;
    }

    public static function formatCuit(string $cuit): string
    {
        $cuit = preg_replace('/\D/', '', $cuit);

        if (strlen($cuit) === 11) {
            return substr($cuit, 0, 2).'-'.substr($cuit, 2, 8).'-'.substr($cuit, 10, 1);
        }

        return $cuit;
    }

    public static function getTaxpayerTypeLabel(string $type): string
    {
        return self::TAXPAYER_TYPES[$type] ?? $type;
    }

    public static function getProvinceName(string $code): string
    {
        return self::PROVINCES[strtoupper($code)] ?? $code;
    }
}
