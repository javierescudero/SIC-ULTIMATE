$(document).on('ready', principal);
function principal() {
  $('span').bind('mouseenter', function(e) {
    $(this).attr('contenteditable','true');
  });
}
