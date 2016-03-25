<?php

namespace Philsquare\LaraManager\Http\Controllers;

use Philsquare\LaraManager\Http\Requests\CreateFeedRequest;
use Philsquare\LaraManager\Http\Requests\UpdateFeedRequest;
use Philsquare\LaraManager\Models\Feed as FeedModel;
use Suin\RSSWriter\Channel;
use Suin\RSSWriter\Feed;
use Suin\RSSWriter\Item;

class RssFeedsController extends Controller
{
    protected $feed;

    public function __construct(FeedModel $feed)
    {
        $this->feed = $feed;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $feeds = $this->feed->all();

        return view('laramanager::feeds.index', compact('feeds'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('laramanager::feeds.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateFeedRequest $request)
    {
        if(! class_exists($request->model)) return redirect()->back()->withInput()
            ->with('failed', 'This model does not exist. Please create model before creating feed.');

        $model = new $request->model;
        if(! method_exists($model, 'getFeedItems')) return redirect()->back()->withInput()
            ->with('failed', 'You must implement RssFeedInterface on your model before making feed');

        $this->feed->create($request->all());

        return redirect('admin/feeds');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($type)
    {
        $feedData = $this->feed->where('slug', $type)->firstOrFail();
        $model = $feedData->model;
        $entities = $model::getFeedItems();

        $feed = new Feed;

        $channel = new Channel;
        $channel
            ->title($feedData->title)
            ->description($feedData->description)
            ->url($feedData->url)
            ->language($feedData->language)
            ->copyright($feedData->copyright)
            ->ttl($feedData->ttl)
            ->appendTo($feed);

        foreach($entities as $entity)
        {
            $item = new Item;
            $item
                ->title($entity->itemTitle())
                ->description($entity->itemDescription())
                ->contentEncoded($entity->itemContent())
                ->url($entity->itemUrl())
                ->guid($entity->itemUrl(), true)
                ->pubDate($entity->itemPubDate())
                ->appendTo($channel);
        }

        return $feed;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $feed = $this->feed->findOrFail($id);

        return view('laramanager::feeds.edit', compact('feed'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFeedRequest $request, $id)
    {
        if(! class_exists($request->model)) return redirect()->back()->withInput()
            ->with('failed', 'This model does not exist. Please create model before updating feed.');

        $model = new $request->model;
        if(! method_exists($model, 'getFeedItems')) return redirect()->back()->withInput()
            ->with('failed', 'You must implement RssFeedInterface on your model before updating feed with new model');

        $feed = $this->feed->findOrFail($id);
        $feed->update($request->all());

        return redirect('admin/feeds');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $feed = $this->feed->findOrFail($id);

        if($feed->delete()) return response()->json(['status' => 'ok']);

        return response()->json(['status' => 'failed']);
    }
}
