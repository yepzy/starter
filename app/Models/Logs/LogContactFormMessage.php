<?php

namespace App\Models\Logs;

use Illuminate\Database\Eloquent\Model;

class LogContactFormMessage extends Model
{
    /** @var string $table */
    protected $table = 'log_contact_form_messages';

    /** @var array $fillable */
    protected $fillable = ['data'];

    /** @var array $cast */
    protected $casts = ['data' => 'array'];
}
