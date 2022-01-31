<?php

namespace Admin\Http\Controllers;

use Admin\Ui\Page;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ExampleController
{
    /**
     * Example items.
     *
     * @param  Request      $request
     * @param  ExampleIndex $index
     * @return void
     */
    public function items(Request $request, ExampleIndex $index)
    {
        return $index->items(
            $request,
            Example::current(),
            ExampleResource::class
        );
    }

    /**
     * Show the example index page for the admin application.
     *
     * @param  Page $page
     * @return Page
     */
    public function index(Page $page)
    {
        return $page->page('Examples/Index');
    }

    /**
     * Show the example detail page for the admin application.
     *
     * @param  Example $example
     * @param  Page    $page
     * @return Page
     */
    public function show(Example $example, Page $page)
    {
        return $page->page('Examples/Show')->with('example', new ExampleResource($example));
    }

    /**
     * Store a new example.
     *
     * @param  Request          $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            //
        ]);

        $example = Example::store($validated);

        return Redirect::route('admin.examples.index');
    }

    /**
     * Update a example.
     *
     * @param  Request $request
     * @param  Example $example
     * @return void
     */
    public function update(Request $request, Example $example)
    {
        $validated = $request->validate([
            //
        ]);

        $example->update($validated);

        return Redirect::route('admin.examples.show', ['example' => $example]);
    }
}
