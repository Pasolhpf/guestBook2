$("#sendData").on("click", function() {
  var username = $("#username").val().trim();
  var email = $("#email").val().trim();
  var homepage = $("#homepage").val().trim();
  var message = $("#message").val().trim();
  var tags = $("#tags").val().trim();
  var createdAt = $("#createdAt").val().trim();
  var captcha = $("#captcha").val();

  if(username == "") {
    $("#errorMess").text("Введите имя пользователя");
    return false;
  } else if(!username.match(/^[a-zA-Z0-9]+$/)) {
    $("#errorMess").text("Используйте только буквы латинского алфавита и цифры");
    return false;
  } else if(email == "") {
    $("#errorMess").text("Введите email");
    return false;
  } else if(message == "") {
    $("#errorMess").text("Введите сообщение");
    return false;
  } else if(message.match(/<[^>]+>/)) {
    $("#errorMess").text("HTML-теги недопустимы");
    return false;
  } else if(createdAt == "") {
    $("#errorMess").text("Введите дату");
    return false;
  }

  $("#errorMess").text("");

  $.ajax({
    url: 'ajax/add.php',
    type: 'POST',
    cache: false,
    data: { 'username': username, 'email': email, 'homepage': homepage, 'tags': tags, 'message': message, 'createdAt': createdAt, 'captcha': captcha, },
    dataType: 'html',
    beforeSend: function() {
      $("#sendData").prop("disabled", true);
    },
    success: function(data) {

      $("#sendData").prop("disabled", false);
      if (data !== "CAPTCHA введена неправильно!") {
        window.location.href = "http://172.55.0.3/book.php";
      } else {
        alert(data);
      }
    }
  });

});
