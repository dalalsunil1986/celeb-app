<?php
namespace App\Src\Photo;

use App\Core\BaseModel;

class Photo extends BaseModel
{

    public static $name = 'photo';

    protected $guarded = ['id'];

    protected $hidden = [];

    protected $table = 'photos';

    protected $types = [
        'celebrity'    => 'App\Src\Celebrity\Celebrity',
    ];

    public function imageable()
    {
        return $this->morphTo();
    }

    public function getImageableTypeAttribute($type)
    {
        $type = strtolower($type);

        return array_get($this->types, $type, $type);
    }

}
