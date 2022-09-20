<?php
namespace Panda\connexion;

enum File
{
    case CONX;

    public function path(): string
    {
        return match ($this) {
            self::CONX => "/Library/conx2.php"
        };
    }
}
