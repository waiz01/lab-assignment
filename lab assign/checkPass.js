var y,
element = document.getElementById('password');
if (element != null) {
    y = element.value;
}
else {
    y = null;
}

//API
const settings = {
"async": true,
"crossDomain": true,
"url": "https://test.khronalforce.com/check",
"method": "GET",
"data": {"password":y},
"contentType": "application/json",
/*"headers": 
{
"X-RapidAPI-Key": "f4cc19a3b1mshcec4c14071c2235p100fabjsn24c618184796",
"X-RapidAPI-Host": "check-password-strength-with-zxcvbn1.p.rapidapi.com"
}*/
 };

function checkPassword(pass)
{
    $.ajax({
      "async": true,
      "crossDomain": true,
      "url": "https://test.khronalforce.com/check",
      "method": "GET",
      "data": {"password":pass},
      "contentType": "application/json",
    }).done(function (response) 
    {
    console.log(response);
     // $('#passCheck').html(response);
     if(pass != null)
     checkResponse(response);
     else
     $('#passCheck').html("");
    });
}

function checkResponse(data)
{
  if(data == '0')
  {
    $('#passCheck').html("Very Weak Password");
  }
  else if(data == '1')
  {
    $('#passCheck').html("Weak Password");
  }
  else if(data == '2')
  {
    $('#passCheck').html("Mediocre Password");
  }
  else if(data == '3')
  {
    $('#passCheck').html("Strong Password");
  }
  else if(data == '4')
  {
    $('#passCheck').html("Very Strong Password");
  }
  else
  {
    $('#passCheck').html("");
  }
}

$(document).on('input','#password',function(e){

    let password = $('#password').val();
    if(password != null)
    {
      checkPassword(password);
    }

});