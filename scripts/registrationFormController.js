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
            case 14 :
                return errorStrings.imageSize;
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
            if(objId == "birthdayDay" || objId == "birthdayYear" || objId == "birthdayMonth"){
                this.updateClasses(objId, "formInvalid", "formValid",  null, null);
                if(errorInfo.birthdayError.day.correct === false){
                    this.updateText("birthday", errorInfo.birthdayError.day.type);
                } else if(errorInfo.birthdayError.month.correct === false){
                    this.updateText("birthday", errorInfo.birthdayError.month.type);
                } else if(errorInfo.birthdayError.year.correct === false){
                    this.updateText("birthday", errorInfo.birthdayError.year.type);
                } else {
                    this.updateClasses(objId, "formInvalid", "formValid", "birthday", {"visibility" : "hidden"});
                }
            } else {
                this.updateClasses(objId, "formInvalid", "formValid", objId, {"visibility" : "hidden"});
            }
        }
    }
}

var inputDataController = {
    emailReg : /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i,
    isValid : function (str){
        return !/[~`!#$%\^&*+=\-\[\]\\';,./{}|\\":<>\?0-9\s]/g.test(str);
    },
    name : function(obj){
        if(obj.value.length > 0){
            if(this.isValid(obj.value)){
                errorInfo.updateErrorInfo(errorInfo.nameError, true, errorInfo.errorType.noErrors);
                viewController.changeView(obj.getAttribute('id'), errorInfo.errorType.noErrors);
            } else {
                errorInfo.updateErrorInfo(errorInfo.nameError, false, errorInfo.errorType.notALetter);
                viewController.changeView(obj.getAttribute('id'), errorInfo.errorType.notALetter);
            }
        } else {
            errorInfo.updateErrorInfo(errorInfo.nameError, false, errorInfo.errorType.empty);
            viewController.changeView(obj.getAttribute('id'), errorInfo.errorType.empty);
        }
    },
    surname : function(obj){
        if(obj.value.length > 0){
            if(this.isValid(obj.value)){
                errorInfo.updateErrorInfo(errorInfo.surnameError, true, errorInfo.errorType.noErrors);
                viewController.changeView(obj.getAttribute('id'), errorInfo.errorType.noErrors);
            } else {
                errorInfo.updateErrorInfo(errorInfo.surnameError, false, errorInfo.errorType.notALetter);
                viewController.changeView(obj.getAttribute('id'), errorInfo.errorType.notALetter);
            }
        } else {
            errorInfo.updateErrorInfo(errorInfo.surnameError, false, errorInfo.errorType.empty);
            viewController.changeView( obj.getAttribute('id'), errorInfo.errorType.empty);
        }
    },
    email : function(obj){
        if(obj.value.length > 0){
            if(this.emailReg.test(obj.value)){
                var oReq = new XMLHttpRequest(); //New request object
                oReq.onload = function() {
                    console.log(this.responseText);
                    if(this.responseText == "1"){
                        errorInfo.updateErrorInfo(errorInfo.emailError, true, errorInfo.errorType.noErrors);
                        viewController.changeView(obj.getAttribute('id'), errorInfo.errorType.noErrors);
                    } else if(this.responseText == "0") {
                        errorInfo.updateErrorInfo(errorInfo.emailError, true, errorInfo.errorType.emailExist);
                        viewController.changeView(obj.getAttribute('id'), errorInfo.errorType.emailExist);
                    }
                };
                oReq.open("GET", "http://webmaster23.16mb.com/checkEmailExist.php?email=" + obj.value, true);
                oReq.send();
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
    birthday : {
        numbers : ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'],
        day : function(obj) {
            if(obj.value <= 31 && obj.value >= 1){
                errorInfo.updateErrorInfo(errorInfo.birthdayError.day, true, errorInfo.errorType.noErrors);
                viewController.changeView(obj.getAttribute('id'), errorInfo.errorType.noErrors);
            } else {
                errorInfo.updateErrorInfo(errorInfo.birthdayError.day, false, errorInfo.errorType.birthdayDayRange);
                viewController.changeView(obj.getAttribute('id'), errorInfo.errorType.birthdayDayRange);
            }
        },
        month : function(obj){
            if(document.getElementById("birthdayMonth").selectedIndex == 0){
                errorInfo.updateErrorInfo(errorInfo.birthdayError.month, false, errorInfo.errorType.empty);
                viewController.changeView(obj.getAttribute('id'), errorInfo.errorType.empty);
            } else {
                errorInfo.updateErrorInfo(errorInfo.birthdayError.month, true, errorInfo.errorType.noErrors);
                viewController.changeView(obj.getAttribute('id'), errorInfo.errorType.noErrors);
            }
        },
        year : function(obj){
            var date = new Date().getFullYear();
            if(obj.value <= date && obj.value >= date - 150){
                errorInfo.updateErrorInfo(errorInfo.birthdayError.year, true, errorInfo.errorType.noErrors);
                viewController.changeView(obj.getAttribute('id'), errorInfo.errorType.noErrors);
            } else {
                errorInfo.updateErrorInfo(errorInfo.birthdayError.year, false, errorInfo.errorType.birthdayYearRange);
                viewController.changeView(obj.getAttribute('id'), errorInfo.errorType.birthdayYearRange);
            }
        }
    },
    gender: function(obj){
        var e = document.getElementById("selectGender");
        if(e.options[e.selectedIndex].value == 0){
            errorInfo.updateErrorInfo(errorInfo.genderError, false, errorInfo.errorType.empty);
            viewController.changeView(obj.getAttribute('id'), errorInfo.errorType.empty);
        } else {
            errorInfo.updateErrorInfo(errorInfo.genderError, true, errorInfo.errorType.noErrors);
            viewController.changeView(obj.getAttribute('id'), errorInfo.errorType.noErrors);
        }
    },
    imageUpload : function(evt) {
        if (!evt.target.files[0].type.match('image.*')) {
            errorInfo.updateErrorInfo(errorInfo.imageError, false, errorInfo.errorType.notAnImage);
            viewController.changeView('files', errorInfo.errorType.notAnImage);
        } else if(evt.target.files[0].size > 64000){
            errorInfo.updateErrorInfo(errorInfo.imageError, false, errorInfo.errorType.imageSize);
            viewController.changeView('files', errorInfo.errorType.imageSize);
        } else {
            var fileType = evt.target.files[0].name.charAt(evt.target.files[0].name.length - 3)
                + evt.target.files[0].name.charAt(evt.target.files[0].name.length - 2)
                + evt.target.files[0].name.charAt(evt.target.files[0].name.length - 1);

            if (fileType == "png" || fileType == "jpg" || fileType == "gif") {
                if (evt.target.files[0].type.match('image.*')) {
                    var reader = new FileReader();
                    reader.onload = (function (theFile) {
                        return function (e) {
                            if(document.getElementById("imageSpan") == null){
                                var span = document.createElement('span');
                                span.setAttribute("id", "imageSpan");
                                span.innerHTML = ['<img class="thumb" id="userImage" src="', e.target.result,
                                    '" title="', escape(theFile.name), '"/>'].join('');
                                document.getElementById('list').insertBefore(span, null);
                            } else {
                                $('#userImage').attr('src', e.target.result);
                            }
                        };
                    })(evt.target.files[0]);
                    // Read in the image file as a data URL.
                    reader.readAsDataURL(evt.target.files[0]);
                    errorInfo.updateErrorInfo(errorInfo.imageError, true, errorInfo.errorType.noErrors);
                    viewController.changeView('files', errorInfo.errorType.noErrors);
                }
            } else {
                errorInfo.updateErrorInfo(errorInfo.imageError, false, errorInfo.errorType.imageFormat);
                viewController.changeView('files', errorInfo.errorType.imageFormat);
            }
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
        if(!errorInfo.nameError.correct){
            viewController.changeView('name', errorInfo.nameError.type);
        }

        if(!errorInfo.surnameError.correct){
            viewController.changeView('surname', errorInfo.surnameError.type);
        }

        if(!errorInfo.emailError.correct){
            viewController.changeView('email', errorInfo.emailError.type);
        }

        if(!errorInfo.passwordError.correct){
            viewController.changeView('password', errorInfo.passwordError.type);
        }

        if(!errorInfo.nameError.correct){
            viewController.changeView('birthdayDay', errorInfo.birthdayError.day.type);
        }
        if(!errorInfo.birthdayError.month.correct){
            viewController.changeView('birthdayMonth', errorInfo.birthdayError.month.type);
        }

        if(!errorInfo.birthdayError.year.correct){
            viewController.changeView('birthdayYear', errorInfo.birthdayError.year.type);
        }

        if(!errorInfo.genderError.correct){
            viewController.changeView('selectGender', errorInfo.genderError.type);
        }

        if(!errorInfo.imageError.correct){
            viewController.changeView('files', errorInfo.imageError.type);
        }

        if(!errorInfo.captchaError.correct){
            viewController.changeView('captcha', errorInfo.captchaError.type);
        }
    }
}

document.getElementById('files').addEventListener('change',  inputDataController.imageUpload, false);