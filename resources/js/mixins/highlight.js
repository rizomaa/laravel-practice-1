import Prism from 'prismjs';

export default {
    methods: {
        highlight() {
            const el = this.$refs.bodyHtml;
            
            console.log('el', el);
            //hileght only child elements
            if (el) Prism.highlightAllUnder(el);  
        },
    }
}