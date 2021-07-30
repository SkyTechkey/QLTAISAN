<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Content extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'contents';
    // const STATUS_DRAFT = 'draft';
    // const STATUS_UNPUBLISHED = 'unpublished';
    // const STATUS_PUBLISHED = 'published';

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function department()
    {
        return $this->belongsTo('App\Models\Department');
    }
    public function detail_content()
    {
        return $this->belongsToMany(ContentDetail::class, 'content_details');
    }
}
