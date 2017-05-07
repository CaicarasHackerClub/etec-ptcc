<?php

class Geocode {

  const KEY = 'AIzaSyC0Qliqe7HjHeD2daBzwVtk6ndT3kJLVlc';
  const URL = 'https://maps.googleapis.com/maps/api/geocode/json?v=3&sensor=false';

  private $title;
  private $latLng;
  private $placeId;
  private $formattedAddress;
  private $types;
  private $status;
  private $language = 'pt';
  private $region = 'BR';

  public function __construct($query) {
    $url = $this->getUrl($query);
    $json = $this->getJson($url);

    $this->status = $json['status'];
    $result = $json['results'][0];

    $this->latLng = new LatLng(
        $result['geometry']['location']['lat'],
        $result['geometry']['location']['lng']
    );
    $this->placeId = $result['place_id'];
    $this->formattedAddress = $result['formatted_address'];
    $this->types = $result['types'];
  }

  public function getLocation() {
    return $this->latLng;
  }
  public function getPlaceId() {
    return $this->placeId;
  }
  public function getFormattedAddress() {
    return $this->formattedAddress;
  }
  public function getTypes() {
    return $this->types;
  }
  public function getStatus() {
    return $this->status;
  }

  /**
   * Recebe um objeto LatLng, retorna URL para reverse geocoding
   * Recebe uma string representando um endereço, retorna URL para geocoding
   */
  private function getUrl($query) {
    if ($query instanceof LatLng) {
      $query = "&latlng=$query";
    } else {
      $query = "&address=" . urlencode(trim($query));
    }

    $url = self::URL
      . $query
      . "&language=" . $this->language
      . "&region=" . $this->region
      . "&key=" . self::KEY;

    return $url;
  }

  private function getJson($url) {
    $file = file_get_contents($url);
    $json = json_decode($file, true);

    return $json;
  }
}
