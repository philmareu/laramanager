<?php

namespace Philsquare\LaraManager\Contracts;


interface RssFeedInterface {

    public static function getFeedItems();

    public function feedTitle();

    public function feedDescription();

    public function feedUrl();
}