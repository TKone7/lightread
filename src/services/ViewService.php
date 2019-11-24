<?php


namespace services;


use domain\Content;
use domain\User;

interface ViewService
{
    public function registerView(Content $content);

}