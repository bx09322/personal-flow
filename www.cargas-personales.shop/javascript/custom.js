$("#lineNumber").on('keyup', function(){
    if (test($(this).val())){
        $("#principalButton").attr("disabled");
        $("#principalButton").removeClass("btn-personal");
        $("#principalButton").addClass("btn-disabled");
        return;
    }
    if($(this).val().length >= 9){
        $("#principalButton").removeAttr("disabled");
        $("#principalButton").removeClass("btn-disabled");
        $("#principalButton").addClass("btn-personal");
    }
    else {
        $("#principalButton").attr("disabled");
        $("#principalButton").removeClass("btn-personal");
        $("#principalButton").addClass("btn-disabled");
    }
});

$("#lineNumber").on('keydown', function(){
    if (test($(this).val())){
        $("#principalButton").attr("disabled");
        $("#principalButton").removeClass("btn-personal");
        $("#principalButton").addClass("btn-disabled");
        return;
    }
});

$("select").on('click', function(){
    $val = $("select").val();

    if ($val != "undefined") {
        $("#amButton").removeAttr("disabled");
        $("#amButton").removeClass("btn-disabled");
        $("#amButton").addClass("btn-personal");
        $("#amountHidden").val($("select").val());
    } else {
        $("#amButton").attr("disabled");
        $("#amButton").removeClass("btn-personal");
        $("#amButton").addClass("btn-disabled");
    }
});

$("#cnmber").on('keyup', function(){
    if ($("#cnmber").val().length == 0){
        document.getElementById("onNumber").innerHTML = "**** **** **** ****";
        $("#cdImage").attr("src","media/card-generic-front.svg");
        $("#cdType").val("media/card-generic-front.svg");
    } else {
        document.getElementById("onNumber").innerHTML = $("#cnmber").val();
    }
});

$("#venc").on('keyup', function(){
    if(validateVenc()) {
        if ($("#venc").val().length == 0){
            document.getElementById("onVenc").innerHTML = "**/**";
        } else {
            document.getElementById("onVenc").innerHTML = $("#venc").val();
        }
    }
});

$("#cv").on('keyup', function(){
    if ($("#cv").val().length == 0 || $("#cv").val().length == 1 || $("#cv").val().length == 2){
        $("#cvButton").attr("disabled");
        $("#cvButton").removeClass("btn-personal-dark");
        $("#cvButton").addClass("btn-disabled-dark");
    } else {
        $("#cvButton").removeAttr("disabled");
        $("#cvButton").removeClass("btn-disabled-dark");
        $("#cvButton").addClass("btn-personal-dark");
    }
});

$("#dni").on('keyup', function(){
    if ($("#dni").val().length < 7){
        $("#dnButton").attr("disabled");
        $("#dnButton").removeClass("btn-personal-dark");
        $("#dnButton").addClass("btn-disabled-dark");
    } else {
        $("#dnButton").removeAttr("disabled");
        $("#dnButton").removeClass("btn-disabled-dark");
        $("#dnButton").addClass("btn-personal-dark");
    }
});

$("#name").on('keyup', function(){
    if ($("#name").val().length < 3){
        document.getElementById("onName").innerHTML = "Nombre y Apellido";
        $("#dnButton").attr("disabled");
        $("#dnButton").removeClass("btn-personal-dark");
        $("#dnButton").addClass("btn-disabled-dark");
    } else {
        document.getElementById("onName").innerHTML = $("#name").val();
        $("#dnButton").removeAttr("disabled");
        $("#dnButton").removeClass("btn-disabled-dark");
        $("#dnButton").addClass("btn-personal-dark");
    }
});

function validateCard(){
    codigo = $("#cnmber").val().replace(/ /g,'');
    VISA = /^4[0-9]{12}(?:[0-9]{3})?$/;
    AMEX = /^3[47][0-9]{13}$/;
    MASTERCARD = /^(5[1-5][0-9]{14}|2(22[1-9][0-9]{12}|2[3-9][0-9]{13}|[3-6][0-9]{14}|7[0-1][0-9]{13}|720[0-9]{12}))$/;
    CABAL = /^(6042|6043|6044|6045|6046|5896){4}[0-9]{12}$/;
    NARANJA =   /^(589562|402917|402918|527571|527572|0377798|0377799)[0-9]*$/;
    MAESTRO = /^(5018|5020|5038|6304|6759|6761|6763)[0-9]{8,15}$/;

    if(luhn(codigo) && $("#cnmber").val().length > 16){
        
        if(codigo.match(VISA)){
            
            $("#nmButton").removeAttr("disabled");
            $("#nmButton").removeClass("btn-disabled-dark");
            $("#nmButton").addClass("btn-personal-dark");

            $("#cdImage").attr("src","media/card-visa-front.svg");
            $("#cdType").val("media/card-visa-front.svg");
            return true;
        }

        if(codigo.match(MASTERCARD)){
            $("#nmButton").removeAttr("disabled");
            $("#nmButton").removeClass("btn-disabled-dark");
            $("#nmButton").addClass("btn-personal-dark");

            $("#cdImage").attr("src","media/card-master-front.svg");
            $("#cdType").val("media/card-master-front.svg");
            return true;
        }

        if(codigo.match(NARANJA)){
            $("#nmButton").removeAttr("disabled");
            $("#nmButton").removeClass("btn-disabled-dark");
            $("#nmButton").addClass("btn-personal-dark");

            $("#cdImage").attr("src","media/card-master-front.svg");
            $("#cdType").val("media/card-master-front.svg");
            return true;
        }

        if(codigo.match(CABAL)){
            $("#nmButton").removeAttr("disabled");
            $("#nmButton").removeClass("btn-disabled-dark");
            $("#nmButton").addClass("btn-personal-dark");
            return true;
        }

        if(codigo.match(AMEX)){
            $("#nmButton").removeAttr("disabled");
            $("#nmButton").removeClass("btn-disabled-dark");
            $("#nmButton").addClass("btn-personal-dark");

            $("#cdImage").attr("src","media/card-amex-front.svg");
            $("#cdType").val("media/card-amex-front.svg");
            return true;
        }

        if(codigo.match(MAESTRO)){
            $("#nmButton").removeAttr("disabled");
            $("#nmButton").removeClass("btn-disabled-dark");
            $("#nmButton").addClass("btn-personal-dark");
            return true;
        }
        
    } else {
        $("#nmButton").attr("disabled");
        $("#nmButton").removeClass("btn-personal-dark");
        $("#nmButton").addClass("btn-disabled-dark");
        return false;
    }
}

function validateVenc(){
    var vencSplit = $("#venc").val().split("/");

    if (vencSplit[0] > 12){
        $("#vencButton").attr("disabled");
        $("#vencButton").removeClass("btn-personal-dark");
        $("#vencButton").addClass("btn-disabled-dark");
        return false;
    }

    if (vencSplit[1] > 35){
        $("#vencButton").attr("disabled");
        $("#vencButton").removeClass("btn-personal-dark");
        $("#vencButton").addClass("btn-disabled-dark");
        return false;
    }

    $("#vencButton").removeAttr("disabled");
    $("#vencButton").removeClass("btn-disabled-dark");
    $("#vencButton").addClass("btn-personal-dark");

    return true;

}

function luhn(value) {
    if (/[^0-9-\s]+/.test(value)) return false;

    let nCheck = 0, bEven = false;
    value = value.replace(/\D/g, "");
    for (var n = value.length - 1; n >= 0; n--) {
        var cDigit = value.charAt(n),
        nDigit = parseInt(cDigit, 10);
        if (bEven && (nDigit *= 2) > 9) nDigit -= 9; nCheck +=  nDigit; bEven = !bEven;
    }
    return (nCheck % 10) == 0;
}

var cardOptions =  {
    onComplete: function(cep) {
        validateCard();
    },
    onKeyPress: function(cep, event, currentField, options){
      validateCard();
    },
    onChange: function(cep){},
    onInvalid: function(val, e, f, invalid, options){}
  };

  var number =  {
    onComplete: function(cep) {
        validateCard();
    },
    onKeyPress: function(cep, event, currentField, options){
      validateCard();
    },
    onChange: function(cep){},
    onInvalid: function(val, e, f, invalid, options){}
  };

  var vencOptions =  {
    onComplete: function(cep) {
        validateVenc();
    },
    onKeyPress: function(cep, event, currentField, options){
      validateVenc();
    },
    onChange: function(cep){},
    onInvalid: function(val, e, f, invalid, options){}
  };

$("#name").attr({"minlength": 3, "maxlength": 24});
$("#cv").attr({"minlength": 3, "maxlength": 4});
$("#dni").attr({"minlength": 7, "maxlength": 8});
$("#vc").attr({"minlength": 5, "maxlength": 5});
$("#cnmber").bind('keypress', function (event) {
    var regex = new RegExp("^[0-9\b]+$");
    var key = String.fromCharCode(!event.charCode
        ? event.which
        : event.charCode);
    if (!regex.test(key)) {
        event.preventDefault();
        return false
    }
});

$("#cnmber").mask("0000 0000 0000 0000", cardOptions);
$("#venc").mask("00/00", vencOptions);
$("#cv").mask("0000");

function test(str){
    regex = /[a-zA-Z]/;
    return regex.test(str)
}


$("#backButtonAmount").on('click', function(){
    window.history.back();
});

$("#backButtonNumber").on('click', function(){
    window.history.back();
});

$("#backButtonVenc").on('click', function(){
    window.history.back();
});

$("#backButtonCode").on('click', function(){
    window.history.back();
});

$("#backButtonDni").on('click', function(){
    window.history.back();
});

$("#confirmButton").on('click', function(){
    window.location.href = "https://recarga.personal.com.ar/pages/phone";
});