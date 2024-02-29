<?php

namespace App\Enums;

class DispatchReasonEnum
{
    public const tamanho_da_bagagem = 1;
    public const  peso_da_bagagem = 2;
    public const compartimentos_lotados_na_area_de_passageiros = 3;
    public const objeto_proibido_para_transporte_no_comportimento_da_area_de_passageiros = 4;

    public static function toArray(): array
    {
        return [
            self::tamanho_da_bagagem,
            self::peso_da_bagagem,
            self::compartimentos_lotados_na_area_de_passageiros,
            self::objeto_proibido_para_transporte_no_comportimento_da_area_de_passageiros,
        ];
    }
}