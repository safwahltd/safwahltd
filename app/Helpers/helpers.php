<?php

use Illuminate\Support\Str;
use Cocur\Slugify\Slugify;
use voku\helper\ASCII;

if (!function_exists('createUniqueSlug')) {
    function createUniqueSlug($title, $model, $id = 0, $slugField = 'slug')
    {
        if (preg_match('/[\p{Bengali}]/u', $title)) {
            // Convert the Bangla title to ASCII characters (transliterate)
            $slug = Str::slug($title);
            $originalSlug = $slug;
            $count = 1;

            // Check for existing slugs in the database
            while ($model::where($slugField, $slug)
                ->where('id', '!=', $id) // Exclude current ID if updating
                ->exists()) {
                $slug = $originalSlug . '-' . $count;
                $count++;
            }
            return $slug;
        }
        else {
            $slug = Str::slug($title);
            $originalSlug = $slug;
            $count = 1;

            // Check for existing slugs in the database
            while ($model::where($slugField, $slug)
                ->where('id', '!=', $id) // Exclude current ID if updating
                ->exists()) {
                $slug = $originalSlug . '-' . $count;
                $count++;
            }
            return $slug;
        }
    }
}

