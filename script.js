function toTop() {
  $("html, body").scrollTop(1);
}

function toBottom() {
  $("html, body").scrollTop($(document).height());
}

var selected_theme = 'black';
function setTheme(theme) {
  $("body").toggleClass(selected_theme);
  $("body").toggleClass(theme);
  selected_theme = theme;
}

// Send comment
$('.send').click(function () {
  xhttp.open("POST", window.location.href + "send.php");
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  let id = $(".comment:last-child").length ? $(".comment:last-child")[$(".comment:last-child").length - 1].id : 0;
  xhttp.send('str=' + encodeURIComponent($(".input").val()) + '&id=' + id);
  $(".input").val('');
})

// Load bad apple cinema
$('#bad-apple-button').click(function () {
  $('#bad-apple-button').replaceWith('<span>Загружается...</span>');

  xhttp.open("POST", window.location.href + "load_bad_apple.php");
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send();
})

function update () {
  xhttp.open("POST", window.location.href + "send.php");
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  let id = $(".comment:last-child").length ? $(".comment:last-child")[$(".comment:last-child").length - 1].id : 0
  xhttp.send("&id=" + id);
}

function addAnswer(data, where) {
  data = JSON.parse(data);

  for (let i=0; i<data.length; i++) {
    let p = `<pre class="comment" id="${data[i]["id"]}"><span class="bg">${data[i]["data"]} | #${data[i]["id"]}</span><br>${data[i]["comments"]}</pre>`;
    $(where).append(p);
  }
}

var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function () {
  if (this.readyState != 4 || this.status != 200) {
    return;
  }

  if (this.responseURL.includes('send.php')) {
    addAnswer(this.responseText, '#comments-container');
  } else if (this.responseURL.includes('load_bad_apple.php')) {
    $('#bad-apple-pre').remove();
    addAnswer(this.responseText, '#bad-apple-comments');
  }
}

$(document).ready(function() {
  setInterval(update, 10000);
})
