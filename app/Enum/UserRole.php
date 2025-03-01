<?php

namespace App\Enum;

enum UserRole:string
{
    case AUTHOR = 'author';
    case READER = 'reader';
    case ADMIN = 'admin';


    public static function all(): array
    {
        return [
            self::READER->value,
            self::AUTHOR->value,
            self::ADMIN->value,
        ];
    }
}
