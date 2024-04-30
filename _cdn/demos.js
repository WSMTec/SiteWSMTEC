document.addEventListener('DOMContentLoaded', function () {
//  var typed = new Typed('#typed', {
//    stringsElement: '#typed-strings',
//    typeSpeed: 40, 
//    backSpeed: 30,
//    startDelay: 200,
//    loop: false,
//    loopCount: Infinity,
//    onComplete: function(self) { prettyLog('onComplete ' + self) },
//    preStringTyped: function(pos, self) { prettyLog('preStringTyped ' + pos + ' ' + self); },
//    onStringTyped: function(pos, self) { prettyLog('onStringTyped ' + pos + ' ' + self) },
//    onLastStringBackspaced: function(self) { prettyLog('onLastStringBackspaced ' + self) },
//    onTypingPaused: function(pos, self) { prettyLog('onTypingPaused ' + pos + ' ' + self) },
//    onTypingResumed: function(pos, self) { prettyLog('onTypingResumed ' + pos + ' ' + self) },
//    onReset: function(self) { prettyLog('onReset ' + self) },
//    onStop: function(pos, self) { prettyLog('onStop ' + pos + ' ' + self) },
//    onStart: function(pos, self) { prettyLog('onStart ' + pos + ' ' + self) },
//    onDestroy: function(self) { prettyLog('onDestroy ' + self) }
//  });
});

function prettyLog(str) {
    console.log('%c ' + str, 'color: green; font-weight: bold;');
}

function toggleLoop(typed) {
    if (typed.loop) {
        typed.loop = false;
    } else {
        typed.loop = true;
    }
}


var typed = new Typed('#typed3', {
    strings: ['A WSM tecnologia em informática tem a solução para você, <span style="color:#f8975e">Infraestrutura de Redes</span>',
        'A WSM tecnologia em informática tem a solução para você, <span style="color:#f8975e">Gestão completa em TI</span>',
        'A WSM tecnologia em informática tem a solução para você, <span style="color:#f8975e">Servidores</span>',
        'A WSM tecnologia em informática tem a solução para você, <span style="color:#f8975e">Backup Corporativo</span>',
        'A WSM tecnologia em informática tem a solução para você, <span style="color:#f8975e">Marketing Digital</span>',
        'A WSM tecnologia em informática tem a solução para você, <span style="color:#f8975e">Desenvolvimento de Software</span>'],
    typeSpeed: 0,
    backSpeed: 30,
    startDelay: 200,
    typeSpeed: 40,
    smartBackspace: true,
    loop: false
});