function mail_resend()
{
  $.get('/auth.ajax.php?task=resend&'+lng_uri, function(data) {
      $('#login-message .message').html(data);
  });
}

function check_email(obj)
{
  var pattern = /^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;

  return obj.val().length > 0 && pattern.test(obj.val());
}

function check_passw(obj)
{
  var pattern = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/;

  return pattern.test(obj.val());
}

function check_fname(obj)
{
  //return obj.val() != '' && obj.val().length > 3;
  return true;
}

function show_message(msg)
{
  $('#login-message .message').html(msg);
  $('#login-message').fadeIn(300);
}

function hide_message()
{
  $('#login-message').fadeOut(300);
}

function toggle_checkable(obj)
{
  var dn = obj.attr('data-name');
  var dv = obj.attr('data-val');

  if(obj.hasClass('checked')) {
    obj.removeClass('checked');
    cfg[dn][dv]=0;
  }
  else {
    obj.addClass('checked');
    cfg[dn][dv]=1;
  }
  obj.blur();
}

function cfg_save()
{
  $.cookie('cfg', JSON.stringify(cfg));
}

function cfg_updt()
{
}

function save_show()
{
  $('#save-popup').fadeIn(150);
}

function save_hide()
{
  $('#save-popup').fadeOut(150);
}