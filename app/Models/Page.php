<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model {

    use HasFactory;

    public function children() {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function parent() {
        return $this->hasOne(self::class, 'id', 'parent_id');
    }

    /**
     * @author Pramod Kushwaha
     * 
     * This recursive function is used to render menu
     * @param array $pages
     * @param type $parentId
     * @return type Array
     */
    public function buildMenu(array $pages, $parentId = 0) {
        $menu = array();
        foreach ($pages as $page) {
            if ($page['parent_id'] == $parentId) {
                $children = self::buildMenu($pages, $page['id']);
                if ($children) {
                    $page['children'] = $children;
                }
                $menu[] = $page;
            }
        }
        return $menu;
    }

}
