require('classlist-polyfill');
const throttle = require('lodash/throttle');

/**
 * Add a bunch of events to the window object
 * @param {array|string} events Events to add to the window object
 * @param {function} callback Callback Function
 * @param {number} throttleTime Time to throttle if adding a single event
 * @param {boolean} immediateLaunch Immediately call callback function
 */
function windowListeners(events, callback, throttleTime, immediateLaunch) {
    if ( ! Array.isArray(events)) {
        events = [{ event: events, throttleTime: throttleTime}];
    }
    events.forEach(function(e) {
        cb = callback;
        if (e.throttleTime) {
            cb = throttle(callback, e.throttleTime);
        }
        window.addEventListener(e.event, cb);
    });
    if (immediateLaunch) {
        callback();
    }
}

// Detect when content goes under masthead
function detectBodyUnderMasthead() {
    var main = document.querySelector('body > main'),
        masthead = document.querySelector('body > .masthead'),
        mainPos = main.getBoundingClientRect(),
        mastheadPos = masthead.getBoundingClientRect(),
        hasClass = document.body.classList.contains('under-masthead');
    if (mainPos.top + mastheadPos.bottom + 10 < mastheadPos.top + mastheadPos.bottom) {
        if ( ! hasClass) document.body.classList.add('under-masthead');
    } else if (hasClass) {
        document.body.classList.remove('under-masthead');
    }
}
windowListeners(
    [
        { event: 'scroll', throttleTime: 100 },
        { event: 'resize', throttleTime: 1000 },
        { event: 'DOMContentLoaded' },
        { event: 'load' }
    ],
    detectBodyUnderMasthead,
    null,
    true
)

// Prevent masthead from getting too large or too small
var originalMastheadHeight;
function recalculateMastheadHeight() {
    var root = document.documentElement,
        masthead = document.querySelector('body > .masthead'),
        mastheadPos = masthead.getBoundingClientRect(),
        vh = window.innerHeight / 100;

    if ( ! originalMastheadHeight) {
        originalMastheadHeight = getComputedStyle(document.documentElement)
            .getPropertyValue('--' + window.THEME_PREFIX + '-masthead-height');
    }

    if (vh > 12) {
        root.style.setProperty('--' + window.THEME_PREFIX + '-masthead-height', '90px');
        return;
    }
    if (vh < 8.3) {
        root.style.setProperty('--' + window.THEME_PREFIX + '-masthead-height', '65px');
        return;
    }
    root.style.setProperty('--' + window.THEME_PREFIX + '-masthead-height', originalMastheadHeight);
}
windowListeners(
    [
        { event: 'resize', throttleTime: 1000 },
        { event: 'DOMContentLoaded' },
        { event: 'load' }
    ],
    recalculateMastheadHeight,
    null,
    true
);