<?php

namespace App\Services\Utils;

use Illuminate\Support\Str;
use SEO;

class SeoService implements SeoServiceInterface
{
    /**
     * Set the page SEO meta.
     *
     * @param string $metaTitle
     * @param string $metaDescription
     * @param array $metaKeywords
     * @param string|null $imageUrl
     * @param string|null $openGraphType
     *
     * @return void
     */
    public function seoMeta(
        string $metaTitle = null,
        string $metaDescription = null,
        array $metaKeywords = [],
        string $imageUrl = null,
        string $openGraphType = null
    ): void {
        // meta
        if ($metaTitle) {
            SEO::metatags()->setTitle($metaTitle);
        }
        if ($metaDescription) {
            SEO::metatags()->setDescription(Str::limit($metaDescription, 200));
        }
        if (! empty($metaKeywords)) {
            SEO::metatags()->addKeyword($metaKeywords);
        }
        // facebook
        SEO::opengraph()->setTitle($metaTitle);
        if ($metaDescription) {
            SEO::opengraph()->setDescription(Str::limit($metaDescription, 200));
        }
        if ($openGraphType) {
            SEO::opengraph()->addProperty('type', $openGraphType);
        }
        if ($imageUrl) {
            SEO::opengraph()->addImage($imageUrl);
        }
        // twitter
        if ($imageUrl) {
            SEO::twitter()->addImage($imageUrl);
        }
    }
}
