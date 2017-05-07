<?php

class LatLng {

  private $lat;       // Latitude
  private $lng;       // Longitude

  public function __construct($lat, $lng) {
    $this->lat = trim($lat);
    $this->lng = trim($lng);
  }

  public function getLat() {
    return $this->lat;
  }
  public function getLng() {
    return $this->lng;
  }
  public function __toString() {
    return $this->lat . ',' . $this->lng;
  }
}
