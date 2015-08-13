/**
 * Created by Sohan on 10.08.2015.
 */

/**
 * Created by Sohan on 07.07.2015.
 */


function sendData(){
    if(errorInfo.containErrors()){
        if(errorInfo.nameError.correct == undefined){
            errorInfo.updateErrorInfo(errorInfo.nameError, false, errorInfo.errorType.empty);
            viewController.changeView('name', errorInfo.errorType.empty);
        }
        if(errorInfo.surnameError.correct == undefined){
            errorInfo.updateErrorInfo(errorInfo.surnameError, false, errorInfo.errorType.empty);
            viewController.changeView('surname', errorInfo.errorType.empty);
        }
        if(errorInfo.emailError.correct == undefined){
            errorInfo.updateErrorInfo(errorInfo.emailError, false, errorInfo.errorType.empty);
            viewController.changeView('email', errorInfo.errorType.empty);
        }
        if(errorInfo.passwordError.correct == undefined){
            errorInfo.updateErrorInfo(errorInfo.passwordError, false, errorInfo.errorType.empty);
            viewController.changeView('password', errorInfo.errorType.empty);
        }
        if(errorInfo.birthdayError.day.correct == undefined){
            errorInfo.updateErrorInfo(errorInfo.birthdayError.day, false, errorInfo.errorType.empty);
            viewController.changeView('birthdayDay', errorInfo.errorType.empty);
        }
        if(errorInfo.birthdayError.month.correct == undefined){
            errorInfo.updateErrorInfo(errorInfo.birthdayError.month, false, errorInfo.errorType.empty);
            viewController.changeView('birthdayMonth', errorInfo.errorType.empty);
        }
        if(errorInfo.birthdayError.year.correct == undefined){
            errorInfo.updateErrorInfo(errorInfo.birthdayError.year, false, errorInfo.errorType.empty);
            viewController.changeView('birthdayYear', errorInfo.errorType.empty);
        }
        if(errorInfo.genderError.correct == undefined){
            errorInfo.updateErrorInfo(errorInfo.genderError, false, errorInfo.errorType.empty);
            viewController.changeView('selectGender', errorInfo.errorType.empty);
        }
        if(errorInfo.captchaError.correct == undefined){
            errorInfo.updateErrorInfo(errorInfo.captchaError, false, errorInfo.errorType.empty);
            viewController.changeView('captcha', errorInfo.errorType.empty);
        }
    } else {
        $("#registrationForm").submit();
    }
}

var captchaController = {
    captchaID : undefined,
    getCaptchaID : function(){
        this.captchaID = (Math.floor(Math.random() * 8388607) + 1);
        $('#captchaID').text(this.captchaID);
        return this.captchaID;
    },
    updateCaptcha : function() {
        $('#captchaImage').attr('src', 'images/preloader.gif');
        $('#captchaImage').attr('src', "http://webmaster23.16mb.com/captcha.php?removeID="
            + captchaController.captchaID + "&newID=" + captchaController.getCaptchaID() + "&t=" + new Date().getTime());
        $('#captchaID').text(this.captchaID);
    }
};

$('#captchaImage').attr('src', "http://webmaster23.16mb.com/captcha.php?newID=" + captchaController.getCaptchaID() + "&t=" + new Date().getTime());

var viewController = {
    updateClasses : function(attributeID, classToRemove, classToAdd, labelName, cssObj){
        if(attributeID != null){
            if(classToRemove != null){
                $("#" + attributeID).removeClass(classToRemove);
            }
            if(classToAdd != null){
                $("#" + attributeID).addClass(classToAdd);
            }
        }
        if(labelName != null){
            $("#" + labelName + "Label").css(cssObj);
        }
    },
    updateText : function(objId, errorType){
        $("#" + objId + "Label").text(this.getTextForError(errorType));
    },
    updateValue : function(objId, value){
        $("#" + objId).text(this.getTextForError(value));
    },
    getTextForError : function(errorType){
        switch (errorType){
            case 1 :
                return errorStrings.empty;
            case 2 :
                return errorStrings.notALetter;
            case 3 :
                return errorStrings.email;
            case 4 :
                return errorStrings.passwordMinLength;
            case 5 :
                return errorStrings.passwordMaxLength;
            case 6 :
                return errorStrings.imageFormat;
            case 7 :
                return errorStrings.birthdayDayNaN;
            case 8 :
                return errorStrings.birthdayDayRange;
            case 9 :
                return errorStrings.birthdayYearNaN;
            case 10 :
                return errorStrings.birthdayYearRange;
            case 11 :
                return errorStrings.notAnImage;
            case 12 :
                return errorStrings.captcha;
            case 13 :
                return errorStrings.emailExist;
        }
    },
    changeView : function(objId, errorType){
        //console.log(errorInfo);
        if(errorType > 0){
            if(objId == "birthdayDay" || objId == "birthdayYear" || objId == "birthdayMonth"){
                this.updateText("birthday", errorType);
                this.updateClasses(objId, "formValid", "formInvalid", "birthday", {"visibility" : "visible"});
            } else {
                this.updateText(objId, errorType);
                this.updateClasses(objId, "formValid", "formInvalid", objId, {"visibility" : "visible"});
            }
        } else {
            this.updateClasses(objId, "formInvalid", "formValid", objId, {"visibility" : "hidden"});
        }
    }
}

var inputDataController = {
    emailReg : /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i,
    isValid : function (str){
        return !/[~`!#$%\^&*+=\-\[\]\\';,./{}|\\":<>\?0-9\s]/g.test(str);
    },
    email : function(obj){
        if(obj.value.length > 0){
            if(this.emailReg.test(obj.value)){
                errorInfo.updateErrorInfo(errorInfo.emailError, true, errorInfo.errorType.noErrors);
                viewController.changeView(obj.getAttribute('id'), errorInfo.errorType.noErrors);
            } else {
                errorInfo.updateErrorInfo(errorInfo.emailError, false, errorInfo.errorType.email);
                viewController.changeView(obj.getAttribute('id'), errorInfo.errorType.email);
            }
        } else {
            errorInfo.updateErrorInfo(errorInfo.emailError, false, errorInfo.errorType.empty);
            viewController.changeView(obj.getAttribute('id'), errorInfo.errorType.empty);
        }
    },
    password : function(obj){
        if(obj.value.length > 0){
            if(obj.value.length > 7){
                if(obj.value.length < 100){
                    errorInfo.updateErrorInfo(errorInfo.passwordError, true, errorInfo.errorType.noErrors);
                    viewController.changeView(obj.getAttribute('id'), errorInfo.errorType.noErrors);
                } else {
                    errorInfo.updateErrorInfo(errorInfo.passwordError, false, errorInfo.errorType.passwordMaxLength);
                    viewController.changeView(obj.getAttribute('id'), errorInfo.errorType.passwordMaxLength);
                }
            } else {
                errorInfo.updateErrorInfo(errorInfo.passwordError, false, errorInfo.errorType.passwordMinLength);
                viewController.changeView(obj.getAttribute('id'), errorInfo.errorType.passwordMinLength);
            }
        } else {
            errorInfo.updateErrorInfo(errorInfo.passwordError, false, errorInfo.errorType.empty);
            viewController.changeView(obj.getAttribute('id'), errorInfo.errorType.empty);
        }
    },
    captcha : function(obj){
        if(obj.value.length > 0){
            errorInfo.updateErrorInfo(errorInfo.captchaError, true, errorInfo.errorType.noErrors);
            viewController.changeView(obj.getAttribute('id'), errorInfo.errorType.noErrors);
        } else {
            errorInfo.updateErrorInfo(errorInfo.captchaError, false, errorInfo.errorType.empty);
            viewController.changeView(obj.getAttribute('id'), errorInfo.errorType.empty);
        }
    }
}

var cookie = {
    setCookie : function(name, value, options) {
        options = options || {};

        var expires = options.expires;

        if (typeof expires == "number" && expires) {
            var d = new Date();
            d.setTime(d.getTime() + expires * 1000);
            expires = options.expires = d;
        }
        if (expires && expires.toUTCString) {
            options.expires = expires.toUTCString();
        }

        value = encodeURIComponent(value);

        var updatedCookie = name + "=" + value;

        for (var propName in options) {
            updatedCookie += "; " + propName;
            var propValue = options[propName];
            if (propValue !== true) {
                updatedCookie += "=" + propValue;
            }
        }

        document.cookie = updatedCookie;
    },
    deleteCookie : function(name) {
        this.setCookie(name, "", {
            expires: -1
        })
    },
    getCookie : function(name) {
        var matches = document.cookie.match(new RegExp(
            "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
        ));
        return matches ? decodeURIComponent(matches[1]) : undefined;
    }
}

function showDataErrors(){
    if(errorInfo.dataChecked){
        if(!errorInfo.emailError.correct){
            viewController.changeView('email', errorInfo.emailError.type);
        }

        if(!errorInfo.passwordError.correct){
            viewController.changeView('password', errorInfo.passwordError.type);
        }
    }
}

showDataErrors();