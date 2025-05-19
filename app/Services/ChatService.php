<?php

namespace App\Services;

use App\Models\Chat;

class ChatService
{
    protected $chat;
    public function __construct(Chat $chat)
    {
        $this->chat = $chat;
    }

    public function getAll()
    {
        return $this->chat->get();
    }

    public function store($data)
    {
        return $this->chat->create($data);
    }

    public function Query()
    {
        return $this->chat->query();
    }

    public function show($id)
    {
        return $this->chat->find($id);
    }

    public function update($id, $data)
    {
        return  $this->chat->where('id', $id)->update($data);
    }

    public function destroy($id)
    {
        return  $this->chat->destroy($id);
    }
}
