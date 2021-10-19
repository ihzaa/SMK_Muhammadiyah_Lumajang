<?php

namespace App\Models\Master;

use App\Models\BaseModel;
use App\Traits\CanGenerateUrlFromColumn;
use App\Traits\RemoveSpecialCharacter;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Announcement extends BaseModel
{
    use HasFactory, CanGenerateUrlFromColumn;
}
