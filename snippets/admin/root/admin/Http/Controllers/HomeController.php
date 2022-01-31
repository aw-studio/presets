<?php

namespace Admin\Http\Controllers;

use Admin\Ui\Page;

class HomeController
{
    /**
     * Show the home page for the admin application.
     *
     * @param  Page $page
     * @return Page
     */
    public function show(Page $page)
    {
        return $page->page('Home/Show');
    }
}
