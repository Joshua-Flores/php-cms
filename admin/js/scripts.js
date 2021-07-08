$(document).ready(function () {
  $('#summernote').summernote();

  $('#selectAllBoxes').click(function (event) {
    console.log(this);
    if (this.checked) {
      $('.checkBoxes').each(function () {
        this.checked = true;
      });
    } else {
      $('.checkBoxes').each(function () {
        this.checked = false;
      });
    }
  });

  function loadUsersOnline() {
    $.get('functions.php?onlineusers=result', function (data) {
      $('#users_online_number').text(data);
    });
  }
  setInterval(function () {
    loadUsersOnline();
  }, 1000);
});
