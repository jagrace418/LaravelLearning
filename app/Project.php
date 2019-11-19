<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //stops MassAssignmentException
    protected $guarded = [];

    public function path(){
        return "/projects/{$this->id}";
    }

}
