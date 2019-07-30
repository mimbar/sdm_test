<?php

namespace App\Http\Middleware;

use Closure;
use Modules\Kitchen\Entities\Menu;

class LeMenus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        \Menu::make('LeMenu', function ($menu) use($request) {
            $menulist = Menu::with('child.child')->where('parentsID','=',0)->get();
            foreach($menulist as $head){
                $nickname = preg_replace('/\s+/', '', $head->nama);
                $icon = '<i class="'.$head->icon.' mr-2"></i>';
                if ($head->child()->count() == 0){
                    $route = [
                        'route' => $head->url
                    ];
                }else{
                    $route = "#";
                }
                $menu->add("$icon $head->nama", $route)
                    ->nickname("$nickname");
                $route = null;
                $menu->group(['prefix' => "$nickname"], function ($m) use ($icon, $head, $nickname, $menu) {
                    foreach ($head->child as $child) {
                        $nickchild = preg_replace('/\s+/', '', $child->nama);
                        $icon = '<i class="fa '.$child->icon.'"></i>';
                        $m->$nickname->add("$icon $child->nama", ['route' => $child->url])->nickname("$nickchild");
                        $menu->group(['prefix' => "$nickchild"], function ($sm) use ($icon, $child, $nickchild) {
                            foreach ($child->child as $grandchild) {
                                $icon = '<i class="fa '.$grandchild->icon.'"></i>';
                                $sm->$nickchild->add("$icon $grandchild->nama", ['route' => $grandchild->url]);
                            }
                        });
                    }
                });
            }
        });
        return $next($request);
    }
}
