<?php

namespace Trebla\ZipCode\Helpers;

abstract class WebServiceHelper
{
    /**
     * Base urls
     * @var String
     */
    public const PAGAR_ME_ZIPCODES_BASE_URL = "https://api.pagar.me/1/zipcodes";
    public const VIA_CEP_BASE_URL = "https://viacep.com.br/ws/";
    public const REPUBLICA_VIRTUAL_CEP_BASE_URL = "http://cep.republicavirtual.com.br/web_cep.php?cep=";
}
