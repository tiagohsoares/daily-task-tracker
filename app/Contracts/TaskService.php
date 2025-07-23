<?php

namespace App\Contracts;

interface TaskService
{
    public function find();
    public function getAll();
    public function insert();
    public function create();
    public function getFrequency();
}
