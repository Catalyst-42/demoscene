let xhttp = new XMLHttpRequest()
let id = document.querySelectorAll(".comment:last-child").length ? document.querySelectorAll(".comment:last-child")[document.querySelectorAll(".comment:last-child").length - 1].id : 0
let interval = setTimeout(update, 5000) 
let selected_theme = 'black'
console.log('max id: ' + id + '\ntheme: ' + selected_theme)

function setTheme(theme) {
    document.body.classList.toggle(selected_theme)
    selected_theme = theme
    document.body.classList.toggle(selected_theme)
}

xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
        addAnswer(this.responseText);
    }
}

document.querySelector('.send').addEventListener('click', function () {    
    xhttp.open("POST", "http://192.168.1.39:8080/Demoscene/send.php")
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
    try { id = document.querySelectorAll(".comment:last-child")[document.querySelectorAll(".comment:last-child").length - 1].id } catch { id = 0 }
    
    let str = (document.querySelector('.input').value).replace('+', '&plus;')

    xhttp.send('str=' + str + '&id=' + id)
    console.log("sended: " + str)

    document.querySelector('.input').value = ''
})

function update () {
    xhttp.open("POST", "http://192.168.1.39:8080/Demoscene/send.php")
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
    try { id = document.querySelectorAll(".comment:last-child")[document.querySelectorAll(".comment:last-child").length - 1].id } catch { id = 0 }
    xhttp.send("&id=" + id)
}

function addAnswer (data) {
    clearInterval(interval)
    interval = setInterval(update, 5000)
    console.log('get:' + data)
    data = JSON.parse(data)
    
    for (let i=0; i<data.length; i++) {
        let p = document.createElement('pre')
        p.classList.add('comment')
        p.id = data[i]['id']
        p.innerHTML =  "<span class='bg'>" + data[i]['data']  + "</span><br>" + data[i]['comments']
        document.body.querySelector('.comments').appendChild(p)
    }
}

