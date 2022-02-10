function success() {
  document.getElementById("middleContent").style.display = "none";
  document.getElementById("success").style.display = "block";
}
// changes email form to successful subscription message
const app = new Vue({
    el: '#app',
    data: {
      errors: [],
      email: null,
      checkbox: null
    },
    methods: {
      checkForm: function (e) {
        this.errors = [];
        if (!this.email) {
          this.errors.push('Email address required.');
        } else if (!this.validEmail(this.email)) {
          this.errors.push('Please provide a valid e-mail address');
        } else if (this.columbia(this.email)) {
          this.errors.push('We are not accepting subscriptions from Columbia emails');
        }
        
        if (!this.checkbox) {
            this.errors.push("You must accept the terms and conditions");
        } 
        
        if (!this.errors.length) {
          success();
          return true;
        }

        e.preventDefault();
      },
      validEmail: function (email) {
        let re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
        //checks for valid email format
      },
      columbia: function (email) {
        let co = /^.+[co]$/;
        return co.test(email);
        //checks for columbia emails
      }
    }
})

/*using vue.js, checks if there is an email, if it's valid and if the checkbox is checked and executes success() if those things are validated*/