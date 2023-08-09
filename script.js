function toTop() {
  $("html, body").scrollTop(1)
}

function toBottom() {
  $("html, body").scrollTop($(document).height())
}

var selected_theme = 'black'
function setTheme(theme) {
  $("body").toggleClass(selected_theme)
  $("body").toggleClass(theme)
  selected_theme = theme
}

// send comment
$('.send').click(function () {    
  xhttp.open("POST", window.location.href + "send.php")
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded")

  let id = $(".comment:last-child").length ? $(".comment:last-child")[$(".comment:last-child").length - 1].id : 0
  xhttp.send('str=' + encodeURIComponent($(".input").val()) + '&id=' + id)
  $(".input").val('')
})

// add new comments on page
function update () {
  xhttp.open("POST", window.location.href + "send.php")
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded")

  let id = $(".comment:last-child").length ? $(".comment:last-child")[$(".comment:last-child").length - 1].id : 0
  xhttp.send("&id=" + id)
}

function addAnswer(data) {
  data = JSON.parse(data)
  
  for (let i=0; i<data.length; i++) {
    let p = `<pre class="comment" id="${data[i]["id"]}"><span class="bg">${data[i]["data"]}</span><br>${data[i]["comments"]}</pre>`
    $('.comments').append(p)
  }
}

// update and post comments
var xhttp = new XMLHttpRequest()
xhttp.onreadystatechange = function () {
  if (this.readyState == 4 && this.status == 200) {
    addAnswer(this.responseText);
  }
}

$(document).ready(function() {
  setInterval(update, 10000)
})
