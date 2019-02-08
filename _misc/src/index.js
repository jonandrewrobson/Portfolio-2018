import _ from 'lodash';
import './style.css';
import Icon from './icon.png';

function component() {
    let element = document.createElement('div');

    // Lodash, now imported by this script
    element.innerHTML = _.join(['Hello', ' webpack', ' this is cool']);
    element.classList.add('hello');

    var myIcon = new Image();
    myIcon.src = Icon;

    // Appends image
    element.appendChild(myIcon);
  
    return element;
  }
  
document.body.appendChild(component());