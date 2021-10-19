<?php

namespace App\Models\Master;

use App\Models\BaseModel;
use App\Traits\CanGenerateUrlFromColumn;
use App\Traits\HasImage;
use App\Traits\RemoveSpecialCharacter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends BaseModel
{
    use HasFactory, HasImage, CanGenerateUrlFromColumn;
}
