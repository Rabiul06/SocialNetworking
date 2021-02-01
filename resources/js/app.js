import axios from 'axios';

require('./bootstrap');

window.Vue = require('vue');



Vue.component('example-component', require('./components/ExampleComponent.vue').default);



const app = new Vue({
    el: '#app',
    data:{
    	
    	privetMassages:[],
    	singlMsgs:[],
      msgFrom: '',
      conID: ''
    },
    created(){
    	axios.get('/getMassage')
  .then(response => {
    // handle success
    console.log(response.data);
    app.privetMassages=response.data;
  })
  .catch(function (error) {
    // handle error
    console.log(error);
  });
    },
    methods:
    {
    	massage: function(id){
         	axios.get('/getMassage/' + id)
  .then(response => {
    // handle success
    console.log(response.data);
    app.singlMsgs=response.data;
    app.conID=response.data[0].conversion_id;
  })
  .catch(function (error) {
    // handle error
    console.log(error);
  });
},

inputHandler(e){
  if(e.keyCode ===13 && !e.shiftkey){
    e.preventDefault();
    this.sendMsg();
  }
},
sendMsg(){
  if(this.msgFrom){

    axios.post('/sendMassage/',{
      conID: this.conID,
      msg: this.msgFrom
    })
    .then(function (response){
      console.log(response.data);
      if(response.status===200){
        app.singlMsgs = response.data;
      }
    })
    .catch(function (error){
      console.log(error);
    });
  }
}
    } 

   
});
       