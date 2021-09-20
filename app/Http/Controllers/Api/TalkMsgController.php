<?php
// mengdewei@dankegongyu.com

namespace App\Http\Controllers\Api;


use App\Events\ChatEvent;
use App\Events\ChatMsgBroadcastEvent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TalkMsgController extends Controller
{
    public function teacherTalk(int $studentId, Request $request)
    {
        $this->validate($request, [
            'content' => 'required|string',
        ]);

        $teacher = $request->user();
        ChatMsgBroadcastEvent::broadcast($teacher->id, $studentId, $request->json('content'), $teacher);
    }

    public function studentTalk(int $teacherId, Request $request)
    {
        $this->validate($request, [
            'content' => 'required|string',
        ]);

        $student = $request->user();
        ChatMsgBroadcastEvent::broadcast($teacherId, $student->id, $request->json('content'), $student);
    }
}