<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
	use HasDateTimeFormatter;
    use SoftDeletes;

    public function category()
    {
        return $this->belongsTo(Category::class, 'type', 'id')->withDefault();

    }

    public function adminUser()
    {
        return $this->belongsTo(AdminUser::class);

    }

}
