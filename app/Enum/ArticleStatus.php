<?php

namespace App\Enum;

enum ArticleStatus:string
{
    case DRAFT = 'draft';
    case PENDING = 'pending';
    case PUBLISHED = 'published';
    case ARCHIVED = 'archived';

    public static function all(): array
    {
        return [
            self::PUBLISHED->value,
            self::DRAFT->value,
            self::PENDING->value,
            self::ARCHIVED->value
        ];
    }
}
