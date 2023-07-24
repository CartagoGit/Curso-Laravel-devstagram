<?php

namespace App\View\Components;

use App\Models\Post;
use Closure;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ListPosts extends Component
{
	/**
     * @var LengthAwarePaginator
     */
	public $posts;
    /**
     * Create a new component instance.
     */
    public function __construct(LengthAwarePaginator $posts)
    {
        //
		  $this->posts = $posts;

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.list-posts');
    }
}
