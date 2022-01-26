function formCheck(formArray,form = null) {
    //serialize data function
    var result = false;
    for (var i = 0; i < formArray.length; i++){
        // returnArray[formArray[i]['name']] = formArray[i]['value'];
        if(formArray[i]['name'] != 'password'){
            if(formArray[i]['value'] == '' || formArray[i]['value'] == null){
                $('input[name="'+formArray[i]['name']+'"]').addClass('input-danger');
                $('input[name="'+formArray[i]['name']+'"]').siblings("small").remove();
                $('input[name="'+formArray[i]['name']+'"]').after('<small class="text-danger">Mohon ini di isi </small>');
                result = false;
            }else{
                $('input[name="'+formArray[i]['name']+'"]').removeClass('input-danger');
                $('input[name="'+formArray[i]['name']+'"]').siblings("small").remove();
                result = true;
            }
        }
        
        
    }
    if(form != null){
        var select = form.find("select");
        var textarea = form.find("textarea");
        for (var i = 0; i < select.length; i++){
            if(select[i].value == 'default'){
                $('select[name="'+select[i].name+'"]').addClass('input-danger');
                $('select[name="'+select[i].name+'"]').siblings().remove();
                $('select[name="'+select[i].name+'"]').after('<small class="text-danger">Mohon ini di isi </small>');
                result = false;
            }else{
                $('select[name="'+select[i].name+'"]').removeClass('input-danger');
                $('select[name="'+select[i].name+'"]').siblings().remove();
                result = true;
            }
        }
        for (var j = 0; j < textarea.length; j++){
            if(textarea[i]['value'] == '' || textarea[i]['value'] == null){
                $('textarea[name="'+textarea[j]['name']+'"]').addClass('input-danger');
                $('textarea[name="'+textarea[j]['name']+'"]').siblings("small").remove();
                $('textarea[name="'+textarea[j]['name']+'"]').after('<small class="text-danger">Mohon ini di isi </small>');
                result = false;
            }else{
                $('textarea[name="'+textarea[j]['name']+'"]').removeClass('input-danger');
                $('textarea[name="'+textarea[j]['name']+'"]').siblings("small").remove();
                result = true;
            }
        }

    }
    return result;
}


// AKKORDION
(function() {
    var d = document,
      accordionToggles = $(document).find('.js-accordionTrigger'),
      setAria,
      setAccordionAria,
      switchAccordion,
      touchSupported = ('ontouchstart' in window),
      pointerSupported = ('pointerdown' in window);
    console.log(accordionToggles.prevObject[0]);
    console.log(accordionToggles.length);
    skipClickDelay = function(e) {
      e.preventDefault();
      e.target.click();
    }

    setAriaAttr = function(el, ariaType, newProperty) {
      el.setAttribute(ariaType, newProperty);
    };
    setAccordionAria = function(el1, el2, expanded) {
      switch (expanded) {
        case "true":
          setAriaAttr(el1, 'aria-expanded', 'true');
          setAriaAttr(el2, 'aria-hidden', 'false');
          break;
        case "false":
          setAriaAttr(el1, 'aria-expanded', 'false');
          setAriaAttr(el2, 'aria-hidden', 'true');
          break;
        default:
          break;
      }
    };
    //function
    switchAccordion = $(document).on("click", ".accordionTitle ", function(e) {
      console.log("triggered");
      e.preventDefault();
      var thisAnswer = e.target.parentNode.nextElementSibling;
      var thisQuestion = e.target;
      if (thisAnswer.classList.contains('is-collapsed')) {
        setAccordionAria(thisQuestion, thisAnswer, 'true');
      } else {
        setAccordionAria(thisQuestion, thisAnswer, 'false');
      }
      thisQuestion.classList.toggle('is-collapsed');
      thisQuestion.classList.toggle('is-expanded');
      thisAnswer.classList.toggle('is-collapsed');
      thisAnswer.classList.toggle('is-expanded');

      thisAnswer.classList.toggle('animateIn');
    });
    for (var i = 0, len = accordionToggles.prevObject.length; i < len; i++) {
      if (touchSupported) {
        accordionToggles.prevObject[i].addEventListener('touchstart', skipClickDelay, false);
      }
      if (pointerSupported) {
        accordionToggles.prevObject[i].addEventListener('pointerdown', skipClickDelay, false);
      }
      accordionToggles.prevObject[i].addEventListener('click', switchAccordion, false);
    }
  })();