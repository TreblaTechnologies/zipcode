<?php

namespace Trebla\ZipCode\Helpers;

abstract class ClientHelper
{
    /**
     * Client types
     * @var string 
     */
    public const PAGAR_ME = "PAGAR_ME";
    public const VIA_CEP = "VIA_CEP";
    public const CORREIOS = "CORREIOS";
    public const REPUBLICA_VIRTUAL = "REPUBLICA_VIRTUAL";
}
