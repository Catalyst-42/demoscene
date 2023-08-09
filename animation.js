$.fn.isInViewport = function() {
  let elementTop = $(this).offset().top
  let elementBottom = elementTop + $(this).outerHeight()

  let viewportTop = $(window).scrollTop()
  let viewportBottom = viewportTop + $(window).height()

  return elementBottom > viewportTop && elementTop < viewportBottom;
};

function applyAnimations() {
  // apply shake effect
  $(".shake-animated").not(".compiled").each(function() {
    if (!$(this).isInViewport()) return
    $(this).addClass("compiled")
    
    let text = $(this).text().split("")
    let modified_text = ""

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
    if (!$(this).isInViewport()) return
    $(this).addClass("compiled")

    let jump_index = 0
    let text = $(this).text().split("")
    let modified_text = ""

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
  
  // animate magic star
  const rand = (min, max) => Math.floor(Math.random() * (max - min + 1)) + min
  const animate = star => {
    star.style.setProperty("--star-left", `${rand(0, 100)}%`)
    star.style.setProperty("--star-top", `${rand(-10, 90)}%`)
    
    star.style.animation = "none"
    star.offsetHeight
    star.style.animation = ""
  }
  
  // apply magic effect
  $(".magic-animated").not(".compiled").each(function() {
    if (!$(this).isInViewport()) return
    $(this).addClass("compiled")

    for (let i = 0; i < 3; i++) {
      $(this).prepend("<span class='magic-star'><svg viewBox='0 0 512 512'><path d='M512 255.1c0 11.34-7.406 20.86-18.44 23.64l-171.3 42.78l-42.78 171.1C276.7 504.6 267.2 512 255.9 512s-20.84-7.406-23.62-18.44l-42.66-171.2L18.47 279.6C7.406 276.8 0 267.3 0 255.1c0-11.34 7.406-20.83 18.44-23.61l171.2-42.78l42.78-171.1C235.2 7.406 244.7 0 256 0s20.84 7.406 23.62 18.44l42.78 171.2l171.2 42.78C504.6 235.2 512 244.6 512 255.1z'></svg></span>")
    }
    
    let index = 0
    for (const star of $(this).find(".magic-star")) {
      setTimeout(() => {
        animate(star)
        setInterval(() => animate(star), 1500)
      }, 500 * index++)
    }
  })
}

// apply new effects every 5 seconds (if new content generated)
$(document).ready(function() {
  applyAnimations()
  setInterval(applyAnimations, 5000)
})
