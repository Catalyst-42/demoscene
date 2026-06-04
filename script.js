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
  $(".input").val('')
})

function update () {
  xhttp.open("POST", window.location.href + "send.php");
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  let id = $(".comment:last-child").length ? $(".comment:last-child")[$(".comment:last-child").length - 1].id : 0
  xhttp.send("&id=" + id);
}

function addAnswer(birthtime, where) {
  birthtime = JSON.parse(birthtime);

  for (let i=0; i<birthtime.length; i++) {
    let p = `<pre class="comment" id="${birthtime[i]["id"]}"><span class="bg">${birthtime[i]["birthtime"]} | #${birthtime[i]["id"]}</span><br>${birthtime[i]["comments"]}</pre>`;
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
  }
}

$(document).ready(function() {
  setInterval(update, 10000);
})
