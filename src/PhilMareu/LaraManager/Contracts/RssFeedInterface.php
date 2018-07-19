<?php

namespace PhilMareu\LaraManager\Contracts;


interface RssFeedInterface {

    public static function getFeedItems();

    public function itemTitle();

    public function itemDescription();

    public function itemContent();

    public function itemUrl();

    public function itemPubDate();
}