var countRecaptcha = 0;
var continueAdCount = 0;
var activeExpiredUrl = null;

/*
 * countDownAfterRecaptcha Methods
 */
function countDownAfterRecaptcha(callback) {
    let recaptchaCountdown = document.getElementById('recaptcha-countdown');
    if (recaptchaCountdown) {
        let progressElm = document.getElementsByClassName('progress')[0];
        let circumference = 2 * Math.PI * progressElm.getAttribute('r');

        progressElm.style.strokeDasharray = circumference;
        progressElm.style.strokeDashoffset = 0;

        let max = 15;
        let seconds = max;

        let secondsElm = document.getElementsByClassName('seconds')[0];

        let timerId = setInterval(() => {
            seconds--;
            if(seconds <= 0) {
                callback();
                document.getElementsByClassName('seconds')[0].textContent = 20;
                clearInterval(timerId);
            }
            percentage = seconds/max * 100;
            progressElm.style.strokeDashoffset = circumference - (percentage/100) * circumference;

            secondsElm.textContent = seconds.toString().padStart(2, '0');
        }, 1000);
    }
}

function handleRecaptchaFormCountDown (isFormHide) {
    let recaptchaForm = document.getElementById('recaptcha-form');
    let recaptchaCountdown = document.getElementById('recaptcha-countdown');
    if (isFormHide) {
        recaptchaForm.classList.add('d-none');
        recaptchaCountdown.classList.remove('d-none');
    } else {
        recaptchaCountdown.classList.add('d-none');
        recaptchaForm.classList.remove('d-none');
    }
}

async function submitRecaptchaForm(event) {
    event.preventDefault();
    let csrf = document.querySelector("[name='csrf-token']");
    // find the prev recaptcha
    let recaptchaPrevElement = document.getElementById('googleRecaptcha-' + countRecaptcha);
    let gRecaptchaInput = recaptchaPrevElement.querySelector('[name="g-recaptcha-response"]');
    if (countRecaptcha > 0) {
        gRecaptchaInput = recaptchaPrevElement.querySelector('[name="g-recaptcha-response"]');
    }
    let alert = document.getElementById('recaptchaError');
    if (gRecaptchaInput.value) {
        const form = { _token: csrf.getAttribute('content'), gRecaptcha: gRecaptchaInput.value };
        let response = await fetch('/recaptcha', {method: 'POST',
            headers: {'Content-Type': 'application/json',}, body: JSON.stringify(form)}
        );
        if (response.status === 201) {
            if (!alert.classList.contains('d-none')) alert.classList.add('d-none');
            // Show Countdown UI
            handleRecaptchaFormCountDown(true);
            // openAds for recaptcha
            openAdsAfterSubmit(countRecaptcha);
            // Countdown start and close
            countDownAfterRecaptcha(() => {
                // Hide Countdown UI
                handleRecaptchaFormCountDown(false);
                if (recaptchaPrevElement && !recaptchaPrevElement.classList.contains('d-none')) {
                    recaptchaPrevElement.classList.add('d-none');
                }
                countRecaptcha++;
                // find the new recaptcha
                let recaptchaNewElement = document.getElementById('googleRecaptcha-' + countRecaptcha);
                if (recaptchaNewElement && recaptchaNewElement.classList.contains('d-none')) {
                    recaptchaNewElement.classList.remove('d-none');
                }
                if (countRecaptcha === 4) {
                    let isSaved = handleUpdateCreateLocalStorage('hCaptcha-url-history');
                    if (isSaved) {
                        window.location.reload();
                    }
                }
            });
        } else {
            if (alert.classList.contains('d-none')) alert.classList.remove('d-none');
        }
    } else {
        if (alert.classList.contains('d-none')) alert.classList.remove('d-none');
    }
}

function showHideModal(id) {
    let modal = document.getElementById(id);
    if (modal.classList.contains('show')) {
        modal.classList.remove('show');
        modal.style.display = 'none';
    } else {
        modal.classList.add('show');
        modal.style.display = 'block';
    }
}

function openAdsAfterSubmit(key) {
    let getLength = key + 1;
    let hCaptchaAds = document.querySelectorAll('[data-hCaptcha-ads]');
    let customAds = document.querySelectorAll('[data-custom-ads]');
    if (hCaptchaAds.length >= getLength) {
        if (hCaptchaAds[key]) {
            window.open(hCaptchaAds[key].querySelector('a').getAttribute('href'), '_blank');
        }
    } else {
        let getRandomInt =  Math.floor(Math.random() * 5);
        if (customAds[getRandomInt]) {
            window.open(customAds[getRandomInt].querySelector('a').getAttribute('href'), '_blank');
        }
    }
}

/*
 * Continue page handle
 */
function continuePagePopup () {
    let getParsed = JSON.parse(localStorage.getItem('continue-url-history'));
    if (!getParsed) {
        showHideModal('continue-page-modal');
        handleContinueClick();
        activeExpiredUrl = null;
    } else {
        let currentTime = new Date().getTime();
        let currentPath = window.location.pathname;
        let findUrl = getParsed.find((item) => item.url === currentPath);
        if (findUrl) {
            if (findUrl.expireAt < currentTime) {
                showHideModal('continue-page-modal');
                handleContinueClick();
                activeExpiredUrl = findUrl.url;
            }
        } else {
            showHideModal('continue-page-modal');
            handleContinueClick();
            activeExpiredUrl = null;
        }
    }
}

function handleContinueClick() {
    let continueBtn = document.getElementById('continue-btn');
    let continueAds = document.querySelectorAll('[data-continue-ads]');
    continueBtn.addEventListener('click', function (event) {
        event.preventDefault();
        if (continueAdCount === 2) {
            const isHandleAds = handleUpdateCreateLocalStorage('continue-url-history');
            if (isHandleAds) {
                window.location.reload();
            }
        } else {
            window.open(continueAds[continueAdCount].querySelector('a').getAttribute('href'), '_blank');
            continueAdCount++;
        }
    })
}

/*
 * hCaptcha section handle
 */
function hCaptchaSectionShowHide() {
    let getParsed = JSON.parse(localStorage.getItem('hCaptcha-url-history'));
    let recaptchaGoogle = document.getElementById('recaptchaGoogle');
    if (!getParsed) {
        showHideModal('captcha-section');
        activeExpiredUrl = null;
        recaptchaGoogle.addEventListener('submit', submitRecaptchaForm);
    } else {
        let currentTime = new Date().getTime();
        let currentPath = window.location.pathname;
        let findUrl = getParsed.find((item) => item.url === currentPath);
        if (findUrl) {
            if (findUrl.expireAt < currentTime) {
                showHideModal('captcha-section');
                activeExpiredUrl = findUrl.url;
                recaptchaGoogle.addEventListener('submit', submitRecaptchaForm);
            }
        } else {
            showHideModal('captcha-section');
            activeExpiredUrl = null;
            recaptchaGoogle.addEventListener('submit', submitRecaptchaForm);
        }
    }
}

function handleUpdateCreateLocalStorage(key) {
    if (key) {
        let storageData = JSON.parse(localStorage.getItem(key));
        let data = {
            status: true,
            url: window.location.pathname,
            expireAt: new Date().getTime() + (1000 * 60 * 60 * 24) // 24 hours
        };
        if (storageData) {
            if (activeExpiredUrl !== null) {
                // remove expired item
                storageData = storageData.filter((item) => item.url !== activeExpiredUrl);
            }
            // push new item
            storageData.push(data);
            localStorage.setItem(key, JSON.stringify(storageData));
            return true;
        } else {
            localStorage.setItem(key, JSON.stringify([data]));
            return true;
        }
    }
    return false;
}

window.addEventListener('DOMContentLoaded', (event) => {
    continuePagePopup();
    hCaptchaSectionShowHide();
});

const myObj = {
    onCLick: () => {

    }
}
