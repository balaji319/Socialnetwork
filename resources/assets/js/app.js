
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));

const app = new Vue({
    el: '#app',
    data: {
    	msg : 'Update New Post',
        oldpost : 'Posts',
    	content : '',
        posts : [],
        likes : [],
        comments:[],
        commentadd :{},
        commentSeen :false,
        image:'',
    },

    ready:function()
    {
     this.created();
    },

  created(){
       axios.get('http://127.0.0.1:8000/posts/display')
            .then(response => {
                console.log(response); //show if success
                this.posts = response.data;
                Vue.filter('mytime', function(value){
                   return moment(value).fromNow();
                });
            })

            .catch(function(response){
                console.log(error); // run if we have error
            });

           //display likes
            axios.get('http://127.0.0.1:8000/likes')
            .then(response => {
                console.log(response); //show if success
                this.likes = response.data;
            })

            .catch(function(response){
                console.log(error); // run if we have error
            })
     },

    methods : {
    	addpost(){
            vm = this;
    		axios.post('http://127.0.0.1:8000/addpost',{
    			content : this.content
    		})

    		.then(function(response){
                vm.content = '';
    			console.log('save Successfully'); //show if success
                if(response.status===200)
                {
                    app.posts = response.data;
                }
    		})

    		.catch(function(response){
    			console.log(error); // run if we have error
    		})
    	},

        deletepost(id)
        {
             axios.get('http://127.0.0.1:8000/deletepost/' + id)
            .then(response => {
                console.log(response); //show if success
                this.posts = response.data;
            })

            .catch(function(response){
                console.log(error); // run if we have error
            })
        },


        LikePost(id)
        {
            axios.get('http://127.0.0.1:8000/LikePost/' + id)
            .then(response => {
                console.log(response); //show if success
                this.posts = response.data;
            })

            .catch(function(response){
                console.log(error); // run if we have error
            })
        },

        sendcomment(post,key)
        {
            axios.post('http://127.0.0.1:8000/addcomments',{
                comment : this.commentadd[key],
                id :  post.id
            })

            .then(function(response){
                console.log('save Successfully'); //show if success
               
                if(response.status===200)
                {
                    app.posts = response.data;
                }
            })

            .catch(function(response){
                console.log(error); // run if we have error
            })
        },

      // save imge by vue 
        onfilechange(e){
            var files = e.target.files || e.dataTransfer.files;
            this.createImg(files[0]);
        },

        createImg(file){
            //we will priview our img before upload
            var image = new Image;
            var reader = new FileReader;

            reader.onload = (e) =>{
                this.image = e.target.result;
            };
            reader.readAsDataURL(file);
        },

        uploadImg(){
           axios.post('http://127.0.0.1:8000/saveImg',{
               image : this.image,
               content : this.content
            })

            .then((response) => {
                console.log("save Successfully"); //show if success
                this.image = '';
                this.content = ''; 
                if(response.status===200)
                {
                    app.posts = response.data;
                }             
            })

            .catch(function(response){
                console.log(error); // run if we have error
            })
        },

        removeImg(){
            this.image = ''
        }
    }
});
