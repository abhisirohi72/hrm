<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactUsHome extends Model
{
    protected $fillable = ['name', 'email', 'message', 'subject'];

    /**
     * Get the validation rules for the contact us form.
     *
     * @return array
     */
    public static function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:1000',
            'subject'   =>  'required',
        ];
    }
}
