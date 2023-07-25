<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\Post;
use Livewire\Component;

class LikePost extends Component

{


	public  $liked; //* Post or Comment

	public $kindLike; //* post | comment
	public function render()
	{
		return view('livewire.like-post');
	}

	public function clickLike(){
		
	}
}
