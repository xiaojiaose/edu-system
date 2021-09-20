<?php

namespace App\Admin\Actions;

use App\Externals\LineService;
use App\Notifications\SiteMsgNotify;
use Encore\Admin\Actions\BatchAction;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class BatchSendMsg extends BatchAction
{
    public $name = '批量发送站内消息';
    const MSG_TYPE_SITE = 1;
    const MSG_TYPE_LINE = 2;

    /**
     * @param \Illuminate\Database\Eloquent\Collection $collection
     * @return \Encore\Admin\Actions\Response
     */
    public function handle(Collection $collection, Request $request)
    {
        $content = $request->get('content');
        $isSiteMsg = $request->get('type') == self::MSG_TYPE_SITE ? true : false;
        if ($isSiteMsg) {
            // 站内消息
            $msg = new SiteMsgNotify($content);
            foreach ($collection as $student) {
                $student->notify($msg);
            }
        } else {
            // line消息
            if (!$lineIds = $collection->pluck('line_id')->unique()->all()) {
                return $this->response()->error('当前选择的学生全部没有绑定line，发送失败');
            }
            $line = new LineService();
            $line->multicastTextMessage($lineIds, $content);

        }

        return $this->response()->success('Success message...')->refresh();
    }

    public function form()
    {
        $type = [
            self::MSG_TYPE_SITE => '站内消息',
            self::MSG_TYPE_LINE => 'Line消息',
        ];
        $this->select('type', '类型')->options($type)->value(1);
        $this->textarea('content', '内容')->rules('required');
    }

}