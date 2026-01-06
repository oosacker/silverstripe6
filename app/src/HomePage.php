<?php

namespace {

  use SilverStripe\CMS\Model\SiteTree;

  class HomePage extends Page
  {
    private static $db = [
      'Content' => 'HTMLText',
    ];

    private static $has_one = [];

    private static $singular_name = 'Home Page';

    private static $plural_name = 'Home Pages';

    private static $description = 'Home page for the website';
  }
}
