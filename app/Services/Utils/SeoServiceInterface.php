<?php

namespace App\Services\Utils;

interface SeoServiceInterface
{
    /**
     * Set the page SEO meta
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
        string $metaTitle,
        string $metaDescription = null,
        array $metaKeywords = [],
        string $imageUrl = null,
        string $openGraphType = null
    ): void;
}
