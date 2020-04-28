import Vote from '../components/Vote.vue';
import UserInfo from '../components/UserInfo.vue';
import MEditor from '../components/MEditor.vue';
import highlight from './highlight';
import destroy from './destroy';

export default {
    
    mixins: [highlight, destroy],
    
    data() {
        return {
            editing: '',
        }
    },    
            
    components: {
        Vote,
        UserInfo,
        MEditor
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
            });
        },
        
        //empty method
        payLoad() {      
        },
        
    }
}