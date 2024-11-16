<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Http\Requests\Reply\ReplyRequest;
use App\Services\ReplyService;
use Exception;
use Illuminate\Http\RedirectResponse;

class ReplyController extends Controller
{
    protected  $replyService;

    public function __construct(ReplyService $replyService)
    {
        $this->replyService = $replyService;
    }
    public function submitReply (ReplyRequest $request): RedirectResponse
    {
            $this->replyService->storeReply($request->validated());
            return redirect()->back()->with('success', 'Success');

    }
}
