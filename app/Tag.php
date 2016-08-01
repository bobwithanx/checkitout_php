<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
	
    /**
     * Gets the students associated with the given tag.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */

	public function students()
	{
		return $this->belongsToMany('App\Student');
	}

}
