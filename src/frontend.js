import './frontend.scss';

import throttle from 'lodash/throttle';

document.querySelector('html').className.replace('no-js', 'js');
const setVh = () => {
  const vh = window.innerHeight * 0.01;
  document.documentElement.style.setProperty('--vh', `${vh}px`);
};
window.addEventListener('load', setVh);
window.addEventListener('resize', throttle(setVh, 100));

import './js/frontend/masthead.js';
import './js/frontend/menu.js';