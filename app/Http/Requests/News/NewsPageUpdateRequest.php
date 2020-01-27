<?php

namespace App\Http\Requests\News;

use App\Http\Requests\Request;
use App\Services\Seo\SeoService;

class NewsPageUpdateRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return (new SeoService)->getSeoMetaRules();
    }
}
