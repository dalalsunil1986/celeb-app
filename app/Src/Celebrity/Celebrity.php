<?php namespace App\Src\Celebrity;

use App\Core\BaseModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Celebrity extends BaseModel
{

    protected $table = 'celebrities';

    protected $morphClass = 'Celebrity';

    protected $guarded = ['id'];

    public function votes()
    {
        return $this->hasMany('App\Src\Vote\Vote', 'celebrity_id');
    }

    public function photos()
    {
        return $this->morphMany('App\Src\Photo\Photo', 'imageable');
    }

    public function thumbnail()
    {
        return $this->morphOne('App\Src\Photo\Photo', 'imageable')->where('thumbnail', 1);
    }

    /**
     * @param int $paginate
     * @return mixed
     * Get The Votes That are
     */
    public function getRankings($paginate = 10)
    {

        // @todo: Debug the Query and Enhance it
        $lastFriday = new Carbon('last friday');

        $beforeLastFriday = new Carbon($lastFriday->subWeek());

        $lastFriday = $lastFriday->copy();

        return $this->selectRaw('celebrities.*, count(*) as `vote_count`')
            ->join('votes', 'celebrities.id', '=', 'votes.celebrity_id')
//            ->whereBetween('votes.created_at', [$lastFriday, $beforeLastFriday->addWeeks(1)])
            ->groupBy('celebrity_id')
            ->orderBy('vote_count', 'desc')
            ->paginate($paginate);
    }
//    public function getRankings($paginate = 10)
//    {
//
//        // @todo: Debug the Query and Enhance it
//        $lastFriday = new Carbon('last friday');
//
//        $beforeLastFriday = new Carbon($lastFriday->subWeek());
//
//        $lastFriday = $lastFriday->copy();
//
//        return $this->selectRaw('celebrities.*, count(*) as `vote_count`')
//            ->join('votes', 'celebrities.id', '=', 'votes.celebrity_id')
//            ->whereBetween('votes.created_at', [$lastFriday, $beforeLastFriday->addWeeks(1)])
//            ->groupBy('celebrity_id')
//            ->orderBy('vote_count', 'desc')
//            ->paginate($paginate);
//    }
}
