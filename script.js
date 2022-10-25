let xhttp = new XMLHttpRequest()
let id = document.querySelectorAll(".comment:last-child")[0].id
let interval = setTimeout(update, 10000) 
console.log(id)

xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
        addAnswer(this.responseText);
    }
}

document.querySelector('.send').addEventListener('click', function () {    
    xhttp.open("POST", "https://demoscene.herokuapp.com/send.php")
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
    try { id = document.querySelectorAll(".comment:last-child")[0].id } catch { id = 0 }
    xhttp.send('str=' + document.querySelector('.input').value + '&id=' + id)
    document.querySelector('.input').value = ''
})

function update () {
    xhttp.open("POST", "https://demoscene.herokuapp.com/send.php")
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
    try { id = document.querySelectorAll(".comment:last-child")[0].id } catch { id = 0 }
    xhttp.send("&id=" + id)
}

function addAnswer (data) {
    clearInterval(interval)
    interval = setInterval(update, 10000)
    data = JSON.parse(data)
    
    for (let i=0; i<data.length; i++) {
        let div = document.createElement('div')
        div.classList.add('comment')
        div.id = data[i]['id']
        div.innerHTML =  "<span class='bg'>" + data[i]['data']  + "</span><br>" + data[i]['comments']
        document.body.querySelector('.comments').appendChild(div)
    }
}
