<?php

namespace App\Enum;

enum UserRole:string
{
    case AUTHOR = 'author';
    case READER = 'reader';
    case ADMIN = 'admin';
}
