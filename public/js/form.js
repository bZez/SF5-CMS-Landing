$(function () {
    setTimeout(function () {
        $('#fader').fadeOut();
        $('#site').css('filter','none');
    },500)

})
var currentTab = 0; // Current tab is set to be the first tab (0)
var x = $('.tab');
showTab(currentTab); // Display the current tab
$('#stepmax').html(x.length);
function showTab(n) {
    // This function will display the specified tab of the form...
    var x = document.getElementsByClassName("tab");
    x[n].style.display = "block";
    //... and fix the Previous/Next buttons:
    if (n == 0) {
        document.getElementById("prevBtn").style.display = "none";
    } else {
        document.getElementById("prevBtn").style.display = "inline";
    }
    if (n == (x.length - 1)) {
        document.getElementById("nextBtn").innerHTML = "Envoyer";
    } else if (n == (x.length -2)) {
        document.getElementById("nextBtn").innerHTML = "Suivant";

    }
    //... and run a function that will display the correct step indicator:
    fixStepIndicator(n)
}

function nextPrev(n) {
    // This function will figure out which tab to display
    var x = document.getElementsByClassName("tab");
    // Exit the function if any field in the current tab is invalid:
    if (n == 1 && !validateForm()) return false;
    // Hide the current tab:
    x[currentTab].style.display = "none";
    // Increase or decrease the current tab by 1:
    currentTab = currentTab + n;
    // if you have reached the end of the form...
    if (currentTab >= x.length) {
        // ... the form gets submitted:
        $.post( "_/register",$('#regForm').serialize(), function( data ) {
            $('body').removeClass('overflow-hidden');
            $('html, body').animate({scrollTop: $('#eligibilite').offset().top -100 }, 'fast');
            $('#regForm').replaceWith("<h1 class='h5'>Merci, vous avez terminé votre demande d'information. <br><br>" +
                "Vos informations ont bien été envoyées. Un opérateur vous contactera dans les prochaines 48 heures afin de vérifier avec vous certaines informations pour valider votre demande. Merci de ne pas faire de multiples demandes afin de garder votre éligibilité au programme.</h1>");
                gtag('event', 'conversion', {'send_to': 'AW-710428717/nuq0CL2Vl8YBEK2Q4dIC'});
        });
        return false;
    }
    // Otherwise, display the correct tab:
    showTab(currentTab);
}

function validateForm() {
    // This function deals with validation of the form fields
    var x, y, i, valid = true;
    x = document.getElementsByClassName("tab");
    y = x[currentTab].getElementsByTagName("input");
    // A loop that checks every input field in the current tab:
    for (i = 0; i < y.length; i++) {
        // If a field is empty...

        let lg = parseInt(y[i].getAttribute('minlength'));
        if (y[i].value.length < lg) {
            // add an "invalid" class to the field:
            y[i].className += " invalid";
            // and set the current valid status to false
            valid = false;
        }
    }
    // If the valid status is true, mark the step as finished and valid:
    if (valid) {
        document.getElementsByClassName("step")[currentTab].className += " finish";
    }
    return valid; // return the valid status
}

function fixStepIndicator(n) {
    // This function removes the "active" class of all steps...
    var i, x = document.getElementsByClassName("step");
    for (i = 0; i < x.length; i++) {
        x[i].className = x[i].className.replace(" active", "");
    }
    $('#stepcount').html(n+1);
    if((n+1)===6) {
        $('#nextBtn').removeAttr('hidden');
    }
    //... and adds the "active" class on the current step:
    x[n].className += " active";
}