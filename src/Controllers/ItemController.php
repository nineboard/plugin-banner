<?php
/**
 *  This file is part of the Xpressengine package.
 *
 * PHP version 5
 *
 * @category    Point
 * @package     Xpressengine\Plugins\Point
 * @author      XE Team (developers) <developers@xpressengine.com>
 * @copyright   2015 Copyright (C) NAVER <http://www.navercorp.com>
 * @license     http://www.gnu.org/licenses/lgpl-3.0-standalone.html LGPL
 * @link        http://www.xpressengine.com
 */
namespace Xpressengine\Plugins\Banner\Controllers;

use App\Http\Controllers\Controller as Origin;
use Illuminate\Http\Request;
use Xpressengine\Plugins\Banner\Handler;
use Xpressengine\Plugins\Banner\Models\Item;
use Xpressengine\Plugins\Banner\Plugin;

/**
 * @category    Point
 * @package     Xpressengine\Plugins\Point\Controllers
 * @author      XE Team (developers) <developers@xpressengine.com>
 * @copyright   2015 Copyright (C) NAVER <http://www.navercorp.com>
 * @license     http://www.gnu.org/licenses/lgpl-3.0-standalone.html LGPL
 * @link        http://www.xpressengine.com
 */
class ItemController extends Origin
{
    /**
     * @var Plugin
     */
    protected $plugin;

    public function __construct(Plugin $plugin)
    {
        $this->plugin = $plugin;
    }

    public function store(Request $request, Handler $handler, $group_id)
    {
        $group = $handler->getGroup($group_id);

        \DB::beginTransaction();
        try {
            $item = $handler->createItem($group);
            $data = [
                'item' => view('banner::views.settings.group.item', compact('item'))->render()
            ];
        } catch (\Exception $e) {
            \DB::rollBack();
            throw $e;
        }
        \DB::commit();
        return app('xe.presenter')->makeApi(array_merge($data, ['alert' => ['type'=>'success', 'message'=>'추가되었습니다.']]));
    }

    public function edit(Request $request, Handler $handler, $group_id, $item_id)
    {
        $group = $handler->getGroup($group_id);
        $skin = \XeSkin::get($group->skin);
        $item = $handler->getItem($item_id);
        return api_render($this->plugin->view('views.settings.item.edit'), compact('item', 'skin'));
    }

    public function update(Request $request, Handler $handler, $group_id, $item_id)
    {
        $inputs = $request->only(['title', 'image', 'content', 'status', 'use_timer', 'link', 'link_target']);
        if (isset($inputs['use_timer']) == false) {
            $inputs['use_timer'] = 0;
        }

        $sd = $request->get('started_at_date');
        $st = $request->get('started_at_time');
        $ed = $request->get('ended_at_date');
        $et = $request->get('ended_at_time');

        if ($sd) {
            $inputs['started_at'] = $sd.' '.($st ?: '00:00').':00';
        }
        if ($ed) {
            $inputs['ended_at'] = $ed.' '.($et ?: '00:00').':00';
        }

        if (array_get($inputs, 'link_target') === null) {
            $inputs['link_target'] = '_self';
        }

        $inputs['etc'] = $request->except([
            '_token', '_method', 'title', 'image', 'content', 'status', 'use_timer', 'link', 'link_target',
            'started_at_date', 'started_at_time', 'ended_at_date', 'ended_at_time',
        ]);

        $item = $handler->getItem($item_id);

        \DB::beginTransaction();
        try {
            $item = $handler->updateItem($item, $inputs);

            $data = [
                'item' => view('banner::views.settings.group.item', compact('item'))->render()
            ];
        } catch (\Exception $e) {
            \DB::rollBack();
            throw $e;
        }
        \DB::commit();

        return app('xe.presenter')->makeApi(array_merge($data, ['alert' => ['type'=>'success', 'message'=>'저장되었습니다.']]));
    }

    public function destroy(Request $request, Handler $handler, $group_id, $item_id){
        $item = Item::where('group_id', $group_id)->find($item_id);

        \DB::beginTransaction();
        try {
            $handler->removeItem($item);
        } catch (\Exception $e) {
            \DB::rollBack();
            throw $e;
        }
        \DB::commit();

        return app('xe.presenter')->makeApi(['alert' => ['type'=>'success', 'message'=>'삭제되었습니다.']]);
    }

}
