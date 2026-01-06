<?php

namespace {

  /**
   * @template T of HomePage
   * @extends PageController<T>
   */
  class HomePageController extends PageController
  {
    private static $allowed_actions = [];

    protected function init()
    {
      parent::init();
      // Add HomePage specific requirements here
    }
  }
}
