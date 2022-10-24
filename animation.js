function toTop() {
    $("html, body").scrollTop(1)
}

function toBottom() {
    $("html, body").scrollTop($(document).height())
}

function applyAnimations() {
  // apply shake effect
  $(".shake-animated").not(".compiled").each(function() {
      $(this).addClass("compiled")
      text = $(this).text().split("")
      modified_text = ""

      for (var i = 0; i < text.length; i++) {
          if (text[i] === ' ' & text[i-1] != ' ') {
              modified_text += '<pre style="margin: 0"> </pre>'
          } else {
              modified_text += `<span class="shake" style="animation-delay: ${-Math.random()}s;">${text[i]}</span>`
          }
      }
      $(this).html(modified_text)
  })

  // apply jump effect
  $(".jump-animated").not(".compiled").each(function() {
    $(this).addClass("compiled")
      let jump_index = 0
      text = $(this).text().split("")
      modified_text = ""

      for (var i = 0; i < text.length; i++) {
          jump_index += 0.05
          if (text[i] === ' ' & text[i-1] != ' ') {
              modified_text += '<pre style="margin: 0"> </pre>'
          } else {
              modified_text += `<span class="jump" style="animation-delay: ${jump_index}s;">${text[i]}</span>`
          }
      }
      $(this).html(modified_text)
  })
}

$(document).ready(function() {
  applyAnimations()
  setInterval(applyAnimations, 10000)
})
