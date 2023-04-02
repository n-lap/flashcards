/*
    Авторизация
*/

$(".login-btn").click(function (e) {
  e.preventDefault();

  $(`input`).removeClass("error");

  let login = $('input[name="login"]').val(),
    password = $('input[name="password"]').val();

  $.ajax({
    url: "vendor/signin.php",
    type: "POST",
    dataType: "json",
    data: {
      login: login,
      password: password,
    },
    success(data) {
      if (data.status) {
        document.location.href = "/cards.php";
      } else {
        if (data.type === 1) {
          data.fields.forEach(function (field) {
            $(`input[name="${field}"]`).addClass("error");
          });
        }

        $(".msg").removeClass("none").text(data.message);
      }
    },
  });
});

/*
    Регистрация
 */

$(".register-btn").click(function (e) {
  e.preventDefault();

  $(`input`).removeClass("error");

  let login = $('input[name="login"]').val(),
    password = $('input[name="password"]').val(),
    full_name = $('input[name="full_name"]').val(),
    email = $('input[name="email"]').val(),
    password_confirm = $('input[name="password_confirm"]').val();

  $.ajax({
    url: "vendor/signup.php",
    type: "POST",
    dataType: "json",
    data: {
      login: login,
      password: password,
      password_confirm: password_confirm,
      full_name: full_name,
      email: email,
    },
    success: function (data) {
      if (data.status) {
        document.location.href = "/index.php";
      } else {
        if (data.type === 1) {
          data.fields.forEach(function (field) {
            $(`input[name="${field}"]`).addClass("error");
          });
        }

        $(".msg").removeClass("none").text(data.message);
      }
    },
  });
});
