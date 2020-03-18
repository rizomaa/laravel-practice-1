import Prism from 'prismjs';

export default {
    methods: {
        highlight() {
            const el = this.$refs.bodyHtml;
            //hileght only child elements
            if (el) Prism.highlightAllUnder(el);  
        },
    }
}