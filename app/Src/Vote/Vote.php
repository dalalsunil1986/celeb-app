<?php namespace App\Src\Vote;

use App\Core\BaseModel;
use Carbon\Carbon;

class Vote extends BaseModel
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'votes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public function celebrity()
    {
        return $this->belongsTo('App\Src\Celebrity\Celebrity');
    }

}
