<?php

namespace App\Console\Commands\Seo;

use App\Console\Commands\CommandAbstract;
use Spatie\Sitemap\SitemapGenerator;

class GenerateSitemap extends CommandAbstract
{
    /** @var string $signature*/
    protected $signature = 'sitemap:generate';

    /** @var string $description*/
    protected $description = 'Generate the sitemap.';

    public function handle(): void
    {
        $this->log('Started sitemap automated generation...', 'title');
        SitemapGenerator::create(config('app.url'))->writeToFile(public_path('sitemap.xml'));
        $this->log('Finished sitemap automated generation.', 'success');
    }
}
