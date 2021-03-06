<?php

namespace Statamic\Tags;

use Statamic\Facades;
use Statamic\Facades\Site;

class Path extends Tags
{
    /**
     * Maps to the {{ path }} tag.
     *
     * @return string
     */
    public function index()
    {
        // If no src param was used, we will treat this as a regular `path` variable.
        if (! $src = $this->params->get(['src', 'to'])) {
            return $this->context->get('path');
        }

        $site = Site::current();

        $url = $this->params->bool('absolute', false)
            ? $site->absoluteUrl().'/'.$src
            : $site->relativePath($src);

        return Facades\Path::tidy($url);
    }
}
