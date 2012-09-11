<?php

  namespace Foursquare\Exception;

  use \RuntimeException;

  class ApiLimitExceedException extends RuntimeException {
    public function __construct($limit) {
        parent::__construct('You have reached the Api limit! Actual limit is: '. $limit);
    }
}
