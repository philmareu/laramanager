<?php

namespace Philsquare\LaraManager\Contracts;


interface RssFeedInterface {

    public static function getFeedItems();

    public function itemTitle();

    public function itemDescription();

    public function itemUrl();
}