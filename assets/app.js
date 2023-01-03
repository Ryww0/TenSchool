/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

// start the Stimulus application
import './bootstrap';

import './React/Components/Accordion'

const navSubjectsContainer = document.querySelector('.nav-subjects-all');
const navSubjectCaretRight = document.getElementById('nav-subjects-caret-right');

navSubjectsContainer.addEventListener('mouseover', () => {
    navSubjectsContainer.classList.toggle('left-nav-subjects')
    navSubjectCaretRight.classList.add('turn-carret-open')
});
navSubjectsContainer.addEventListener('mouseout', () => {
    navSubjectsContainer.classList.toggle('left-nav-subjects')
    navSubjectCaretRight.classList.remove('turn-carret-open')
});