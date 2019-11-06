'use strict';

let now = new Date();
let hours = (now.getHours() < 10 ? '0' : '') + now.getHours();
let minutes = (now.getMinutes() < 10 ? '0' : '') + now.getMinutes();
let nowFormated = hours + ':' + minutes;

$('#init_time_input').val(nowFormated);
new Picker(document.querySelector('#init_time_input'), {
    container: '#init_time_picker',
    controls: true,
    headers: true,
    inline: true,
    date: null,
    format: 'HH:mm',
    language: 'en-US',
    rows: 9,
});

$('#end_time_input').val(nowFormated);
new Picker(document.querySelector('#end_time_input'), {
    container: '#end_time_picker',
    controls: true,
    headers: true,
    inline: true,
    date: null,
    format: 'HH:mm',
    language: 'en-US',
    rows: 9,
});
