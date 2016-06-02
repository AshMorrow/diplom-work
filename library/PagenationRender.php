<?php
/**
 * Created by PhpStorm.
 * User: koragg
 * Date: 02.06.16
 * Time: 11:47
 */

namespace library;


class PagenationRender
{
    public static function render($pokemon_count,$offset=0,$per_page = 10)
    {
        $list_pages = ceil($pokemon_count / $per_page);
        for ($i = 0; $i < $list_pages; $i++) {
            echo '<li><a href="/?route=admin/pokemonselect&offset=' . $i * $per_page . '">' . ($i + 1) . "</a></li>\n";
        }
    }
}
