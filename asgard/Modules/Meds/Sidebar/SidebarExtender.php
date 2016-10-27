<?php namespace Modules\Meds\Sidebar;

use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Modules\Core\Contracts\Authentication;

class SidebarExtender implements \Maatwebsite\Sidebar\SidebarExtender
{
    /**
     * @var Authentication
     */
    protected $auth;

    /**
     * @param Authentication $auth
     *
     * @internal param Guard $guard
     */
    public function __construct(Authentication $auth)
    {
        $this->auth = $auth;
    }

    /**
     * @param Menu $menu
     *
     * @return Menu
     */
    public function extendWith(Menu $menu)
    {
        $menu->group(trans('core::sidebar.content'), function (Group $group) {
            $group->item(trans('Anunţuri'), function (Item $item) {
                $item->icon('fa fa-medkit');
                $item->weight(0);
				$item->route('admin.meds.patient.index');
				
                $item->authorize(
                    $this->auth->hasAccess('meds.patients.index')
                );
//				$item->badge(function (Badge $badge, CommentRepository $comm) {
//                    $badge->setClass('bg-orange');
//                    $badge->setValue($comm->count('pending'));
//                });

            });
        });		
/*        $menu->group(trans('core::sidebar.content'), function (Group $group) {
            $group->item(trans('meds::abcs.title.abcs'), function (Item $item) {
                $item->icon('fa fa-copy');
                $item->weight(10);
                $item->authorize(
                    //append
                );
                $item->item(trans('meds::meds.title.meds'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.meds.med.create');
                    $item->route('admin.meds.med.index');
                    $item->authorize(
                        $this->auth->hasAccess('meds.meds.index')
                    );
                });
                $item->item(trans('meds::patients.title.patients'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.meds.patient.create');
                    $item->route('admin.meds.patient.index');
                    $item->authorize(
                        $this->auth->hasAccess('meds.patients.index')
                    );
                });
                $item->item(trans('meds::contacts.title.contacts'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.meds.contact.create');
                    $item->route('admin.meds.contact.index');
                    $item->authorize(
                        $this->auth->hasAccess('meds.contacts.index')
                    );
                });
                $item->item(trans('meds::recipes.title.recipes'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.meds.recipe.create');
                    $item->route('admin.meds.recipe.index');
                    $item->authorize(
                        $this->auth->hasAccess('meds.recipes.index')
                    );
                });
                $item->item(trans('meds::replies.title.replies'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.meds.reply.create');
                    $item->route('admin.meds.reply.index');
                    $item->authorize(
                        $this->auth->hasAccess('meds.replies.index')
                    );
                });
// append

            });
        });*/

        return $menu;
    }
}
