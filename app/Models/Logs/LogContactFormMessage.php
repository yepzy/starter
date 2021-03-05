<?php

namespace App\Models\Logs;

use Illuminate\Database\Eloquent\Model;

class LogContactFormMessage extends Model
{
    /** @var string*/
    protected $table = 'log_contact_form_messages';

    /** @var array */
    protected $fillable = ['data'];

    /** @var array */
    protected $casts = ['data' => 'array'];
}
