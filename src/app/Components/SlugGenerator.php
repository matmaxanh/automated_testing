<?php


namespace App\Components;


use App\Entities\Models\Post;
use Carbon\Carbon;

class SlugGenerator
{
    /**
     * Generate slug from post title with current timestamp
     *
     * @param Post $post
     *
     * @return string
     */
    public function generate(Post $post)
    {
        $title = $post->title;

        // Replace non letter or digits by -
        $title = preg_replace('~[^\pL\d]+~u', '-', $title);

        // Transliterate
        $title = iconv('utf-8', 'us-ascii//TRANSLIT', $title);

        // Remove unwanted characters
        $title = preg_replace('~[^-\w]+~', '', $title);

        // Trim
        $title = trim($title, '-');

        // Remove duplicate -
        $title = preg_replace('~-+~', '-', $title);

        // Lowercase
        $title = strtolower($title);

        if (empty($title)) {
            return 'n-a';
        }

        return $title . '-' . Carbon::now()->timestamp;
    }
}