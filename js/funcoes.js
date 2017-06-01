function showMessage($div, message, millis, done) {
  $div.text(message).fadeIn();
  if (millis > 0) {
    setTimeout(function() {
      $div.fadeOut('slow', done);
    }, millis);
  }
}
