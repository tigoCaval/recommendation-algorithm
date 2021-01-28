<?php
namespace Tigo\Recommendation\Interfaces;

interface CollaborativeInterface
{
   
    public function recommend($table, $user, $score = 0);
    
}