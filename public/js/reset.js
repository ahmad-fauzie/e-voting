function show1() {
    document.getElementById('password').setAttribute('type', 'text');
}
function show2() {
    document.getElementById('password-confirm').setAttribute('type', 'text');
}

function hide1() {
    document.getElementById('password').setAttribute('type', 'password');
}
function hide2() {
    document.getElementById('password-confirm').setAttribute('type', 'password');
}

var pwShown1 = 0;
var pwShown2 = 0;

document.getElementById("eye1").addEventListener("click", function () {
    if (pwShown1 == 0) {
        pwShown1 = 1;
        show1();
    } else {
        pwShown1 = 0;
        hide1();
    }
}, false);

document.getElementById("eye2").addEventListener("click", function () {
    if (pwShown2 == 0) {
        pwShown2 = 1;
        show2();
    } else {
        pwShown2 = 0;
        hide2();
    }
}, false);