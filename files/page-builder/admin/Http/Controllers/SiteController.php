<?php

namespace Admin\Http\Controllers;

use Admin\Http\Indexes\SiteIndex;
use Admin\Ui\Page;
use AwStudio\Sites\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SiteController
{
    /**
     * Ship index page.
     *
     * @param  Page $page
     * @return Page
     */
    public function items(Request $request, SiteIndex $index)
    {
        return $index->items(
            $request,
            Site::query()
        );
    }

    /**
     * Show the ship index page for the admin application.
     *
     * @param  Page $page
     * @return Page
     */
    public function index(Page $page)
    {
        return $page->page('Sites/Index');
    }

    public function show(Page $page, Site $site)
    {
        return $page->page('Sites/Show')
            ->with('site', $site->load('files'));
    }

    public function update(Request $request, Site $site)
    {
        $site->update([
            'content' => $request->content,
        ]);

        return redirect()->back();
    }

    public function upload(Request $request, Site $site)
    {
        $validated = $request->validate([
            'file' => 'required',
        ]);

        $site->addFile($validated['file'])->save();

        return Redirect::route('admin.sites.show', ['site' => $site]);
    }
}
