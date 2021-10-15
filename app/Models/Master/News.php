<?php

namespace App\Models\Master;

use App\Models\BaseModel;
use App\Traits\HasImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends BaseModel
{
    use HasFactory, HasImage;
}
