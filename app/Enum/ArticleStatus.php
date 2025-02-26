<?php

namespace App\Enum;

enum ArticleStatus:string
{
    case DRAFT = 'draft';
    case PENDING = 'pending';
    case PUBLISHED = 'published';
    case ARCHIVED = 'archived';
}
