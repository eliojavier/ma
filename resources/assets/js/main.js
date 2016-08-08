var Vue = require('vue');

import SquareLink from './components/SquareLink.vue';
import Counter from './components/Counter.vue';

new Vue({
    el: 'body',
    components: {
        square: SquareLink,
        counter: Counter
    },
    data: {
        picked: 'personalized',
        counters:[
            { subject: 'Motivador', icon: 'icon-motivador'},
            { subject: 'Interesante', icon: 'icon-interesante'},
            { subject: 'Satisfactorio', icon: 'icon-satisfactorio'},
            { subject: 'Informativo', icon: 'icon-informativo'},
            { subject: 'Soso', icon: 'icon-soso'},
            { subject: 'Aburrido', icon: 'icon-aburrido'}
        ]
    },
    ready(){
        console.log('Vue Ready to Go!');
    }
});
