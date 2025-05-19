<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    protected $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getAll()
    {
        return $this->user->get();
    }

    public function store($data)
    {
        return $this->user->create($data);
    }

    public function Query()
    {
        return $this->user->query();
    }

    public function show($id)
    {
        $opd = $this->user->find($id);
        return $opd;
    }

    public function update($id, $data)
    {
        $opd =  $this->user->where('id', $id)->update($data);
        return $opd;
    }

    public function destroy($id)
    {
        $opd = $this->user->destroy($id);
        return $opd;
    }
}
