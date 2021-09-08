let xhttp = new XMLHttpRequest()
let id = 0

xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
        addAnswer(this.responseText);
    }
}

document.querySelector('.send').addEventListener('click', function () {    
    xhttp.open("POST", "https://demoscene.herokuapp.com/send.php")
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
    if ((document.getElementById("0").lastElementChild.id) == null) { id = 0
    } else { document.getElementById("0").lastElementChild.id }

    xhttp.send('str=' + document.querySelector('.input').value + '&id=' + id)
    
    document.querySelector('.input').value = ''
})

setInterval(update, 3000) 
function update () {
    xhttp.open("POST", "https://demoscene.herokuapp.com/send.php")
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded")

    if ((document.getElementById("0").lastElementChild.id) == null) { id = 0
    } else { document.getElementById("0").lastElementChild.id }

    xhttp.send('id=' + id)
}

function addAnswer (data) {
    data = JSON.parse(data)
    
    for (let i=0; i<data.length; i++) {
        let p = document.createElement('p')
        p.classList.add('comment')
        p.id = data[i]['id']

        // p.innerHTML =  year + "-" + month + "-" + date + " " + hours + ":" + minutes + ":" + seconds + '<br>' + data
        p.innerHTML =  data[i]['data'] + "<br>" + data[i]['comment']
        document.body.querySelector('.comments').appendChild(p)
    }
}