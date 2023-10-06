<?php


namespace Temir8173\Sanitizer;


enum DataTypesList: string
{
    case STRING = 'string';
    case INTEGER = 'integer';
    case FLOAT = 'float';
    case PHONE = 'phone';
    case ARRAY = 'array';
    case STRUCTURE = 'structure';

}
