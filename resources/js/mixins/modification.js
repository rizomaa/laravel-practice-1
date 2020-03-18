import highlight from './highlight';

export default {
    
    mixins: [highlight],
    
    data() {
        return {
            editing: '',
        }
    },
            
    methods: {
        edit() {
            
            this.setEditCache();
            this.editing = true;
        },

        cancel () {
            this.restoreFromCache()
            this.editing = false;
        },
        
        //empty method NTB redeclared
        setEditCache () {
        },
        
        //empty method
        restoreFromCache() {
        },        
        
        update () {
            axios.put(this.endpoint, this.payLoad())
            .catch(({response}) => {
                this.$toast.error(response.data.message, "Error", { timeout: 3000});
            })                    
            .then(({data}) => {
                this.bodyHtml = data.body_html;    
                this.$toast.success(data.message, "Success", { timeout: 3000});
                this.editing = false;
            })
            .then(() => this.highlight());
        },
        
        //empty method
        payLoad() {      
        },
        
        
        destroy () {
            this.$toast.question('Are you sure about that?', 'Success', {
            timeout: 20000,
            close: false,
            overlay: true,
            displayMode: 'once',
            id: 'question',
            zindex: 999,
            position: 'center',
            buttons: [
                ['<button><b>YES</b></button>', (instance, toast) => {

                    this.delete();                      

                    instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

                }, true],
                ['<button>NO</button>', function (instance, toast) {

                    instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

                }],
            ]
            });
        },
        
        //empty method
        delete() {           
        }
        
        
        
    }
}