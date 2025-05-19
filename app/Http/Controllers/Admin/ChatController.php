<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChatStoreRequest;
use App\Services\ChatService;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    protected $chat;
    public function __construct(ChatService $chatService)
    {
        $this->chat = $chatService;
    }

    public function store(ChatStoreRequest $request)
    {
        try {
            $this->chat->store($request->validated());
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
        return redirect()->back();
    }
}

